<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "products";
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'discount_price',
        'category_id',
        'stock',
        'status'
    ];


    public function get_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function get_product_images()
    {
        return $this->hasOne(ProductImages::class, 'product_id');
    }
}
