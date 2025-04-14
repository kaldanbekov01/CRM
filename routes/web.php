<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Redirect to step 2 after registration
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'registration_completed'], function () {
        Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    });
    Route::get('/signup/info', [RegisterController::class, 'step2Form'])->name('register.step2.form');
    Route::post('/signup/info', [RegisterController::class, 'completeProfile'])->name('register.complete');
    

    // Employee routes
    Route::get('/employee', [App\Http\Controllers\EmployeeController::class, 'index'])->name('employee.index');
    Route::get('/employee/create', [App\Http\Controllers\EmployeeController::class, 'create'])->name('employee.create');
    Route::post('/employee', [App\Http\Controllers\EmployeeController::class, 'store'])->name('employee.store');
});



// Route::get('/signup/info', [RegisterController::class, 'step2Form'])
//     ->name('register.step2.form')
//     ->middleware('auth');

// Route::post('/signup/info', [RegisterController::class, 'completeProfile'])
//     ->name('register.complete')
//     ->middleware('auth');


