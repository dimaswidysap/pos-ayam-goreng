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
            'name' => 'dimas admin',
            'email' => 'dimaswidyadmin@gmail.com',
            'password' => Hash::make('admin123'),
            'status' => true,
            'role' => 'admin',
        ]);
        User::create([
            'name' => 'Dimas Kasir',
            'email' => 'dimaswidy@gmail.com',
            'password' => Hash::make('dimas123'),
            'status' => true,
            'role' => 'kasir',
        ]);
    }
}
