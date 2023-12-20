<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'First')</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>

    <header>
        <img style="width:60px;height:60px;"src="{{ asset('images/logo.svg') }}" alt="Your Logo">
    <nav>
        <ul>
            <li><a href="{{ route('home') }}">Главная</a></li>
            <li><a href="{{ route('posts.index') }}">Блог</a></li>
            <li><a href="{{ route('posts.create') }}">Создать новый пост</a></li>
            <li><a href="{{ route('posts.drafts') }}">Черновики</a></li>
            <li><a href="{{ route('comments.moderationIndex') }}">Модерация комментариев</a></li>
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