<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class LampiranDokumen extends Model
{
    protected $table = 'lampiran_dokumen';
    protected $primaryKey = 'lampiran_id';

    protected $fillable = [
        'dokumen_id',
    ];

    public function dokumen()
    {
        return $this->belongsTo(DokumenHukum::class, 'dokumen_id', 'dokumen_id');
    }

    public function media()
{
    return $this->hasMany(Media::class, 'ref_id', 'lampiran_id')
                ->where('ref_table', 'lampiran_dokumen');
}

}

