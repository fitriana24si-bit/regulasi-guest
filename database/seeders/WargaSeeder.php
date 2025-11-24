<?php

namespace Database\Seeders;

use App\Models\Warga;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class WargaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = Faker::create('id_ID');

        $this->command->info('🔄 Membuat 100 data dummy warga...');

        $dataWarga = [];

        for ($i = 1; $i <= 100; $i++) {
            $gender = $faker->randomElement(['Laki-laki', 'Perempuan']);
            $firstName = $faker->firstName($gender === 'Laki-laki' ? 'male' : 'female');
            $lastName = $faker->lastName();

            $noKtp = '32' . $faker->numerify('##############');

            $dataWarga[] = [
                'no_ktp' => $noKtp,
                'nama' => $firstName . ' ' . $lastName,
                'jenis_kelamin' => $gender,
                'agama' => $faker->randomElement(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Buddha', 'Konghucu']),
                'pekerjaan' => $faker->randomElement([
                    'Petani', 'PNS', 'Wiraswasta', 'Karyawan Swasta', 'Guru',
                    'Dokter', 'Perawat', 'Pedagang', 'Buruh', 'Nelayan',
                    'Ibu Rumah Tangga', 'Mahasiswa', 'Pelajar', 'Pensiunan',
                    'Sopir', 'Tukang Bangunan', 'Penjahit', 'Koki', 'Security'
                ]),
                'telp' => '08' . $faker->numerify('##########'),
                'email' => strtolower(str_replace(' ', '.', $firstName)) . '.' . strtolower(str_replace(' ', '.', $lastName)) . '@example.com',
            ];

            if ($i % 20 === 0) {
                $this->command->info("📊 Created {$i} records...");
            }
        }

        $this->command->info('💾 Menyimpan data ke database...');

        // Insert data
        foreach ($dataWarga as $warga) {
            Warga::create($warga);
        }

        $this->command->info('✅ BERHASIL! 100 data dummy warga berhasil ditambahkan!');
        $this->command->info('📈 Statistik:');
        $this->command->info('   - Total data: ' . Warga::count());
        $this->command->info('   - Laki-laki: ' . Warga::where('jenis_kelamin', 'Laki-laki')->count());
        $this->command->info('   - Perempuan: ' . Warga::where('jenis_kelamin', 'Perempuan')->count());
    }
}
