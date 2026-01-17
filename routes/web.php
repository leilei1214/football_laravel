<?php
// namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\DB;

Route::get('/db-test', function () {
    return DB::select('SELECT 1 as ok');
});

Route::get('/hello', function () {
    return 'Hello Laravel 👋';
});

Route::get('/', [PageController::class, 'home'])->name('home');

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::get('/line_login', [LoginController::class, 'login']);
Route::get('/login_data', [LoginController::class, 'callback']);
Route::post('/save-to-session', function (\Illuminate\Http\Request $request) {
    session($request->all());
    return response()->json(['message' => 200]);
});
Route::get('/ShowEvent', [EventController::class, 'ShowEvent'])->name('ShowEvent');