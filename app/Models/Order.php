<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = "order";
    protected $fillable = [
        'order_id',
        'date',
        'product_id',
        'size_id',
        'quantity',
        'total_amount',
        'address',
        'state_id',
        'city_id',
        'pincode',
        'payment_method',
        'delivery_status'
    ];




    public function get_payment()
    {
        return $this->hasOne(Payment::class, 'order_id', 'id');
    }


    public function get_product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function get_size()
    {
        return $this->belongsTo(Sizetype::class, 'size_id');
    }

    public function get_state()
    {
        return $this->belongsTo(State::class, 'state_id');
    }

    public function get_cities()
    {
        return $this->belongsTo(City::class, 'city_id');
    }
}
