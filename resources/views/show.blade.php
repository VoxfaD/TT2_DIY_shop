<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $listing->title }} - DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>{{ $listing->title }}</h1>
        <div class="listing-detail">
            <img src="{{ $listing->image_url }}" alt="{{ $listing->title }}">
            <p>Price: ${{ number_format($listing->price, 2) }}</p>
            <p>Seller: {{ $listing->user->name }}</p>
            <p>Description: {{ $listing->product->description }}</p>
            <p>Keywords: {{ $listing->keywords }}</p>
        </div>
        <div class="reviews">
            <h2>Reviews</h2>
            @foreach($listing->reviews as $review)
                <div class="review">
                    <p><strong>{{ $review->user->name }}</strong> rated {{ $review->rating }}/5</p>
                    <p>{{ $review->content }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>