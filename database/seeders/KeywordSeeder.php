<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Keyword;

class KeywordSeeder extends Seeder
{
    public function run()
    {
        Keyword::firstOrCreate(['title' => 'example']);
        Keyword::firstOrCreate(['title' => 'product']);
        Keyword::firstOrCreate(['title' => '1']);
        Keyword::firstOrCreate(['title' => '2']);
        Keyword::firstOrCreate(['title' => '3']);
    }
}