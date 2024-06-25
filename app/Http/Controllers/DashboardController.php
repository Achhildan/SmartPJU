<?php 
// app/Http/Controllers/DashboardController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocateModel;

class DashboardController extends Controller
{
    public function index()
    {
        // Mengambil semua data untuk tabel
        $markers = LocateModel::all();
        
        // Menghitung jumlah data di field 'name' dari tabel 'pju'
        $totalCount = LocateModel::count();

        // Debugging
        // dd($totalCount);

        // Mengirim data ke view
        return view('dashboard', compact('markers', 'totalCount'));
    }
    
}

