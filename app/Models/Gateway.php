<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gateway extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'address' ,'lat','lng','API','lifetime'];
}
