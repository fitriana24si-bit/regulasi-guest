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
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }

        $dokumen = DokumenHukum::all();
        return view('pages.lampiran.create', compact('dokumen'));
    }

    public function store(Request $request)
    {
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $request->validate([
            'dokumen_id' => 'required',
            'file.*'     => 'required|file|mimes:jpg,jpeg,png,pdf|max:5120',
        ]);

        foreach ($request->file('file') as $f) {

            // 1️⃣ SIMPAN LAMPIRAN (HANYA RELASI)
            $lampiran = LampiranDokumen::create([
                'dokumen_id'  => $request->dokumen_id,
                'tipe_file'   => $f->getClientOriginalExtension(),
                'ukuran_file' => $f->getSize(),
            ]);

            // 2️⃣ SIMPAN FILE KE STORAGE
            $filename = time() . '_' . $f->getClientOriginalName();
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
        if (auth()->user()->role !== 'admin') {
            abort(403);
        }
        $lampiran = LampiranDokumen::with('media')->findOrFail($id);

        foreach ($lampiran->media as $m) {
            Storage::disk('public')->delete('lampiran/' . $m->file_name);
            $m->delete();
        }

        $lampiran->delete();

        return redirect()->route('lampiran.index')
            ->with('success', 'Lampiran berhasil dihapus');
    }

    public function show($id)
    {
        $lampiran = LampiranDokumen::with([
            'dokumen',
            'media',
        ])->findOrFail($id);

        return view('pages.lampiran.detail', compact('lampiran'));
    }

    public function downloadMedia($id)
    {
        $media = Media::findOrFail($id);

        $path = 'lampiran/' . $media->file_name;

        if (! Storage::disk('public')->exists($path)) {
            abort(404, 'File tidak ditemukan');
        }

        return Storage::disk('public')->download($path, $media->file_name);
    }

}
