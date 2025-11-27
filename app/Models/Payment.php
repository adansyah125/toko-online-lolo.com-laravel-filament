<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'jasa_id',
        'order_id',
        'payment_id',
        'payment_status',
        'order_status',
        'price',
    ];


    public function order()
    {
        return $this->belongsTo(Order::class, 'jasa_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
