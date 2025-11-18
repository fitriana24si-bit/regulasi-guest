<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KategoriDokumen extends Model
{
    use HasFactory;

    protected $table = 'kategori_dokumen';
    protected $primaryKey = 'kategori_id';

    protected $fillable = [
        'nama',
        'deskripsi'
    ];

    public $timestamps = true;

    // Relasi ke dokumen_hukum
    public function dokumenHukum()
    {
        return $this->hasMany(DokumenHukum::class, 'kategori_id', 'kategori_id');
    }
}
