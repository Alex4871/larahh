@extends('layout.app')

@section('title', 'Создание разметки')

@section('content')

    <div class="text-center">
        <h1 class="display-4 mb-4">Создание XML-файла</h1>
        <a href="{{route('journal.create')}}" class="btn btn-light btn-lg hover-lift">Начать</a>
    </div>


@endsection
