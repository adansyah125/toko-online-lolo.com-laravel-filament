<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Informasi extends Model
{
    use HasFactory;

    protected $fillable = ['video'];

    protected static function booted()
    {
        static::updating(function ($informasi) {
            if ($informasi->isDirty('video')) {
                $oldVideo = $informasi->getOriginal('video');
                if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
                    Storage::disk('public')->delete($oldVideo);
                }
            }
        });


        static::deleting(function ($informasi) {
            if ($informasi->video && Storage::disk('public')->exists($informasi->video)) {
                Storage::disk('public')->delete($informasi->video);
            }
        });
    }
}
