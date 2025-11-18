<?php

namespace Database\Seeders;

use App\Models\JenisDokumen;
use Illuminate\Database\Seeder;

class JenisDokumenSeeder extends Seeder
{
    public function run()
    {
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
            JenisDokumen::create($data);
        }
    }
}
