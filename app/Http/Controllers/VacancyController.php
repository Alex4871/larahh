<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class VacancyController extends Controller
{

    protected array $vacancies = [
        ['title' => 'Программист php, Битрикс (джуниор)', 'price' => '80 000 — 150 000 руб.', 'description' => 'Сопровождение, правки по текущим проектам на базе Битрикс разработка сайтов.'],
        ['title' => 'PHP-разработчик', 'price' => '150 000 - 250 000 руб.', 'description' => 'Обязанности: Поддержка и разработка API для взаимодействия с web-интерфейсом системы и с мобильным приложением Разработка интеграционных API для внешних программных систем операторов связи Разработка'],
        ['title' => 'Специалист технической поддержки', 'price' => 'от 150 000 ₽ за месяц', 'description' => 'Оперативно реагировать на заявки клиентов (звонки, почта, багтрекер)']
    ];

    public function index(): View
    {
        $vacancies = $this->vacancies;
        return view('vacancies.index', compact('vacancies'));
    }


    public function create()
    {
        //
    }


    public function store(Request $request)
    {
        //
    }


    public function show(string $id)
    {
        //
    }


    public function edit(string $id)
    {
        //
    }


    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
