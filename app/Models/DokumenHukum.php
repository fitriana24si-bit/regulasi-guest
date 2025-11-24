<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class DokumenHukum extends Model
{
    use HasFactory;

    // PERBAIKI: Ubah jadi tanpa 's'
    protected $table = 'dokumen_hukum'; // ← UBAH INI (HAPUS 's')
    protected $primaryKey = 'dokumen_id';

    protected $fillable = [
        'id_jenis',
        'kategori_id',
        'nomor',
        'judul',
        'tanggal',
        'ringkasan',
        'status'
    ];

    protected $casts = [
        'tanggal' => 'date',
    ];

    public $timestamps = true;

    // Relasi ke kategori_dokumen
    public function kategori()
    {
        return $this->belongsTo(KategoriDokumen::class, 'kategori_id', 'kategori_id');
    }

    // Relasi ke jenis_dokumen
    public function jenis()
    {
        return $this->belongsTo(JenisDokumen::class, 'id_jenis', 'id_jenis');
    }

    // Scope untuk filter
    public function scopeFilter(Builder $query, $request, array $filterableColumns): Builder
    {
        foreach ($filterableColumns as $column) {
            if ($request->filled($column)) {
                $query->where($column, $request->input($column));
            }
        }
        return $query;
    }

    // Scope untuk search
    public function scopeSearch($query, $request, array $columns)
    {
        if ($request->filled('search')) {
            $query->where(function($q) use ($request, $columns) {
                foreach ($columns as $column) {
                    $q->orWhere($column, 'LIKE', '%' . $request->search . '%');
                }
            });
        }
    }
}
