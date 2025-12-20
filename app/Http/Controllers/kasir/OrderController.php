<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use App\Models\Voucher; 
use App\Models\OrderItem;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with(['customer', 'creator'])
                    ->latest()
                    ->paginate(10);
        
        return view('kasir.pages.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('status', 1)->where('stock', '>', 0)->get();
        return view('kasir.pages.orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'voucher_code' => 'nullable|string|exists:vouchers,code',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat Header Order
            $order = Order::create([
                'customer_id' => $validated['customer_id'],
                'created_by' => Auth::id(),
                'order_date' => now(),
                'pickup_date' => $validated['pickup_date'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_price' => 0,
            ]);

            $subtotal = 0;

            // 2. Tambahkan Order Items & Cek Stok
            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi!");
                }

                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal, 
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            // 3. Logika Voucher dengan Limit Pemakaian
            $totalFinal = $subtotal;
            if ($request->filled('voucher_code')) {
                $voucher = Voucher::where('code', $request->voucher_code)
                    ->where('status', 1)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->first();

                if ($voucher) {
                    // VALIDASI LIMIT KUOTA VOUCHER
                    if ($voucher->usage_limit > 0 && $voucher->used_count >= $voucher->usage_limit) {
                        throw new \Exception("Maaf, kuota voucher ini sudah habis terpakai!");
                    }

                    // Hitung Diskon
                    if ($voucher->discount_type == 'fixed') {
                        $totalFinal = $subtotal - $voucher->discount_value;
                    } else {
                        $totalFinal = $subtotal - ($subtotal * ($voucher->discount_value / 100));
                    }
                    
                    $totalFinal = max(0, $totalFinal);

                    // UPDATE COUNTER PEMAKAIAN VOUCHER
                    $voucher->increment('used_count');

                } else {
                    throw new \Exception("Voucher tidak valid atau sudah kedaluwarsa!");
                }
            }

            // 4. Update Total Harga Akhir
            $order->update(['total_price' => $totalFinal]);

            DB::commit();
            
            return redirect()->route('kasir.orders.index')
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show($id)
    {
        $order = Order::with(['customer', 'orderItems.product', 'payment'])->findOrFail($id);
        return view('kasir.pages.orders.show', compact('order'));
    }

    public function antrean()
    {
        $orders = Order::with(['customer', 'orderItems.product'])
                    ->where('payment_status', 'unpaid')
                    ->where('status', '!=', 'canceled')
                    ->latest()
                    ->paginate(10);
        return view('kasir.pages.payments.index', compact('orders'));
    }

    public function bayar(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        
        $request->validate([
            'payment_method' => 'required|in:cash,qris,bank_transfer',
            'bayar' => $request->payment_method == 'cash' 
                ? 'required|numeric|min:' . $order->total_price 
                : 'nullable',
        ], [
            'bayar.min' => 'Uang yang dimasukkan kurang!',
        ]);

        DB::beginTransaction();
        try {
            $bayarNominal = $request->payment_method == 'cash' ? $request->bayar : $order->total_price;
            $kembalian = $bayarNominal - $order->total_price;

            // Simpan data pembayaran (untuk sinkronisasi dengan kembalian di struk/laporan)
            Payment::create([
                'order_id' => $order->id,
                'payment_method' => $request->payment_method,
                'amount' => $bayarNominal,
                'change' => $kembalian,
                'paid_at' => now(),
            ]);

            // Update status menjadi lunas
            $order->update([
                'payment_status' => 'paid',
                'status'         => 'done',
            ]);

            DB::commit();
            return back()->with('success', 'Pembayaran Berhasil! Kembalian: Rp ' . number_format($kembalian, 0, ',', '.'));
            
        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }

    public function print($id)
    {
        $order = Order::with(['customer', 'creator', 'orderItems.product', 'payment'])->findOrFail($id);
        
        // Mengarahkan ke view khusus cetak thermal
        return view('kasir.pages.orders.print', compact('order'));
    }
    public function stock()
    {
        $products = Product::with('category')
                    ->where('status', 1)
                    ->orderBy('stock', 'asc')
                    ->get();
                    
        return view('kasir.pages.products.stock', compact('products'));
    }
}