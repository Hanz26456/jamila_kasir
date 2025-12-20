<?php
namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\PreOrder;
use App\Models\PreOrderPayment;
use App\Models\PreOrderStatusHistory;
use App\Models\PreOrderReminder;
use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon;

class PreOrderController extends Controller
{
    // Dashboard Pre-Order
    public function index(Request $request)
    {
        $query = PreOrder::with(['customer', 'creator'])
            ->latest();

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by delivery date
        if ($request->filled('delivery_date')) {
            $query->whereDate('delivery_date', $request->delivery_date);
        }

        // Filter by payment status
        if ($request->filled('payment_status')) {
            $query->where('payment_status', $request->payment_status);
        }

        $preOrders = $query->paginate(15);

        // Stats untuk dashboard
        $stats = [
            'pending' => PreOrder::where('status', 'pending')->count(),
            'confirmed' => PreOrder::where('status', 'confirmed')->count(),
            'in_production' => PreOrder::where('status', 'in_production')->count(),
            'ready' => PreOrder::where('status', 'ready')->count(),
            'delivery_today' => PreOrder::whereDate('delivery_date', today())->count(),
        ];

        return view('admin.pages.pre-orders.index', compact('preOrders', 'stats'));
    }

    // Form Create Pre-Order
    public function create()
    {
        $customers = Customer::all();
        return view('admin.pages.pre-orders.create', compact('customers'));
    }

    // Store Pre-Order
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
            
            // Spesifikasi
            'spec_size' => 'nullable|string',
            'spec_flavor' => 'nullable|string',
            'spec_shape' => 'nullable|string',
            'spec_color_theme' => 'nullable|string',
            'spec_topping' => 'nullable|string',
            'spec_filling' => 'nullable|string',
            
            // Pricing
            'quantity' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric|min:0',
            'dp_percentage' => 'required|integer|min:0|max:100',
            
            // Delivery
            'delivery_method' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:delivery_method,delivery',
            'delivery_fee' => 'nullable|numeric|min:0',
            
            'customer_notes' => 'nullable|string',
            'admin_notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Generate order number
            $orderNumber = $this->generateOrderNumber();

            // Handle image upload
            $imagePath = null;
            if ($request->hasFile('reference_image')) {
                $imagePath = $request->file('reference_image')
                    ->store('pre-orders/references', 'public');
            }

            // Build specifications JSON
            $specifications = [
                'size' => $request->spec_size,
                'flavor' => $request->spec_flavor,
                'shape' => $request->spec_shape,
                'color_theme' => $request->spec_color_theme,
                'topping' => $request->spec_topping,
                'filling' => $request->spec_filling,
            ];

            // Calculate pricing
            $totalPrice = $validated['quantity'] * $validated['price_per_unit'];
            $dpAmount = ($totalPrice * $validated['dp_percentage']) / 100;
            $remainingPayment = $totalPrice - $dpAmount;

            // Create pre-order
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
                'specifications' => $specifications,
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
                'delivery_fee' => $validated['delivery_fee'] ?? 0,
                'customer_notes' => $validated['customer_notes'],
                'admin_notes' => $validated['admin_notes'],
            ]);

            // Create automatic reminders
            $this->createReminders($preOrder);

            DB::commit();

            return redirect()->route('admin.pre-orders.show', $preOrder)
                ->with('success', "Pre-order berhasil dibuat! Order Number: {$orderNumber}");

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Show Pre-Order Detail


