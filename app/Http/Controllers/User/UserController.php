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
            $player = [
                'name' => '陳威廷',
                'nameEn' => 'Wei-Ting Chen',
                'image' => 'https://images.unsplash.com/photo-1682486519525-a2c2d1c65b8b?crop=entropy&cs=tinysrgb&fit=max&fm=jpg&ixid=M3w3Nzg4Nzd8MHwxfHNlYXJjaHwxfHxwcm9mZXNzaW9uYWwlMjBiYXNrZXRiYWxsJTIwcGxheWVyJTIwcG9ydHJhaXR8ZW58MXx8fHwxNzcxOTk2NTc4fDA&ixlib=rb-4.1.0&q=80&w=1080',
                'number' => 10,
                'position' => '前鋒',
                'nationality' => '台灣',
                'age' => 26,
                'height' => '183 cm',
                'weight' => '78 kg',
                'team' => '台北雄鷹隊',
                'stats' => [
                    'matches' => 28,
                    'goals' => 15,
                    'assists' => 8,
                    'rating' => 8.5,
                ],
            ];

            return view('User.player-profile', compact('player'));
        }

 

    }
?>