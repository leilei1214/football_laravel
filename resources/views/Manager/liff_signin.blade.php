@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>

<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/Manager.css') }}">
<style>
.product-header .badge {
    position: relative;
    font-size: 20px;
    padding: 10px;
}
.product-figure{
    width: 80%;
    margin: 0 auto;
}
</style>
@endsection


@section('content')

<section class="section section-md bg-gray-100"  style="height:100vh">
    <div class="container">
    <div class="row row-50">
        <div class="col-lg-8">

            <div class="blog-post">
                <!-- Badge-->
                <div id="qrcode"></div>
                <div id="result">正在檢查是否從 LINE 開啟...</div>


            </div>

        </div>
    </div>
    </div>

</section>
@endsection
@section('scripts')

<script sr 淤c="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src = "https://cdn.datatables.net/1.13.8/js/jquery.dataTables.min.js" ></script>
 

<script>
    // 修正你的 fetch 語法錯誤 (少了一個括號)
    fetch('/check-identity')
      .then(res => res.json())
      .then(data => {
        console.log('Level:', data.level, 'Guild:', data.Guild);
        if(data.level == 1){
            $(".addEventHref").addClass("d-none");
        }
      })
      .catch(err => console.error('Fetch error:', err));
</script>

<script>
      function ClockOut() {
        const currentUrl = window.location.href;

        // 使用 URLSearchParams 提取查詢參數
        const urlParams = new URLSearchParams(window.location.search);

        // 獲取 `list_id` 的值
        const activityId = urlParams.get('list_id');

        window.location.href ="./SignIn?list_id="+activityId

      }
      function QrcodeSign(){
        const currentUrl = window.location.href;

        // 使用 URLSearchParams 提取查詢參數
        const urlParams = new URLSearchParams(window.location.search);

        // 獲取 `list_id` 的值
        const activityId = urlParams.get('list_id');
        const Guild = localStorage.getItem('Guild');

        window.location.href ="./Sign_Qrcode?list_id="+activityId+"&Guild="+Guild

      }
</script>


<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>
        // window.location.href ="./Sign_Qrcode?list_id="+activityId+"&Guild="+Guild
            const liffId = "1661291645-p5ObO70M"
            async function runLiffSignIn() {
                try {
                    await liff.init({ liffId });

                    if (!liff.isLoggedIn()) {
                        liff.login();
                        return;
                    }
                    const currentUrl = window.location.href;

                    // 使用 URLSearchParams 提取查詢參數
                    const urlParams = new URLSearchParams(window.location.search);

                    // 獲取 `list_id` 的值
                    // list_id=${listId}&Guild=${Guild}&Sign=IN
                    const listId = urlParams.get('list_id');
                    const Guild = urlParams.get('guild_id');
                    const Sign = urlParams.get('Sign');

                    console.log(listId);
                    const profile = await liff.getProfile();
                    const userId = profile.userId;
                    const name = profile.displayName;

                    document.getElementById("result").innerHTML = `
                    🆔 活動編號 : ${listId}
                    ✅ <b>簽到成功！</b><br>
                    👤 使用者名稱：${name}<br>
                    🆔 User ID：<code>${userId}</code><br>
                    🕒 時間：${new Date().toLocaleString()}
                    `;
                    fetch('/api/Update_SignIn_Qrcode', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                ?.getAttribute('content')
                        },
                        body: JSON.stringify({
                          time: new Date(),
                          Up_userId:userId,
                          listId:listId,
                          Guild:Guild,
                          Sign:Sign

                        }),
                    })
                    .then(response => {
                      if (response.status === 200) {
                        return response.json(); // 解析 JSON
                      } else {
                        throw new Error(`伺服器回傳錯誤：${response.status}`);
                      }
                    })
                    .then(data => {
                      alert('會員等級已成功更新');
                      window.location.href ="./event_content?list_id="+listId

                    })
                    .catch(error => {
                        console.error("更新失敗，請稍後再試:", error);
                    });
                    // 👉 若你要送資料到後端或 Google Sheet，可放這裡
                    /*
                    fetch("https://your-backend.com/checkin", {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        userId,
                        name,
                        timestamp: new Date().toISOString()
                    })
                    });
                    */
                } catch (err) {
                    document.getElementById("result").innerText = "⚠️ LIFF 初始化失敗：" + err;
                }
            }

            // 如果支援 LIFF，執行簽到
            if (window.liff) {
             runLiffSignIn();
            }

</script>
@endsection