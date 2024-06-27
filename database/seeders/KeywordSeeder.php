<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keyword;

class KeywordSeeder extends Seeder
{
    public function run()
    {
        Keyword::firstOrCreate(['title' => 'Earrings']);
        Keyword::firstOrCreate(['title' => 'Plushie']);
        Keyword::firstOrCreate(['title' => 'Necklace']);
        Keyword::firstOrCreate(['title' => 'Sweater']);
        Keyword::firstOrCreate(['title' => 'Scarf']);
    }
}