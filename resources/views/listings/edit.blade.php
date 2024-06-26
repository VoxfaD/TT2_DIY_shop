<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Listing - DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/listings-create-edit.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Listing</h1>
        <form action="{{ route('listings.update', $listing->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" value="{{ $listing->title }}" required>
            </div>
            <div>
                <label for="user_id">User ID:</label>
                <input type="number" id="user_id" name="user_id" value="{{ $listing->user_id }}" required>
            </div>
            <div>
                <label for="keyword_id">Keyword:</label>
                <select id="keyword_id" name="keyword_id" required>
                    @foreach($keywords as $keyword)
                        <option value="{{ $keyword->id }}" {{ $listing->keyword_id == $keyword->id ? 'selected' : '' }}>{{ $keyword->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" value="{{ $listing->price }}" required>
            </div>
            <div>
                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url" value="{{ $listing->image_url }}" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ $listing->description }}</textarea>
            </div>
            <button type="submit">Update Listing</button>
        </form>
    </div>
</body>
</html>