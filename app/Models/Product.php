<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = "product";
    protected $fillable = [
        'product_name',
        'description',
        'price',
        'discount_price',
        'category_id',
        'stock',
        'image_path',
        'status'
    ];


    public function get_category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
