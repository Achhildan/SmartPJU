<?php 
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocateModel;

class LocateController extends Controller
{
    public function index()
    {
        $markers = LocateModel::all();
        return view('locate', compact('markers'));
    }

    public function edit($id)
    {
        $marker = LocateModel::findOrFail($id);
        return view('edit-locate', compact('marker'));
    }

    public function update(Request $request, $id)
    {
        // Proses untuk menyimpan perubahan pada data
        // Contoh implementasi:
        $marker = LocateModel::findOrFail($id);
        $marker->name = $request->name;
        $marker->address = $request->address;
        $marker->lat = $request->lat;
        $marker->lng = $request->lng;
        $marker->save();

        return redirect()->route('index.location')->with('success', 'Data berhasil diubah.');
    }

    public function destroy($id)
    {
        LocateModel::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }
}
