<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $table = "payment";
    protected $fillable = [
        'order_id',
        'payment_gateway',
        'card_type',
        'currency',
        'payment_status',
        'transaction_id',
        'paid_at'
    ];

    public function get_order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
