<?php

namespace App\Http\Controllers\event;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class EventController extends Controller
{
     public function ShowEvent()
    {
        return view('event.ViewList');
    }
    public function AddEvent()
    {
        return view('event.AddEvent');
    }
    public function USEREventContent()
    {
        return view('event.USEREventContent');
    }
    
    public function ApiEvent(Request $request)
    {
        // $identifier = $request->input('identifier');
        $level = $request->input('level');

        try {
        // 🔐 未登入就擋
            if ($level === '總覽') {
                $activities = DB::table('activities')->get();
                if ($activities->isEmpty()) {
                    return response()->json(['message' => '找不到對應的活動'], 404);
                }
                return response()->json($activities);
            }else{
                // $activities = DB::table('activities')->get();
                // if ($activities->isEmpty()) {
                //     return response()->json(['message' => '找不到對應的活動'], 404);
                // }

                // // 撈活動
                $result = DB::select(
                    "SELECT * FROM activities
                    WHERE FIND_IN_SET(
                        ?, 
                        REPLACE(REPLACE(activity_level, '{', ''), '}', '')
                    ) > 0",
                    [$level]
                );

                if (count($result) === 0) {
                    return response()->json(['message' => '找不到對應的活動'], 404);
                }

                return response()->json($result);
            }
        }catch (\Exception $e) {
            // 將完整 Exception 訊息寫入日誌
            \Log::error('ApiEvent Exception', [
                'message' => $e->getMessage(),
                'trace'   => $e->getTraceAsString()
            ]);

            return response()->json([
                'message' => '資料庫查詢錯誤',
                'error'   => $e->getMessage()
            ], 500);
        }


    }
        // 單一活動內容
    public function content(Request $request)
    {
        $listId  = $request->input('list_id');
        $guildId = $request->input('guild_id');

        if (!$listId) {
            return response()->json(['message' => 'list_id 必填'], 400);
        }

        $event = DB::table('activities')->where('id', $listId)->first();

        if (!$event) {
            return response()->json(['message' => '找不到活動'], 404);
        }

        $registrations = DB::select("
            SELECT r.*, u.username, u.user_img,u.preferred_position1, u.preferred_position2
            FROM registrations r
            JOIN users u ON r.identifier = u.identifier
            WHERE r.activity_id = ?
            ORDER BY r.id ASC
        ", [$listId]);

        return response()->json([
            'event' => $event,
            'registrations' => $registrations
        ]);
    }
    public function updateStatus(Request $request)
    {
        $guildId  = $request->input('guildId');
        $guildName  = "";
        // 1️⃣ 取得 session 使用者
        if (!session('identifier')) {
            $result = DB::select(
                'SELECT * FROM guilds WHERE guild_id = ?',
                [$guildId]
            );
            if (count($result) > 0) {
                $guildName = $result[0] ->name;
            }
            return response()->json([
                'status' => 401,
                'message' => 'User session not found',
                'redirect' => route('login') . '?status=login&club='.$guildName.'&level=2'
            ], 401);
        }
        $identifier = session('identifier');
        $Guild = session('Guild');
        $activityId = $request->input('activityId');



        $statusAdd  = (int) $request->input('status_add');

        try {
            DB::beginTransaction();

            // 2️⃣ 取得活動上限
            $activity = DB::table('activities')
                ->where('id', $activityId)
                ->lockForUpdate()
                ->first();

            if (!$activity) {
                DB::rollBack();
                return response()->json(['message' => 'Activity not found'], 404);
            }

            // 3️⃣ 若是「簽到」，檢查人數
            if ($statusAdd === 1) {
                $currentCount = DB::table('registrations')
                    ->where('activity_id', $activityId)
                    ->where('status_add', 1)
                    ->count();

                if ($currentCount >= $activity->max_participants) {
                    DB::rollBack();
                    return response()->json([
                        'status' => 409,
                        'message' => '人數已滿'
                    ], 409);
                }
            }

            // 4️⃣ 是否已有報名資料
            $registration = DB::table('registrations')
                ->where('activity_id', $activityId)
                ->where('identifier', $identifier)
                ->first();

            if ($registration) {
                // UPDATE
                DB::table('registrations')
                    ->where('id', $registration->id)
                    ->update([
                        'status_add' => $statusAdd,
                        'updated_at' => now()
                    ]);
            } else {
                // INSERT
                DB::table('registrations')
                    ->insert([
                        'activity_id' => $activityId,
                        'identifier'  => $identifier,
                        'status_add'  => $statusAdd,
                        'created_at'  => now(),
                        'updated_at'  => now()
                    ]);
            }

            // 5️⃣ 重新計算在場人數（只算簽到）
            $currentParticipants = DB::table('registrations')
                ->where('activity_id', $activityId)
                ->where('status_add', 1)
                ->count();

            DB::table('activities')
                ->where('id', $activityId)
                ->update([
                    'current_participants' => $currentParticipants
                ]);

            DB::commit();

            return response()->json(['status' => 200]);

        } catch (\Exception $e) {
            DB::rollBack();
            \Log::error($e);

            return response()->json([
                'status' => 500,
                'message' => '資料庫錯誤'.$e
            ], 500);
        }
    }
}

