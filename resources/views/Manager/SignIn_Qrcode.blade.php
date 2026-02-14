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
<section class="section section-md bg-gray-100" style="height:100vh">
    <div class="container">
        <div class="row row-50 justify-content-center">
            <div class="col-lg-10 ">



                <div class="blog-post" style="margin: -4px;">
                <!-- Badge-->
                    <div id="activity_level">

                    </div>
                <!-- <div class="badge badge-secondary">The Team
                </div> -->
                <!-- <div class="badge badge-secondary">The Team
                </div> -->
                <h3 class="blog-post-title"></h3>
                <div class="blog-post-header">
                    <div class="blog-post-author">
                    <img class="img-circle" src="/images/logo.png" alt="" width="63" height="63">

                    <!-- <img class="img-circle" src="images/user-3-63x63.jpg" alt="" width="63" height="63"> -->
                    <p class="post-author organizer"></p>
                    </div>
                    <div class="blog-post-meta">
                    <time class="blog-post-time" datetime="2024"><span class="icon mdi mdi-clock"></span><span class="active_date"></span></time>
                    <div class="blog-post-comment"><span class="icon mdi mdi-map-marker"></span><span class="location"></span></div>
                    <div class="blog-post-view"><span class="icon mdi mdi-account-multiple"></span><span class="current_participants"></span>/<span class="max_participants"></span> </div>
                    <div class="blog-post-view "><span class="icon">$</span><span class="icon amount"></div>
                    <div class="blog-post-view Boss_edit"><span class="icon">應收:</span><span class="icon sum_amount"></div>


                    </div>
                </div>
                <div class="blog-post-author-quote">
                    <p class="activity_intro"></p>
                </div>

                </div>
                <div class="row">
                    <div id="tabs-modern" >
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation" ><a class="nav-link btn_add" href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="true" role="tab">編輯</a></li>
                            <li class="nav-item" role="presentation" ><a class="nav-link btn_Nadd" href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">刪除</a></li>
                            <li class="nav-item" role="presentation" ><a class="nav-link active show" onclick="ClockOut()" href="#tabs-modern-3" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">簽到表</a></li>
                            <li class="nav-item" role="presentation" ><a class="nav-link" onclick="QrcodeSign()" href="#tabs-modern-3" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">Qrcode簽到</a></li>

                        </ul>                    
                    </div>
                    <!-- mx-auto -->



                </div>
                <div class="">
                    <div class="col-sm-12 owl-carousel-outer-navigation">
                        <article class="heading-component" >
                            <div class="heading-component-inner">
                            <h5 class="heading-component-title">簽到
                            </h5>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-md-4  d-inline-block">
                        <!-- Badge-->
                        <header class="product-header">
                            <!-- Badge-->

                            <div class="product-figure">
                            <div id="qrcode_in"></div>
                            </div>
                    
                        </header>


                    </div>
                    <div class="col-sm-12 owl-carousel-outer-navigation">
                        <article class="heading-component" >
                            <div class="heading-component-inner">
                            <h5 class="heading-component-title">簽退
                            </h5>
                            </div>
                        </article>
                    </div>
                    <div class="col-12 col-md-4  d-inline-block">
                        <header class="product-header">
                            <!-- Badge-->

                            <div class="product-figure">
                            <div id="qrcode_out"></div>
                            </div>
                    
                        </header>
                    </div>
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
    async function loadEventContent() {
        const params = new URLSearchParams(window.location.search);
        const listId = params.get('list_id');
        const guildId = params.get('guild_id');

        if (!listId || !guildId) {
            alert("連結錯誤");
            setTimeout(() => {
                window.location.href = "/";
            }, 1000);
            return;
        }

        try {
            const response = await fetch('/api/event/content', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content')
                },
                body: JSON.stringify({
                    list_id: listId,
                    guild_id: guildId
                })
            });

            if (!response.ok) {
                alert('讀取失敗');
                return;
            }
            if (response.ok) {
                const res = await response.json();

                const data = res.event
                console.log(data)
                // 遍歷陣列並輸出每個元素
                // for (const item of data.activity_category) {
                //   document.getElementById('activity_level').innerHTML += `
                //     <div class="badge badge-secondary">${item}
                //     </div>
                //   `
                // }
                const levels = data.activity_level.replace(/^{|}$/g, '').split(',');

                for (const item of levels) {
                    if( item == "基礎"){
                    document.getElementById('activity_level').innerHTML += `
                        <div class="badge badge-primary">${item}
                        </div>
                    `
                    }
                    else if( item == "實踐"){
                    document.getElementById('activity_level').innerHTML += `
                        <div class="badge badge-red">${item}
                        </div>
                    `
                    }
                    else{
                    document.getElementById('activity_level').innerHTML += `
                        <div class="badge badge-secondary">${item}
                        </div>
                    `
                    }

                }
                $(".blog-post-title").html(data.activity_notice)
                // const taiwanTime = new Date(data.time).toLocaleString('zh-TW', { timeZone: 'Asia/Taipei', hour12: false });

                const taiwanDate = new Date(data.time);
                taiwanDate.setHours(taiwanDate.getHours()-7 );
                // const taiwanDate =  new Date(new Date(date.getTime() + 8 * 60 * 60 * 1000));
                // 提取年月日和小時分鐘
                const year = taiwanDate.getFullYear();

                const month = String(taiwanDate.getMonth() + 1).padStart(2, '0'); // 月份從0開始，需要+1
                const day = String(taiwanDate.getDate()).padStart(2, '0');
                const hours = String(taiwanDate.getHours()).padStart(2, '0');
                const minutes = String(taiwanDate.getMinutes()).padStart(2, '0');

                // 組合成所需格式
                const formattedDate = `${year}-${month}-${day} ${hours}:${minutes}`;
                // console.log(formattedDate); // "2024-11-01 06:00"
                $(".amount").html(data.amount)
                $(".current_participants").html(data.current_participants)
                $(".max_participants").html(data.max_participants)
                $(".location").html(data.location)
                $(".organizer").html(data.organizer)
                $(".active_date").html(formattedDate)
                $(".activity_intro").html(data.activity_intro)
                $(".sum_amount").html(data.amount*data.current_participants)

                localStorage.setItem('Guild',data.club);
                                // #---------------------------------------------------------------------------------------
                const registrations = res.registrations
                console.log(registrations)
                let add_registrations = ""; // Initialize the HTML string
                let Nadd_registrations = ""; // Initialize the HTML string
                let Backup_registrations = "";
                // 不參加名單
                Istatus_Nadd = 0;
                Istatus_add = 0;
                // 備取生
                Istatus_Badd = 0;



            } 

        } catch (err) {
            console.error(err);
            alert('系統錯誤');
        }
    }

    // 頁面載入後執行
    document.addEventListener('DOMContentLoaded', loadEventContent);
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

