<?php

use Filament\Http\Controllers\Auth\LogoutController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Home');
})->name('home');

Route::any('/login', function () {
    return Inertia::location(route("filament.dashboard.auth.login"));
})->name('login');

Route::post('/logout', LogoutController::class)->name('logout');

Route::any('/register', function () {
    return Inertia::location(route("filament.dashboard.auth.register"));
});

Route::controller(\App\Http\Controllers\ImageController::class)->group(
    function () {

        Route::get('/image/index', 'index')
            ->name('image.index')
            ->middleware('auth');
        Route::get('/image/create', 'create')
            ->name('image.create')
            ->middleware('auth');
        Route::post('/image/store', 'store')
            ->middleware('auth');
        Route::get('/image/{image:link}', 'show')
            ->name('image.show')->middleware('auth');
    }
);

/*
Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
 */
