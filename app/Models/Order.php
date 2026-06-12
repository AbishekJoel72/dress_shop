<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "orders";
    protected $fillable = [
        'order_no ',
        'order_date',
        'user_id',
        'sub_total',
        'discount_amount',
        'delivery_charge',
        'grand_total',
        'delivery_status'
    ];

    public function get_orderitems()
    {
        return $this->hasMany(OrderItems::class,'order_id');
    }
}
