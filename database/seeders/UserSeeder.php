<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    public function run()
    {
         // Ensure profile pictures directory exists
         if (!Storage::disk('public')->exists('profile_pictures')) {
            Storage::disk('public')->makeDirectory('profile_pictures');
        }


        User::firstOrCreate(
            ['email' => 'Leah@example.com'],
            [
                'name' => 'Leah Pearl', 
                'password' => Hash::make('pass'),
                'role' => User::ROLE_VENDOR,
                'profile_picture' => $this->copyProfilePictureToStorage('Leah.jpg'),
                'description' => 'Hiii! I am Leah, i love making fashionable earrings and necklaces hope you find the one that speaks to you the most! :)'
            ]
        );

        User::firstOrCreate(
            ['email' => 'jasmine@example.com'],
            [
                'name' => 'Jasmine Leaf', 
                'password' => Hash::make('pass'),
                'role' => User::ROLE_VENDOR,
                'profile_picture' => $this->copyProfilePictureToStorage('Jasmine.jpg'),
                'description' => 'I love flowers (favourite one is Jasmines) and my designs incorporate floral designs'
            ]
        );

        User::firstOrCreate(
            ['email' => 'Vicky@example.com'],
            [
                'name' => 'Vicky Oak', 
                'password' => Hash::make('pass'),
                'role' => User::ROLE_VENDOR,
                'profile_picture' => $this->copyProfilePictureToStorage('Vicky.jpg'),
                'description' => 'Heyo! I am Vicky and I love knitting sweaters and scarfs in my past time, hope you like what you see!'
            ]
        );

        User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin User', 
                'password' => Hash::make('adminpassword'),
                'role' => User::ROLE_ADMIN,
                'profile_picture' => $this->copyProfilePictureToStorage('CP287-.png'),
                'description' => 'Admin user with full access to manage the application.'
            ]
        );

        User::firstOrCreate(
            ['email' => 'john@example.com'],
            [
                'name' => 'Johnny', 
                'password' => Hash::make('password'),
                'role' => User::ROLE_USER,
                'profile_picture' => 'https://via.placeholder.com/150/0000FF/808080?text=John',
                'description' => 'null'
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

    private function copyProfilePictureToStorage($imageName)
    {
        $sourcePath = database_path('seeders/images/pfp/' . $imageName);
        $destinationPath = 'profile_pictures/' . Str::random(10) . '_' . $imageName;
        Storage::disk('public')->put($destinationPath, file_get_contents($sourcePath));
        return $destinationPath;
    }
}