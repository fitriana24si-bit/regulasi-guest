<?php

namespace App\Http\Controllers;

use App\Models\JenisDokumen;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Database\Eloquent\Builder;

class RegnaController extends Controller
{
    public function dashboard()
    {
        return view('pages.dashboard');
    }

    // ===============================
    // METHOD UNTUK JENIS DOKUMEN
    // ===============================

    /**
     * Display a listing of the resource dengan pagination & search
     */
    public function jenis(Request $request)
    {
        // Searchable columns
        $searchableColumns = ['nama_jenis', 'deskripsi'];

        // Query dengan search dan pagination
        $jenisDokumen = JenisDokumen::when($request->filled('search'), function($query) use ($request, $searchableColumns) {
                $query->where(function($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->onEachSide(2);

        return view('pages.jenis.index', compact('jenisDokumen'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function jenisCreate()
    {
        return view('pages.jenis.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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

    /**
     * Show the form for editing the specified resource.
     */
    public function jenisEdit($id)
    {
        $jenis = JenisDokumen::findOrFail($id);
        return view('pages.jenis.edit', compact('jenis'));
    }

    /**
     * Update the specified resource in storage.
     */
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

    /**
     * Remove the specified resource from storage.
     */
    public function jenisDestroy($id)
    {
        $jenis = JenisDokumen::findOrFail($id);
        $jenis->delete();

        return redirect()->route('jenis.index')
            ->with('success', 'Jenis dokumen berhasil dihapus');
    }

    // ===============================
    // METHOD UNTUK MODUL LAINNYA
    // ===============================

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
}
