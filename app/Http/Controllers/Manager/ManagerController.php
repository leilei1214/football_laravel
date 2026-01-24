<?php
    namespace App\Http\Controllers\Manager;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    class ManagerController extends Controller
    {
        public function EventManager()
        {
            return view('Manager.EventList');
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
                    return '<a href="/manager/event-edit/'.$row->id.'" class="btn btn-sm btn-primary">編輯</a>';
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
    }
?>