@extends('layouts.app')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/seller-edit.css') }}">
@endsection

@section('content')
<div class="container">
    <h1>{{ __('messages.edit_profile') }} - {{ $user->name }}</h1>
    <form action="{{ route('seller.update', $user->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div>
            <label for="name">{{ __('messages.name') }}:</label>
            <input type="text" id="name" name="name" value="{{ $user->name }}" required>
        </div>
        <div>
            <label for="description">{{ __('messages.description') }}:</label>
            <textarea id="description" name="description" required>{{ $user->description }}</textarea>
        </div>
        <div>
            <label for="profile_picture">{{ __('messages.profile_picture') }}:</label>
            <input type="file" id="profile_picture" name="profile_picture" accept="image/*">
            @if($user->profile_picture)
                <img src="{{ asset('storage/' . $user->profile_picture) }}" alt="{{ $user->name }}" style="max-width: 150px;">
            @endif
        </div>
        <button type="submit">{{ __('messages.update_profile') }}</button>
    </form>
</div>
@endsection