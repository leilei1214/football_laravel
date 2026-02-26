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
        public function ClubProfile()
        {
                    // 範例：從資料庫獲取球隊資料
        // $team = Team::with(['players', 'stats', 'achievements'])->findOrFail($id);
        
        // 示範用的假資料
            $team = [
                'name' => '台北雄鷹隊',
                'nameEn' => 'Taipei Eagles',
                'logo' => 'https://images.unsplash.com/photo-1761325970487-05c2541653eb',
                'coverImage' => '/images/clubbackground.jpg',
                'founded' => 2015,
                'stadium' => '台北市立體育場',
                'capacity' => '20,000',
                'league' => '台灣職業足球聯賽',
                'manager' => '王建民',
                'colors' => ['深藍色', '金色'],
                'stats' => [
                    'matches' => 30,
                    'wins' => 18,
                    'draws' => 6,
                    'losses' => 6,
                    'goalsFor' => 52,
                    'goalsAgainst' => 28,
                    'points' => 60,
                ],
                'players' => [
                    [
                        'id' => 1,
                        'name' => '陳威廷',
                        'number' => 10,
                        'position' => '前鋒',
                        'image' => 'https://images.unsplash.com/photo-1682486519525-a2c2d1c65b8b',
                    ],
                    [
                        'id' => 2,
                        'name' => '林俊傑',
                        'number' => 7,
                        'position' => '中場',
                        'image' => 'https://images.unsplash.com/photo-1677119966332-8c6e9fb0efab',
                    ],
                    [
                        'id' => 3,
                        'name' => '黃志強',
                        'number' => 9,
                        'position' => '前鋒',
                        'image' => 'https://images.unsplash.com/photo-1760046997065-25e4d6352bc8',
                    ],
                    [
                        'id' => 4,
                        'name' => '王美玲',
                        'number' => 23,
                        'position' => '後衛',
                        'image' => 'https://images.unsplash.com/photo-1573113062125-2ccf3cbb67df',
                    ],
                ],
                'achievements' => [
                    ['year' => 2024, 'title' => '聯賽亞軍'],
                    ['year' => 2023, 'title' => '盃賽冠軍'],
                    ['year' => 2022, 'title' => '聯賽季軍'],
                ],
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
        

        
    }
?>