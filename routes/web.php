<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppControllers\VacancyControllers\IndexController;

Route::get('/', IndexController::class);

Route::view('/admin', 'admin.layout.layout');
