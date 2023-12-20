@extends('layouts.app')

@section('title', 'Модерация комментариев')

@section('content')
    <h1>Модерация комментариев</h1>
    @forelse ($comments as $comment)
        <div>
            <p><strong>Пост:</strong> {{ $comment->post->title }}</p>
            <p><strong>Комментарий:</strong> {{ $comment->content }}</p>
            <p><strong>Создан:</strong> {{ $comment->created_at->format('d.m.Y H:i') }}</p>
            <form action="{{ route('comments.approve', $comment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('PUT')
                <button type="submit">Одобрить</button>
            </form>
            <form action="{{ route('comments.reject', $comment->id) }}" method="POST" style="display: inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Отклонить</button>
            </form>
        </div>
        <hr>
    @empty
        <p>Нет комментариев для модерации.</p>
    @endforelse

    <a href="{{ route('posts.index') }}">Вернуться к постам</a>
@endsection