<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Configuration extends Model
{
    protected $table = "configuration";
    protected $fillable = [
        'company_name','tag_line','logo','phone','alter_phone','email','support_email','address',
        'state_id','city_id','pincode','website_url','facebook','instagram','twitter'
    ];
}
