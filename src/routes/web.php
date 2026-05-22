<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\UserController;
use App\Models\User;

// Route::get('/cinnamon', function () {
//     return view('home');
// });

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::post('/login', function (Request $request) {

    $request->validate([
        'email' => 'required|email',
        'password' => 'required',
    ]);
    log::info('**** GET USER ****');
    $user = User::where('email', $request->email)->first();
    log::info($user);

    if ($user && Hash::check($request->password, $user->password)) {
        return redirect('/home'); // 👈 redirect here
    }

    return back()->withErrors([
        'email' => 'Invalid credentials 🐾',
    ]);
});

Route::fallback(function () {
    return response()->view('404', [], 404);
});


use App\Http\Controllers\AuthController;

// Guest-only routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login']);
});

// Authenticated-only routes
Route::middleware('auth')->group(function () {
    Route::get('/home', function () {
        return view('home');
    });
    Route::get('/cinnamon', [UserController::class, 'getAll']);
    Route::post('/users/register', [UserController::class, 'create']);
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Redirect home to dashboard
Route::get('/', function () {
    return redirect('/home');
});