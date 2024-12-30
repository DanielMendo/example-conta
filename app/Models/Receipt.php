<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    protected $fillable = [
        'receipt_number',
        'client_id',
        'counter_id',
        'amount',
        'payment_method',
        'payment_date',
        'description',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function counter()
    {
        return $this->belongsTo(Counter::class);
    }
}
