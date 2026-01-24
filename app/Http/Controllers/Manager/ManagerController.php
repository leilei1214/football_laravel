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
                if ($level === '總覽') {      

                    $activities = DB::table('activities')->get();
                    if ($activities->isEmpty()) {
                        $activities->where(function($q) use ($levels){
                            foreach ($levels as $level) {
                                $q->orWhereRaw("FIND_IN_SET(?, REPLACE(REPLACE(activity_level, '{',''), '}','')) > 0", [$level]);
                            }
                        });                    
                    }
                    return response()->json($activities);
                }else{
                    // $activities = DB::table('activities')->get();
                    // if ($activities->isEmpty()) {
                    //     return response()->json(['message' => '找不到對應的活動'], 404);
                    // }

                    // // 撈活動
                    $result = DB::table()->whereRaw(
                        "FIND_IN_SET(?, REPLACE(REPLACE(activity_level, '{',''), '}','')) > 0",
                        [$level]
                    );

                    if (count($result) === 0) {
                        return response()->json(['message' => '找不到對應的活動'], 404);
                    }

                    $result->where(function($q) use ($levels){
                        foreach ($levels as $level) {
                            $q->orWhereRaw("FIND_IN_SET(?, REPLACE(REPLACE(activity_level, '{',''), '}','')) > 0", [$level]);
                        }
                    });                   
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
                $levels = $request->input('level', []);


        }
    }
?>