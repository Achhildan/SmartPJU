<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\LocateEditModel;

class LocateEditController extends Controller
{
    // Method untuk menampilkan data lokasi
    public function datatampil()
    {
        $datalocate = LocateEditModel::orderBy('id', 'ASC')->paginate(5);
        return view('locateedit', ['markers' => $datalocate]);
    }

    // Method untuk menambah data lokasi
    public function locatetambah(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        LocateEditModel::create([
            'name' => $request->name,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        return redirect('/locateedit')->with('success', 'Location added successfully.');
    }

    // Method untuk menghapus data lokasi
    public function locatehapus($id)
    {
        LocateEditModel::findOrFail($id)->delete();
        return redirect()->back()->with('success', 'Location deleted successfully.');
    }

    // Method untuk mengedit data lokasi
    public function locateedit($id, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'address' => 'required',
            'lat' => 'required',
            'lng' => 'required'
        ]);

        $locate = LocateEditModel::findOrFail($id);
        $locate->update([
            'name' => $request->name,
            'address' => $request->address,
            'lat' => $request->lat,
            'lng' => $request->lng
        ]);

        return redirect()->back()->with('success', 'Location updated successfully.');
    }
}
