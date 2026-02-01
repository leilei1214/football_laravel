<?php
dd('api.php loaded');

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\EventController;
use App\Http\Controllers\event\EventController;


/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
| 所有路由都自動加上 /api 前綴
| 不需要再寫 api/
|--------------------------------------------------------------------------
*/

/*
|-------------------------------------------------
| 活動列表（DataTable / 一般列表）
| POST /api/event
|-------------------------------------------------
*/
// Route::post('event', [EventController::class, 'ApiEvent']);

/*
|-------------------------------------------------
| 活動內容（單一活動 + 報名人員）
| POST /api/event/content
|-------------------------------------------------
*/
Route::post('event/content', [EventController::class, 'content']);

/*
|-------------------------------------------------
| （可選）測試用
| GET /api/ping
|-------------------------------------------------
*/
Route::get('ping', function () {
    return response()->json([
        'status' => 'ok',
        'time'   => now()
    ]);
});
