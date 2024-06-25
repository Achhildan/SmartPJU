<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\AddpjuModel;

class AddpjuController extends Controller
{
    public function index()
    {
        $pju = AddpjuModel::all();
        return view('addpju', compact('pju'));
    }

    public function edit($id)
    {
        $pju = AddpjuModel::findOrFail($id);
        return view('edit-data', compact('pju'));
    }

    public function update(Request $request, $id)
    {
        $pju = AddpjuModel::findOrFail($id);

        // Perbarui data kecuali created_at
        $pju->update($request->except(['created_at']));

        return redirect()->route('addpju.index')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        // Temukan data berdasarkan ID
        $pju = AddpjuModel::findOrFail($id);

        // Dapatkan nama tabel dari kolom 'name'
        $tableName = $pju->name;
        $tableNameModif = $tableName . 'modif';

        // Hapus data dari tabel 'pju'
        $pju->delete();

        // Hapus tabel berdasarkan 'name' dan 'name' + 'modif'
        DB::statement("DROP TABLE IF EXISTS {$tableName}");
        DB::statement("DROP TABLE IF EXISTS {$tableNameModif}");

        return redirect()->back()->with('success', 'Data dan tabel berhasil dihapus.');
    }
}
