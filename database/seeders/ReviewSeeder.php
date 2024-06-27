<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;

class ReviewSeeder extends Seeder
{
    public function run()
    {
        Review::create([
            'listing_id' => 1,
            'user_id' => 2,
            'content' => 'Great product, highly recommend!',
            'rating' => 5
        ]);

        Review::create([
            'listing_id' => 1,
            'user_id' => 3,
            'content' => 'Decent quality for the price.',
            'rating' => 4
        ]);

        Review::create([
            'listing_id' => 2,
            'user_id' => 3,
            'content' => 'Not what I expected.',
            'rating' => 2
        ]);

        Review::create([
            'listing_id' => 3,
            'user_id' => 5,
            'content' => 'Excellent product!',
            'rating' => 5
        ]);
    }
}
