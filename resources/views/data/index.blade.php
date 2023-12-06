@extends('layouts.app')

@section('title', 'Данные')

@section('content')
    <h1>Список полученных данных</h1>

    @if(count($data) > 0)
        <table border="1">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Введенные данные</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $item)
                    <tr>
                        <td>{{ $loop->index + 1 }}</td>
                        <td>{{ $item['data'] }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Нет данных для отображения.</p>
    @endif
@endsection