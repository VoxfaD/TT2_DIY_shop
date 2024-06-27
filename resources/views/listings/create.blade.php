@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/listings-create-edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>{{ __('messages.create_listing') }}</h1>
    <form action="{{ route('listings.store') }}" method="POST"  enctype="multipart/form-data">
        @csrf
        <div>
            <label for="title">{{ __('messages.title') }}:</label>
            <input type="text" id="title" name="title" required>
        </div>
        <input type="hidden" id="user_id" name="user_id" value="{{ Auth::user()->id }}">
        <div>
            <label for="keyword_id">{{ __('messages.keyword') }}:</label>
            <select id="keyword_id" name="keyword_id" required>
                @foreach($keywords as $keyword)
                    <option value="{{ $keyword->id }}">{{ $keyword->title }}</option>
                @endforeach
            </select>
        </div>
        <div>
            <label for="price">{{ __('messages.price') }}:</label>
            <input type="number" id="price" name="price" step="0.01" required>
        </div>
        <div>
            <label for="image">{{ __('messages.image') }}:</label>
            <input type="file" id="image" name="image" accept="image/*" required>
        </div>
        <div>
            <label for="description">{{ __('messages.description') }}:</label>
            <textarea id="description" name="description" required></textarea>
        </div>
        <button type="submit">{{ __('messages.create_listing_button') }}</button>
    </form>
</div>
@endsection