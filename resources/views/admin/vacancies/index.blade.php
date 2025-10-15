@extends('admin.layout.layout')

@section('content')

    <style>
        .action-btn {
            color: #6c757d;
            text-decoration: none;
            padding: 0.25rem;
            border-radius: 0.25rem;
        }

        .action-btn:hover {
            color: #0d6efd;
        }

        .action-btn.delete:hover {
            color: #dc3545;
        }

        .table-container {
            border-radius: 8px;
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
        }
    </style>

    <div class="container">
        <div class="table-container">
            <table class="table table-hover align-middle mb-0">
                <thead class="table-light">
                <tr>
                    <th scope="col" style="width: 10%;">№</th>
                    <th scope="col">Название</th>
                    <th scope="col" class="text-end" style="width: 15%;">Действия</th>
                </tr>
                </thead>
                <tbody>

                @forelse($vacancies as $vacancy)

                    <tr>
                        <td>{{$vacancy->id}}</td>
                        <td>{{$vacancy->title}}</td>
                        <td class="text-end">
                            <a href="#" class="action-btn" aria-label="Редактировать">
                                <i class="bi bi-pencil"></i>
                            </a>
                            <a href="#" class="action-btn delete" aria-label="Удалить">
                                <i class="bi bi-trash"></i>
                            </a>
                        </td>
                    </tr>

                @empty
                    <p>Вакансий не найдено (((</p>
                @endforelse
                
                </tbody>
            </table>
        </div>
    </div>
@endsection

