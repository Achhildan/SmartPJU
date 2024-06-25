<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class LocateModel extends Model
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

    public function getLastOnAttribute()
    {
        // Asumsikan tabel data memiliki kolom `time` dan sesuai dengan `name` di pju
        $table = $this->name;
        $latestData = DB::table($table)->orderBy('time', 'desc')->first();
        return $latestData ? $latestData->time : null;
    }
}
