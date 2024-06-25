<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    // Kolom yang dapat diisi
    protected $fillable = [
        'username', 'password',
    ];

    // Kolom yang disembunyikan dalam serialisasi
    protected $hidden = [
        'password',
    ];

    // Nonaktifkan timestamps jika tidak digunakan dalam tabel
    public $timestamps = false;
}
