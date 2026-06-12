<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $table = "address";
    protected $fillable = [

        'user_id',
        'order_id',
        'address_line1',
        'address_line2',
        'state_id',
        'city_id',
        'pincode'
    ];
}
