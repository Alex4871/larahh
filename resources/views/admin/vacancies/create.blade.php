@extends('admin.layout.layout')

@section('content')
    <div class="container">
        <h3 class="m-3">Добавление новой вакансии</h3>
        <form class="row g-4 needs-validation" novalidate>
            <div class="col-12">
                <label for="title" class="form-label fw-medium">Название вакантной должности</label>
                <input type="text" class="form-control" id="title" required>
            </div>

            <div class="col-12">
                <label for="work_schedule" class="form-label fw-medium">График и место работы</label>
                <textarea class="form-control" id="work_schedule" rows="2" required></textarea>
            </div>

            <div class="col-12">
                <label for="salary" class="form-label fw-medium">Заработная плата</label>
                <input type="text" class="form-control" id="salary" placeholder="Например: от 80 000 ₽">
            </div>

            <div class="col-md-6">
                <label for="specialists" class="form-label fw-medium">Количество требуемых специалистов</label>
                <select class="form-select" id="specialists" required>
                    <option value="" disabled selected>Выберите количество</option>
                    <option value="1">1</option>
                    <option value="2">2</option>
                    <option value="3">3</option>
                </select>
            </div>

            <div class="col-md-6">
                <label for="gender" class="form-label fw-medium">Пол</label>
                <select class="form-select" id="gender" required>
                    <option value="" disabled selected>Выберите пол</option>
                    <option value="Мужской">Мужской</option>
                    <option value="Женский">Женский</option>
                </select>
            </div>

            <div class="col-12">
                <label for="experience" class="form-label fw-medium">Опыт работы</label>
                <input type="text" class="form-control" id="experience" placeholder="Например: не менее 2 лет">
            </div>

            <div class="col-12">
                <label for="responsibilities" class="form-label fw-medium">Краткий перечень должностных обязанностей</label>
                <textarea class="form-control" id="responsibilities" rows="3"></textarea>
            </div>

            <div class="col-12">
                <label for="conditions" class="form-label fw-medium">Предлагаемые условия работы</label>
                <textarea class="form-control" id="conditions" rows="3"></textarea>
            </div>

            <div class="col-12">
                <label for="addInformation" class="form-label fw-medium">Дополнительная информация</label>
                <textarea class="form-control" id="addInformation" rows="3"></textarea>
            </div>

            <div class="col-12">
                <button type="submit" class="btn btn-primary px-4">Добавить</button>
            </div>
        </form>
    </div>
@endsection
