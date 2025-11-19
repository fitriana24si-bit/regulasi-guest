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

        // Data admin tetap
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@desa.id',
            'password' => Hash::make('password123'),
        ]);

        User::create([
            'name' => 'Operator Desa',
            'email' => 'operator@desa.id',
            'password' => Hash::make('password123'),
        ]);

        // Tambahkan user dummy (5 user)
        foreach (range(1, 5) as $index) {
            User::create([
                'name' => $faker->name,
                'email' => $faker->unique()->safeEmail,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        $this->command->info('✅ User berhasil di-seed! (7 data: 2 admin + 5 dummy)');
    }
}
