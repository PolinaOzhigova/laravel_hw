<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'First')</title>
</head>
<body>

    <header>
        <img src="{{ asset('images/logo.png') }}" alt="Your Logo">
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('posts.index') }}">Список постов</a></li>
            <li><a href="{{ route('about') }}">О нас</a></li>
        </ul>
    </nav>
    </header>

    <main>
        @yield('content')
    </main>

    <footer>
        <p>&copy; {{ date('Y') }} First. All rights reserved.</p>
    </footer>
</body>
</html>