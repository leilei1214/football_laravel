<?php
    namespace App\Http\Controllers\User;
    use Yajra\DataTables\Facades\DataTables;
    use App\Http\Controllers\Controller;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\DB;
    class ClubController extends Controller
    {
        // 基礎
        public function ClubList()
        {
            return view('Club.ClubList');
        }

        

    }
?>