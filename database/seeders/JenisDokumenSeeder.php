<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Factory as Faker;

class JenisDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        DB::table('jenis_dokumen')->delete();

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
            ],
            [
                'nama_jenis' => 'SK',
                'deskripsi' => 'Surat Keputusan'
            ],
            [
                'nama_jenis' => 'Nota',
                'deskripsi' => 'Nota Dinas'
            ]
        ];

        foreach ($jenis as $data) {
            JenisDokumen::create($data);
        }

        $this->command->info('✅ Jenis Dokumen berhasil di-seed! (5 data)');
    }
}
