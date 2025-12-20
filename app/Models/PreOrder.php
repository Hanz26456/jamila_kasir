<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'customer_id',
        'created_by',
        'order_number',
        'order_date',
        'delivery_date',
        'order_type',
        'status',
        'product_name',
        'description',
        'specifications',
        'design_notes',
        'reference_image',
        'quantity',
        'price_per_unit',
        'total_price',
        'dp_amount',
        'dp_percentage',
        'remaining_payment',
        'payment_status',
        'delivery_method',
        'delivery_address',
        'delivery_fee',
        'admin_notes',
        'customer_notes',
        'cancellation_reason',
        'canceled_at',
        'completed_at',
    ];

    protected $casts = [
        'order_date' => 'datetime',
        'delivery_date' => 'datetime',
        'specifications' => 'array',
        'canceled_at' => 'datetime',
        'completed_at' => 'datetime',
        'price_per_unit' => 'decimal:2',
        'total_price' => 'decimal:2',
        'dp_amount' => 'decimal:2',
        'remaining_payment' => 'decimal:2',
        'delivery_fee' => 'decimal:2',
    ];

    // Relationships
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function payments()
    {
        return $this->hasMany(PreOrderPayment::class);
    }

    public function statusHistory()
    {
        return $this->hasMany(PreOrderStatusHistory::class);
    }

    public function reminders()
    {
        return $this->hasMany(PreOrderReminder::class);
    }

    // Accessor untuk status badge color
    public function getStatusBadgeAttribute()
    {
        return match($this->status) {
            'pending' => 'warning',
            'confirmed' => 'info',
            'in_production' => 'primary',
            'ready' => 'success',
            'completed' => 'secondary',
            'canceled' => 'danger',
        };
    }

    public function getPaymentStatusBadgeAttribute()
    {
        return match($this->payment_status) {
            'unpaid' => 'danger',
            'dp_paid' => 'warning',
            'paid' => 'success',
            'refunded' => 'secondary',
        };
    }

    // Scope untuk filter
    public function scopePending($query)
    {
        return $query->where('status', 'pending');
    }

    public function scopeConfirmed($query)
    {
        return $query->where('status', 'confirmed');
    }

    public function scopeInProduction($query)
    {
        return $query->where('status', 'in_production');
    }

    public function scopeReady($query)
    {
        return $query->where('status', 'ready');
    }

    public function scopeDeliveryToday($query)
    {
        return $query->whereDate('delivery_date', today());
    }

public function statusHistories()
{
    return $this->hasMany(PreOrderStatusHistory::class);
}

}