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
        

    }
?>