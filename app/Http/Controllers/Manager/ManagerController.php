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
    }
?>