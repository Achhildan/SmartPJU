<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LifetimeModel;
use DateTime;

class LifetimeController extends Controller
{
    public function index()
    {
        $pjuData = LifetimeModel::all();
        $pjuEstimates = [];

        foreach ($pjuData as $pju) {
            // Parsing tanggal created_at menjadi objek DateTime
            $createdAt = new DateTime($pju->created_at);
            $now = new DateTime();  // Tanggal sekarang

            // Menghitung estimasi daya tahan sebagai tanggal dengan menambahkan lifetime (jumlah hari) ke created_at
            $estimasiDayaTahanDate = clone $createdAt;
            $estimasiDayaTahanDate->modify("+$pju->lifetime days");

            // Menghitung selisih antara created_at dan sekarang
            $selisihSekarang = $createdAt->diff($now)->days;

            // Menghitung estimasi sisa waktu dengan mengurangi jumlah hari dari created_at sampai sekarang dari lifetime
            $estimasiSisaWaktu = $pju->lifetime - $selisihSekarang;

            // Menambahkan data ke array hasil
            $pjuEstimates[] = [
                'name' => $pju->name,
                'created_at' => $pju->created_at,
                'lifetime' => $pju->lifetime,
                'estimasi_daya_tahan' => $estimasiDayaTahanDate->format('Y-m-d'),
                'estimasi_sisa_waktu' => $estimasiSisaWaktu,
            ];
        }

        return view('lifetime', compact('pjuEstimates'));
    }
}
