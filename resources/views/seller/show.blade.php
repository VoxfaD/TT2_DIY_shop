@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/seller-show.css') }}?v={{ time() }}">
@endsection

@section('content')
<div class="container">
    <h1>{{ $user->name }}'s {{ __('messages.profile') }}</h1>
    @if(auth()->check() && auth()->user()->isVendor() && auth()->user()->id == $user->id)
        <div class="actions">
            <a href="{{ route('seller.edit', $user->id) }}" class="btn btn-primary">{{ __('messages.edit_profile') }}</a>
            <a href="{{ route('listings.create') }}" class="btn btn-primary">{{ __('messages.create_new_listing') }}</a>
        </div>
    @endif
    <div class="profile">
        <img src="{{ $user->profile_picture }}" alt="{{ $user->name }}">
        <p>{{ $user->description }}</p>
    </div>
    <h2>{{ __('messages.listings_by') }} {{ $user->name }}</h2>
    <div class="listings">
        @foreach($user->listings as $listing)
            <div class="listing">
                <a href="{{ route('listing.show', $listing->id) }}"><img src="{{ $listing->image_url }}" alt="{{ $listing->title }}"></a>
                <h2>{{ $listing->title }}</h2>
                <p>{{ __('messages.price') }}: ${{ number_format($listing->price, 2) }}</p>
                <p>{{ __('messages.keyword') }}: {{ $listing->keyword ? $listing->keyword->title : __('messages.no_keyword') }}</p>
            </div>
        @endforeach
    </div>
</div>
@endsection