<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payments";
    protected $fillable = [
        'order_id',
        'transaction_id',
        'payment_gateway',
        'amount',
        'currency',
        'payment_status',
        'paid_at'
    ];

    public function get_order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
