<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
