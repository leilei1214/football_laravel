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


    }
?>