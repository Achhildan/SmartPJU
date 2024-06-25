<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TablesModel extends Model
{
    protected $table = 'pju';
    protected $fillable = ['name', 'API'];
}
