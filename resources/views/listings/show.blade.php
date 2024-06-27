<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $listing->title }} - DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/listings-show.css') }}">
</head>
<body>
@extends('layouts.app')

@section('title', $listing->title)

@section('content')
    <div class="container">
        <h1>{{ $listing->title }}</h1>
        <div class="listing-detail">
            <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
            <p>Price: ${{ number_format($listing->price, 2) }}</p>
            <p>Seller: <a href="{{ route('seller.show', $listing->user->id) }}">{{ $listing->user->name }}</a></p>
            <p>Description: {{ $listing->description }}</p>
            <p>Keywords: {{ $listing->keyword ? $listing->keyword->title : 'No keyword' }}</p>
        </div>
        
        <!-- Edit and Delete Buttons -->
        @if(auth()->check() && auth()->user()->id == $listing->user_id)
            <div class="actions">
                <a href="{{ route('listings.edit', $listing->id) }}" class="btn btn-primary">Edit Listing</a>
                <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" onclick="return confirm('Are you sure you want to delete this listing?')" class="btn btn-danger">Delete Listing</button>
                </form>
            </div>
        @endif

        <div class="reviews">
            <h2>Reviews</h2>

            <!-- Review Form -->
            @auth
                <div class="add-review">
                    <h2>Add a Review</h2>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <div>
                            <label for="rating">Rating:</label>
                            <select id="rating" name="rating" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div>
                            <label for="content">Review:</label>
                            <textarea id="content" name="content" required></textarea>
                        </div>
                        <button type="submit">Submit Review</button>
                    </form>
                </div>
            @endauth

            @foreach($listing->reviews ?? [] as $review)
                <div class="review">
                    <p><strong>{{ $review->user->name }}</strong> rated {{ $review->rating }}/5</p>
                    <p>{{ $review->content }}</p>
                    @if(auth()->check() && (auth()->user()->id == $review->user_id || auth()->user()->isAdmin()))
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this review?')" class="btn btn-danger">Delete Review</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
    @endsection
</body>
</html>