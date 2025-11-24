<?php

namespace App\Http\Controllers;

use App\Models\Warga;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;

class WargaController extends Controller
{
    public function index(Request $request)
    {
        // Filterable columns
        $filterableColumns = ['jenis_kelamin', 'agama', 'pekerjaan'];

        // Searchable columns
        $searchableColumns = ['nama', 'no_ktp', 'email', 'telp'];

        // Query dengan search, filter, dan pagination
        $warga = Warga::when($request->filled('search'), function($query) use ($request, $searchableColumns) {
                $query->where(function($q) use ($request, $searchableColumns) {
                    foreach ($searchableColumns as $column) {
                        $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                    }
                });
            })
            ->when($request->filled('jenis_kelamin'), function($query) use ($request) {
                $query->where('jenis_kelamin', $request->jenis_kelamin);
            })
            ->when($request->filled('agama'), function($query) use ($request) {
                $query->where('agama', $request->agama);
            })
            ->when($request->filled('pekerjaan'), function($query) use ($request) {
                $query->where('pekerjaan', $request->pekerjaan);
            })
            ->latest()
            ->paginate(12) // ✅ UBAH: dari 15 jadi 12 (sesuai grid layout 4 kolom)
            ->withQueryString()
            ->onEachSide(2);

        // Data untuk dropdown filter
        $jenisKelaminList = Warga::distinct()->pluck('jenis_kelamin')->filter();
        $agamaList = Warga::distinct()->pluck('agama')->filter();
        $pekerjaanList = Warga::distinct()->pluck('pekerjaan')->filter();

        return view('pages.warga.index', compact('warga', 'jenisKelaminList', 'agamaList', 'pekerjaanList'));
    }

    public function create()
    {
        return view('pages.warga.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'required|email|unique:warga,email',
        ]);

        Warga::create($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $warga = Warga::findOrFail($id);
        return view('pages.warga.edit', compact('warga'));
    }

    public function update(Request $request, $id)
    {
        $warga = Warga::findOrFail($id);

        $validated = $request->validate([
            'no_ktp'        => 'required|unique:warga,no_ktp,' . $id . ',warga_id',
            'nama'          => 'required',
            'jenis_kelamin' => 'required',
            'agama'         => 'required',
            'pekerjaan'     => 'required',
            'telp'          => 'required',
            'email'         => 'required|email|unique:warga,email,' . $id . ',warga_id',
        ]);

        $warga->update($validated);

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $warga = Warga::findOrFail($id);
        $warga->delete();

        return redirect()->route('warga.index')
            ->with('success', 'Data warga berhasil dihapus!');
    }
}
