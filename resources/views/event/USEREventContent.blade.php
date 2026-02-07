@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')
<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">
<style>
.product-header .badge {
    position: relative;
    font-size: 20px;
    padding: 10px;
}
.player-avatar {
  width: 80px;
  text-align: center;
  font-family: Arial, sans-serif;
}

/* 頭貼包裝 */
.avatar-wrapper {
  position: relative;
  width: 64px;
  height: 64px;
  margin: 0 auto;
}

/* 圓形頭貼 */
.avatar-wrapper img {
  width: 100%;
  height: 100%;
  border-radius: 50%;
  object-fit: cover;
  border: 2px solid #2a2a2a;
}

/* 位置 Badge（FW） */
.position-badge {
  position: absolute;
  right: -4px;
  bottom: -4px;
  background-color: #e74c3c;
  color: #fff;
  font-size: 12px;
  font-weight: bold;
  padding: 4px 6px;
  border-radius: 12px;
  box-shadow: 0 0 0 2px #fff;
}

/* 狀態列 */
.status-row {
  display: flex;
  justify-content: center;
  gap: 6px;
  margin-top: 6px;
}

/* 狀態 Icon */
.status {
  width: 18px;
  height: 18px;
  border-radius: 50%;
  font-size: 12px;
  line-height: 18px;
  text-align: center;
  color: #fff;
}

/* 已簽到 */
.status.checkin {
  background-color: #2ecc71;
}

/* 已繳費 */
.status.paid {
  background-color: #3498db;
}
</style>
@endsection


@section('content')
<section class="section section-md bg-gray-100">
    <div class="container">
        <div class="row row-50">
            <div class="col-lg-8 ">



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
                    <!-- mx-auto -->
                    <ul class="list-inline mx-auto list-inline-xs">
                        <li><a class="button button-md button-primary btn_add" href="#">V 參加</a></li>
                        <li><a class="button button-md button-primary btn_Nadd" href="#">X 不參加</a></li>

                    </ul>
                </div>
                <div class="row">
                <div class="col-sm-12 owl-carousel-outer-navigation">
                    <article class="heading-component" >
                    <div class="heading-component-inner">
                        <h5 class="heading-component-title">錄取名單
                        </h5>
                    </div>
                    </article>
                </div>

                </div>
                <div class="table-custom-responsive">

                <!-- <table class="table">

                    <thead class="table-standings ">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">名字</th>
                        <th scope="col">位置</th>
                        <th scope="col">簽到</th>
                        <th scope="col">簽退</th>
                        <th scope="col">繳費</th>

                    </tr>
                    </thead>
                    <tbody id="add_registrations">

                    </tbody>
                </table> -->
                </div>

                
            </div>
            <!-- Aside Block-->
            <div class="col-sm-12 col-md-12 col-lg-4">
                <aside class="aside-components"  style="display: contents;">

                <div class="aside-component">
                    <!-- Heading Component-->
                    <article class="heading-component">
                    <div class="heading-component-inner">
                        <h5 class="heading-component-title">備取名單
                    </div>
                    </article>
                    <!-- Table team-->
                    <div class="table-custom-responsive">
                    <table class="table-custom table-standings table-classic" style="table-layout: fixed; width: 100%;">
                        <thead>
                        <tr>
                            <th>順序</th>
                            <th>名字</th>
                            <th>位置</th>
                            <th>備註</th>
                        </tr>
                        </thead>
                        <tbody id="Backup_registrations">

                        </tbody>
                    </table>
                    </div>
                </div>
                </aside>
            </div>
            <div class="col-lg-8">
                <aside class="aside-components"  style="display: contents;">

                <div class="aside-component">
                    <!-- Heading Component-->
                    <article class="heading-component">
                    <div class="heading-component-inner">
                        <h5 class="heading-component-title">不參加名單
                    </div>
                    </article>
                    <!-- Table team-->
                    <div class="table-custom-responsive">
                    <table class="table-custom table-standings table-classic" style="table-layout: fixed; width: 100%;">
                        <thead>
                        <tr>
                            <th>順序</th>
                            <th>名字</th>
                            <th>位置</th>
                            <!-- <th>備註</th> -->
                        </tr>
                        </thead>
                        <tbody id="Nadd_registrations">

                        </tbody>
                    </table>
                    </div>
                </div>
                </aside>
            </div>
        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- <script src="{{ asset('js/event_level.js') }}"></script> -->
<script>
    function show_level(level){
        var tabEl = document.querySelectorAll('#tabs-modern .nav-link');
        consol
        tabEl.forEach(function (el) {
            el.addEventListener('shown.bs.tab', function (event) {
                const level = event.target.dataset.level;
                console.log('切換完成：', level);
            });
        });
    }
