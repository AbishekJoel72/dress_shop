<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Favourites extends Model
{
    protected $table = 'favourites';

    protected $fillable = [
        'user_id',
        'product_id',
    ];

    public function get_product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
    
}