<script>
    function save(){
    const currentUrl = window.location.href;

    // 使用 URLSearchParams 提取查詢參數
    const urlParams = new URLSearchParams(window.location.search);

    // 獲取 `list_id` 的值
    const activityId = urlParams.get('list_id');
    const guildId = urlParams.get('guild_id');

    // SignIn SignOut SignFree
    let jsonData = []; // 用于存储复选框信息的数组

    // 遍历所有 .SignIn 复选框
    $(".SignIn").each(function () {
        let isChecked = $(this).is(":checked"); // 检查是否选中
        let value = $(this).val(); // 获取复选框的值

        // 将状态和值存入 JSON 数组
        jsonData.push({
            checked: isChecked,  // 是否选中
            value: value,      // 复选框的值
            class: "SignIn",
            time: new Date()
        });
    });
            // 遍历所有 .SignIn 复选框
    $(".SignOut").each(function () {
        let isChecked = $(this).is(":checked"); // 检查是否选中
        let value = $(this).val(); // 获取复选框的值

        // 将状态和值存入 JSON 数组
        jsonData.push({
            checked: isChecked,  // 是否选中
            value: value,         // 复选框的值
            class: "SignOut",
            time: new Date()

        });
    });
            // 遍历所有 .SignIn 复选框
    $(".SignFree").each(function () {
        let isChecked = $(this).is(":checked"); // 检查是否选中
        let value = $(this).val(); // 获取复选框的值

        // 将状态和值存入 JSON 数组
        jsonData.push({
            checked: isChecked,  // 是否选中
            value: value,         // 复选框的值
            class:"SignFree",
            time: new Date()
            
        });
    });
    // 打印结果
    console.log(jsonData);
    fetch('/Mapi/Update_SignIn', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content')
        },
        body: JSON.stringify({
            activityId: activityId,
            jsonData:jsonData,
            guildId:guildId

        })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status == 200) {
                alert("儲存成功！");
                location.reload();
            }else if (data.message === 'User session not found') {
                window.location.href = data.redirect;
                return;
            } 
            else {
                alert("儲存失败：" + data.message);
            }
        })
        .catch(error => {
            console.error("请求失败:", error);
        });
    }
    // $(".btn_add").click(()=>{
    //   const currentUrl = window.location.href;

    //   // 使用 URLSearchParams 提取查詢參數
    //   const urlParams = new URLSearchParams(window.location.search);

    //   // 獲取 `list_id` 的值
    //   const activityId = urlParams.get('list_id');
    //   fetch('./insert-event', {
    //       method: 'POST',
    //       headers: {
    //           'Content-Type': 'application/json',
    //       },
    //       body: JSON.stringify({
    //         status_add: 1,
    //         activityId:activityId
    //       }),
    //   })
    //   .then(response => response.json())
    //   .then(data => {
    //       if (data.status == 200) {
    //           alert("報名成功！");
    //       } else {
    //           alert("報名失败：" + data.message);
    //       }
    //   })
    //   .catch(error => {
    //       console.error("请求失败:", error);
    //   });
    // })
