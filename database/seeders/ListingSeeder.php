<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Listing;
use App\Models\Keyword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ListingSeeder extends Seeder
{
    public function run()
    {
        $keyword1 = Keyword::where('title', 'Earrings')->first();
        $keyword2 = Keyword::where('title', 'Plushie')->first();
        $keyword3 = Keyword::where('title', 'Necklace')->first();
        $keyword4 = Keyword::where('title', 'Sweater')->first();
        $keyword5 = Keyword::where('title', 'Scarf')->first();

        $imagePaths = [
            'Earrings1.jpg' => $this->copyImageToStorage('Earrings1.jpg'),
            'Earrings2.jpg' => $this->copyImageToStorage('Earrings2.jpg'),
            'Necklace1.jpg' => $this->copyImageToStorage('Necklace1.jpg'),
            'Necklace2.jpg' => $this->copyImageToStorage('Necklace2.jpg'),
            'Plushie1.jpg' => $this->copyImageToStorage('Plushie1.jpg'),
            'Plushie2.jpg' => $this->copyImageToStorage('Plushie2.jpg'),
            'scarf1.jpg' => $this->copyImageToStorage('scarf1.jpg'),
            'scarf2.jpg' => $this->copyImageToStorage('scarf2.jpg'),
            'sweater1.jpg' => $this->copyImageToStorage('sweater1.jpg'),
            'sweater2.jpg' => $this->copyImageToStorage('sweater2.jpg'),
            'sweater3.jpg' => $this->copyImageToStorage('sweater3.jpg'),
        ];

        Listing::create([
            'title' => 'Jellyfish Earrings',
            'user_id' => 1,
            'keyword_id' => $keyword1->id,
            'price' => 5.00,
            'image_url' => $imagePaths['Earrings1.jpg'],
            'description' => 'Asymmetrical and Whimsical Jellyfish Earrings, only available in this specific color.'
        ]);

        Listing::create([
            'title' => 'Moon Earrings',
            'user_id' => 1,
            'keyword_id' => $keyword1->id,
            'price' => 4.00,
            'image_url' => $imagePaths['Earrings2.jpg'],
            'description' => 'Vintage Rhinestone Crystal Moon Planet Pearl Zircon Earring, quality made and has some smaller details to it.'
        ]);

        Listing::create([
            'title' => 'Butterfly Necklace',
            'user_id' => 1,
            'keyword_id' => $keyword3->id,
            'price' => 7.00,
            'image_url' => $imagePaths['Necklace2.jpg'],
            'description' => 'A lovely butterfly necklace with a dainty butterfly pendant.
                                Gold base colour
                                    Gold chain: 18k Gold plating over brass
                                    Pendant: Glass crystal, cubic zirconia.'
        ]);


        Listing::create([
            'title' => 'Flower Necklace',
            'user_id' => 2,
            'keyword_id' => $keyword3->id,
            'price' => 5.00,
            'image_url' => $imagePaths['Necklace1.jpg'],
            'description' => 'A Flower Necklace or Sakura Flower Pendant, carefully crafted and very neat looking.'
        ]);

        Listing::create([
            'title' => 'Flower Plushie',
            'user_id' => 2,
            'keyword_id' => $keyword2->id,
            'price' => 8.00,
            'image_url' => $imagePaths['Plushie1.jpg'],
            'description' => 'Knitted flower plushie, works great as a decor or can go with any floral outfit together.'
        ]);

        Listing::create([
            'title' => 'Floral Cow plush',
            'user_id' => 2,
            'keyword_id' => $keyword2->id,
            'price' => 15.00,
            'image_url' => $imagePaths['Plushie2.jpg'],
            'description' => 'Knitted purple cow plushie wearing a nice sunflower flowercrown.'
        ]);

        Listing::create([
            'title' => 'Floral sweater',
            'user_id' => 2,
            'keyword_id' => $keyword4->id,
            'price' => 16.00,
            'image_url' => $imagePaths['sweater3.jpg'],
            'description' => 'A cute knitted blue sweater with white flowers knitted on to it, cute for a casual day out.'
        ]);

        Listing::create([
            'title' => 'White scarf',
            'user_id' => 3,
            'keyword_id' => $keyword5->id,
            'price' => 13.00,
            'image_url' => $imagePaths['scarf1.jpg'],
            'description' => 'Very warm knitted scarf good for winter time to keep yourself warm.'
        ]);

        Listing::create([
            'title' => 'Magenta scarf',
            'user_id' => 3,
            'keyword_id' => $keyword5->id,
            'price' => 9.00,
            'image_url' => $imagePaths['scarf2.jpg'],
            'description' => 'A cute magenta scarf, looks good for any outfit an very soft.'
        ]);

        Listing::create([
            'title' => 'Heart sweater',
            'user_id' => 3,
            'keyword_id' => $keyword4->id,
            'price' => 18.00,
            'image_url' => $imagePaths['sweater1.jpg'],
            'description' => 'Cute and dainty sweater, Valentine day inspired.'
        ]);


    }

    private function copyImageToStorage($imageName)
    {
        $sourcePath = database_path('seeders/images/' . $imageName);
        $destinationPath = 'images/' . Str::random(10) . '_' . $imageName;
        Storage::disk('public')->put($destinationPath, file_get_contents($sourcePath));
        return $destinationPath;
    }
}
