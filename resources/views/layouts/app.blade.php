<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title') - DIY Product Store</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
</head>
<body>
    <header class="header">
        <div class="logo">
            <a href="{{ route('listings.index') }}">DIY Product Store</a>
        </div>
        <div class="auth-links">
            @auth
                <p>Welcome, {{ auth()->user()->name }} | 
                    <a href="{{ route('logout') }}" 
                        onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                        Logout
                    </a>
                </p>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            @else
                <a href="{{ route('login') }}">Login</a>
                <a href="{{ route('register') }}">Register</a>
            @endauth
        </div>
    </header>

    <div class="container">
        @yield('content')
    </div>
</body>
</html>