</script>
<script src="https://cdn.jsdelivr.net/npm/qrcodejs@1.0.0/qrcode.min.js"></script>
<script src="https://static.line-scdn.net/liff/edge/2/sdk.js"></script>
<script>
        // window.location.href ="./Sign_Qrcode?list_id="+activityId+"&Guild="+Guild
        function getURLParameter(name) {
            return decodeURIComponent((new RegExp('[?|&]' + name + '=' + '([^&;]+?)(&|#|;|$)')
                .exec(location.search) || [null, ''])[1].replace(/\+/g, '%20')) || null;
        }
        const listId = getURLParameter('list_id');
        const guild_id = getURLParameter('guild_id');
        const liffUrl_IN = `https://liff.line.me/1661291645-p5ObO70M?list_id=${listId}&Sign=IN&guild_id=${guild_id}`; // ← 替換成你的 LIFF 網址
        const liffUrl_OUT = `https://liff.line.me/1661291645-p5ObO70M?list_id=${listId}&Sign=OUT&guild_id=${guild_id}`; // ← 替換成你的 LIFF 網址
        console.log(liffUrl_IN);
        const liffId = "1661291645-p5ObO70M"
        new QRCode(document.getElementById("qrcode_in"), {
            text: liffUrl_IN,
            width: 256,
            height: 256,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        new QRCode(document.getElementById("qrcode_out"), {
            text: liffUrl_OUT,
            width: 256,
            height: 256,
            colorDark: "#000000",
            colorLight: "#ffffff",
            correctLevel: QRCode.CorrectLevel.H
        });
        function back_event(){
                window.location.href = `./event_content?list_id=${listId}`
        }

</script>
@endsection