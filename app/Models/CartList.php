<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CartList extends Model
{
    protected $table = 'cart_list';

    protected $fillable = [
        'user_id',
        'product_id',
        'size_id',
        'quantity',
        'price',
        'discount_price',
        'total_amount',
    ];

    public function get_product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    // public function get_size()
    // {
    //     return $this->belongsTo(SizeType::class, 'size_id', 'id');
    // }
}
