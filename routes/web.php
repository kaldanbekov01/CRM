<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\MultiLoginController;
use App\Http\Controllers\AIChatController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\ResetPasswordController;


Route::get('/login', [MultiLoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [MultiLoginController::class, 'login'])->name('multi.login');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');


Route::post('/logout', function () {
    if (Auth::guard('web')->check()) {
        Auth::guard('web')->logout();
    } elseif (Auth::guard('employee')->check()) {
        Auth::guard('employee')->logout();
    }

    request()->session()->invalidate();
    request()->session()->regenerateToken();

    return redirect('/');
})->name('logout');

Route::get('/', function () {
    return view('welcome');
});

// Auth::routes();

Route::middleware('auth:employee')->group(function () {
    Route::get('/employee/dashboard', function () {
        return view('employee.dashboard'); // create this view if needed
    })->name('employee.dashboard');
});


// Redirect to step 2 after registration
Route::group(['middleware' => ['multiauth']], function () {
    Route::group(['middleware' => 'registration_completed'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
        Route::get('/support', action: [App\Http\Controllers\HomeController::class, 'support'])->name('support');
        // Receipt route
        Route::get('/profile', function () {
            return view('profile');
        })->name('profile');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
    

    });
    Route::get('/signup/info', [RegisterController::class, 'step2Form'])->name('register.step2.form');
    Route::post('/signup/info', [RegisterController::class, 'completeProfile'])->name('register.complete');


    // Employee routes
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');

    // Employee routes
    Route::get('/product', [App\Http\Controllers\ProductController::class, 'index'])->name('product.index');
    Route::get('/product/create', [App\Http\Controllers\ProductController::class, 'create'])->name('product.create');
    Route::post('/product', [App\Http\Controllers\ProductController::class, 'store'])->name('product.store');
    Route::post('/product/{product}', [App\Http\Controllers\ProductController::class, 'update'])->name('product.update');
    Route::delete('/product/{product}', [App\Http\Controllers\ProductController::class, 'destroy'])->name('product.destroy');

    Route::post('/category', [App\Http\Controllers\CategoryController::class, 'store'])->name('category.store');

    Route::post('/supplier', [App\Http\Controllers\SupplierController::class, 'store'])->name('supplier.store');


    Route::get('/posSystem', [App\Http\Controllers\PosSystemController::class, 'index'])->name('posSystem.index');
    Route::get('/posSystem/select', [App\Http\Controllers\PosSystemController::class, 'select'])->name('posSystem.select');
    Route::get('/posSystem/search', action: [App\Http\Controllers\PosSystemController::class, 'search'])->name('posSystem.search');
    Route::get('/posSystem/show', action: [App\Http\Controllers\PosSystemController::class, 'show'])->name('posSystem.show');
    Route::post('/posSystem/checkout', [App\Http\Controllers\PosSystemController::class, 'checkout'])->name('posSystem.checkout');
    // Order routes
    Route::get('/order', [App\Http\Controllers\OrderController::class, 'index'])->name('order.index');

    Route::get('/financial', [App\Http\Controllers\FinancialController::class, 'index'])->name('financial.index');

    Route::get('/client', [App\Http\Controllers\ClientController::class, 'index'])->name('client.index');
    Route::post('/client', [App\Http\Controllers\ClientController::class, 'store'])->name('client.store');

    // Receipt route
    Route::get('/receipt', function () {
        return view('pos_system.checkout');
    })->name('receipt');

    Route::get('/settings', function () {
        return view('settings');
    })->name('settings');
});

Route::post('/ai-chat', [AIChatController::class, 'chat'])->name('ai.chat');



// Route::get('/signup/info', [RegisterController::class, 'step2Form'])
//     ->name('register.step2.form')
//     ->middleware('auth');

// Route::post('/signup/info', [RegisterController::class, 'completeProfile'])
//     ->name('register.complete')
//     ->middleware('auth');


