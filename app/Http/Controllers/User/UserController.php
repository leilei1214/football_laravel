<?php
    namespace App\Http\Controllers\User;
    use Yajra\DataTables\Facades\DataTables;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    class UserController extends Controller
    {
        // 基礎
        public function USER_Member_3()
        {
            return view('User.USER_Member_3');
        }
        // 實踐
        public function USER_Member_2()
        {
            return view('User.USER_Member_2');
        }
        // 樂踢
        public function USER_Member_4()
        {
            return view('User.USER_Member_4');
        }
        public function userListMember(Request $request)
        {
            try {

                // $identifier   = $request->input('identifier');
                $Search_level = $request->input('Search_level');

                $result = DB::table('users')
                    ->where('level', $Search_level)
                    ->orderBy('time', 'asc')
                    ->get();

                if ($result->isEmpty()) {
                    return response()->json([
                        'message' => '找不到對應的會員'
                    ], 404);
                }

                return response()->json([
                    'data' => $result
                ], 200);

            } catch (\Exception $e) {

                \Log::error($e->getMessage());

                return response()->json([
                    'message' => '資料庫查詢錯誤'
                ], 500);
            }
        }
            /**
         * 顯示球員詳細資料
         *
         * @return \Illuminate\View\View
         */
        public function show($id)
        {
            // 範例：從資料庫獲取球員資料
            // $player = Player::findOrFail($id);
            
            // 示範用的假資料
            $playerData = DB::table('users')
            ->where('identifier', $id)
            ->join('union_members', 'players.identifier', '=', 'union_members.name')
            ->join('guilds', 'players.Guild', '=', 'guilds.guild_id')
                ->select(
                    'players.*',
                    'union_members.number as number',
                    'union_members.name as clubname'
                )
            ->first();
            $guilds = DB::table('union_members')
            ->join('guilds', 'union_members.guild_id', '=', 'guilds.guild_id')
            ->where('union_members.name', $id)
            ->select(
                // 'guilds.guild_id',
                'union_members.created_at',
                'guilds.name',
                'union_members.number'
            )
            ->get();
            $player = [
                'name' => $playerData->username,
                'nameEn' => $playerData->nameEn,
                'image' => $playerData->user_img,
                'number' => $playerData->number,
                'position' =>$playerData->preferred_position1 ,
                'nationality' => $playerData->nationality,
                'age' => $playerData->age,
                'team' => $playerData->clubname,
                'stats' => [
                    'matches' => $playerData->activitySum,
                    'FreeSum' => $playerData->FreeSum,
                    'goals' => $playerData->goal,
                    'assists' => $playerData->activitySum,
                    'Assist' => $playerData->Assist,
                ],
                'guilds' => $guilds
            ];

            return view('User.player-profile', compact('player'));
        }

 

    }
?>