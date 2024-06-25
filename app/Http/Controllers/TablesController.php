<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TablesModel;
use App\Models\TablesModifModel;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

date_default_timezone_set('Asia/Jakarta');

class TablesController extends Controller
{
    public function index(Request $request)
    {
        // Ambil pilihan PJU dari input atau gunakan default
        $pju_selection = $request->input('pju_selection', '');
        $pju_list = TablesModel::all();

        if (empty($pju_selection)) {
            $pju_selection = $pju_list->first()->name;
        }

        // Ambil URL API dari database berdasarkan pilihan PJU
        $api_url = TablesModel::where('name', $pju_selection)->first()->API;

        // Ambil data dari API menggunakan Laravel HTTP client
        $response = Http::withOptions([
            'verify' => false, // Nonaktifkan verifikasi SSL, tidak disarankan untuk produksi
        ])->get($api_url);

        // Periksa apakah permintaan API berhasil
        if ($response->failed()) {
            abort(500, 'Gagal mengambil data dari API.');
        }

        $data = $response->json();

        // Simpan data ke database
        $this->storeDataToDatabase($pju_selection, $data);

        // Ambil tanggal mulai dan tanggal selesai dari inputan
        $start_date = $request->input('start_date', '');
        $end_date = $request->input('end_date', '');

        // Buat instance model dan set nama tabel secara dinamis
        $tablesModifModel = new TablesModifModel();
        $tablesModifModel->setTableName($pju_selection . 'modif');

        // Buat query untuk mengambil data dari tabel berdasarkan filter tanggal
        $query = $tablesModifModel->newQuery();

        if (!empty($start_date) && !empty($end_date)) {
            $query->whereBetween('time', ["$start_date 00:00:00", "$end_date 23:59:59"]);
        }

        $records = $query->orderBy('time', 'desc')->get();

        return view('tables', [
            'pju_list' => $pju_list,
            'pju_selection' => $pju_selection,
            'records' => $records,
            'waktu_simpan' => now()->format('Y-m-d H:i:s')
        ]);
    }

    private function storeDataToDatabase($pju_selection, $data)
    {
        foreach ($data as $row) {
            $time = gmdate("Y-m-d H:i:s", strtotime($row['time']) + 25200); // Convert UTC to WIB (+7 hours)
    
            // Cek keberadaan key 'data'
            if (!isset($row['data'])) {
                // Tangani kasus di mana 'data' tidak ada
                // Misalnya, log error dan lanjutkan ke iterasi berikutnya
                error_log("Key 'data' tidak ditemukan dalam array \$row: " . print_r($row, true));
                continue;
            }
    
            $rowData = $row['data'];
            $exists = DB::table($pju_selection)->where('time', $time)->exists();
    
            if (!$exists) {
                // Masukkan data mentah ke tabel utama
                DB::table($pju_selection)->insert([
                    'time' => $time,
                    'data' => json_encode($rowData) // Simpan data dalam bentuk JSON
                ]);
    
                // Masukkan data ke tabel modifikasi
                if (is_array($rowData)) {
                    // Data adalah JSON objek
                    $power = $rowData['power'] ?? null;
                } else {
                    // Data adalah nilai tunggal
                    $power = $rowData;
                }
    
                $status = $power == 0 ? 'OFF' : 'ON';
    
                DB::table($pju_selection . 'modif')->insert([
                    'time' => $time,
                    'power' => $power,
                    // 'status' => $status
                ]);
            }
        }
    }
    

    
    
}

