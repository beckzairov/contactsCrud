<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\Auth\RegisterController;

Route::get('/', [DashboardController::class, 'redirect']);
Route::get('/login', [LoginController::class, 'index'])->name('login');
Route::post('/login', [LoginController::class, 'store']);
Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register', [RegisterController::class, 'store']);

Route::resource('dashboard', DashboardController::class);
Route::resource('contact', ContactController::class);
Route::get('/search', [DashboardController::class, 'search'])->name('search');
Route::post('/logout', [LogoutController::class, 'store'])->name('logout');


