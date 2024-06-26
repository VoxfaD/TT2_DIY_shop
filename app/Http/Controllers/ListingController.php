<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Listing;
use App\Models\Keyword;

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
            'keyword_id' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required|url',
            'description' => 'required'
        ]);

        Listing::create([
            'title' => $request->title,
            'user_id' => auth()->id(),
            'keyword_id' => $request->keyword_id,
            'price' => $request->price,
            'image_url' => $request->image_url,
            'description' => $request->description,
        ]);

        return redirect()->route('listings.index')->with('success', 'Listing created successfully.');
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
            'keyword_id' => 'required',
            'price' => 'required|numeric',
            'image_url' => 'required|url',
            'description' => 'required'
        ]);

        $listing = Listing::findOrFail($id);
        $listing->update($request->all());

        return redirect()->route('listings.show', $listing->id)->with('success', 'Listing updated successfully.');
    }

    public function destroy($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('listings.index')->with('success', 'Listing deleted successfully.');
    }
}