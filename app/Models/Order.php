<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
use HasFactory;
protected $fillable = [
    'customer_id',
    'created_by',
    'order_date',
    'pickup_date',
  'status',
    'total_price',
    'payment_status'
  
  
];
public function customer(){
    return $this->belongsTo(Customer::class, 'customer_id');
}
public function kasir(){ 
        return $this->belongsTo(User::class, 'created_by');
    }
public function user(){
    return $this->belongsTo(User::class, 'created_by');

}
public function orderItems(){
    return $this->hasMany(OrderItem::class);
}
public function items(){
    return $this->hasMany(OrderItem::class);
}
public function payments(){
    return $this->hasMany(Payment::class);
}
}