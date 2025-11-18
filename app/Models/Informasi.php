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
        // Hapus file lama saat update
        static::updating(function ($informasi) {
            if ($informasi->isDirty('video')) { // cek apakah video diupdate
                $oldVideo = $informasi->getOriginal('video');
                if ($oldVideo && Storage::disk('public')->exists($oldVideo)) {
                    Storage::disk('public')->delete($oldVideo);
                }
            }
        });

        // Hapus file saat record dihapus
        static::deleting(function ($informasi) {
            if ($informasi->video && Storage::disk('public')->exists($informasi->video)) {
                Storage::disk('public')->delete($informasi->video);
            }
        });
    }
}
