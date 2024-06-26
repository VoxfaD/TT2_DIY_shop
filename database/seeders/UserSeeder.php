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
            ['email' => 'jane@example.com'],
            [
                'name' => 'Jane Smith', 
                'password' => Hash::make('password'),
                'role' => User::ROLE_VENDOR,
                'profile_picture' => 'https://via.placeholder.com/150/FF0000/FFFFFF?text=Jane',
                'description' => 'Jane loves crafting and selling DIY kits for enthusiasts.'
            ]
        );

        User::firstOrCreate(
            ['email' => 'jasminelin@example.com'],
            [
                'name' => 'Jasmine Lin', 
                'password' => Hash::make('password'),
                'role' => User::ROLE_VENDOR,
                'profile_picture' => 'https://via.placeholder.com/150/FFFF00/000000?text=Jasmine',
                'description' => 'Jasmine is an expert in home decor and DIY interior design.'
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User', 
                'password' => Hash::make('adminpassword'),
                'role' => User::ROLE_ADMIN,
                'profile_picture' => 'https://via.placeholder.com/150/000000/FFFFFF?text=Admin',
                'description' => 'Admin user with full access to manage the application.'
            ]
        );

        User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'John Doe', 
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/808080?text=John',
                'description' => 'John is a professional DIYer with a passion for creating unique projects.'
            ]
        );

        User::firstOrCreate(
            ['email' => 'visitor@example.com'],
            [
                'name' => 'Visitor User', 
                'password' => Hash::make('password'),
                'role' => User::ROLE_VISITOR,
            ]
        );
    }
}