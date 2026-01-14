<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
//身分驗證
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str; 
class LoginController extends Controller
{
     public function showLoginForm()
    {
        return view('auth.login');
    }
        // ① 導向 LINE 授權頁
    public function login()
    {
        $state = Str::random(32);
        session(['line_state' => $state]);

        $query = http_build_query([
            'response_type' => 'code',
            'client_id'     => env('LINE_CHANNEL_ID'),
            'redirect_uri'  => env('LINE_REDIRECT_URI'),
            'state'         => $state,
            'scope'         => 'profile openid',
            
        ]);

        return redirect('https://access.line.me/oauth2/v2.1/authorize?' . $query);
    }

    public function callback(Request $request)
    {
        if ($request->state !== session('line_state')) {
            abort(403, 'Invalid state');
        }

        $tokenResponse = Http::asForm()->post(
            'https://api.line.me/oauth2/v2.1/token',
            [
                'grant_type'    => 'authorization_code',
                'code'          => $request->code,
                'redirect_uri'  => env('LINE_REDIRECT_URI'),
                'client_id'     => env('LINE_CHANNEL_ID'),
                'client_secret'=> env('LINE_CHANNEL_SECRET'),
            ]
        );

        $accessToken = $tokenResponse['access_token'];

        $profile = Http::withToken($accessToken)
            ->get('https://api.line.me/v2/profile')
            ->json();


        $userId = $profile['userId'];
        $lineDisplayName = $profile['displayName'];
        /*
          $profile = [
            'userId' => 'Uxxxx',
            'displayName' => 'John',
            'pictureUrl' => 'https://...',
          ]
        */
        $result = DB::select(
            'SELECT * FROM users WHERE userid = ? ',
            [$userId]
        );

        if (count($result) > 0) {
            // 使用者存在
            return redirect()->route('home');
        }
        return redirect('/login');
    }
    
}
