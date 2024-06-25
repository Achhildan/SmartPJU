<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB; // Import DB facade
use App\Models\Marker;

class LocationController extends Controller
{
    // Metode untuk menampilkan formulir
    public function showForm()
    {
        return view('form_location');
    }

    

    // Metode untuk menyimpan data ke dalam database
    public function store(Request $request)
    {
        // Validasi data
        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'address' => 'required|string|max:80',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
        ]);

        // Cek apakah semua field telah diisi
        if ($request->filled('name') && $request->filled('address') && $request->filled('lat') && $request->filled('lng')) {
            // Simpan data ke dalam tabel "markers"
            $marker = new Marker;
            $marker->name = $request->name;
            $marker->address = $request->address;
            $marker->lat = $request->lat;
            $marker->lng = $request->lng;
            $marker->save();

            // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            // Jika ada field yang kosong, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Semua field harus diisi.');
        }
    }

    // Method untuk menampilkan data dari database menggunakan SQL
    public function index()
    {
        // Ambil data dari tabel 'markers' menggunakan query SQL
        $markers = DB::table('markers')->get();
        
        // Kembalikan view 'locate.blade.php' dan kirimkan data marker ke dalam view
        return view('locate', compact('markers'));
    }
}
