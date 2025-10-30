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
        return view('pages.jenis', compact('jenisDokumen'));
    }

    public function jenisCreate()
    {
        return view('guest.jenis.create'); // Diubah ke guest.jenis.create
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
        return view('guest.jenis.edit', compact('jenis')); // Diubah ke guest.jenis.edit
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
        return view('pages.kategori');
    }

    public function dokumen()
    {
        return view('pages.dokumen');
    }

    public function riwayat()
    {
        return view('pages.riwayat');
    }

    public function lampiran()
    {
        return view('pages.lampiran');
    }

    public function login()
    {
        return view('pages.login');
    }
}
