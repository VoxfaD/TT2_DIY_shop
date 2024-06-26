<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeywordListing extends Model
{
    use HasFactory;

    protected $table = 'keyword_listing';

    protected $fillable = ['keyword_id', 'listing_id'];
}
