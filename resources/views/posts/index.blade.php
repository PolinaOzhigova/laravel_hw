@extends('layouts.app')

@section('title', 'Блог')

@section('content')
    <h1>Список постов</h1>

    <form action="{{ route('posts.index') }}" method="GET">
        <label for="category">Выберите категорию:</label>
        <select id="category" name="category">
            <option value="all">Все категории</option>
            @foreach ($categories as $category)
                <option value="{{ $category->name }}" {{ request('category') == $category->name ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
        <button type="submit">Фильтровать</button>
    </form>

    <ul>
        @foreach ($posts as $post)
            <li>
                <h2>{{ $post->title }}</h2>
                <a href="{{ route('posts.show', $post->id) }}">Комментарии</a>
                <p>{{ $post->content }}</p>
                <p><strong>Категория:</strong> {{ $post->category->name }}</p>
                <p><em>Создано: {{ $post->created_at->format('d.m.Y H:i') }}</em></p>

                @if ($post->status === 'published')
                    <form action="{{ route('posts.unpublish', $post->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('PUT')
                        <button type="submit">Снять с публикации</button>
                    </form>
                @endif

                <form action="{{ route('posts.edit', $post->id) }}" method="GET" style="display: inline;">
                    @csrf
                    <button type="submit">Редактировать</button>
                </form>

                <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit">Удалить</button>
                </form>
            </li>
        @endforeach
    </ul>
@endsection