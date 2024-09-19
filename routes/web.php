<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;

Route::view('/', 'welcome');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

Route::middleware(['auth'])->group(function () {
    route::resource('/clients', ClientController::class);

    route::get('/chart', function () {
        return 'Wilquey chart';
    });
});

require __DIR__.'/auth.php';
