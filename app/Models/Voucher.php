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
        'usage_limit',
        'used_count',
        'end_date',
        'status' // e.g., 'active', 'expired', 'used'
    ];
    public function products()
{
    return $this->belongsToMany(Product::class, 'product_voucher');
}

}
