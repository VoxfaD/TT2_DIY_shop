@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/listings-create-edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>{{ __('messages.edit_listing') }}</h1>
    <form action="{{ route('listings.update', $listing->id) }}" method="POST"  enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="title">{{ __('messages.title') }}:</label>
            <input type="text" id="title" name="title" value="{{ $listing->title }}" required>
        </div>
        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
        <div>
            <label for="keyword_id">{{ __('messages.keyword') }}:</label>
            <select id="keyword_id" name="keyword_id" required>
                @foreach($keywords as $keyword)
                    <option value="{{ $keyword->id }}" {{ $listing->keyword_id == $keyword->id ? 'selected' : '' }}>{{ $keyword->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price">{{ __('messages.price') }}:</label>
            <input type="number" id="price" name="price" step="0.01" value="{{ $listing->price }}" required>
        </div>
        <div>
            <label for="image">{{ __('messages.image') }}:</label>
            <input type="file" id="image" name="image" accept="image/*">
            @if($listing->image_url)
                <img src="{{ asset('storage/' . $listing->image_url) }}" alt="{{ $listing->title }}" style="max-width: 150px;">
            @endif
        </div>
        <div>
            <label for="description">{{ __('messages.description') }}:</label>
            <textarea id="description" name="description" required>{{ $listing->description }}</textarea>
        </div>
        <button type="submit">{{ __('messages.update_listing_button') }}</button>
    </form>
</div>
@endsection