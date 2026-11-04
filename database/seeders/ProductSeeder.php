<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Clear old data before seeding new data
        Product::truncate();

        // Seed realistic fruit data
        Product::create([
            'name' => 'Xoài Cát Hòa Lộc',
            'price' => 60000,
            'stock' => 25.5,
            'image' => null
        ]);

        Product::create([
            'name' => 'Măng Cụt Chợ Lách',
            'price' => 55000,
            'stock' => 15.0,
            'image' => null
        ]);

        Product::create([
            'name' => 'Chuối Xiêm Chín',
            'price' => 15000,
            'stock' => 40.0,
            'image' => null
        ]);
    }
}
