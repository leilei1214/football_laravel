<?php
    namespace App\Http\Controllers\Club;
    use Yajra\DataTables\Facades\DataTables;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    use Carbon\Carbon;
    class ClubController extends Controller
    {
        // 基礎
        public function ClubList()
        {
            return view('Club.ClubList');
        }        
        public function ClubProfile($id)
        {
                    // 範例：從資料庫獲取球隊資料
        // $team = Team::with(['players', 'stats', 'achievements'])->findOrFail($id);
            $results = DB::table('guilds')
            ->select('guild_id','name','tag','created_at','guild_logo','club_level_1','club_level_2','club_level_3','description')
            ->where('guild_id', $id)
            ->first();
            $defaultImage = "/images/logo-soccer-default-95x126.png";
            $users = DB::table('union_members')
                ->join('users', 'union_members.name', '=', 'users.identifier')
                ->where('guild_id', $id)
                ->orderBy('created_at', 'asc')
                ->get();
            $players = [];
            foreach ($users as $index => $user) {
                $players[] = [
                    'id' => $index + 1,
                    'name' => $user->username,
                    'number' => $user->number,
                    'level' => $user->level,
                    'image' => $user->user_img,
                    'position' => $user->preferred_position1
                ];
            }
                 // 示範用的假資料
            $team = [
                'name' => $results->name,
                'nameEn' => '',
                'logo' => $results->guild_logo ? asset($results->guild_logo) : asset($defaultImage),
                'coverImage' =>'/images/clubbackground.jpg',
                'founded' => $results->created_at ? Carbon::parse($results->created_at)->format('Y-m-d') : null,
                'stadium' => '台中',
                // 'capacity' => '20,000',
                'league' => '球隊標籤',
                'manager' => '王建民',
                'club_level_1' => $results->club_level_1,
                'club_level_2' => $results->club_level_2,
                'club_level_3' => $results->club_level_3,
                // 'colors' => ['深藍色', '金色'],
                'stats' => [
                    'matches' => 0,
                    'wins' => 0,
                    'draws' => 0,
                    'losses' => 0,
                    'goalsFor' => 0,
                    'goalsAgainst' => 0,
                    'points' => 0,
                ],
                'players' => $players,
                'achievements' => [
                    ['year' => 'xxxx', 'title' => 'xx亞軍'],
                    ['year' => 'xxxx', 'title' => 'xx冠軍'],
                    ['year' => 'xxxx', 'title' => 'xxwq1季軍'],
                ],
                //  ['year' => 2022, 'title' => '聯賽季軍'],
                // ],
            ];

            return view('Club.ClubProfile', compact('team'));
        }
        
        public function getGuilds(Request $request)
        {
            try {
                // 執行查詢
                $results = DB::select('SELECT guild_id, name, tag, created_at, guild_logo, club_level_1, club_level_2, club_level_3, description FROM guilds ORDER BY guild_id ASC');

                if (empty($results)) {
                    return response()->json(['message' => '尚未建立公會'], 404);
                }

                // 預設圖片路徑 (務必確保前面有斜線 /)
                $defaultImage = "/images/logo-soccer-default-95x126.png";

                // 轉換格式 (對標你原本的 posts 陣列)
                $posts = collect($results)->map(function ($row) use ($defaultImage) {
                    // 解析 Tag JSON
                    $tags = json_decode($row->tag, true) ?? [];
                    $category = $tags[0] ?? "unknown";

                    return [
                        'id'           => $row->guild_id,
                        'title'        => $row->name,
                        // 這裡最重要：強制回傳絕對路徑或完整 URL，解決 Club/js 這種路徑污染
                        'image'        => $row->guild_logo ? asset($row->guild_logo) : asset($defaultImage),
                        'category'     => $category,
                        'date'         => $row->created_at ? Carbon::parse($row->created_at)->format('Y-m-d') : null,
                        'club_level_1' => $row->club_level_1,
                        'club_level_2' => $row->club_level_2,
                        'club_level_3' => $row->club_level_3,
                        'excerpt'      => $row->description
                    ];
                });

                return response()->json(['data' => $posts], 200);

            } catch (\Exception $e) {
                \Log::error('資料庫查詢失敗: ' . $e->getMessage());
                return response()->json(['message' => '資料庫查詢錯誤'], 500);
            }
        }
        public function registerClub($id)
        {
            if (!session('identifier')) {
                return response()->json([
                    'redirect' => route('login') . '?status=login&club=' . $id . '&level=4'
                ]);
            }

            $name = session('identifier');

            // 先檢查是否已加入
            $exists = DB::table('union_members')
                ->where('guild_id', $id)
                ->where('name', $name)
                ->first();

            if ($exists) {
                return response()->json([
                    'success' => false,
                    'message' => '你已經加入過此球隊'
                ]);
            }

            // 沒有才新增
            DB::table('union_members')->insert([
                'guild_id'   => $id,
                'name'       => $name,
                'level'      => 4,
                'is_active'  => 1,
                'joined_at'  => now(),
                'created_at' => now(),
                'class'      => 'football'
            ]);

            return response()->json([
                'success' => true,
                'message' => '加入球隊成功'
            ]);
        }
        

        
    }
?>