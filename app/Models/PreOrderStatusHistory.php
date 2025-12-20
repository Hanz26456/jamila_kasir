<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PreOrderStatusHistory extends Model
{
     use HasFactory;
      protected $table = 'pre_order_status_history';
   

    protected $fillable = [
        'pre_order_id',
        'old_status',
        'new_status',
        'notes',
        'changed_by',
        'changed_at',
    ];

    protected $casts = [
        'changed_at' => 'datetime',
    ];

    public function preOrder()
    {
        return $this->belongsTo(PreOrder::class);
    }

    public function changer()
    {
        return $this->belongsTo(User::class, 'changed_by');
    }
}