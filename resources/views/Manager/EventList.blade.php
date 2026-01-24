@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">
<style>
.product-header .badge {
    position: relative;
    font-size: 20px;
    padding: 10px;
}
</style>
@endsection


@section('content')
<section class="section section-variant-1 bg-gray-100">
    <div class="container">
        <!-- 更改成管理中心 -->
        <h2>活動列表</h2>

        <table id="events-table" class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>標題</th>
                    <th>活動等級</th>
                    <th>建立時間</th>
                    <th>操作</th>
                </tr>
            </thead>
        </table>
    </div>
</section>


@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.datatables.net"></script>

<!-- <script src="{{ asset('js/event_level.js') }}"></script> -->
<script>
    function show_level(level){
        var tabEl = document.querySelectorAll('#tabs-modern .nav-link');
        tabEl.forEach(function (el) {
            el.addEventListener('shown.bs.tab', function (event) {
                const level = event.target.dataset.level;
                console.log('切換完成：', level);
            });
        });
    }
</script>
<script>
fetch('/check-identity')
  .then(res => res.json())
  .then(data => 
    console.log('Level:', data.level, 'Guild:', data.Guild)
    if(data.level == 1){
        $(".addEventHref").addClass("d-none")
    }
  );
</script>
<!-- 1️⃣ jQuery 先載入 -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

<!-- 2️⃣ DataTables CSS -->

<!-- 3️⃣ DataTables JS -->
<script>
    //   fetch('./api/event', {
    //       method: 'POST',
    //       headers: {
    //         'Content-Type': 'application/json;charset=utf-8',
    //         'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')

    //       },
    //       body: JSON.stringify({ level:"總覽" })
    //   })
    //   .then(response => {
    //       if (!response.ok) {
    //           if (response.status == 400) {
    //               window.location.href = "/login";  // 如果狀態碼是 400，跳轉到登入頁
    //           }
    //           throw new Error(`Network response was not ok, status: ${response.status}`);
    //       }
    //       return response.json();  // 解析 JSON 響應
    //   })
    //   .then(data => {
    //       console.log('Response data:', data);  // 查看完整響應

    //       const activities = Array.isArray(data) ? data : [];
    //       if (activities.length === 0) {
    //           console.log("No activities to display");
    //       }
          
    //       // 生成每個活動的 HTML
    //       let activitylevel = '';
    //       let activitiesHtml = '';
    //       for (let activity of activities) {
    //           activitylevel = '';
              
    //           console.log('Activity:', activity);

    //           // 檢查時間是否有效
    //           const eventDate = new Date(activity.time);
    //           if (isNaN(eventDate)) {
    //               console.error('Invalid date:', activity.time);
    //               continue;  // 跳過無效日期的活動
    //           }

    //           const formattedDate = `${eventDate.getFullYear()}-${String(eventDate.getMonth() + 1).padStart(2, '0')}-${String(eventDate.getDate()).padStart(2, '0')} ${String(eventDate.getHours()).padStart(2, '0')}:${String(eventDate.getMinutes()).padStart(2, '0')}`;
              
    //           const levels = activity.activity_level.replace(/^{|}$/g, '').split(',');
    //           for (const item of levels) {
    //               if( item == "基礎"){
    //                 activitylevel += `
    //                   <div class="badge badge-primary">${item}
    //                   </div>
    //                 `
    //               }
    //               else if( item == "實踐"){
    //                 activitylevel += `
    //                   <div class="badge badge-red">${item}
    //                   </div>
    //                 `
    //               }
    //               else{
    //                 activitylevel += `
    //                   <div class="badge badge-secondary">${item}
    //                   </div>
    //                 `
    //               }

    //           }
    //           activitiesHtml += `
    //               <div class="item mb-3" style="width: 330px; margin-right: 30px;" onclick="event_content_href(${activity.id })">
    //                   <article class="product">
    //                       <header class="product-header">
    //                           ${activitylevel}
    //                           <div class="product-figure">
    //                               <img src="images/戰術對抗訓練.jpg" alt="活動圖片">
    //                           </div>
    //                       </header>
    //                       <footer class="product-content">
    //                           <h6 class="product-title"><a href="product-page.html">${activity.activity_notice}</a></h6>
    //                           <div class="post-future-meta product-price">
    //                               <div class="post-future-time"><span class="icon mdi mdi-clock"></span><time datetime="${formattedDate}">${formattedDate}</time></div>
    //                           </div>
    //                           <div class="product-price"><p><i class="icon mdi mdi-map-marker"></i> ${activity.location}</p></div>
    //                           <hr>
    //                           <div class="product-price"><span class="heading-6 product-price-new">$${activity.amount}</span></div>
    //                           <p><strong>目前參加人數：</strong>${activity.current_participants} / ${activity.max_participants}</p>
    //                       </footer>
    //                   </article>
    //               </div>
    //           `;
    //       }
    //       // activitiesHtml +=`</div>`
    //       // 確保插入的元素存在
    //       console.log($('#select_event'));  // 確保選擇器正確
    //       const carousel = $('#myCarousel');

    //       // 先銷毀先前的 carousel (如果有初始化過)
    //       if (carousel.hasClass('owl-loaded')) {
    //         carousel.trigger('destroy.owl.carousel');
    //         carousel.html('');  // 清空原本的內容
    //       }

    //       // 放入新內容
    //       carousel.html(activitiesHtml);
    //       // carousel.html(activitiesHtml);  // 插入活動卡片;
    //       // $('#select_event').html(activitiesHtml);  // 插入 HTML
          

    //       // 延遲初始化 Owl Carousel，確保 HTML 插入後執行
    //       setTimeout(() => {
    //       // $('#select_event').html(activitiesHtml).promise().done(()
    //         // $('#select_event').html(activitiesHtml).promise().done(() => {
    //             carousel.owlCarousel({
    //                 items: 3,
    //                 margin: 30,
    //                 nav: true,
    //                 dots: false,
    //                 loop: activities.length > 3,
    //                 autoplay: true,
    //                 autoplayTimeout: 4000,
    //                 responsive: {
    //                     0: { items: 1 },
    //                     600: { items: 2 },
    //                     1000: {items:3 }
    //                 }
    //             });
    //         // })

    //       }, 1000);  // 延遲初始化，確保內容已插入

    //   })
    //   .catch((error) => {
    //       console.error('Error:', error);
    //   });

    $(document).ready(function(){
        $('#events-table').DataTable({
            processing: true,
            serverSide: true,
            destroy: true, // 重新初始化
            ajax: {
                url: '{{ route('Mapi.event') }}',
                data: { level: '總覽' }
            },
            columns: [
                { data: 'id', name: 'id' },
                { data: 'title', name: 'title' },
                { data: 'activity_level', name: 'activity_level' },
                { data: 'created_at', name: 'created_at' },
                { data: 'action', name: 'action', orderable: false, searchable: false }
            ]
        });
    });
</script>
@endsection