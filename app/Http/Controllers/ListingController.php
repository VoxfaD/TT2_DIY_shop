<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Keyword;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\App;

class ListingController extends Controller
{
    public function index(Request $request)
    {
        $query = Listing::with('keyword', 'user');

        // Filter by keywords if selected
        if ($request->has('keywords') && is_array($request->keywords)) {
            $query->whereIn('keyword_id', $request->keywords);
        }

        // Filter by minimum price if provided
        if ($request->has('min_price') && $request->min_price !== null) {
            $query->where('price', '>=', $request->min_price);
        }

        // Filter by maximum price if provided
        if ($request->has('max_price') && $request->max_price !== null) {
            $query->where('price', '<=', $request->max_price);
        }

        $listings = $query->get();
        $keywords = Keyword::all();

        return view('listings.index', compact('listings', 'keywords'));
    }

    public function show($id)
    {
        $listing = Listing::with(['keyword', 'user', 'reviews.user'])->findOrFail($id);
        return view('listings.show', compact('listing'));
    }

    public function create()
    {
        $keywords = Keyword::all();
        return view('listings.create', compact('keywords'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'keyword_id' => 'required',
            'price' => 'required|numeric',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required'
        ]);

        $imagePath = $request->file('image')->store('images', 'public');

        Listing::create([
            'title' => $request->title,
            'user_id' => $request->user_id,
            'keyword_id' => $request->keyword_id,
            'price' => $request->price,
            'image_url' => $imagePath,
            'description' => $request->description
        ]);

        return redirect()->route('listings.index');
    }

    public function edit($id)
    {
        $listing = Listing::findOrFail($id);
        $keywords = Keyword::all();
        return view('listings.edit', compact('listing', 'keywords'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'user_id' => 'required',
            'keyword_id' => 'required',
            'price' => 'required|numeric',
            'image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'required'
        ]);

        $listing = Listing::findOrFail($id);
        $listing->title = $request->title;
        $listing->user_id = $request->user_id;
        $listing->keyword_id = $request->keyword_id;
        $listing->price = $request->price;
        $listing->description = $request->description;

        if ($request->hasFile('image')) {
            if ($listing->image_url) {
                Storage::delete('public/' . $listing->image_url);
            }
            $listing->image_url = $request->file('image')->store('images', 'public');
        }

        $listing->save();

        return redirect()->route('listings.show', $listing->id);
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('listings.index');
    }
}