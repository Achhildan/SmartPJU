<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gateway;
use App\Models\Pju;
use Carbon\Carbon;
use App\Models\DynamicModel;
class MapController extends Controller
{
    protected function getModelByName($name)
    {
        $tableName = strtolower($name) . 'modif';
        
        // Buat instance dari DynamicModel
        $model = new DynamicModel();
        $model->setTable($tableName);

        return $model;
    }

    public function index()
    {
        $gateways = Gateway::all();
        $users = Pju::all();
        $now = Carbon::now('Asia/Jakarta');
        
        $userIcons = [];
        $userLastTimes = [];
        
        foreach ($users as $user) {
            $currentIcon = '/icon/merah.png'; // default icon
            $latestTime = null; // Inisialisasi variabel untuk menyimpan waktu terbaru
            
            // Ambil model yang sesuai berdasarkan nama user
            $model = $this->getModelByName($user->name);
            if ($model) {
                $times = $model->orderBy('time', 'asc')->get();
                
                foreach ($times as $time) {
                    $timeCarbon = Carbon::parse($time->time, 'Asia/Jakarta');
                    
                    // Periksa apakah waktu dalam entri adalah hari ini atau sudah lewat
                    if ($timeCarbon->lessThanOrEqualTo($now)) {
                        // Update waktu terbaru jika kondisi terpenuhi
                        if ($latestTime === null || $timeCarbon->greaterThan($latestTime)) {
                            $latestTime = $timeCarbon;
                            
                            // Hitung selisih waktu
                            $diff = $now->diff($timeCarbon);
                            $minutesDifference = $diff->days * 1440 + $diff->h * 60 + $diff->i; // total menit
                            
                            if ($minutesDifference <= 10) {
                                $currentIcon = '/icon/kuning.png'; // Icon 1
                            } else if ($minutesDifference > 10 && $minutesDifference < 1440) {
                                // 1440 menit = 1 hari
                                $currentIcon = '/icon/hitam.png'; // Icon 2
                            } else {
                                $currentIcon = '/icon/merah.png'; // Icon 3
                            }
                        }
                    }
                }
            }
            
            // Masukkan ikon dan waktu terakhir ke dalam array
            $userIcons[$user->id] = $currentIcon;
            $userLastTimes[$user->id] = isset($latestTime) ? $latestTime->diffForHumans() : 'Tidak ada data'; // Format waktu terakhir
        }
    
        return view('map', compact('gateways', 'users', 'userIcons', 'userLastTimes'));
    }
}
