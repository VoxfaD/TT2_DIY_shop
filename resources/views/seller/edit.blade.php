<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - {{ $user->name }}</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
    <div class="container">
        <h1>Edit Profile</h1>
        <form action="{{ route('seller.update', $user->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div>
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="{{ $user->name }}" required>
            </div>
            <div>
                <label for="description">Description:</label>
                <textarea id="description" name="description" required>{{ $user->description }}</textarea>
            </div>
            <div>
                <label for="profile_picture">Profile Picture URL:</label>
                <input type="url" id="profile_picture" name="profile_picture" value="{{ $user->profile_picture }}" required>
            </div>
            <button type="submit">Update Profile</button>
        </form>
    </div>
</body>
</html>