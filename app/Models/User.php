<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    const ROLE_VISITOR = 'visitor';
    const ROLE_USER = 'user';
    const ROLE_VENDOR = 'vendor';
    const ROLE_ADMIN = 'admin';

    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'profile_picture',
        'description',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function isAdmin()
    {
        return $this->role === self::ROLE_ADMIN;
    }

    public function isVendor()
    {
        return $this->role === self::ROLE_VENDOR;
    }

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function getProfilePictureAttribute($value)
    {
        return $value ? asset('storage/' . $value) : asset('images/default_profile_picture.png');
    }
}