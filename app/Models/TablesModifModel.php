<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TablesModifModel extends Model
{
    use HasFactory;

    // protected $fillable = ['time', 'Temp', 'Humd', 'Status', 'LightSensor', 'CurrentSensor', 'VoltageSensor'];
    protected $fillable = ['time', 'data'];

    public function setTableName($tableName)
    {
        $this->table = $tableName;
    }
}
