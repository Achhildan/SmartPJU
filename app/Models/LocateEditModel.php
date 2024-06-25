<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocateEditModel extends Model
{
    use HasFactory;
    
    protected $table = "pju";
    protected $primaryKey = "id";
    protected $fillable = ['name', 'address', 'lat', 'lng'];
}
