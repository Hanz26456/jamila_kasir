<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderPayment extends Model
{
    use HasFactory;

    protected $fillable = [
        'pre_order_id',
        'payment_type',
        'payment_method',
        'amount',
        'change',
        'proof_image',
        'notes',
        'paid_at',
        'processed_by',
    ];

    protected $casts = [
        'paid_at' => 'datetime',
        'amount' => 'decimal:2',
        'change' => 'decimal:2',
    ];

    public function preOrder()
    {
        return $this->belongsTo(PreOrder::class);
    }

    public function processor()
    {
        return $this->belongsTo(User::class, 'processed_by');
    }
}