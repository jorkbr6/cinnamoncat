<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PublicQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/cinnamon', [UserController::class, 'getAll'])->name('cinnamon.index');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::resource('questions', QuestionController::class)->except(['show']);
});

Route::get('/questions/{question}', [PublicQuestionController::class, 'show'])->name('public.questions.show');
Route::post('/questions/{question}/answer', [PublicQuestionController::class, 'answer'])->name('public.questions.answer');
Route::get('/questions/{question}/result', [PublicQuestionController::class, 'result'])->name('public.questions.result');

Route::post('/users/register', [UserController::class, 'create'])->name('users.store');

Route::get('/', function () {
    return redirect()->route('home');
});

Route::fallback(function () {
    return response()->view('404', [], 404);
});
