<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LifetimeModel extends Model
{
    use HasFactory;

    protected $table = 'pju'; // Nama tabel dalam basis data

    protected $fillable = [
        'name',
        'created_at',
        'lifetime',
    ];
}
