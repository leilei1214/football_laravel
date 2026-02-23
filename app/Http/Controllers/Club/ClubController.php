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