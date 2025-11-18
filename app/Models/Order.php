<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'nama_produk',
        'qty',
        'total_harga',
        'nama_penerima',
        'no_telp',
        'alamat',
        'ekspedisi',
        'status',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
