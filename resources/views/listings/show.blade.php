@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/listings-show.css') }}?v={{ time() }}">
@endsection

@section('content')
    <div class="container">
        <h1>{{ $listing->title }}</h1>
        <div class="listing-detail">
            <div class="image-container">
                <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
            </div>
            <p>{{ __('messages.price') }}: ${{ number_format($listing->price, 2) }}</p>
            <p>{{ __('messages.seller') }}: <a href="{{ route('seller.show', $listing->user->id) }}">{{ $listing->user->name }}</a></p>
            <p>{{ __('messages.description') }}: {{ $listing->description }}</p>
            <p>{{ __('messages.keyword') }}: {{ $listing->keyword ? $listing->keyword->title : __('messages.no_keyword') }}</p>
        </div>
        
        <!-- Edit and Delete Buttons -->
        @if(auth()->check() && auth()->user()->id == $listing->user_id)
            <div class="actions">
                <a href="{{ route('listings.edit', $listing->id) }}" class="btn btn-primary">{{ __('messages.edit_listing') }}</a>
                <form action="{{ route('listings.destroy', $listing->id) }}" method="POST" style="display:inline-block;">
                    @csrf
                    @method('DELETE')
                    <button type="submit"  class="btn btn-danger">{{ __('messages.delete_listing') }}</button>
                </form>
            </div>
        @endif

        <div class="reviews">
            <h2>{{ __('messages.reviews') }}</h2>

            <!-- Review Form -->
            @auth
                <div class="add-review">
                    <h2>{{ __('messages.add_review') }}</h2>
                    <form action="{{ route('reviews.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="listing_id" value="{{ $listing->id }}">
                        <div>
                            <label for="rating">{{ __('messages.rating') }}:</label>
                            <select id="rating" name="rating" required>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                            </select>
                        </div>
                        <div>
                            <label for="content">{{ __('messages.review') }}:</label>
                            <textarea id="content" name="content" required></textarea>
                        </div>
                        <button type="submit">{{ __('messages.submit_review') }}</button>
                    </form>
                </div>
            @endauth

            @foreach($listing->reviews ?? [] as $review)
                <div class="review">
                    <p><strong>{{ $review->user->name }}</strong> {{ __('messages.rated') }} {{ $review->rating }}/5</p>
                    <p>{{ $review->content }}</p>
                    @if(auth()->check() && (auth()->user()->id == $review->user_id || auth()->user()->isAdmin()))
                        <form action="{{ route('reviews.destroy', $review->id) }}" method="POST" style="display:inline-block;">
                            @csrf
                            @method('DELETE')
                            <button type="submit"  class="btn btn-danger">{{ __('messages.delete_review') }}</button>
                        </form>
                    @endif
                </div>
            @endforeach
        </div>
    </div>
@endsection