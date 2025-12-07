<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sizetype extends Model
{
    protected $table = "size";
    protected $fillable = [
        "size_name"
    ];
}
