@extends('layouts.app')

@section('title', 'Создать пост')

@section('content')
    <h1>Создать новый пост</h1>

    <form action="{{ route('posts.store') }}" method="POST">
        @csrf

        <label for="title">Заголовок:</label>
        <input type="text" id="title" name="title" required>
        @error('title')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <label for="content">Содержание:</label>
        <textarea id="content" name="content" required></textarea>
        @error('content')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <label for="category_id">Выберите категорию:</label>
        <select id="category_id" name="category_id" required>
            @foreach ($categories as $category)
                <option value="{{ $category->id }}">{{ $category->name }}</option>
            @endforeach
        </select>
        @error('category_id')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit" name="action" value="drafts">Сохранить как черновик</button>
        <button type="submit" name="action" value="create">Опубликовать</button>

    </form>
@endsection