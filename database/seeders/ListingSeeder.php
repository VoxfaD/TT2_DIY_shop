<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\Keyword;

class ListingSeeder extends Seeder
{
    public function run()
    {
        $keyword1 = Keyword::where('title', 'example')->first();
        $keyword2 = Keyword::where('title', 'product')->first();
        $keyword3 = Keyword::where('title', '1')->first();

        Listing::create([
            'title' => 'Listing for Product 1',
            'user_id' => 1,
            'keyword_id' => $keyword1->id,
            'price' => 2.00,
            'image_url' => 'https://via.placeholder.com/150/0000FF/808080?text=Product+1',
            'description' => 'Description for Product 1'
        ]);

        Listing::create([
            'title' => 'Listing for Product 2',
            'user_id' => 1,
            'keyword_id' => $keyword2->id,
            'price' => 5.00,
            'image_url' => 'https://via.placeholder.com/150/FF0000/FFFFFF?text=Product+2',
            'description' => 'Description for Product 2'
        ]);

        Listing::create([
            'title' => 'Listing for Product 3',
            'user_id' => 2,
            'keyword_id' => $keyword3->id,
            'price' => 8.00,
            'image_url' => 'https://via.placeholder.com/150/FFFF00/000000?text=Product+3',
            'description' => 'Description for Product 3'
        ]);
    }
}
