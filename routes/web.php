<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\VacancyController;

Route::get('/', [VacancyController::class, 'index']);
