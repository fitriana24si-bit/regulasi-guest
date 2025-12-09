<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LampiranDokumen extends Model
{
    use HasFactory;

    protected $table = 'lampiran_dokumen';
    protected $primaryKey = 'lampiran_id';

    protected $fillable = [
        'dokumen_id',
        'nama_file',
        'file_path',
        'tipe_file',
        'ukuran_file'
    ];

    public function dokumen()
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }
}
