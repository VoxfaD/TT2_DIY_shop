<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;

class ListingController extends Controller
{
    public function index()
    {
        $listings = Listing::with('user')->get();
        return view('index', compact('listings'));
    }

    public function show($id)
    {
        $listing = Listing::with(['user', 'reviews.user'])->findOrFail($id);
        return view('show', compact('listing'));
    }
}
