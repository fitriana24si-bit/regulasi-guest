<?php

namespace Database\Seeders;

use App\Models\KategoriDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class KategoriDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        DB::table('kategori_dokumen')->delete();

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
            ],
            [
                'nama' => 'Administrasi',
                'deskripsi' => 'Dokumen administrasi pemerintahan desa'
            ],
            [
                'nama' => 'Kependudukan',
                'deskripsi' => 'Dokumen terkait kependudukan'
            ]
        ];

        foreach ($kategoris as $kategori) {
            KategoriDokumen::create($kategori);
        }

        $this->command->info('✅ Kategori Dokumen berhasil di-seed! (6 data)');
    }
}
