<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    public function home()
    {
        return view('home'); // 對應 resources/views/home.blade.php
    }

    // 可選其他方法
    public function about()
    {
        return view('about'); // 對應 resources/views/about.blade.php
    }
}
