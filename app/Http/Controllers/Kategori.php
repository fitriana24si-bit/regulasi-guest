<?php

namespace App\Http\Controllers;

use App\Models\KategoriDokumen;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class Kategori extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // Searchable columns
        $searchableColumns = ['nama', 'deskripsi'];

        // Query dengan search dan pagination
        $kategoris = KategoriDokumen::withCount('dokumenHukum')
            ->when($request->filled('search'), function($query) use ($request, $searchableColumns) {
                $query->where(function($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                });
            })
            ->latest()
            ->paginate(9)
            ->withQueryString()
            ->onEachSide(2);

        return view('pages.kategori.index', compact('kategoris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('pages.kategori.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        KategoriDokumen::create($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori dokumen berhasil dibuat.');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);
        return view('pages.kategori.show', compact('kategori'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);
        return view('pages.kategori.edit', compact('kategori'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'deskripsi' => 'nullable|string'
        ]);

        $kategori = KategoriDokumen::findOrFail($id);
        $kategori->update($request->all());

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori dokumen berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $kategori = KategoriDokumen::findOrFail($id);
        $kategori->delete();

        return redirect()->route('kategori.index')
            ->with('success', 'Kategori dokumen berhasil dihapus.');
    }
}
