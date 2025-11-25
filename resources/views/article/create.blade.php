@extends('layout.app')

@section('title', 'Добавление журнала')

@section('content')

    <div class="container">

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form class="row h-100" action="{{ route('article.store', ['journal' => $journal]) }}" method="post">
            <!-- Левый столбец -->
            <div class="col-6 d-flex flex-column">
                <!-- Поле: DOI -->
                <div class="mb-3">
                    <label class="form-label">DOI</label>
                    <input type="text" name="doi" value="{{old('doi')}}"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="10.xxxx/xxxxx">
                </div>
                <!-- Поле: УДК -->
                <div class="mb-3">
                    <label class="form-label">УДК</label>
                    <input type="text" name="udk" value="{{old('udk')}}"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="УДК">
                </div>
                <!-- Поле: Название (РУС) -->
                <div class="mb-3">
                    <label class="form-label">Название статьи (РУС)</label>
                    <input type="text" name="title_ru" value="{{old('title_ru')}}"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="Введите название на русском">
                </div>
                <!-- Поле: Аннотация (РУС) -->
                <div class="mb-3 flex-grow-1">
                    <label class="form-label">Аннотация (РУС)</label>
                    <textarea name="annotation_ru" class="form-control bg-dark text-light border-secondary" rows="5"
                              placeholder="Введите аннотацию на русском">{{old('annotation_ru')}}</textarea>
                </div>
                <!-- Поле: Первая страница -->
                <div class="mb-3">
                    <label class="form-label">Первая страница</label>
                    <input type="number" value="{{old('f_page')}}" name="f_page"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="Номер первой страницы">
                </div>
            </div>

            <!-- Правый столбец -->
            <div class="col-6 d-flex flex-column">
                <!-- Поле: EDN -->
                <div class="mb-3">
                    <label class="form-label">EDN (ровно 6 символов)</label>
                    <input type="text" name="edn" value="{{old('edn')}}"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="EDN код">
                </div>

                <!-- Поле: Дата -->
                <div class="mb-3">
                    <label class="form-label">Дата публикации</label>
                    <input type="date" name="date" value="{{old('date')}}"
                           class="form-control bg-dark text-light border-secondary">
                </div>

                <!-- Поле: Название (ENG) -->
                <div class="mb-3">
                    <label class="form-label">Название статьи (ENG)</label>
                    <input type="text" name="title_en" value="{{old('title_en')}}"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="Введите название на английском">
                </div>

                <!-- Поле: Аннотация (ENG) -->
                <div class="mb-3 flex-grow-1">
                    <label class="form-label">Аннотация (ENG)</label>
                    <textarea name="annotation_en" class="form-control bg-dark text-light border-secondary" rows="5"
                              placeholder="Введите аннотацию на английском">{{old('annotation_en')}}</textarea>
                </div>
                <!-- Поле: Последняя страница -->
                <div class="mb-3">
                    <label class="form-label">Последняя страница</label>
                    <input type="number" name="l_page" value="{{old('l_page')}}"
                           class="form-control bg-dark text-light border-secondary"
                           placeholder="Номер последней страницы">
                </div>

            </div>

            <div class="mb-3">
                <label class="form-label">Ключеввые слова (РУС)</label>
                <input type="text" name="keywords_ru" value="{{old('keywords_ru')}}"
                       class="form-control bg-dark text-light border-secondary"
                       placeholder="Введите через запятую">
            </div>

            <div class="mb-3">
                <label class="form-label">Ключеввые слова (ENG)</label>
                <input type="text" name="keywords_eng" value="{{old('keywords_eng')}}"
                       class="form-control bg-dark text-light border-secondary"
                       placeholder="Введите через запятую">
            </div>

            <div class="mb-3">
                <label class="form-label">Список литературы (РУС)</label>
                <textarea type="text" name="references_ru" rows="5"
                       class="form-control bg-dark text-light border-secondary"
                          placeholder="Каждый источник с новой строки">{{old('references_ru')}}</textarea>
            </div>

            <div class="mb-3">
                <label class="form-label">Список литературы (ENG)</label>
                <textarea type="text" name="references_en" rows="5"
                          class="form-control bg-dark text-light border-secondary"
                          placeholder="Каждый источник с новой строки">{{old('references_en')}}</textarea>
            </div>

            <!-- Блок с авторами -->
            <div class="mb-4 p-3 rounded"
                 style="background-color: rgba(255, 255, 255, 0.05); border: 1px solid rgba(255, 255, 255, 0.1);">
                <h4 class="mb-3">Авторы</h4>
                @for($i = 0; $i < $authorsCount; $i++)
                    <div id="authors-container">
                        <!-- Первый автор -->
                        <div class="author-group mb-3 p-2 rounded" style="background-color: rgba(0, 0, 0, 0.1);">
                            <h5 class="mb-2">Автор №{{$i + 1}}</h5>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Фамилия (РУС)</label>
                                        <input type="text" name="authors[{{$i}}][surname_ru]"
                                               value="{{old('authors.'.$i.'.surname_ru')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Фамилия на русском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Инициалы (РУС)</label>
                                        <input type="text" name="authors[{{$i}}][initials_ru]"
                                               value="{{old('authors.'.$i.'.initials_ru')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Инициалы на русском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Должность (РУС)</label>
                                        <input type="text" name="authors[{{$i}}][job_ru]"
                                               value="{{old('authors.'.$i.'.job_ru')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Должность на русском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Ученое звание (РУС)</label>
                                        <input type="text" name="authors[{{$i}}][rank_ru]"
                                               value="{{old('authors.'.$i.'.rank_ru')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Ученое звание на русском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">ORCID</label>
                                        <input type="text" name="authors[{{$i}}][orcid]"
                                               value="{{old('authors.'.$i.'.orcid')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="0000-0000-0000-0000">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <label class="form-label">Фамилия (ENG)</label>
                                        <input type="text" name="authors[{{$i}}][surname_en]"
                                               value="{{old('authors.'.$i.'.surname_en')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Фамилия на английском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Инициалы (ENG)</label>
                                        <input type="text" name="authors[{{$i}}][initials_en]"
                                               value="{{old('authors.'.$i.'.initials_en')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Инициалы на английском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Должность (ENG)</label>
                                        <input type="text" name="authors[{{$i}}][job_en]"
                                               value="{{old('authors.'.$i.'.job_en')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Должность на английском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Ученое звание (ENG)</label>
                                        <input type="text" name="authors[{{$i}}][rank_en]"
                                               value="{{old('authors.'.$i.'.rank_en')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="Ученое звание на английском">
                                    </div>
                                    <div class="mb-2">
                                        <label class="form-label">Email</label>
                                        <input type="email" name="authors[{{$i}}][email]"
                                               value="{{old('authors.'.$i.'.email')}}"
                                               class="form-control bg-dark text-light border-secondary"
                                               placeholder="email@example.com">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>


            <div class="d-flex justify-content-between align-items-center mt-2">
                <button type="submit" formaction="{{route('article.addAuthor', ['journal' => $journal])}}"
                        id="add-author-btn" class="btn btn-outline-light btn-sm">+ Добавить еще автора
                </button>
                <small class="text-muted">Максимум 10 авторов</small>
            </div>

            @csrf
            <div class="btn_wrapper text-center mt-3">
                <button type="submit" class="btn btn-light btn-lg hover-lift">Сохранить статью</button>
            </div>
        </form>


    </div>

@endsection