</script>
<script>
// fetch('/check-identity')
//   .then(res => res.json())
//   .then(data => 
//     console.log('Level:', data.level, 'Guild:', data.Guild)
//     if(data.level == 1){
//         $(".addEventHref").addClass("d-none")
//     }
//   );
</script>
<script>
    
    function formatDate(dateStr, offsetHours = -7) {
        // return new Date(dateStr).toLocaleString('zh-TW', { timeZone: 'Asia/Taipei', hour12: false });

        const taiwanDate = new Date(dateStr);
         taiwanDate.setHours(taiwanDate.getHours() + offsetHours);
        // const taiwanDate = new Date(new Date(date.getTime() + 8 * 60 * 60 * 1000));

        // 年、月、日
        const year = taiwanDate.getFullYear();
        const month = String(taiwanDate.getMonth() + 1).padStart(2, '0'); // 月份從 0 開始
        const day = String(taiwanDate.getDate()).padStart(2, '0');

        // 時、分、秒
        const hours = String(taiwanDate.getHours()).padStart(2, '0');
        const minutes = String(taiwanDate.getMinutes()).padStart(2, '0');
        const seconds = String(taiwanDate.getSeconds()).padStart(2, '0');

        return `${year}/${month}/${day} ${hours}:${minutes}:${seconds}`;
    }
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
                registrations.forEach((registration, index) => {
                    Istatus_add += 1
                    if(registration.status_add == "1"){
                        
                        if(registration.identifier == localStorage.getItem("identifier") ){
                        const element = document.querySelector('.btn_add');
                        $(".btn_add").addClass("active")
                        // Add inline styles
                        element.style.background = '#888'; // Changes text color to red
                        element.style.borderColor = '#888'; 
                        }
                        let check_in = "未簽到";
                        if (registration.check_in == 1) {
                            check_in = "已簽到";
                            check_in = '✔';

                            // check_in = formatDate(registration.check_in_time)
                        }

                        let check_out = "未簽退"; // Corrected this line
                        if (registration.check_out == 1) {
                            check_out = "已簽退";
                            check_out = '⏹';
                            // check_out = formatDate(registration.check_out_time)
                        }

                        let payment_status = "未繳費";
                        if (registration.payment_status) {
                        payment_status ="已繳費"; // Use the actual name
                        payment_status ='💰';
                        // payment_status = formatDate(registration.payment_time); // Use the actual name

                        }

                        console.log(`Registration ${index + 1}:`, registration);
                        if(Istatus_add <= data.max_participants){
                        add_registrations +=`
                        <div class="player-avatar">
                            <div class="avatar-wrapper">
                                <img src="${registration.user_img}" alt="player" />

                                <!-- 位置 Badge -->
                                <span class="position-badge">${registration.preferred_position1}</span>
                            </div>

                            <!-- 狀態列 -->
                            <div class="status-row">
                                <span class="status checkin" title="已簽到">${check_in}</span>
                                <span class="status checkin" title="已簽退">${check_out}</span>
                                <span class="status paid" title="已繳費">${payment_status}</span>
                            </div>
                        </div>
                        `
                        // add_registrations += `
                        // <tr>
                        //     <th scope="row">${Istatus_add}</th>
                        //     <td>${registration.username}</td>
                        //     <td>${registration.preferred_position1}、${registration.preferred_position2}</td>
                        //     <td>${check_in}</td>
                        //     <td>${check_out}</td>
                        //     <td>${payment_status}</td>
                        // </tr>
                        // `;
                        }else{
                        Istatus_Badd += 1
                        Backup_registrations +=`
                        <tr>
                            <td><span>${Istatus_Badd}</span></td>
                            <td class="team-inline">

                            <div class="team-title">
                                <div class="team-name">${registration.preferred_position1}、${registration.preferred_position2}</div>
                            </div>
                            </td>
                            <td>備取${Istatus_Badd}</td>
                        </tr>
                        `
                        }

                    }

                    else if(registration.status_add == "0"){

                        Istatus_Nadd += 1
                        $(".btn_Nadd").addClass("active")
                        // Add inline styles
                        const element = document.querySelector('.btn_Nadd');

                        element.style.background = '#888'; // Changes text color to red
                        element.style.borderColor = '#888'; 

                        Nadd_registrations += `
                        <tr>
                            <td>${Istatus_Nadd}</th>
                            <td>${registration.username}</td>
                            <td>${registration.preferred_position1}、${registration.preferred_position2}</td>
                    
                        </tr>
                        `;
                    }
                    
                });

                $("#add_registrations").html(add_registrations); // Correct jQuery method
                $("#Nadd_registrations").html(Nadd_registrations); // Correct jQuery method
                $("#Backup_registrations").html(Backup_registrations); // Correct jQuery method

                
                // activity_level
                // eventContentDiv.innerHTML = `
                //     <p><strong>活動名稱：</strong> ${data.activity_name || '無資料'}</p>
                //     <p><strong>地點：</strong> ${data.location || '無資料'}</p>
                //     <p><strong>簡介：</strong> ${data.activity_intro || '無資料'}</p>
                //     <p><strong>時間：</strong> ${data.time || '無資料'}</p>
                //     <p><strong>參加人數：</strong> ${data.current_participants || 0} / ${data.max_participants || '無限制'}</p>
                // `;
            } 


        } catch (err) {
            console.error(err);
            alert('系統錯誤');
        }
    }
    document.addEventListener('DOMContentLoaded', loadEventContent);

</script>
@endsection