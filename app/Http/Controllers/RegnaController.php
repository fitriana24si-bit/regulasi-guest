<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class RegnaController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    // Method untuk Jenis Dokumen
    public function jenis()
    {
        $jenisDokumen = JenisDokumen::all();
        return view('pages.jenis.index', compact('jenisDokumen')); // Sesuaikan path
    }

    public function jenisCreate()
    {
        return view('pages.jenis.create'); // Sesuaikan path
    }

    public function jenisStore(Request $request)
    {
        $request->validate([
            'nama_jenis' => 'required|string|max:255|unique:jenis_dokumen,nama_jenis',
            'deskripsi' => 'nullable|string'
        ]);

        JenisDokumen::create($request->all());

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis dokumen berhasil ditambahkan');
    }

    public function jenisEdit($id)
    {
        $jenis = JenisDokumen::findOrFail($id);
        return view('pages.jenis.edit', compact('jenis')); // Sesuaikan path
    }

    public function jenisUpdate(Request $request, $id)
    {
        $jenis = JenisDokumen::findOrFail($id);

        $request->validate([
            'nama_jenis' => [
                'required',
                'string',
                'max:255',
                Rule::unique('jenis_dokumen')->ignore($jenis->id_jenis, 'id_jenis')
            ],
            'deskripsi' => 'nullable|string'
        ]);

        $jenis->update($request->all());

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis dokumen berhasil diperbarui');
    }

    public function jenisDestroy($id)
    {
        $jenis = JenisDokumen::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis dokumen berhasil dihapus');
    }

    public function kategori()
    {
        return view('pages.kategori.index'); // Sesuaikan path
    }

    public function dokumen()
    {
        return view('pages.dokumen.index'); // Sesuaikan path
    }

    public function riwayat()
    {
        return view('pages.riwayat.index'); // Sesuaikan path
    }

    public function lampiran()
    {
        return view('pages.lampiran.index'); // Sesuaikan path
    }
}
