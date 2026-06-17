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
        'delivery_charge',
        'grand_total',
        'delivery_status'
    ];

    public function get_orderitems()
    {
        return $this->hasMany(OrderItems::class,'order_id');
    }

    public function get_user()
    {
        return $this->belongsTo(Registration::class,'user_id');
    }

    public function get_payment()
    {
        return $this->hasOne(Payment:: class, 'order_id');
    }
    
    public function get_address()
    {
        return $this->hasOne(Address:: class, 'order_id');
    }


}
