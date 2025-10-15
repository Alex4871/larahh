<?php

namespace App\Http\Controllers\AppControllers\VacancyControllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Models\Vacancy\Vacancy;


class IndexController extends Controller
{
    public function __invoke(): View
    {
        $vacancies = Vacancy::all();
        return view('app.vacancies.index', compact('vacancies'));
    }
}
