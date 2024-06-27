<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;

class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'listing_id' => 'required|exists:listings,id',
            'rating' => 'required|integer|between:1,5',
            'content' => 'required|string'
        ]);

        Review::create([
            'listing_id' => $request->listing_id,
            'user_id' => auth()->id(), // Assuming user is logged in
            'rating' => $request->rating,
            'content' => $request->content
        ]);

        return redirect()->route('listings.show', $request->listing_id)->with('success', 'Review added successfully.');
    }

    public function destroy($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->back()->with('success', 'Review deleted successfully.');
    }
}