@extends('layouts.app')

@section('title', 'Главная')

@section('content')
    <h1>Добро пожаловать на главную страницу!</h1>

    <form action="{{ route('submitForm') }}" method="POST">
        @csrf

        <label for="data">Введите имя:</label>
        <input type="text" id="data" name="data" required>
        @error('data')
            <p style="color: red;">{{ $message }}</p>
        @enderror

        <button type="submit">Отправить</button>
    </form>

    @if(session('successMessage'))
        <p style="color: green;">{{ session('successMessage') }}</p>
    @endif
@endsection
