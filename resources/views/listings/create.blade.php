<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Listing - DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/listings-create-edit.css') }}">
</head>
<body>
    <div class="container">
        <h1>Create Listing</h1>
        <form action="{{ route('listings.store') }}" method="POST">
            @csrf
            <div>
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="keyword_id">Keyword:</label>
                <select id="keyword_id" name="keyword_id" required>
                    @foreach($keywords as $keyword)
                        <option value="{{ $keyword->id }}">{{ $keyword->title }}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <label for="price">Price:</label>
                <input type="number" id="price" name="price" step="0.01" required>
            </div>
            <div>
                <label for="image_url">Image URL:</label>
                <input type="url" id="image_url" name="image_url" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required></textarea>
            </div>
            <button type="submit">Create Listing</button>
        </form>
    </div>
</body>
</html>