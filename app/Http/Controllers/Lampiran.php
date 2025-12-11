<?php
namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\LampiranDokumen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Lampiran extends Controller
{
    // =============================
    // TAMPILKAN SEMUA LAMPIRAN
    // =============================
    public function index(Request $request)
    {
        // Kolom yang bisa dicari
        $searchableColumns = ['nama_file', 'tipe_file'];

        $lampiran = LampiranDokumen::with('dokumen')
            ->when($request->filled('search'), function ($query) use ($request, $searchableColumns) {
                $query->where(function ($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $col) {
                        $q->orWhere($col, 'LIKE', '%' . $request->search . '%');
                    }
                });
            })
            ->latest()
            ->paginate(10) // <---- PAGINATION DITAMBAHKAN DI SINI
            ->withQueryString()
            ->onEachSide(2);

        return view('pages.lampiran.index', compact('lampiran'));
    }

    // =============================
    // FORM TAMBAH
    // =============================
    public function create()
    {
        $dokumen = DokumenHukum::all();
        return view('pages.lampiran.create', compact('dokumen'));
    }

    // =============================
    // SIMPAN LAMPIRAN BARU
    // =============================
    public function store(Request $request)
    {
        $request->validate([
            'dokumen_id' => 'required',
            'file.*'     => 'required|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        if ($request->hasFile('file')) {

            foreach ($request->file('file') as $f) {

                $filename = time() . '_' . preg_replace('/\s+/', '_', $f->getClientOriginalName());
                $path     = $f->storeAs('lampiran', $filename, 'public');

                LampiranDokumen::create([
                    'dokumen_id'  => $request->dokumen_id,
                    'nama_file'   => $f->getClientOriginalName(),
                    'file_path'   => $path,
                    'tipe_file'   => $f->getClientOriginalExtension(),
                    'ukuran_file' => $f->getSize(),
                ]);
            }
        }

        return redirect()->route('lampiran.index')->with('success', 'Lampiran berhasil diunggah');
    }

    // =============================
    // DETAIL
    // =============================
    public function show($id)
    {
        $lampiran = LampiranDokumen::with('dokumen')->findOrFail($id);
        return view('pages.lampiran.detail', compact('lampiran'));
    }

    // =============================
    // EDIT FORM
    // =============================
    public function edit($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);
        $dokumen  = DokumenHukum::all();

        return view('pages.lampiran.edit', compact('lampiran', 'dokumen'));
    }

    // =============================
    // UPDATE
    // =============================
    public function update(Request $request, $id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        $request->validate([
            'dokumen_id' => 'required',
            'file'       => 'nullable|mimes:pdf,doc,docx,jpg,png|max:5120',
        ]);

        // kalau user upload file baru → hapus file lama
        if ($request->hasFile('file')) {
            Storage::disk('public')->delete($lampiran->file_path);

            $f        = $request->file('file');
            $filename = time() . '_' . preg_replace('/\s+/', '_', $f->getClientOriginalName());
            $path     = $f->storeAs('lampiran', $filename, 'public');

            $lampiran->update([
                'nama_file'   => $f->getClientOriginalName(),
                'file_path'   => $path,
                'tipe_file'   => $f->getClientOriginalExtension(),
                'ukuran_file' => $f->getSize(),
            ]);
        }

        // update dokumen_id saja (kalau tidak ganti file)
        $lampiran->update([
            'dokumen_id' => $request->dokumen_id,
        ]);

        return redirect()->route('lampiran.index')->with('success', 'Lampiran berhasil diperbarui');
    }

    // =============================
    // DOWNLOAD
    // =============================
    public function download($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);
        return Storage::disk('public')->download($lampiran->file_path, $lampiran->nama_file);
    }

    // =============================
    // HAPUS
    // =============================
    public function destroy($id)
    {
        $lampiran = LampiranDokumen::findOrFail($id);

        Storage::disk('public')->delete($lampiran->file_path);
        $lampiran->delete();

        return back()->with('success', 'Lampiran berhasil dihapus');
    }
}
