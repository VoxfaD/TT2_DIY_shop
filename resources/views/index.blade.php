<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>All the listings</h1>
        <div class="listings">
            @foreach($listings as $listing)
                <div class="listing">
                <a href="{{ route('listing.show', $listing->id) }}"><img src="{{ $listing->image_url }}" alt="{{ $listing->title }}"></a>
                        <h2>{{ $listing->title }}</h2>
                        <p>Price: ${{ number_format($listing->price, 2) }}</p>
                        <p>Seller: {{ $listing->user->name }}</p>
                        <p>Keywords: {{ $listing->keywords }}</p>
                </div>
            @endforeach
        </div>
    </div>
</body>
</html>