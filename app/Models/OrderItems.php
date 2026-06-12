<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class OrderItems extends Model
{
    protected $table = "order_items";
    protected $fillable = [
        'order_id',
        'product_id',
        'size_id',
        'quantity',
        'price',
        'discount_price',
        'total_amount'
    ];

    public function get_size()
    {
        return $this->belongsTo(Sizetype::class, "size_id", "id");
    }

    public function get_product()
    {
        return $this->belongsTo(Product::class, "product_id", "id");
    }
}
