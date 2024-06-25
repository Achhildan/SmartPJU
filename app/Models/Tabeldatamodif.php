<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabeldatamodif extends Model
{
    protected $guarded = [];

    public static function convertAndSave()
    {
        $dataplatfroms = DataplatformModel::all();

        foreach ($dataplatfroms as $dataplatfrom) {
            $data = json_decode($dataplatfrom->data, true);

            self::create([
                'time' => $dataplatfrom->time,
                'temp' => $data['Temp'],
                'humd' => $data['Humd'],
                'status' => $data['Status'],
                'LightSensor' => $data['LightSensor'],
                'CurrentSensor' => $data['CurrentSensor'],
                'VoltageSensor' => $data['VoltageSensor']
            ]);
        }
    }
}
