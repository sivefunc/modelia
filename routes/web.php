<?php

use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::controller(\App\Http\Controllers\ImageController::class)->group(
    function () {
        Route::get('/image/create', 'create')->name('image.create')->middleware('auth');
        Route::post('/image/store', 'store')->middleware('auth');
    }
);

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
