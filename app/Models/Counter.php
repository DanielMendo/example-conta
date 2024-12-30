<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Counter extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'full_name',
        'email',
        'phone',
        'address',
    ];

    public function receipts()
    {
        return $this->hasMany(Receipt::class);
    }
}
