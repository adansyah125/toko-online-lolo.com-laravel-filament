<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'nama',
        'stok',
        'harga',
        'deskripsi',
        'image1',
        'image2',
        'image3',
    ];

    protected static function booted()
    {

        static::updating(function ($product) {
            foreach (['image1', 'image2', 'image3'] as $image) {
                if ($product->isDirty($image)) {
                    $oldImage = $product->getOriginal($image);
                    if ($oldImage && Storage::disk('public')->exists($oldImage)) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }
            }
        });


        static::deleting(function ($product) {
            foreach (['image1', 'image2', 'image3'] as $image) {
                if ($product->$image && Storage::disk('public')->exists($product->$image)) {
                    Storage::disk('public')->delete($product->$image);
                }
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
