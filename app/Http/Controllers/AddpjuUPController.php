<?php
namespace App\Http\Controllers;

use App\Models\AddpjuModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema; // Import Schema facade

class AddpjuUPController extends Controller
{
    public function showForm()
    {
        return view('form_addpju');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:60',
            'address' => 'required|string|max:150',
            'lat' => 'required|numeric',
            'lng' => 'required|numeric',
            'API' => 'required|string|max:500',
            'lifetime' => 'required|string|max:100',
        ]);

        // Cek apakah semua field telah diisi
        if ($request->filled('name') && $request->filled('address') && $request->filled('lat') && $request->filled('lng') && $request->filled('API') && $request->filled('lifetime')) {

            // Nama tabel berdasarkan input 'name' dalam huruf besar
            $tableName = strtoupper($request->name);

            // Buat tabel 'PJU' jika belum ada
            if (!Schema::hasTable($tableName)) {
                Schema::create($tableName, function ($table) {
                    $table->string('time', 100)->primary();
                    $table->string('data', 100);
                });
            }

            // Buat tabel 'PJU_MODIF' jika belum ada
            $tableNameModif = $tableName . 'modif';
            if (!Schema::hasTable($tableNameModif)) {
                Schema::create($tableNameModif, function ($table) {
                    $table->string('time', 100)->primary();
                    $table->float('power')->nullable(false);
                });
            }

            // Simpan data ke dalam tabel 'PJU'
            $pju = new AddpjuModel();
            $pju->name = strtoupper($request->name);
            $pju->address = $request->address;
            $pju->lat = $request->lat;
            $pju->lng = $request->lng;
            $pju->API = $request->API;
            $pju->lifetime = $request->lifetime;
            $pju->save();

            // Redirect ke halaman yang sesuai atau tampilkan pesan sukses
            return redirect()->back()->with('success', 'Data berhasil disimpan.');
        } else {
            // Jika ada field yang kosong, kembalikan ke halaman sebelumnya dengan pesan error
            return redirect()->back()->with('error', 'Semua field harus diisi.');
        }
    }

    public function index()
    {
        $pju = AddpjuModel::all(); // Mengambil semua data dari model AddpjuModel
        return view('addpju', compact('pju'));
    }
}
