<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\JenisDokumen;
use App\Models\KategoriDokumen;
use Illuminate\Http\Request;

class Dokumen extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dokumens = DokumenHukum::with(['jenis', 'kategori'])->paginate(9); // 9 item per halaman
        $jenis = JenisDokumen::all();
        $kategoris = KategoriDokumen::all();

        return view('pages.dokumen.index', compact('dokumens', 'jenis', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis = JenisDokumen::all();
        $kategoris = KategoriDokumen::all();
        return view('pages.dokumen.create', compact('jenis', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis' => 'required|exists:jenis_dokumen,id_jenis',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|string|unique:dokumen_hukum,nomor',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif'
        ]);

        DokumenHukum::create($request->all());

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen hukum berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
   public function show($id)
{
    $dokumen = DokumenHukum::with(['jenis', 'kategori'])->findOrFail($id);
    return view('pages.dokumen.show', compact('dokumen'));
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $jenis = JenisDokumen::all();
        $kategoris = KategoriDokumen::all();
        return view('pages.dokumen.edit', compact('dokumen', 'jenis', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis' => 'required|exists:jenis_dokumen,id_jenis',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor' => 'required|string|unique:dokumen_hukum,nomor,' . $id . ',dokumen_id',
            'judul' => 'required|string|max:255',
            'tanggal' => 'required|date',
            'ringkasan' => 'nullable|string',
            'status' => 'required|in:aktif,tidak_aktif'
        ]);

        $dokumen = DokumenHukum::findOrFail($id);
        $dokumen->update($request->all());

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen hukum berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $dokumen = DokumenHukum::findOrFail($id);
        $dokumen->delete();

        return redirect()->route('dokumen.index')
            ->with('success', 'Dokumen hukum berhasil dihapus.');
    }
}