public function show(PreOrder $preOrder)
{
    $preOrder->load([
        'customer',
        'statusHistories.changer',
    ]);

    return view('admin.pages.pre-orders.show', compact('preOrder'));
}



    // Form Edit Pre-Order
    public function edit(PreOrder $preOrder)
    {
        if ($preOrder->status !== 'pending') {
            return back()->with('error', 'Hanya pre-order dengan status pending yang bisa diedit!');
        }

        $customers = Customer::all();
        return view('admin.pages.pre-orders.edit', compact('preOrder', 'customers'));
    }

    // Update Pre-Order
    public function update(Request $request, PreOrder $preOrder)
    {
        if ($preOrder->status !== 'pending') {
            return back()->with('error', 'Hanya pre-order dengan status pending yang bisa diupdate!');
        }

        $validated = $request->validate([
            'delivery_date' => 'required|date|after:today',
            'product_name' => 'required|string|max:255',
            'description' => 'required|string',
            'design_notes' => 'nullable|string',
            'reference_image' => 'nullable|image|mimes:jpeg,png,jpg|max:5120',
            'quantity' => 'required|integer|min:1',
            'price_per_unit' => 'required|numeric|min:0',
            'dp_percentage' => 'required|integer|min:0|max:100',
            'delivery_method' => 'required|in:pickup,delivery',
            'delivery_address' => 'required_if:delivery_method,delivery',
            'admin_notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            // Handle new image
            if ($request->hasFile('reference_image')) {
                // Delete old image
                if ($preOrder->reference_image) {
                    Storage::disk('public')->delete($preOrder->reference_image);
                }
                $validated['reference_image'] = $request->file('reference_image')
                    ->store('pre-orders/references', 'public');
            }

            // Recalculate pricing
            $totalPrice = $validated['quantity'] * $validated['price_per_unit'];
            $dpAmount = ($totalPrice * $validated['dp_percentage']) / 100;
            $remainingPayment = $totalPrice - $dpAmount;

            $preOrder->update([
                'delivery_date' => $validated['delivery_date'],
                'product_name' => $validated['product_name'],
                'description' => $validated['description'],
                'design_notes' => $validated['design_notes'],
                'quantity' => $validated['quantity'],
                'price_per_unit' => $validated['price_per_unit'],
                'total_price' => $totalPrice,
                'dp_amount' => $dpAmount,
                'dp_percentage' => $validated['dp_percentage'],
                'remaining_payment' => $remainingPayment,
                'delivery_method' => $validated['delivery_method'],
                'delivery_address' => $validated['delivery_address'] ?? null,
                'admin_notes' => $validated['admin_notes'],
            ] + ($request->hasFile('reference_image') ? ['reference_image' => $validated['reference_image']] : []));

            DB::commit();

            return redirect()->route('admin.pre-orders.show', $preOrder)
                ->with('success', 'Pre-order berhasil diupdate!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->withInput()->with('error', $e->getMessage());
        }
    }

    // Update Status Pre-Order
    public function updateStatus(Request $request, PreOrder $preOrder)
    {
        $validated = $request->validate([
            'status' => 'required|in:pending,confirmed,in_production,ready,completed,canceled',
            'notes' => 'nullable|string',
        ]);

        if ($preOrder->status === $validated['status']) {
            return back()->with('info', 'Status tidak berubah.');
        }

        DB::beginTransaction();
        try {
            $oldStatus = $preOrder->status;

            // Validasi status flow
            if ($validated['status'] === 'completed' && $preOrder->payment_status !== 'paid') {
                throw new \Exception('Pre-order belum lunas! Tidak bisa diselesaikan.');
            }

            // Update status
            $updateData = ['status' => $validated['status']];
            
            if ($validated['status'] === 'completed') {
                $updateData['completed_at'] = now();
            }
            
            if ($validated['status'] === 'canceled') {
                $updateData['canceled_at'] = now();
                if ($request->filled('cancellation_reason')) {
                    $updateData['cancellation_reason'] = $request->cancellation_reason;
                }
            }

            $preOrder->update($updateData);

            // Log status history
            PreOrderStatusHistory::create([
                'pre_order_id' => $preOrder->id,
                'old_status' => $oldStatus,
                'new_status' => $validated['status'],
                'notes' => $validated['notes'],
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

    // Process DP Payment
    public function payDP(Request $request, PreOrder $preOrder)
    {
        if ($preOrder->payment_status !== 'unpaid') {
            return back()->with('error', 'Pre-order sudah dibayar DP!');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:cash,qris,bank_transfer',
            'amount' => 'required|numeric|min:' . $preOrder->dp_amount,
            'proof_image' => 'required_if:payment_method,bank_transfer|nullable|image|max:5120',
            'notes' => 'nullable|string',
        ]);

        DB::beginTransaction();
        try {
            $proofPath = null;
            if ($request->hasFile('proof_image')) {
                $proofPath = $request->file('proof_image')
                    ->store('pre-orders/payments', 'public');
            }

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
                'proof_image' => $proofPath,
                'notes' => $validated['notes'],
                'paid_at' => now(),
                'processed_by' => Auth::id(),
            ]);

            // Update pre-order status
            $preOrder->update([
                'payment_status' => 'dp_paid',
                'status' => 'confirmed',
            ]);

            // Log status change
            PreOrderStatusHistory::create([
                'pre_order_id' => $preOrder->id,
                'old_status' => $preOrder->status,
                'new_status' => 'confirmed',
                'notes' => 'DP sebesar Rp ' . number_format($validated['amount'], 0, ',', '.') . ' telah dibayar',
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);

            DB::commit();

            $message = 'Pembayaran DP berhasil!';
            if ($change > 0) {
                $message .= ' Kembalian: Rp ' . number_format($change, 0, ',', '.');
            }

            return back()->with('success', $message);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    // Process Remaining Payment (Pelunasan)
    public function payRemaining(Request $request, PreOrder $preOrder)
    {
        if ($preOrder->payment_status !== 'dp_paid') {
            return back()->with('error', 'DP belum dibayar atau sudah lunas!');
        }

        $validated = $request->validate([
            'payment_method' => 'required|in:cash,qris,bank_transfer',
            'amount' => 'required|numeric|min:' . $preOrder->remaining_payment,
            'notes' => 'nullable|string',
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
                'notes' => $validated['notes'],
                'paid_at' => now(),
                'processed_by' => Auth::id(),
            ]);

            // Update pre-order
            $preOrder->update([
                'payment_status' => 'paid',
                'status' => 'completed',
                'completed_at' => now(),
            ]);

            // Log status change
            PreOrderStatusHistory::create([
                'pre_order_id' => $preOrder->id,
                'old_status' => $preOrder->status,
                'new_status' => 'completed',
                'notes' => 'Pelunasan sebesar Rp ' . number_format($validated['amount'], 0, ',', '.'),
                'changed_by' => Auth::id(),
                'changed_at' => now(),
            ]);

            DB::commit();

            $message = 'Pelunasan berhasil! Pre-order selesai.';
            if ($change > 0) {
                $message .= ' Kembalian: Rp ' . number_format($change, 0, ',', '.');
            }

            return redirect()->route('admin.pre-orders.print', $preOrder)
                ->with('success', $message);

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
    }

    // Print Pre-Order (Struk/Invoice)
    public function print(PreOrder $preOrder)
    {
        $preOrder->load(['customer', 'creator', 'payments.processor']);
        return view('admin.pages.pre-orders.print', compact('preOrder'));
    }

    // Delete Pre-Order (hanya jika pending)
    public function destroy(PreOrder $preOrder)
    {
        if ($preOrder->status !== 'pending') {
            return back()->with('error', 'Hanya pre-order pending yang bisa dihapus!');
        }

        DB::beginTransaction();
        try {
            // Delete reference image if exists
            if ($preOrder->reference_image) {
                Storage::disk('public')->delete($preOrder->reference_image);
            }

            // Delete all payment proof images
            foreach ($preOrder->payments as $payment) {
                if ($payment->proof_image) {
                    Storage::disk('public')->delete($payment->proof_image);
                }
            }

            $preOrder->delete();

            DB::commit();

            return redirect()->route('admin.pre-orders.index')
                ->with('success', 'Pre-order berhasil dihapus!');

        } catch (\Exception $e) {
            DB::rollback();
            return back()->with('error', $e->getMessage());
        }
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

    // Private Helper: Create Reminders
    private function createReminders(PreOrder $preOrder)
    {
        $deliveryDate = Carbon::parse($preOrder->delivery_date);

        // Production reminder (2 days before delivery)
        if ($deliveryDate->diffInDays(now()) >= 2) {
            PreOrderReminder::create([
                'pre_order_id' => $preOrder->id,
                'reminder_type' => 'production_start',
                'reminder_date' => $deliveryDate->copy()->subDays(2)->setTime(8, 0),
                'notes' => 'Mulai produksi pre-order',
            ]);
        }

        // Pickup reminder (1 day before)
        PreOrderReminder::create([
            'pre_order_id' => $preOrder->id,
            'reminder_type' => 'pickup_reminder',
            'reminder_date' => $deliveryDate->copy()->subDay()->setTime(16, 0),
            'notes' => 'Reminder pengambilan besok',
        ]);

        // Payment reminder (if not yet paid DP)
        if ($preOrder->payment_status === 'unpaid') {
            PreOrderReminder::create([
                'pre_order_id' => $preOrder->id,
                'reminder_type' => 'payment_reminder',
                'reminder_date' => now()->addHours(24),
                'notes' => 'Follow up pembayaran DP',
            ]);
        }
    }
}