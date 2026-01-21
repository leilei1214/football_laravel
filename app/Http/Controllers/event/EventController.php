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
        $identifier = $request->identifier;
        $level      = $request->level;

        // 🔐 未登入就擋
        if ($level === '總覽') {
            $activities = DB::table('activities')->get();
            if (count($activities) === 0) {
                return response('找不到對應的活動', 404);
            }
           return response()->json($activities);
        }else{

            // 撈活動
            $events = DB::table('events')
                ->where('activity_level', 'like', "%{$level}%")
                ->orderBy('time', 'asc')
                ->get();

            if (count($events) === 0) {
                return response('找不到對應的活動', 404);
            }
            return response()->json($events);
        }



    }

}

