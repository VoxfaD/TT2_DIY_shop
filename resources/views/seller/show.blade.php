<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile - DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/seller-show.css') }}">
</head>
<body>
@extends('layouts.app')

@section('title', $user->name . "'s Profile")

@section('content')
    <div class="container">
        <h1>{{ $user->name }}'s Profile</h1>

        @if(auth()->check() && auth()->user()->isVendor() && auth()->user()->id == $user->id)
            <div class="actions">
                <a href="{{ route('seller.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
                <a href="{{ route('listings.create') }}" class="btn btn-primary">Create New Listing</a>
            </div>
        @endif

        <div class="profile">
            <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}">
            <p>{{ $user->description }}</p>
        </div>
        <h2>Listings by {{ $user->name }}</h2>
        <div class="listings">
            @foreach($user->listings as $listing)
                <div class="listing">
                    <a href="{{ route('listing.show', $listing->id) }}"><img src="{{ $listing->image_url }}" alt="{{ $listing->title }}"></a>
                    <h2>{{ $listing->title }}</h2>
                    <p>Price: ${{ number_format($listing->price, 2) }}</p>
                    <p>Keywords: {{ $listing->keyword ? $listing->keyword->title : 'No keyword' }}</p>
                </div>
            @endforeach
        </div>
    </div>
@endsection
    
</body>
</html>