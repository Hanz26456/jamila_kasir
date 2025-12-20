<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderReminder extends Model
{
    use HasFactory;

    protected $fillable = [
        'pre_order_id',
        'reminder_type',
        'reminder_date',
        'is_sent',
        'sent_at',
        'notes',
    ];

    protected $casts = [
        'reminder_date' => 'datetime',
        'sent_at' => 'datetime',
        'is_sent' => 'boolean',
    ];

    public function preOrder()
    {
        return $this->belongsTo(PreOrder::class);
    }
}