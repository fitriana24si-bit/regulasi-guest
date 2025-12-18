<?php

namespace App\Http\Controllers;

use App\Models\DokumenHukum;
use App\Models\LampiranDokumen;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class Lampiran extends Controller
{
    public function index(Request $request)
    {
        $lampiran = LampiranDokumen::with(['dokumen', 'media'])
            ->when($request->search, function ($q) use ($request) {
                $q->whereHas('media', function ($m) use ($request) {
                    $m->where('file_name', 'like', "%{$request->search}%")
                      ->orWhere('mime_type', 'like', "%{$request->search}%");
                });
            })
            ->latest()
            ->paginate(10);

        return view('pages.lampiran.index', compact('lampiran'));
    }

    public function create()
    {
        $dokumen = DokumenHukum::all();
        return view('pages.lampiran.create', compact('dokumen'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dokumen_id' => 'required',
            'file.*' => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        foreach ($request->file('file') as $f) {

            // 1️⃣ SIMPAN LAMPIRAN (HANYA RELASI)
            $lampiran = LampiranDokumen::create([
                'dokumen_id'  => $request->dokumen_id,
                'tipe_file'   => $f->getClientOriginalExtension(),
                'ukuran_file' => $f->getSize(),
            ]);

            // 2️⃣ SIMPAN FILE KE STORAGE
            $filename = time().'_'.$f->getClientOriginalName();
            $f->storeAs('lampiran', $filename, 'public');

            // 3️⃣ SIMPAN KE TABEL MEDIA
            Media::create([
                'ref_table' => 'lampiran_dokumen',
                'ref_id'    => $lampiran->lampiran_id,
                'file_name' => $filename,
                'mime_type' => $f->getClientMimeType(),
            ]);
        }

        return redirect()->route('lampiran.index')
            ->with('success', 'Lampiran berhasil diunggah');
    }

    public function destroy($id)
    {
        $lampiran = LampiranDokumen::with('media')->findOrFail($id);

        // HAPUS FILE FISIK + MEDIA
        foreach ($lampiran->media as $m) {
            Storage::disk('public')->delete('lampiran/'.$m->file_name);
            $m->delete();
        }

        // HAPUS LAMPIRAN
        $lampiran->delete();

        return back()->with('success', 'Lampiran berhasil dihapus');
    }
}
