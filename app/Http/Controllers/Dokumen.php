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
    public function index(Request $request)
    {
        // Filterable columns
        $filterableColumns = ['id_jenis', 'kategori_id', 'status'];

        // Searchable columns
        $searchableColumns = ['nomor', 'judul', 'ringkasan'];

        // Query dengan filter, search, dan pagination
        $dokumens = DokumenHukum::with(['jenis', 'kategori'])
            ->when($request->filled('search'), function ($query) use ($request, $searchableColumns) {
                $query->where(function ($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                });
            })
            ->filter($request, $filterableColumns)
            ->latest()
            ->paginate(9)
            ->withQueryString()
            ->onEachSide(2); // TIPS 1: hanya tampilkan 2 halaman sebelum & sesudah

        $jenis     = JenisDokumen::all();
        $kategoris = KategoriDokumen::all();

        return view('pages.dokumen.index', compact('dokumens', 'jenis', 'kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $jenis     = JenisDokumen::all();
        $kategoris = KategoriDokumen::all();
        return view('pages.dokumen.create', compact('jenis', 'kategoris'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'id_jenis'    => 'required|exists:jenis_dokumen,id_jenis',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor'       => 'required|string|unique:dokumen_hukum,nomor',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'ringkasan'   => 'nullable|string',
            'status'      => 'required|in:aktif,tidak_aktif',
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
        $dokumen = DokumenHukum::with([
            'jenis',
            'kategori',
            'lampiran.media',
        ])->findOrFail($id);

        return view('pages.dokumen.show', compact('dokumen'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $dokumen   = DokumenHukum::findOrFail($id);
        $jenis     = JenisDokumen::all();
        $kategoris = KategoriDokumen::all();
        return view('pages.dokumen.edit', compact('dokumen', 'jenis', 'kategoris'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'id_jenis'    => 'required|exists:jenis_dokumen,id_jenis',
            'kategori_id' => 'required|exists:kategori_dokumen,kategori_id',
            'nomor'       => 'required|string|unique:dokumen_hukum,nomor,' . $id . ',dokumen_id',
            'judul'       => 'required|string|max:255',
            'tanggal'     => 'required|date',
            'ringkasan'   => 'nullable|string',
            'status'      => 'required|in:aktif,tidak_aktif',
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
