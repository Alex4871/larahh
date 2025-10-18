<?php

namespace App\Http\Controllers\AdminControllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyStoreRequest;
use App\Models\Vacancy\Vacancy;
use Illuminate\Http\RedirectResponse;
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
        $genders = ['мужской', 'женский', 'не имеет значения'];
        $numberOfSpecialist = range(1,10);
        return view('admin.vacancies.create', compact('genders', 'numberOfSpecialist'));
    }

    public function store(VacancyStoreRequest $request): RedirectResponse
    {
        $data = $request->validated();
        Vacancy::create($data);
        return redirect()->route('admin.vacancies');
    }

}
