<?php

use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Auth\CompleteRegistrationController;
use App\Http\Controllers\Auth\ConfirmablePasswordController;
use App\Http\Controllers\Auth\EmailVerificationNotificationController;
use App\Http\Controllers\Auth\EmailVerificationPromptController;
use App\Http\Controllers\Auth\LoginCodeController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\PasswordResetLinkController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Auth\SocialiteController;
use App\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);

    Route::get('login', [AuthenticatedSessionController::class, 'create'])
        ->name('login');

    Route::post('login', [AuthenticatedSessionController::class, 'store']);

    Route::get('forgot-password', [PasswordResetLinkController::class, 'create'])
        ->name('password.request');

    Route::post('forgot-password', [PasswordResetLinkController::class, 'store'])
        ->name('password.email');

    Route::get('reset-password/{token}', [NewPasswordController::class, 'create'])
        ->name('password.reset');

    Route::post('reset-password', [NewPasswordController::class, 'store'])
        ->name('password.store');

    // 1ª tela: usuário informa o e-mail para receber o código
    Route::get('login/code', [LoginCodeController::class, 'create'])
        ->name('login.code.request');

    // Envia o código por e-mail
    Route::post('login/code', [LoginCodeController::class, 'send'])
        ->name('login.code.send');

    // Tela para digitar o código
    Route::get('login/code/verify', [LoginCodeController::class, 'showVerify'])
        ->name('login.code.verify');

    // Valida o código e faz login
    Route::post('login/code/verify', [LoginCodeController::class, 'verify'])
        ->name('login.code.check');

    // GOOGLE
    Route::get('auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])
        ->name('auth.google.redirect');

    Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
        ->name('auth.google.callback');

    // Se quiser deixar preparado pra Facebook depois:
    // Route::get('auth/facebook/redirect', [SocialiteController::class, 'redirectToFacebook'])
    //     ->name('auth.facebook.redirect');
    //
    // Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback'])
    //     ->name('auth.facebook.callback');
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

    Route::post('logout', [AuthenticatedSessionController::class, 'destroy'])
        ->name('logout');

    Route::get('/tenants/{tenant}/complete', [CompleteRegistrationController::class, 'edit'])
        ->name('tenants.complete');

    Route::post('/tenants/{tenant}/complete', [CompleteRegistrationController::class, 'update'])
        ->name('tenants.complete.store');
});

// GOOGLE
// Route::get('auth/google/redirect', [SocialiteController::class, 'redirectToGoogle'])
//     ->name('auth.google.redirect');

// Route::get('auth/google/callback', [SocialiteController::class, 'handleGoogleCallback'])
//     ->name('auth.google.callback');

// Se quiser deixar preparado pra Facebook depois:
// Route::get('auth/facebook/redirect', [SocialiteController::class, 'redirectToFacebook'])
//     ->name('auth.facebook.redirect');
//
// Route::get('auth/facebook/callback', [SocialiteController::class, 'handleFacebookCallback'])
//     ->name('auth.facebook.callback');
