<?php

namespace Database\Seeders;

use App\Models\KategoriDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KategoriDokumenSeeder extends Seeder
{
    public function run()
    {
        // HAPUS INI: DB::table('kategori_dokumens')->delete();

        // GUNAKAN INI: Update data yang sudah ada
        $kategoris = [
            [
                'nama' => 'Peraturan Desa',
                'deskripsi' => 'Peraturan yang ditetapkan oleh pemerintah desa'
            ],
            [
                'nama' => 'Surat Edaran',
                'deskripsi' => 'Surat edaran dari kepala desa'
            ],
            [
                'nama' => 'Laporan',
                'deskripsi' => 'Laporan kegiatan dan keuangan desa'
            ],
            [
                'nama' => 'Anggaran',
                'deskripsi' => 'Dokumen anggaran pendapatan dan belanja desa'
            ]
        ];

        foreach ($kategoris as $kategori) {
            KategoriDokumen::updateOrCreate(
                ['nama' => $kategori['nama']],
                $kategori
            );
        }

        $this->command->info('✅ Kategori Dokumen berhasil di-seed!');
    }
}
