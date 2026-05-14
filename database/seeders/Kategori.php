<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class Kategori extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('kategori')->insert([
            [
                'nama' => 'Makanan Lauk',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Minuman',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Makanan Paket',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nama' => 'Sambal',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
