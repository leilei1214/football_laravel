<?php
    namespace App\Http\Controllers\Manager;
    use Yajra\DataTables\Facades\DataTables;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    class ManagerController extends Controller
    {
        public function EventManager()
        {
            return view('Manager.EventList');
        }
        public function EventContentManager()
        {
            return view('Manager.EventContent');
        }
        public function SignIn()
        {
            return view('Manager.SignIn');
        }
        
        public function SignIn_Qrcode()
        {
            return view('Manager.SignIn_Qrcode');
        }
        public function liff_signin()
        {
            return view('Manager.liff_signin');
        }
        public function MApiEvent(Request $request)
        {
            $Slevel= session('level');
            $Guild = $request->session()->get('Guild'); // 拿 session 裡存的公會
            $level = $request->input('level');
            try {
            // 🔐 未登入就擋
                $query = DB::table('activities')->get();
                if ($level !== '總覽') {
                    // 只撈符合 level 的活動
                    $query->whereRaw(
                        "FIND_IN_SET(?, REPLACE(REPLACE(activity_level, '{',''), '}','')) > 0",
                        [$level]
                    );
                }

                return DataTables::of($query)
                ->addColumn('action', function($row){
                    return '
                    
                    <a href="/Manager/event-content/'.$row->id.'" class="btn btn-sm btn-primary">詳情</a>
                    <a href="/Manager/event-edit/'.$row->id.'" class="btn btn-sm btn-secondary">編輯</a>
                    <a href="/Manager/event-delete/'.$row->id.'" class="btn btn-sm btn-red">刪除</a>
                    ';
                })
                ->rawColumns(['action'])
                ->make(true);


                
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
        public function updateSignIn(Request $request)
        {
            $guildId  = $request->input('guildId');
            // 1️⃣ 檢查 session
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
                    'redirect' => route('login') . '?status=login&club='.$guildName.'&level=1'
                ], 401);
            }

            $jsonData   = $request->input('jsonData');
            $activityId = $request->input('activityId');
            $results    = [];

            try {
                DB::beginTransaction();

                foreach ($jsonData as $item) {

                    $checked   = $item['checked'];
                    $value     = $item['value'];     // identifier
                    $className = $item['class'];
                    $time = date('Y-m-d H:i:s', strtotime($item['time']));

                    if ($className === 'SignIn') {

                        $changeChecked = $checked ? 1 : 0;

                        DB::update(
                            "
                            UPDATE registrations
                            SET check_in = ?, check_in_time = ?
                            WHERE activity_id = ?
                            AND identifier = ?
                            AND check_in != ?
                            ",
                            [$changeChecked, $time, $activityId, $value, $changeChecked]
                        );

                    } elseif ($className === 'SignOut') {

                        $changeChecked = $checked ? 1 : 0;

                        DB::update(
                            "
                            UPDATE registrations
                            SET check_out = ?, check_out_time = ?
                            WHERE activity_id = ?
                            AND identifier = ?
                            AND check_out != ?
                            ",
                            [$changeChecked, $time, $activityId, $value, $changeChecked]
                        );

                    } elseif ($className === 'SignFree') {

                        $changeChecked = $checked ? 1 : 0;

                        DB::update(
                            "
                            UPDATE registrations
                            SET payment_status = ?, payment_time = ?
                            WHERE activity_id = ?
                            AND identifier = ?
                            AND payment_status != ?
                            ",
                            [$changeChecked, $time, $activityId, $value, $changeChecked]
                        );
                    }

                    $results[] = ['status' => 200];
                }

                DB::commit();

                return response()->json([
                    'status'  => 200,
                    'results' => $results
                ]);

            } catch (\Exception $e) {
                DB::rollBack();

                \Log::error('Unexpected error: ' . $e->getMessage());

                return response()->json([
                    'status'  => 500,
                    'message' => 'Unexpected server error:'.$e
                ], 500);
            }
        }
        public function updateSignInQrcode(Request $request)
        {
            // 檢查 session
            $guildId  = $request->input('guildId');
            // 1️⃣ 檢查 session
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
                    'redirect' => route('login') . '?status=login&club='.$guildName.'&level=1'
                ], 401);
            }

            $time      = $request->input('time');
            $upUserId  = $request->input('Up_userId');
            $listId    = $request->input('listId');
            $sign      = $request->input('Sign');

            try {

                // 1️⃣ 取得 identifier
                $userRow = DB::select(
                    "SELECT identifier FROM users WHERE userid = ?",
                    [$upUserId]
                );

                if (empty($userRow)) {
                    return response()->json([
                        'status' => 404,
                        'message' => 'User not found'
                    ], 404);
                }

                $identifier = $userRow[0]->identifier;

                // ⭐⭐⭐ 重要：轉時間格式 ⭐⭐⭐
                $formattedTime = date('Y-m-d H:i:s', strtotime($time));

                if ($sign === 'IN') {

                    DB::update(
                        "
                        UPDATE registrations
                        SET check_in = 1,
                            check_in_time = ?
                        WHERE activity_id = ?
                        AND identifier = ?
                        ",
                        [$formattedTime, $listId, $identifier]
                    );

                } elseif ($sign === 'OUT') {

                    DB::update(
                        "
                        UPDATE registrations
                        SET check_out = 1,
                            check_out_time = ?
                        WHERE activity_id = ?
                        AND identifier = ?
                        ",
                        [$formattedTime, $listId, $identifier]
                    );
                }

                return response()->json([
                    'status' => 200
                ]);

            } catch (\Exception $e) {

                \Log::error($e->getMessage());

                return response()->json([
                    'status' => 500,
                    'message' => 'Unexpected server error'
                ], 500);
            }
        }
        public function EventDelete(Request $request)
        {
            // 檢查 session
            $list_id  = $request->input('list_id');
            $guild_id  = $request->input('guild_id');
            $identifier = session('identifier');

            // 1️⃣ 檢查 session
            if (!session('identifier')) {
                $result = DB::select(
                    'SELECT * FROM guilds WHERE guild_id = ?',
                    [$guild_id]
                );
                if (count($result) > 0) {
                    $guildName = $result[0] ->name;
                }
                return response()->json([
                    'status' => 401,
                    'message' => 'User session not found',
                    'redirect' => route('login') . '?status=login&club='.$guildName.'&level=1'
                ], 401);
            }



            try {


                DB::update(
                    "
                    UPDATE activities
                    SET status = 0,
                        edit_person = ?
                    WHERE id = ?
                    AND guild_id = ?
                    ",
                    [$identifier, $list_id, $guild_id]
                );

                return response()->json([
                    'status' => 200
                ]);

            } catch (\Exception $e) {

                \Log::error($e->getMessage());

                return response()->json([
                    'status' => 500,
                    'message' => 'Unexpected server error'
                ], 500);
            }
        }

    }
?>