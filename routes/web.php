<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\QuizController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;



Route::get('/login', [LoginController::class, 'login'])->name('login');

Route::get('/', function () {
    return Inertia::render('Home/Index');
})->name('home');

Route::get('/dashboard', function(){
    return Inertia::render('Dashboard');
})->name('dashboard');

Route::resource('/quizs', QuizController::class);
Route::get('/quizs/show/{slug}', [QuizController::class, 'showQuizs'])->name('quizs.show');
