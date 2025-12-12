<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->command->info('🎯 Memulai proses seeding database...');

        $this->call([
            UserSeeder::class,
            JenisDokumenSeeder::class, // ✅ JENIS DOKUMEN DULUAN
            KategoriDokumenSeeder::class,
            DokumenHukumSeeder::class,
            WargaSeeder::class,
            LampiranDokumenSeeder::class
        ]);

        $this->command->info('🎉 SEMUA SEEDER BERHASIL DIJALANKAN!');
    }
}
