@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1>{{ $post->title }}</h1>
    <p>{{ $post->content }}</p>

    <h2>Комментарии:</h2>
    <ul>
        @forelse ($comments as $comment)
            <li>{{ $comment->content }}</li>
        @empty
            <li>Нет комментариев</li>
        @endforelse
    </ul>

    <form action="{{ route('comments.store', ['post' => $post->id]) }}" method="POST">
        @csrf

        <label for="content">Добавить комментарий:</label>
        <textarea id="content" name="content" required></textarea>
        @error('content')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">Отправить комментарий</button>
    </form>

    <a href="{{ route('posts.index') }}">Назад к списку постов</a>
@endsection
