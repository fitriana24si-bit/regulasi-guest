<?php

namespace App\Http\Controllers;

use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    public function index()
    {
        $media = Media::latest()->paginate(9);
        return view('media.index', compact('media'));
    }

    public function create()
    {
        return view('media.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file',
        ]);

        $file = $request->file('file');
        $filename = time().'_'.$file->getClientOriginalName();

        // SIMPAN KE storage/app/public/lampiran
        $file->storeAs('lampiran', $filename, 'public');

        Media::create([
            'ref_table' => 'lampiran_dokumen',
            'ref_id'    => 0,
            'file_name' => $filename,
            'mime_type' => $file->getClientMimeType(),
        ]);

        return redirect()->route('media.index')
            ->with('success', 'File berhasil diupload');
    }

    public function destroy($id)
    {
        $media = Media::findOrFail($id);

        Storage::disk('public')->delete('lampiran/'.$media->file_name);
        $media->delete();

        return back()->with('success', 'File dihapus');
    }
}
