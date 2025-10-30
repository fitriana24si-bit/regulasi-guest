<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;

class WargaController extends Controller
{
    public function index()
    {
        $warga = Warga::all();
        return view('guest.warga.index', compact('warga'));
    }

    public function create()
    {
        return view('guest.warga.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'no_ktp' => 'required|unique:warga',
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'agama' => 'required',
            'pekerjaan' => 'required',
            'telp' => 'required',
            'email' => 'required|email',
        ]);

        Warga::create($request->all());
        return redirect()->route('warga.index')->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('guest.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
{
    $warga = Warga::findOrFail($id);

    $request->validate([
        // perbaikan ada di bagian unique -> tambahkan ,warga_id
        'no_ktp' => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
        'nama' => 'required',
        'jenis_kelamin' => 'required',
        'agama' => 'required',
        'pekerjaan' => 'required',
        'telp' => 'required',
        'email' => 'required|email|unique:warga,email,' . $id . ',warga_id',
    ]);

    $warga->update($request->all());
    return redirect()->route('warga.index')->with('success', 'Data warga berhasil diperbarui!');
}


    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')->with('success', 'Data warga berhasil dihapus!');
    }
}
