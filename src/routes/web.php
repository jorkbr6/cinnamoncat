<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    })->name('home');

    Route::get('/cinnamon', [UserController::class, 'getAll']);
    Route::post('/users/register', [UserController::class, 'create']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

Route::get('/', function () {
    return redirect()->route('home');
});

Route::fallback(function () {
    return response()->view('404', [], 404);
});
