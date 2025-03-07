<?php

use App\Http\Controllers\AuthController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;


// Auth Routes
Route::controller(AuthController::class)->group(function () {
    Route::get('/', 'showLoginForm')->name('login');
    Route::put('/login', 'login')->name('login.post');
    Route::post('/logout', 'logout')->name('logout');

    Route::get('/signup', 'showSignupForm')->name('signup');
    Route::put('/signup', 'signup')->name('signup.post');

    Route::get('/forgot-password', 'showForgetPassForm')->middleware('guest')->name('password.request');
    Route::post('/forgot-password', 'forgotPassword')->middleware('guest')->name('password.email');
    Route::get('/reset-password/{token}', 'showResetPasswordForm')->middleware('guest')->name('password.reset');
    Route::post('/reset-password', 'resetPassword')->middleware('guest')->name('password.update');

    Route::get('/email/verify', 'showVerifyEmail')->middleware('auth')->name('verification.notice');
    Route::get('/email/verify/{id}/{hash}', 'verifyEmail')->middleware(['auth', 'signed'])->name('verification.verify');
    Route::post('/email/verification-notification', 'resendVerificationEmail')->middleware(['auth', 'throttle:6,1'])->name('verification.send');
});


Route::middleware('auth',"verified")->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});