<?php

use App\Actions\Auth\LoginAction;
use App\Actions\Auth\LogoutAction;
use App\Actions\Auth\RegisterAction;
use App\Actions\Auth\SendPasswordResetLinkAction;
use App\Actions\Auth\ResetPasswordAction;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisterAction::class, 'handle'])
        ->name('register');

    Route::post('register', [RegisterAction::class, 'asController']);

    Route::get('login', [LoginAction::class, 'asController'])
        ->name('login');

    Route::post('login', [LoginAction::class, 'handle']);

    Route::get('forgot-password', [SendPasswordResetLinkAction::class, 'handle'])
        ->name('password.request');

    Route::post('forgot-password', [SendPasswordResetLinkAction::class, 'asController'])
        ->name('password.email');

    Route::get('reset-password/{token}', [ResetPasswordAction::class, 'asController'])
        ->name('password.reset');

    Route::post('reset-password', [ResetPasswordAction::class, 'handle'])
        ->name('password.store');
});

Route::middleware('auth')->group(function () {
    Route::get('verify-email', EmailVerificationPromptController::class)
        ->name('verification.notice');

    Route::get('verify-email/{id}/{hash}', VerifyEmailController::class)
        ->middleware(['signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware('throttle:6,1')
        ->name('verification.send');

    Route::get('confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->name('password.confirm');

    Route::post('confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('logout', [LogoutAction::class, 'handle'])
        ->name('logout');
});
