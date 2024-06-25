<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PowerModif extends Model
{
    protected $table;
    protected $fillable = ['voltagesensor', 'currentsensor'];

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        if (isset($attributes['table'])) {
            $this->setTable($attributes['table']);
        }
    }

    public static function getTableName($name)
    {
        return $name . 'modif';
    }
}

