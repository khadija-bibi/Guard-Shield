<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\CompanyRequestController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
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
    Route::get('/home', function () {
        return view('home');
    })->name('home');
    Route::get('/dashboard', [AuthController::class, 'showDashboard'])->name('dashboard');
    Route::get('/company/create', [CompanyController::class, 'create'])->name('company.create');
    Route::post('/company/store', [CompanyController::class, 'store'])->name('company.store');

    Route::get('/service-seeker/create', [RequestController::class, 'create'])->name('request.create');
    Route::post('/service-seeker/store', [RequestController::class, 'store'])->name('request.store');

    Route::get('/roles', [RoleController::class, 'index'])->name('roles.index');
    Route::get('/roles/create', [RoleController::class, 'create'])->name('roles.create');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::get('/roles/{id}/edit', [RoleController::class, 'edit'])->name('roles.edit');
    Route::put('/roles/{id}', [RoleController::class, 'update'])->name('roles.update');
    Route::get('/roles/{id}', [RoleController::class, 'destroy'])->name('roles.destroy');

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::get('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::post('/users', [UserController::class, 'store'])->name('users.store');
    Route::get('/users/{id}/edit', [UserController::class, 'edit'])->name('users.edit');
    Route::put('/users/{id}', [UserController::class, 'update'])->name('users.update');
    Route::get('/users/{id}', [UserController::class, 'destroy'])->name('users.destroy');

    Route::get('/company', [CompanyController::class, 'index'])->name('companies.index');
    Route::get('/company/{id}/detail', [CompanyController::class, 'detail'])->name('companies.detail');
    Route::get('/company/{id}/docs', [CompanyController::class, 'docs'])->name('companies.docs');
    Route::get('/documents/download/{id}', [CompanyController::class, 'download'])->name('documents.download');

    Route::post('/companies/freeze/{id}', [CompanyController::class, 'toggleFreeze'])->name('companies.freeze');
    Route::post('/companies/drop/{id}', [CompanyController::class, 'dropCompany'])->name('companies.drop');


    Route::get('/companies-request', [CompanyRequestController::class, 'index'])->name('companies-request.index');
    Route::get('/company-request/{id}/detail', [CompanyRequestController::class, 'detail'])->name('company-request.detail');
    Route::get('/company-request/{id}/docs', [CompanyRequestController::class, 'docs'])->name('company-request.docs');

    Route::post('/company/verify/{id}/{status}', [CompanyRequestController::class, 'verifyCompany'])->name('company.verify');

});
