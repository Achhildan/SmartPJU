<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Http;

class DataplatformModel extends Model
{
    protected $guarded = [];

    public static function fetchDataFromApi()
    {
        $response = Http::get('https://api-data.telkomiot.id/api/v2.0/APP65a5f65f37a7932719/DEV65a61fdd9229e66665/lasthistory');

        if ($response->successful()) {
            $data = $response->json();

            foreach ($data as $item) {
                self::create([
                    'time' => $item['time'],
                    'data' => json_encode($item['data']),
                    'radio' => $item['radio'],
                    'type' => $item['type']
                ]);
            }
        }
    }
}
