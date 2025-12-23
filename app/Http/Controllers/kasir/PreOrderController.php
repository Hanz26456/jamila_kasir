<?php

// ========================================
// FILE: app/Http/Controllers/Kasir/PreOrderController.php
// ========================================
//
namespace App\Http\Controllers\Kasir;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use App\Models\PreOrderPayment;
use App\Models\PreOrderStatusHistory;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class PreOrderController extends Controller
{
    // Lihat Daftar Pre-Order
    public function index(Request $request)
    {
        $query = PreOrder::with(['customer', 'creator'])
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter delivery hari ini
        if ($request->has('today')) {
            $query->whereDate('delivery_date', today());
        }

        $preOrders = $query->paginate(10);

        // Quick stats
        $stats = [
            'ready_today' => PreOrder::whereDate('delivery_date', today())
                ->where('status', 'ready')
                ->count(),
            'pickup_today' => PreOrder::whereDate('delivery_date', today())
                ->whereIn('status', ['ready', 'in_production'])
                ->count(),
        ];

        return view('kasir.pages.pre-orders.index', compact('preOrders', 'stats'));
    }

    // Form Create Pre-Order (Kasir juga bisa input)
    public function create()
    {
        $customers = Customer::all();
        return view('kasir.pages.pre-orders.create', compact('customers'));
    }

    // Store Pre-Order (simplified untuk kasir)
    public function store(Request $request)
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,id',
            'delivery_date' => 'required|date|after:today',
            'order_type' => 'required|in:custom_cake,pre_order,catering',
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'design_notes' => 'nullable|string',
            'reference_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'quantity' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric|min:0',
            'dp_percentage' => 'required|integer|min:0|max:100',
            'delivery_method' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:delivery_method,delivery',
            'customer_notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $orderNumber = $this->generateOrderNumber();
            
            $imagePath = null;
            if ($request->hasFile('reference_image')) {
                $imagePath = $request->file('reference_image')
                    ->store('pre-orders/references', 'public');
            }

            $totalPrice = $validated['quantity'] * $validated['price_per_unit'];
            $dpAmount = ($totalPrice * $validated['dp_percentage']) / 100;
            $remainingPayment = $totalPrice - $dpAmount;

            $preOrder = PreOrder::create([
                'customer_id' => $validated['customer_id'],
                'created_by' => Auth::id(),
                'order_number' => $orderNumber,
                'order_date' => now(),
                'delivery_date' => $validated['delivery_date'],
                'order_type' => $validated['order_type'],
                'status' => 'pending',
                'product_name' => $validated['product_name'],
                'description' => $validated['description'],
                'design_notes' => $validated['design_notes'],
                'reference_image' => $imagePath,
                'quantity' => $validated['quantity'],
                'price_per_unit' => $validated['price_per_unit'],
                'total_price' => $totalPrice,
                'dp_amount' => $dpAmount,
                'dp_percentage' => $validated['dp_percentage'],
                'remaining_payment' => $remainingPayment,
                'payment_status' => 'unpaid',
                'delivery_method' => $validated['delivery_method'],
                'delivery_address' => $validated['delivery_address'] ?? null,
                'customer_notes' => $validated['customer_notes'],
            ]);

            DB::commit();

            return redirect()->route('kasir.pre-orders.show', $preOrder)
                ->with('success', "Pre-order berhasil dibuat! Order Number: {$orderNumber}");

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Detail Pre-Order
    public function show($id)
    {
        $preOrder = PreOrder::with([
            'customer', 
            'creator', 
            'payments.processor',
            'statusHistory.changer'
        ])->findOrFail($id);

        return view('kasir.pages.pre-orders.show', compact('preOrder'));
    }

    // Antrean Pre-Order untuk Pembayaran
    public function antrean()
    {
        // Pre-order yang siap diambil dan belum lunas
        $preOrders = PreOrder::with(['customer', 'payments'])
            ->whereIn('status', ['ready', 'in_production'])
            ->whereIn('payment_status', ['unpaid', 'dp_paid'])
            ->whereDate('delivery_date', '<=', today())
            ->orderBy('delivery_date')
            ->paginate(10);

        return view('kasir.pages.pre-orders.payment-queue', compact('preOrders'));
    }

    // Form Bayar DP
    public function showPayDP($id)
    {
        $preOrder = PreOrder::with('customer')->findOrFail($id);

        if ($preOrder->payment_status !== 'unpaid') {
            return back()->with('error', 'Pre-order sudah dibayar DP!');
        }

        return view('kasir.pages.pre-orders.pay-dp', compact('preOrder'));
    }

    // Process Bayar DP
    public function payDP(Request $request, $id)
    {
        $preOrder = PreOrder::findOrFail($id);

        if ($preOrder->payment_status !== 'unpaid') {
            return back()->with('error', 'Pre-order sudah dibayar DP!');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:cash,qris,bank_transfer',
            'amount' => 'required|numeric|min:' . $preOrder->dp_amount,
        ], [
            'amount.min' => 'Nominal DP minimal Rp ' . number_format($preOrder->dp_amount, 0, ',', '.'),
        ]);

        DB::beginTransaction();
        try {
            $change = $validated['payment_method'] === 'cash' 
                ? $validated['amount'] - $preOrder->dp_amount 
                : 0;

            // Create payment record
            PreOrderPayment::create([
                'pre_order_id' => $preOrder->id,
                'payment_type' => 'dp',
                'payment_method' => $validated['payment_method'],
                'amount' => $validated['amount'],
                'change' => $change,
                'paid_at' => now(),
                'processed_by' => Auth::id(),
            ]);

            // Update status
            $preOrder->update([
                'payment_status' => 'dp_paid',
                'status' => 'confirmed',
            ]);

            // Log history
            PreOrderStatusHistory::create([
                'pre_order_id' => $preOrder->id,
                'old_status' => 'pending',
                'new_status' => 'confirmed',
                'notes' => 'DP dibayar: Rp ' . number_format($validated['amount'], 0, ',', '.'),
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);

            DB::commit();

            $message = 'Pembayaran DP berhasil!';
            if ($change > 0) {
                $message .= ' Kembalian: Rp ' . number_format($change, 0, ',', '.');
            }

            return redirect()->route('kasir.pre-orders.index')
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    // Form Pelunasan
    public function showPayRemaining($id)
    {
        $preOrder = PreOrder::with('customer')->findOrFail($id);

        if ($preOrder->payment_status !== 'dp_paid') {
            return back()->with('error', 'DP belum dibayar atau sudah lunas!');
        }

        return view('kasir.pages.pre-orders.pay-remaining', compact('preOrder'));
    }

    // Process Pelunasan
    public function payRemaining(Request $request, $id)
    {
        $preOrder = PreOrder::findOrFail($id);

        if ($preOrder->payment_status !== 'dp_paid') {
            return back()->with('error', 'DP belum dibayar atau sudah lunas!');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:cash,qris,bank_transfer',
            'amount' => 'required|numeric|min:' . $preOrder->remaining_payment,
        ], [
            'amount.min' => 'Nominal pelunasan minimal Rp ' . number_format($preOrder->remaining_payment, 0, ',', '.'),
        ]);

        DB::beginTransaction();
        try {
            $change = $validated['payment_method'] === 'cash' 
                ? $validated['amount'] - $preOrder->remaining_payment 
                : 0;

            // Create payment record
            PreOrderPayment::create([
                'pre_order_id' => $preOrder->id,
                'payment_type' => 'remaining_payment',
                'payment_method' => $validated['payment_method'],
                'amount' => $validated['amount'],
                'change' => $change,
                'paid_at' => now(),
                'processed_by' => Auth::id(),
            ]);

            // Update status
            $preOrder->update([
                'payment_status' => 'paid',
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            // Log history
            PreOrderStatusHistory::create([
                'pre_order_id' => $preOrder->id,
                'old_status' => $preOrder->status,
                'new_status' => 'completed',
                'notes' => 'Pelunasan: Rp ' . number_format($validated['amount'], 0, ',', '.'),
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);

            DB::commit();

            $message = 'Pelunasan berhasil! Pre-order selesai.';
            if ($change > 0) {
                $message .= ' Kembalian: Rp ' . number_format($change, 0, ',', '.');
            }

            return redirect()->route('kasir.pre-orders.print', $preOrder)
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    // Print Struk Pre-Order
    public function print($id)
    {
        $preOrder = PreOrder::with([
            'customer', 
            'creator', 
            'payments.processor'
        ])->findOrFail($id);

        return view('kasir.pages.pre-orders.print', compact('preOrder'));
    }

    // Update Status (untuk kasir yang bisa update status)
    public function updateStatus(Request $request, $id)
    {
        $preOrder = PreOrder::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,in_production,ready,completed',
        ]);

        DB::beginTransaction();
        try {
            $oldStatus = $preOrder->status;

            $preOrder->update(['status' => $validated['status']]);

            // Log history
            PreOrderStatusHistory::create([
                'pre_order_id' => $preOrder->id,
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'notes' => 'Status diupdate oleh kasir',
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);

            DB::commit();

            return back()->with('success', 'Status berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    // Stock Pre-Order (untuk lihat jadwal produksi)
    public function schedule()
    {
        $preOrders = PreOrder::with(['customer'])
            ->whereIn('status', ['confirmed', 'in_production'])
            ->whereBetween('delivery_date', [today(), today()->addDays(7)])
            ->orderBy('delivery_date')
            ->get()
            ->groupBy(function($item) {
                return Carbon::parse($item->delivery_date)->format('Y-m-d');
            });

        return view('kasir.pages.pre-orders.schedule', compact('preOrders'));
    }

    // Private Helper: Generate Order Number
    private function generateOrderNumber()
    {
        $date = now()->format('Ymd');
        $lastOrder = PreOrder::whereDate('created_at', today())
            ->orderBy('id', 'desc')
            ->first();

        $sequence = $lastOrder ? (int) substr($lastOrder->order_number, -4) + 1 : 1;

        return 'PO-' . $date . '-' . str_pad($sequence, 4, '0', STR_PAD_LEFT);
    }
}