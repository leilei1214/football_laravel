<?php

namespace App\Http\Controllers\event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
     public function ShowEvent()
    {
        return view('event.ViewList');
    }
    public function ApiEvent(Request $request)
    {
        $identifier = $request->input('identifier');
        $level      = $request->input('input');

        // 🔐 未登入就擋
        if ($level === '總覽') {
            $activities = DB::table('activities')->get();
            if ($activities->isEmpty()) {
                return response('找不到對應的活動', 404);
            }
           return response()->json($activities);
        }else{

            // 撈活動
            $result = DB::select(
                "SELECT * FROM activities
                 WHERE FIND_IN_SET(
                    ?, 
                    REPLACE(REPLACE(activity_level, '{', ''), '}', '')
                 ) > 0",
                [$level]
            );

            if (count($result) === 0) {
                return response('找不到對應的活動', 404);
            }

            return response()->json($result);
        }



    }

}

