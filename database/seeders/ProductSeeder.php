<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'title' => 'Example Product 1',
            'name' => 'Product One',
            'price' => 20.00,
            'description' => 'Description for product one'
        ]);
        Product::create([
            'title' => 'Example Product 2',
            'name' => 'Product Two',
            'price' => 35.00,
            'description' => 'Description for product two'
        ]);
        Product::create([
            'title' => 'Example Product 3',
            'name' => 'Product Three',
            'price' => 50.00,
            'description' => 'Description for product three'
        ]);
    }
}