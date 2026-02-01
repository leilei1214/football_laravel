@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')

<link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>


<link rel="stylesheet" href="{{ asset('css/Manager.css') }}">
<style>
.product-header .badge {
    position: relative;
    font-size: 20px;
    padding: 10px;
}
</style>
@endsection


@section('content')
<section class="section section-md bg-gray-100">
    <div class="container">
        <div class="row row-50">
            <div class="col-lg-8 ">
                <ul class="list-inline mx-auto list-inline-xs Boss_edit"  style="margin-bottom: -4px;display: inline-block;">
                <li class="pl-0 pr-0"><a class=" button-md icon-media icon-media-round icon-media-instagram " href="#">編輯</a></li>
                <li class="pl-0 pr-0"><a class="button-md icon-media icon-media-round icon-media-google " href="#">刪除</a></li>
                </ul>
                <ul class="list-inline mx-auto list-inline-xs Boss_edit float-right"  style="margin-bottom: -4px;display: inline-block;">
                <li class="pl-0 pr-0"><a class="button-md icon-media icon-media-round icon-media-instagram " onclick="ClockOut()">簽到表</a></li>
                <li class="pl-0 pr-0"><a class="button-md icon-media icon-media-round icon-media-instagram " onclick="QrcodeSign()">Qrcode簽到</a></li>
                </ul>


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
                    <img class="img-circle" src="images/logo.png" alt="" width="63" height="63">

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
                <table class="table">
                    <!-- <div class="badge badge-secondary">錄取名單
                    </div> -->
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
                    <!-- <tr>
                        <th scope="row">1</th>
                        <td>Mark</td>
                        <td>Otto</td>
                        <td>@mdo</td>
                    </tr>
                    <tr>
                        <th scope="row">2</th>
                        <td>Jacob</td>
                        <td>Thornton</td>
                        <td>@fat</td>
                    </tr>
                    <tr>
                        <th scope="row">3</th>
                        <td>Larry</td>
                        <td>the Bird</td>
                        <td>@twitter</td>
                    </tr> -->
                    </tbody>
                </table>
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
    const params = new URLSearchParams(window.location.search);
    const listId = params.get('list_id');
    const guildId = params.get('guild_id');
    if (!listId || !guildId) {
        alert("連結錯誤");
        setTimeout(() => {
            window.location.href = "/";
        }, 1000);
    }else{
        const response = await fetch('/api/event/content', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content
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

        const data = await response.json();
        console.log(data);
    }


</script>
@endsection