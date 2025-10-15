<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminControllers\MainController;
use App\Http\Controllers\AppControllers\VacancyControllers\IndexController;
use App\Http\Controllers\AdminControllers\VacancyController;

Route::get('/', IndexController::class)->name('home');

Route::get('/admin', [MainController::class, 'index'])->name('admin');
Route::get('/admin/vacancies', [VacancyController::class, 'index'])->name('admin.vacancies');
Route::get('/admin/vacancies/create', [VacancyController::class, 'create'])->name('admin.vacancies.create');
