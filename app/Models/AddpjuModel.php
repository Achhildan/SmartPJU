<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddpjuModel extends Model
{
    use HasFactory;

    protected $table = 'pju'; // Nama tabel dalam basis data

    protected $fillable = [ // Field yang dapat diisi
        'name',
        'address',
        'lat',
        'lng',
        'API',
        'lifetime',
    ];

    // Field yang berfungsi sebagai timestamp (created_at dan updated_at)
    public $timestamps = true;

    // Mengamankan agar created_at tidak berubah saat update
    protected static function boot()
    {
        parent::boot();

        static::updating(function ($model) {
            $model->created_at = $model->getOriginal('created_at');
        });
    }
}
