<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;

class ListingSeeder extends Seeder
{
    public function run()
    {
        Listing::create([
            'title' => 'Listing for Product 1', 
            'product_id' => 1, 
            'user_id' => 1, 
            'price' => 2.00, 
            'keywords' => 'example, product, 1',
            'image_url' => 'https://via.placeholder.com/150/0000FF/808080?text=Product+1'
        ]);
        Listing::create([
            'title' => 'Listing for Product 2', 
            'product_id' => 2, 
            'user_id' => 1, 
            'price' => 5.00, 
            'keywords' => 'example, product, 2',
            'image_url' => 'https://via.placeholder.com/150/FF0000/FFFFFF?text=Product+2'
        ]);
        Listing::create([
            'title' => 'Listing for Product 3', 
            'product_id' => 3, 
            'user_id' => 2, 
            'price' => 8.00, 
            'keywords' => 'example, product, 3',
            'image_url' => 'https://via.placeholder.com/150/FFFF00/000000?text=Product+3'
        ]);
    }
}
