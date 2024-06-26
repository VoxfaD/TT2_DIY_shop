
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/listings-index.css') }}">
</head>
<body>
@extends('layouts.app')

@section('title', 'All the listings')

@section('content')
    <div class="container">
        <h1 class="title">All the listings</h1>

        <div class="content">
            <!-- Filter Form -->
            <form method="GET" action="{{ route('listings.index') }}" class="filter-form">
                <div class="keywords-filter">
                    <h3>Keywords</h3>
                    @foreach($keywords as $keyword)
                        <div>
                            <input type="checkbox" id="keyword_{{ $keyword->id }}" name="keywords[]" value="{{ $keyword->id }}" 
                                {{ request('keywords') && in_array($keyword->id, request('keywords')) ? 'checked' : '' }}>
                            <label for="keyword_{{ $keyword->id }}">{{ $keyword->title }}</label>
                        </div>
                    @endforeach
                </div>

                <div class="price-filter">
                    <h3>Price</h3>
                    <div>
                        <label for="min_price">Minimum price:</label>
                        <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" step="0.01">
                    </div>
                    <div>
                        <label for="max_price">Maximum price:</label>
                        <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" step="0.01">
                    </div>
                </div>

                <button type="submit">Filter</button>
            </form>

            <div class="listings">
                @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif

                @foreach($listings as $listing)
                    <div class="listing">
                    @if(auth()->check() && (auth()->user()->isAdmin() || (auth()->user()->isVendor() && auth()->user()->id == $listing->user_id)))
                            <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Are you sure you want to delete this listing?')">Delete</button>
                            </form>
                        @endif
                        <a href="{{ route('listings.show', $listing->id) }}">
                            <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
                        </a>
                        <h2>{{ $listing->title }}</h2>
                        <p>Price: ${{ number_format($listing->price, 2) }}</p>
                        <p>Seller: <a href="{{ route('seller.show', $listing->user->id) }}">{{ $listing->user->name }}</a></p>
                        <p>Keyword: 
                            @if($listing->keyword)
                                {{ $listing->keyword->title }}
                            @else
                                No keyword
                            @endif
                        </p>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
</body>
</html>