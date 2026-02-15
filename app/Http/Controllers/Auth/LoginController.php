<?php

namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
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
        // status:'register'

        $status = $request->session()->get('status'); // 拿 session 裡存的公會
        $guild_Id = $request->session()->get('guild_Id'); // 拿 session 裡存的公會
        $result = DB::select(
            'SELECT * FROM users WHERE userid = ?',
            [$userId]
        );
        $sql_true = false;
        $identifier = '';
        if (count($result) > 0) {
            $identifier = $result[0] ->identifier;


            foreach ($result as  $index => $user) {
                // $user 是物件，可以直接存取欄位
                if ($user->guild_Id == $guild_Id && $status == 'login') {
                    $guildId = DB::table('guilds')
                    ->where('guild_id', $guild_Id)
                    ->value('guild_id');
                    if ($guildId > 0) {
                        session([
                            'guild_Id'=>$guildId
                        ]);
                    }
                    // Guild 一致，導首頁
                    session([
                        'identifier'=>$user -> identifier,
                        'level'     => $user ->level,
                    ]);
                    return redirect()->route('home');
                } 
                // 使用者未註冊
                else if($user->guild_Id != $guild_Id && ($index+1 == count($result)) && $status == 'login'){
                    // Guild 不一致
                    return redirect()->route('login')->with('error', '公會不一致');
                }
                // 註冊第二個工會確認(一人最多兩個)
                else if($user->guild_Id != $guild_Id && count($result) == 1 && $status == 'register'){
                    $sql_true = TRUE;
                }
            }

            // 使用者存在
        }else{
            $sql_true = true;
            
        }
        if($sql_true){

            $birthday  = session('birthday');
            $position1 = session('position1');
            $position2 = session('position2');
            $guild_Id  = session('guild_Id');
            $level     = session('level');
            $Gender    = session('Gender');
            

            // 頭像
            $user_img = match ($Gender) {
                'M' => 'images/person_log.png',
                'W' => 'images/person_log_W.png',
                default => 'images/person_log.png',
            };
            if($identifier == ''){
                $identifier =  generateUniqueIdentifier(); // 生成唯一的 identifier
            }
            DB::beginTransaction();

            try {

                // ===============================
                // 🟡 level 5 → 創建公會
                // ===============================
                if ($level == 5) {

                    $tag           = session('tag'); // array
                    $club_level_1  = session('club_level_1');
                    $club_level_2  = session('club_level_2');
                    $club_level_3  = session('club_level_3');

                    // 建立 guild
                    DB::table('guilds')->insert([
                        'name'          => $Guild,
                        'tag'           => json_encode($tag),
                        'club_level_1'  => $club_level_1,
                        'club_level_2'  => $club_level_2,
                        'club_level_3'  => $club_level_3,
                    ]);
                }
                DB::table('users')->insert([
                    'username' => $lineDisplayName,
                    'userid'   => $userId,
                    'identifier'=> $identifier,
                    'birthday' => $birthday,
                    'displayName' => $lineDisplayName,
                    'preferred_position1' => $position1,
                    'preferred_position2' => $position2,
                    'Guild'    => $guild_Id,
                    'level'    => $level,
                    'Gender'   => $Gender,
                    'user_img' => $user_img,
                    'Sex' => $Gender
                ]);
                
                DB::commit();

                // 取得 guild_id
                $guildId = DB::table('guilds')
                    ->where('guild_id', $guild_Id)
                    ->value('guild_id');
                if ($guildId > 0) {
                    session([
                        'guild_Id'=>$guildId
                    ]);
                    $tag = session('tag') ?? ['football'];
                    foreach ($tag as $sport) {
                        DB::table('union_members')->insert([
                            'guild_id' => $guildId,
                            'name'     => $identifier,
                            'level'    => $level,
                            'is_active'=> 1,
                            'class'    => $sport,
                        ]);
                    }
                }
                    // ✅ 有公會 → 繼續
                else {

                    // ❌ 查不到公會
                    return redirect()->route('login')
                        ->with('error', '找不到此公會');
                }
                // 建立 union_members（多筆）
                return redirect()->route('home');
            }
            catch (Exception $e) {

                DB::rollBack();

                return redirect()
                    ->route('login')
                    ->with('error', '註冊失敗：'.$e->getMessage());
            }

        }
    }
    
}
function generateIdentifier()
{
    $digits = rand(1000, 9999);

    $letters = collect(range('A', 'Z'))
        ->random(4)
        ->implode('');

    $identifier = str_shuffle($digits . $letters);

    return $identifier;
}
function generateUniqueIdentifier()
{
    while (true) {
        $identifier = generateIdentifier();

        try {
            User::create([
                'identifier' => $identifier,
            ]);

            return $identifier;

        } catch (QueryException $e) {

            // MySQL duplicate key
            if ($e->errorInfo[1] != 1062) {
                throw $e;
            }

            // 撞號就重來
        }
    }
}