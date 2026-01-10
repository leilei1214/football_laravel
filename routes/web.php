<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('/hello', function () {
    return 'Hello Laravel 👋';
});

Route::get('/', [PageController::class, 'home']);

