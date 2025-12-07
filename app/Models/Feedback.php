<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Feedback extends Model
{
    protected $table = "feedback";
    protected $fillable = [

        'user_id','rating','comment','subject'
    ];

    public function get_register(){

        return $this->belongsTo(Registration::class, 'user_id');
    }
}
