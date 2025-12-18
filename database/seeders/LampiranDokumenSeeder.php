<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\LampiranDokumen;
use App\Models\DokumenHukum;
use Faker\Factory as Faker;

class LampiranDokumenSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

        // Hapus data lama
        LampiranDokumen::truncate();

        $this->command->info('🔄 Membuat lampiran dokumen...');

        $dokumens = DokumenHukum::all();

        foreach ($dokumens as $dokumen) {
            foreach (range(1, rand(1, 3)) as $i) { // 1–3 lampiran tiap dokumen
                LampiranDokumen::create([
                    'dokumen_id' => $dokumen->dokumen_id,
                    'nama_file' => $faker->word . '.pdf',
                    'file_path' => 'uploads/dokumen/' . $faker->uuid . '.pdf',
                    'tipe_file' => 'application/pdf',
                    'ukuran_file' => $faker->numberBetween(100, 5000),
                    'keterangan' => 'Lampiran file ' . $faker->word . '.pdf',
                ]);
            }
        }

        $this->command->info('✅ Lampiran berhasil di-seed!');
    }
}
