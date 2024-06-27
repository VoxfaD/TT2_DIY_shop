<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}?v={{ time() }}">
    @yield('styles')
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="{{ route('listings.index') }}">DIY Product Store</a>
        </div>
                <div class="language-switcher">
            <a href="{{ route('locale.switch', ['lang' => 'en']) }}">EN</a> | 
            <a href="{{ route('locale.switch', ['lang' => 'lv']) }}">LV</a>
        </div>
        <div class="auth-links">
            @auth
                <p>{{ __('messages.welcome') }}, {{ auth()->user()->name }} | 
                    <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        {{ __('messages.logout') }}
                    </a>
                </p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
            @endauth
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>