<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasFactory;

    protected $table = 'markers';

    protected $fillable = [
        'id',
        'name',
        'address',
        'lat',
        'lng',
        'type',
        'created_at',
        'updated_at',
    ];
}
