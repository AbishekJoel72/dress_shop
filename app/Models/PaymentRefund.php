<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaymentRefund extends Model
{
    protected $table = 'payments_refund';

    protected $fillable = [
        'payment_id', 'refund_transaction_id', 'refund_amount', 'refund_date', 'remarks',
    ];

    public function get_payment()
    {

        return $this->belongsTo(Payment::class, 'payment_id');
    }
}
