<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CookieController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Cookie consent routes
Route::prefix('cookie')->name('cookie.')->group(function () {
    Route::get('/consent', [CookieController::class, 'consent'])->name('consent');
    Route::post('/accept', [CookieController::class, 'accept'])->name('accept');
    Route::post('/update', [CookieController::class, 'update'])->name('update');
    Route::post('/revoke', [CookieController::class, 'revoke'])->name('revoke');
});

// Protected route example
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware('cookie.consent')->name('dashboard');