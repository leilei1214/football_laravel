<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EventController extends Controller
{
     public function ShowEvent()
    {
        return view('event.ViewList', compact('events'));
    }

}