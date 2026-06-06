<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Admin Utama',
            'email' => 'admin@toko.com',
            'password' => Hash::make('admin123'),
            'status' => true,
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin Dimas',
            'email' => 'dimas@toko.com',
            'password' => Hash::make('dimas123'),
            'status' => true,
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Admin Wiji',
            'email' => 'wiji@toko.com',
            'password' => Hash::make('wiji123'),
            'status' => true,
            'role' => 'admin',
        ]);

        User::create([
            'name' => 'Kasir Satu',
            'email' => 'kasir@toko.com',
            'password' => Hash::make('kasir123'),
            'status' => true,
            'role' => 'kasir',
        ]);
        User::create([
            'name' => 'Kasir vano',
            'email' => 'vano@toko.com',
            'password' => Hash::make('vano123'),
            'status' => false,
            'role' => 'kasir',
        ]);
    }
}
