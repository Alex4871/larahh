<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JournalController;
use App\Http\Controllers\ArticleController;

Route::view('/', 'index')->name('home');

Route::get('/journal/create', [JournalController::class, 'create'])->name('journal.create');
Route::post('/journal', [JournalController::class, 'store'])->name('journal.store');

Route::get('/journal/{journal}/article/create', [ArticleController::class, 'create'])->name('article.create');
Route::post('/journal/{journal}/article/create', [ArticleController::class, 'addAuthor'])->name('article.addAuthor');
Route::post('/journal/{journal}/article', [ArticleController::class, 'store'])->name('article.store');
Route::get('journal/{journal}/xml', [JournalController::class, 'xml'])->name('journal.xml');
