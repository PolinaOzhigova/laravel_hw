@extends('layouts.app')

@section('title', 'Черновики')

@section('content')
    <h1>Черновики</h1>

    <ul>
        @foreach ($drafts as $draft)
            <li>
                <h2><a href="{{ route('posts.show', $draft->id) }}">{{ $draft->title }}</a></h2>
                <p>{{ $draft->content }}</p>
                <p><strong>Категория:</strong> {{ $draft->category->name }}</p>
                <p><em>Создано: {{ $draft->created_at->format('d.m.Y H:i') }}</em></p>

                <form action="{{ route('posts.publishDraft', $draft->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('PUT')
                    <button type="submit">Опубликовать</button>
                </form>


                <form action="{{ route('posts.edit', $draft->id) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit">Редактировать</button>
                </form>

                <form action="{{ route('posts.destroy', $draft->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection