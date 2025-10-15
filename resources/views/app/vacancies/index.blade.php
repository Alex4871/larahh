@extends('app.layout.app')

@section('title', 'Электронная ярмарка вакансий')

@section('content')

    <div class="row g-4 mb-5">
        @forelse($vacancies as $vacancy)

            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">{{$vacancy->title}}</h5>
                        <p class="card-text">{{$vacancy->salary}} руб.</p>
                        <p class="card-text">{{$vacancy->responsibilities}}</p>
                    </div>
                </div>
            </div>

        @empty
            <p>Вакансий не найдено (((</p>
        @endforelse

    </div>

@endsection
