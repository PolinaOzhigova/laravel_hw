@extends('layouts.app')

@section('title', 'Редактировать пост')

@section('content')
    <h1>Редактировать пост</h1>

    <form action="{{ route('posts.update', $post->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" value="{{ $post->title }}" required>

        <label for="content">Содержимое:</label>
        <textarea id="content" name="content" required>{{ $post->content }}</textarea>
        
        <label for="category">Категория:</label>
        <select id="category" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}" {{ $category->id == $post->category_id ? 'selected' : '' }}>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>

        <button type="submit">Обновить</button>
    </form>

    <a href="{{ route('posts.index') }}">Назад к списку постов</a>
@endsection