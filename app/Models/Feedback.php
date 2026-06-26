<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = "product_feedback";
    protected $fillable = [

       'order_id','product_id','user_id','rating','feedback'
    ];


    public function get_order(){

        return $this->belongsTo(Order::class, 'order_id');
    }

    public function get_product(){

        return $this->belongsTo(Product::class, 'product_id');
    }

    public function get_register(){

        return $this->belongsTo(Registration::class, 'user_id');
    }
}
