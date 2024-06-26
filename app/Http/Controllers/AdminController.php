<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Listing;
use App\Models\Review;

class AdminController extends Controller
{
    public function destroyUser($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return redirect()->route('admin.index')->with('success', 'User deleted successfully.');
    }

    public function destroyListing($id)
    {
        $listing = Listing::findOrFail($id);
        $listing->delete();

        return redirect()->route('admin.index')->with('success', 'Listing deleted successfully.');
    }

    public function destroyReview($id)
    {
        $review = Review::findOrFail($id);
        $review->delete();

        return redirect()->route('admin.index')->with('success', 'Review deleted successfully.');
    }

    public function index()
    {
        $users = User::all();
        $listings = Listing::all();
        $reviews = Review::all();

        return view('admin.index', compact('users', 'listings', 'reviews'));
    }
}