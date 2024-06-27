@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/listings-index.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="container">
    <h1 class="title">{{ __('messages.all_listings') }}</h1>
    <div class="content">
        <!-- Filter Form -->
        <form method="GET" action="{{ route('listings.index') }}" class="filter-form">
            <div class="keywords-filter">
                <h3>{{ __('messages.keyword') }}</h3>
                @foreach($keywords as $keyword)
                <div>
                        <input type="checkbox" id="keyword_{{ $keyword->id }}" name="keywords[]" value="{{ $keyword->id }}" 
                            {{ request('keywords') && in_array($keyword->id, request('keywords')) ? 'checked' : '' }}>
                        <label for="keyword_{{ $keyword->id }}">{{ $keyword->title }}</label>
                    </div>
                @endforeach
            </div>

            <div class="price-filter">
                <h3>{{ __('messages.price') }}</h3>
                <div>
                    <label for="min_price">{{ __('messages.minimum_price') }}</label>
                    <input type="number" id="min_price" name="min_price" value="{{ request('min_price') }}" step="0.01">
                </div>
                <div>
                    <label for="max_price">{{ __('messages.maximum_price') }}</label>
                    <input type="number" id="max_price" name="max_price" value="{{ request('max_price') }}" step="0.01">
                </div>
            </div>

            <button type="submit">{{ __('messages.filter') }}</button>
        </form>

        <div class="listings">
            @if(session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @foreach($listings as $listing)
                <div class="listing">
                    @if(auth()->check() && (auth()->user()->isAdmin() || auth()->user()->id == $listing->user_id))
                    <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn-danger" onclick="return confirm('Are you sure you want to delete this listing?')">{{ __('messages.delete_listing') }}</button>
                        </form>
                    @endif
                    <a href="{{ route('listings.show', $listing->id) }}">
                        <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
                    </a>
                    <h2>{{ $listing->title }}</h2>
                    <p>{{ __('messages.price') }}: ${{ number_format($listing->price, 2) }}</p>
                    <p>{{ __('messages.seller') }}: <a href="{{ route('seller.show', $listing->user->id) }}">{{ $listing->user->name }}</a></p>
                    <p>{{ __('messages.keyword') }}: 
                        @if($listing->keyword)
                            {{ $listing->keyword->title }}
                        @else
                            {{ __('messages.no_keyword') }}
                        @endif
                    </p>
                </div>
            @endforeach
        </div>
    </div>
</div>
@endsection