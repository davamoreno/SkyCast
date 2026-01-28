<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Actions\Weather\ShowWeatherAction;
use App\Actions\Profile\EditProfileAction;
use App\Actions\Profile\UpdateProfileAction;
use App\Actions\Profile\DeleteUserAction;
use App\Actions\Auth\UpdatePasswordAction;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [EditProfileAction::class, 'handle'])->name('profile.edit');
    Route::patch('/profile', [UpdateProfileAction::class, 'handle'])->name('profile.update');
    Route::delete('/profile', [DeleteUserAction::class, 'handle'])->name('profile.destroy');
    Route::put('password', UpdatePasswordAction::class)->name('password.update');

    Route::get('/weather', [ShowWeatherAction::class, 'handle'])->name('weather');
});

require __DIR__.'/auth.php';
