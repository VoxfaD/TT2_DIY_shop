<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'name', 'price', 'description',
    ];

    public function listings()
    {
        return $this->hasMany(Listing::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}