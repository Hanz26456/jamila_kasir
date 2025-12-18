<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PaymentController extends Controller
{
    public function index()
{
    $pendingOrders = Order::with('customer')
        ->where('payment_status', 'unpaid')
        ->where('status', 'processing') 
        ->latest()
        ->paginate(15);

    return view('admin.pages.payments.index', compact('pendingOrders'));
}
    public function create(Order $order)
    {
        // Cegah bayar jika sudah lunas
        if ($order->payment_status === 'paid') {
            return redirect()->route('admin.orders.show', $order)->with('error', 'Pesanan ini sudah lunas.');
        }
        return view('admin.pages.payments.create', compact('order'));
    }

   public function store(Request $request, Order $order)
{
    $request->validate([
        'payment_method' => 'required|in:cash,qris,bank_transfer',
        'amount' => 'required|numeric|min:' . $order->total_price,
    ], [
        'amount.min' => 'Jumlah bayar tidak boleh kurang dari total tagihan.'
    ]);

    DB::beginTransaction();
    try {
        // 1. Simpan data payment
        Payment::create([
            'order_id' => $order->id,
            'payment_method' => $request->payment_method,
            'amount' => $request->amount,
            'paid_at' => now(),
        ]);

        // 2. Update status order menjadi paid DAN otomatis status pesanan menjadi 'done'
        $order->update([
            'payment_status' => 'paid',
            'status' => 'done' // Otomatis selesai setelah dibayar
        ]);

        DB::commit();
        return redirect()->route('admin.orders.show', $order)->with('success', 'Pembayaran berhasil diproses dan pesanan selesai!');
        
    } catch (\Exception $e) {
        DB::rollback();
        return back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
    }
}
}