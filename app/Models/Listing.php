<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Listing extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'keyword_id',
        'price',
        'image_url',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function keyword()
    {
        return $this->belongsTo(Keyword::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
