@extends('admin.layout.layout')

@section('content')
    <div class="container">
        <h3 class="m-3">Добавление новой вакансии</h3>
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form class="row g-4 needs-validation" method="post" action="{{route('admin.vacancies.store')}}">
            @csrf
            <div class="col-12">
                <label for="title" class="form-label fw-medium">Название вакантной должности</label>
                <input type="text" class="form-control" id="title" name="title" value="{{old('title')}}" required>
            </div>

            <div class="col-12">
                <label for="work_schedule" class="form-label fw-medium">График и место работы</label>
                <textarea class="form-control" id="work_schedule" name="work_schedule" rows="2" required>{{old('work_schedule')}}</textarea>
            </div>

            <div class="col-12">
                <label for="salary" class="form-label fw-medium">Заработная плата</label>
                <input type="text" class="form-control" id="salary" name="salary" value="{{old('salary')}}" placeholder="Например: от 80 000 ₽">
            </div>

            <div class="col-md-6">
                <label for="specialists" class="form-label fw-medium">Количество требуемых специалистов</label>
                <select class="form-select" id="specialists" name="numberOfSpecialist" required>
                    <option value="" disabled selected>Выберите количество</option>
                    @foreach($numberOfSpecialist as $number)
                        <option value="{{$number}}"
                            {{$number == old('numberOfSpecialist') ? 'selected' : ''}}>
                            {{$number}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-md-6">
                <label for="gender" class="form-label fw-medium">Пол</label>
                <select class="form-select" id="gender" name="gender" required>
                    <option value="" disabled selected>Выберите пол</option>
                    @foreach($genders as $gender)
                        <option value="{{$gender}}"
                            {{$gender == old('gender') ? 'selected' : ''}}>
                            {{$gender}}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="col-12">
                <label for="experience" class="form-label fw-medium">Опыт работы</label>
                <input type="text" class="form-control" id="experience" name="experience" value="{{old('experience')}}" placeholder="Например: не менее 2 лет">
            </div>

            <div class="col-12">
                <label for="responsibilities" class="form-label fw-medium">Краткий перечень должностных обязанностей</label>
                <textarea class="form-control" id="responsibilities" name="responsibilities" rows="3">{{old('responsibilities')}}</textarea>
            </div>

            <div class="col-12">
                <label for="conditions" class="form-label fw-medium">Предлагаемые условия работы</label>
                <textarea class="form-control" id="conditions" name="conditions" rows="3">{{old('conditions')}}</textarea>
            </div>

            <div class="col-12">
                <label for="addInformation" class="form-label fw-medium">Дополнительная информация</label>
                <textarea class="form-control" id="addInformation" name="addInformation" rows="3">{{old('addInformation')}}</textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary px-4">Добавить</button>
            </div>
        </form>
    </div>
@endsection
