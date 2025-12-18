<?php

namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\OrderItem;

class OrderController extends Controller
{
    public function index()
{
    // Mengambil data pesanan beserta relasi pelanggan dan pembuatnya
    $orders = \App\Models\Order::with(['customer', 'creator'])
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
        // Pastikan nama di validation sama dengan nama di Blade (input name="items[0][product_id]")
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'pickup_date' => 'required|date|after_or_equal:today',
            'voucher_code' => 'nullable|string|exists:vouchers,code',
            'items' => 'required|array|min:1', // Sesuaikan 'items' jika di Blade pakai name="items"
            'items.*.product_id' => 'required|exists:products,id',
            'items.*.quantity' => 'required|integer|min:1',
        ]);

        DB::beginTransaction();
        try {
            // 1. Buat Header Order
            $order = Order::create([
                'customer_id' => $validated['customer_id'],
                'created_by' => Auth::id(), // Solusi Error Field 'created_by'
                'order_date' => now(),
                'pickup_date' => $validated['pickup_date'],
                'status' => 'pending',
                'payment_status' => 'unpaid',
                'total_price' => 0,
            ]);

            $subtotal = 0;

            // 2. Tambahkan Order Items
            foreach ($validated['items'] as $item) {
                $product = Product::findOrFail($item['product_id']);
                
                if ($product->stock < $item['quantity']) {
                    throw new \Exception("Stok {$product->name} tidak mencukupi!");
                }

                $itemSubtotal = $product->price * $item['quantity'];
                $subtotal += $itemSubtotal;

                // Solusi Error Field 'subtotal'
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                    'subtotal' => $itemSubtotal, 
                ]);

                $product->decrement('stock', $item['quantity']);
            }

            // 3. Logika Voucher
            $totalFinal = $subtotal;
            if ($request->filled('voucher_code')) {
                $voucher = \App\Models\Voucher::where('code', $request->voucher_code)
                    ->where('status', 1)
                    ->whereDate('start_date', '<=', now())
                    ->whereDate('end_date', '>=', now())
                    ->first();

                if ($voucher) {
                    if ($voucher->discount_type == 'fixed') {
                        $totalFinal = $subtotal - $voucher->discount_value;
                    } else {
                        $totalFinal = $subtotal - ($subtotal * ($voucher->discount_value / 100));
                    }
                    $totalFinal = max(0, $totalFinal);
                } else {
                    throw new \Exception("Voucher tidak valid atau sudah kedaluwarsa!");
                }
            }

            // 4. Update Total Harga Akhir
            $order->update(['total_price' => $totalFinal]);

            DB::commit();
            
            // Redirect ke halaman index kasir, bukan admin
            return redirect()->route('kasir.orders.index')
                ->with('success', 'Pesanan berhasil dibuat!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }
    public function show($id)
{
    // Ambil data order beserta relasi yang dibutuhkan
    $order = \App\Models\Order::with(['customer', 'orderItems.product'])->findOrFail($id);
    
    // Pastikan mengarah ke view detail milik kasir
    return view('kasir.pages.orders.show', compact('order'));
}
public function antrean()
{
    $orders = \App\Models\Order::with('customer')
                ->where('payment_status', 'unpaid')
                ->where('status', '!=', 'canceled')
                ->latest()
                ->paginate(10);
    return view('kasir.pages.payments.index', compact('orders'));
}

// Proses simpan pembayaran (Uang Tunai & Kembalian)
public function bayar(Request $request, $id)
{
    $order = \App\Models\Order::findOrFail($id);
    
    $request->validate([
        'payment_method' => 'required|in:cash,qris,bank_transfer',
        'bayar' => $request->payment_method == 'cash' 
            ? 'required|numeric|min:' . $order->total_price 
            : 'nullable',
    ], [
        // Pesan error kustom
        'bayar.min' => 'Uang yang dimasukkan kurang! Minimal: Rp ' . number_format($order->total_price, 0, ',', '.'),
    ]);

    $order->update([
        'payment_status' => 'paid',
        'status'         => 'done',
        'payment_method' => $request->payment_method,
    ]);

    return back()->with('success', 'Pembayaran Berhasil via ' . strtoupper($request->payment_method));
}
public function stock()
{
    // Mengambil produk yang aktif, diurutkan dari stok terkecil agar kasir waspada
    $products = \App\Models\Product::where('status', 1)
                ->orderBy('stock', 'asc')
                ->get();
                
    return view('kasir.pages.products.stock', compact('products'));
}
}
