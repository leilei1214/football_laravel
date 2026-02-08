<?php
// namespace App\Http\Controllers;

use Illuminate\Support\Str;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\event\EventController;
use App\Http\Controllers\Manager\ManagerController;

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
Route::get('/check-identity', function () {

    $birthday  = session('birthday');
    $position1 = session('position1');
    $position2 = session('position2');
    $Guild     = session('Guild');
    $level     = session('level');
    $Gender    = session('Gender');

    // 例：用 session 去查資料庫
    return response()->json([
        'level'     => $level,
        'Guild'     => $Guild,
    ]);
});

Route::get('/ShowEvent', [EventController::class, 'ShowEvent'])->name('ShowEvent');
Route::post('/api/event', [EventController::class, 'ApiEvent'])->name('api.event');;
Route::get('/AddEvent', [EventController::class, 'AddEvent'])->name('AddEvent');
Route::get('/USEREventContent', [EventController::class, 'USEREventContent'])->name('USEREventContent');
Route::post('/update-registration-status', [EventController::class, 'updateStatus']);
Route::post('/update-registration-NoStatus', [EventController::class, 'updateNoStatus']);

Route::post('/Mapi/event', [ManagerController::class, 'MApiEvent'])->name('Mapi.event');;

Route::get('/Manager/EventList', [ManagerController::class, 'EventManager'])->name('ManagerEventList');
Route::get('/Manager/EventContent', [ManagerController::class, 'EventContentManager'])->name('ManagerEventContent');
Route::get('/Manager/SignIn', [ManagerController::class, 'SignIn'])->name('ManagerSignIn');
Route::post('/Mapi/Update_SignIn', [ManagerController::class, 'updateSignIn'])->name('ManagerUpdateSignIn');




