<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Administrator',
            'email' => 'admin@desa.id',
            'password' => Hash::make('password123'),
            // Hapus 'role' => 'admin', jika kolom tidak ada
        ]);

        User::create([
            'name' => 'Operator Desa',
            'email' => 'operator@desa.id',
            'password' => Hash::make('password123'),
            // Hapus 'role' => 'operator', jika kolom tidak ada
        ]);
    }
}
