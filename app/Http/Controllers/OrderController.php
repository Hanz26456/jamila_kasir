<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Customer;
use App\Models\Product;
use App\Models\OrderItem;
use App\Models\Voucher; // Pastikan Model Voucher di-import
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    // Tampilkan semua pesanan
    public function index()
    {
        $orders = Order::with(['customer', 'creator'])
            ->latest()
            ->paginate(15);
        
        return view('admin.pages.orders.index', compact('orders'));
    }

    public function create()
    {
        $customers = Customer::all();
        $products = Product::where('status', 1)->where('stock', '>', 0)->get();
        
        return view('admin.pages.orders.create', compact('customers', 'products'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'voucher_code' => 'nullable|string|exists:vouchers,code',
            'products' => 'required|array|min:1',
            'products.*.product_id' => 'required|exists:products,id',
            'products.*.quantity' => 'required|integer|min:1',
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

            // 2. Tambahkan Order Items & Kurangi Stok
            foreach ($validated['products'] as $item) {
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

            // 3. LOGIKA VOUCHER DENGAN LIMIT PEMAKAIAN
            $totalFinal = $subtotal;
            if ($request->filled('voucher_code')) {
                $voucher = Voucher::where('code', $request->voucher_code)
                    ->where('status', 1)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->first();

                if ($voucher) {
                    // CEK LIMIT KUOTA VOUCHER
                    if ($voucher->usage_limit > 0 && $voucher->used_count >= $voucher->usage_limit) {
                        throw new \Exception("Maaf, kuota penggunaan voucher {$voucher->code} sudah habis!");
                    }

                    // Hitung potongan harga
                    if ($voucher->discount_type == 'fixed') {
                        $totalFinal = $subtotal - $voucher->discount_value;
                    } else {
                        $totalFinal = $subtotal - ($subtotal * ($voucher->discount_value / 100));
                    }
                    
                    // Pastikan total tidak negatif
                    $totalFinal = max(0, $totalFinal);

                    // TAMBAH COUNTER PEMAKAIAN VOUCHER
                    $voucher->increment('used_count');
                    
                } else {
                    throw new \Exception("Voucher tidak valid atau sudah kedaluwarsa!");
                }
            }

            // 4. Update total harga akhir ke tabel orders
            $order->update(['total_price' => $totalFinal]);

            DB::commit();
            return redirect()->route('admin.orders.show', $order)
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    public function show(Order $order)
    {
        $order->load(['customer', 'creator', 'orderItems.product', 'payment']);
        return view('admin.pages.orders.show', compact('order'));
    }

    /**
     * FITUR CETAK STRUK
     */
    public function print(Order $order)
    {
        // Load relasi agar data struk lengkap
        $order->load(['customer', 'creator', 'orderItems.product', 'payment']);
        
        // Struk biasanya dicetak setelah pembayaran (Payment Status: Paid)
        return view('admin.pages.orders.print', compact('order'));
    }

    public function updateStatus(Request $request, Order $order)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,processing,done,canceled',
        ]);

        if ($validated['status'] == 'canceled' && $order->status != 'canceled') {
            foreach ($order->orderItems as $item) {
                $item->product->increment('stock', $item->quantity);
            }
        }
        
        if ($order->status == 'canceled' && $validated['status'] != 'canceled') {
            foreach ($order->orderItems as $item) {
                if ($item->product->stock < $item->quantity) {
                     return back()->with('error', "Gagal mengaktifkan kembali. Stok {$item->product->name} habis.");
                }
                $item->product->decrement('stock', $item->quantity);
            }
        }

        $order->update(['status' => $validated['status']]);
        return back()->with('success', 'Status pesanan diperbarui!');
    }
}