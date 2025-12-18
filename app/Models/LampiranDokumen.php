<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class LampiranDokumen extends Model
{
    use HasFactory;

    protected $table = 'lampiran_dokumen';
    protected $primaryKey = 'lampiran_id';

    protected $fillable = [
        'dokumen_id',
        'file_name',
        'file_path',
        'tipe_file',
        'ukuran_file'
    ];

    public function dokumen()
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }


    /** ----------------------------------------------
     *  AUTO DUMMY DATA KETIKA CREATE (opsional)
     *  ---------------------------------------------- */
    protected static function booted()
    {
        static::creating(function ($lampiran) {

            // Isi dokumen_id default (HARUS ada 1 di DB)
            if (empty($lampiran->dokumen_id)) {
                $lampiran->dokumen_id = 1;
            }

            // Nama file dummy jika kosong
            if (empty($lampiran->nama_file)) {
                $lampiran->nama_file = uniqid('lampiran_') . '.pdf';
            }

            // Generate file dummy di storage
            if (empty($lampiran->file_path)) {
                $relative = "lampiran_dokumen/" . $lampiran->nama_file;

                Storage::disk('public')->put($relative, "ISI FILE DUMMY LAMPIRAN");

                $lampiran->file_path = "storage/" . $relative;
            }

            // Tipe file default
            if (empty($lampiran->tipe_file)) {
                $lampiran->tipe_file = "application/pdf";
            }

            // Ukuran file dummy
            if (empty($lampiran->ukuran_file)) {
                $lampiran->ukuran_file = rand(50_000, 400_000); // 50 KB – 400 KB
            }
        });
    }
}
