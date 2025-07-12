<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    public function run()
    {
        DB::table('categories')->insert([
            // Jenis tas
            ['name' => 'Tas Ransel', 'type' => 'jenis'],
            ['name' => 'Tas Selempang', 'type' => 'jenis'],
            ['name' => 'Tas Tote', 'type' => 'jenis'],

            // Fungsi tas
            ['name' => 'Tas Sekolah', 'type' => 'fungsi'],
            ['name' => 'Tas Kerja', 'type' => 'fungsi'],
            ['name' => 'Tas Travelling', 'type' => 'fungsi'],
        ]);
    }
}
