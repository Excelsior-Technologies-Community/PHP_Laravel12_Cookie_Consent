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

/*
|--------------------------------------------------------------------------
| Cookie Consent Routes
|--------------------------------------------------------------------------
*/

Route::prefix('cookie')->name('cookie.')->group(function () {

    Route::get('/consent', [
        CookieController::class,
        'consent'
    ])->name('consent');

    Route::post('/accept', [
        CookieController::class,
        'accept'
    ])->name('accept');

    Route::post('/update', [
        CookieController::class,
        'update'
    ])->name('update');

    Route::post('/revoke', [
        CookieController::class,
        'revoke'
    ])->name('revoke');

    // New: Cookie Policy
    Route::get('/policy', [
        CookieController::class,
        'policy'
    ])->name('policy');

    // New: Consent Audit History
    Route::get('/history', [
        CookieController::class,
        'history'
    ])->name('history');
});

/*
|--------------------------------------------------------------------------
| Protected Route
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})
    ->middleware('cookie.consent')
    ->name('dashboard');