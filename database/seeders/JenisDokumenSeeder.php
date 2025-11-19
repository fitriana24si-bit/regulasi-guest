<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisDokumenSeeder extends Seeder
{
    public function run()
    {
        // HAPUS INI: DB::table('jenis_dokumen')->delete();

        // GUNAKAN INI: Update data yang sudah ada
        $jenis = [
            [
                'nama_jenis' => 'Perdes',
                'deskripsi' => 'Peraturan Desa'
            ],
            [
                'nama_jenis' => 'Perkades',
                'deskripsi' => 'Peraturan Kepala Desa'
            ],
            [
                'nama_jenis' => 'SE',
                'deskripsi' => 'Surat Edaran'
            ]
        ];

        foreach ($jenis as $data) {
            JenisDokumen::updateOrCreate(
                ['nama_jenis' => $data['nama_jenis']],
                $data
            );
        }

        $this->command->info('✅ Jenis Dokumen berhasil di-seed!');
    }
}
