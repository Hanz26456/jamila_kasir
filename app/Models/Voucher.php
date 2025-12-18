<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'discount_type', // e.g., 'percentage' or 'fixed'
        'discount_value',
        'start_date',
        'end_date',
        'status' // e.g., 'active', 'expired', 'used'
    ];

}
