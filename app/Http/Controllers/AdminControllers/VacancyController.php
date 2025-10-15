<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Models\Vacancy\Vacancy;
use Illuminate\View\View;

class VacancyController extends Controller
{

    public function index(): View
    {
        $vacancies = Vacancy::all();
        return view('admin.vacancies.index', compact('vacancies'));
    }

    public function create(): View
    {
        return view('admin.vacancies.create');
    }

}
