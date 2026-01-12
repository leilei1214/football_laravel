<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/hello', function () {
    return 'Hello Laravel 👋';
});

Route::get('/', [PageController::class, 'home']);

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');

