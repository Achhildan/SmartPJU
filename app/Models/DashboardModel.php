<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DashboardModel extends Model
{
    use HasFactory;

    protected $table = 'pju'; // Nama tabel dalam basis data

    protected $fillable = [ // Field yang dapat diisi
        'name',
        'address',
        'lat',
        'lng',
    ];

    // Field yang berfungsi sebagai timestamp (created_at dan updated_at)
    public $timestamps = true;
}
