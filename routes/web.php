<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\DocumentController;


Route::middleware(['guest'])->group(function () {
    Route::get('/', [AuthController::class, 'loginPage'])->name('login');
    Route::get('/register', [AuthController::class, 'registerPage'])->name('register');
    Route::post('/register', [AuthController::class, 'register'])->name('new.register');

    Route::post('/login', [AuthController::class, 'login'])->name('loginSubmit');

});

Route::middleware(['auth'])->group(function () 
{
    Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');
    Route::post('/logout', [HomeController::class, 'logout'])->name('logout');
});

Route::middleware('auth')->group(function () {
    Route::resource('documents', DocumentController::class);
});