@extends('layout.app')

@section('title', 'Добавление журнала')

@section('content')

    <div class="container">
        <form class="row h-100" action="{{route('journal.store')}}" method="post">
            <!-- Левый столбец -->
            <div class="col-6 d-flex flex-column">
                <div class="mb-3">
                    <label class="form-label">Название журнала (РУС)</label>
                    <input type="text" name="title_ru" class="form-control bg-dark text-light border-secondary"
                           placeholder="Введите название">
                </div>
                <div class="mb-3">
                    <label class="form-label">ISSN</label>
                    <input type="text" name="issn" class="form-control bg-dark text-light border-secondary"
                           placeholder="ISSN журнала">
                </div>
                <div class="mb-3">
                    <label class="form-label">Том</label>
                    <input type="text" name="volume" class="form-control bg-dark text-light border-secondary"
                           placeholder="Введите номер тома">
                </div>
                <div class="mb-3">
                    <label class="form-label">Дата публикации</label>
                    <input type="date" name="date" class="form-control bg-dark text-light border-secondary"
                           placeholder="Дата публикации">
                </div>
            </div>

            <!-- Правый столбец -->
            <div class="col-6 d-flex flex-column">
                <div class="mb-3">
                    <label class="form-label">Название журнала (ENG)</label>
                    <input type="text" name="title_en" class="form-control bg-dark text-light border-secondary"
                           placeholder="Введите название на английском">
                </div>
                <div class="mb-3">
                    <label class="form-label">eISSN</label>
                    <input type="text" name="eissn" class="form-control bg-dark text-light border-secondary"
                           placeholder="eISSN">
                </div>
                <div class="mb-3">
                    <label class="form-label">Номер</label>
                    <input type="text" name="issue" class="form-control bg-dark text-light border-secondary"
                           placeholder="Номер выпуска">
                </div>
                <div class="mb-3">
                    <label class="form-label">Издатель (ENG)</label>
                    <input type="text" name="publisher" class="form-control bg-dark text-light border-secondary"
                           placeholder="Издатель на аглийском языке">
                </div>
            </div>
            @csrf
            <div class="btn_wrapper text-center mt-3">
                <button type="submit" class="btn btn-light btn-lg hover-lift">Далее</button>
            </div>
        </form>


    </div>

@endsection


