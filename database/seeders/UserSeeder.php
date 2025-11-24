<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('id_ID');

        // Gunakan firstOrCreate untuk admin dan operator
        User::firstOrCreate(
            ['email' => 'admin@desa.id'],
            [
                'name' => 'Administrator',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        User::firstOrCreate(
            ['email' => 'operator@desa.id'],
            [
                'name' => 'Operator Desa',
                'password' => Hash::make('password123'),
                'email_verified_at' => now(),
            ]
        );

        // Tambahkan 100 user dummy
        $this->command->info('🔄 Membuat 100 user dummy...');

        $progressBar = $this->command->getOutput()->createProgressBar(100);
        $progressBar->start();

        for ($i = 1; $i <= 100; $i++) {
            User::firstOrCreate(
                ['email' => $faker->unique()->safeEmail],
                [
                    'name' => $faker->name,
                    'password' => Hash::make('password123'),
                    'email_verified_at' => now(),
                    'created_at' => now()->subDays(rand(1, 365)), // random date dalam 1 tahun terakhir
                    'updated_at' => now(),
                ]
            );

            $progressBar->advance();
        }

        $progressBar->finish();
        $this->command->newLine(2); // Tambahkan 2 baris baru setelah progress bar
        $this->command->info('✅ 102 User berhasil di-seed! (2 user utama + 100 user dummy)');
    }
}
