<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'name' => 'Tas Ransel Keren',
            'description' => 'Tas ransel warna hitam cocok untuk sekolah',
            'price' => 150000,
            'image' => 'tas1.jpg',
            'status' => true,
            'category_id' => 1,
        ]);

        // Tambah produk lain...
    }
}

