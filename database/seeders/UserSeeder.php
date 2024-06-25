<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::firstOrCreate(
            ['email' => 'john@example.com'],
            ['name' => 'John Doe', 'password' => Hash::make('password')]
        );

        User::firstOrCreate(
            ['email' => 'jane@example.com'],
            ['name' => 'Jane Smith', 'password' => Hash::make('password')]
        );

        User::firstOrCreate(
            ['email' => 'jasminelin@example.com'],
            ['name' => 'Jasmine Lin', 'password' => Hash::make('password')]
        );
    }
}