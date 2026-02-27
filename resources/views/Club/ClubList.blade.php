@extends('layouts.app')

@section('title', '公會列表')
@section('style')
<link rel="stylesheet" href="{{ asset('/css/SUM_CLUB.css') }}">

<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.13.8/css/jquery.dataTables.min.css"> -->
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/> -->


<style>

ul#pagination {
    list-style: none;
    padding: 0;
    display: flex;
    gap: 10px;
}
ul#pagination li button {
    padding: 5px 10px;
    cursor: pointer;
}
ul#pagination li.active button {
    font-weight: bold;
    color: white;
    background-color: #007BFF;
}

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
          <div class="row row-50 justify-content-center">

            <div id="post-list"></div>

            <ul id="pagination" style="list-style: none; display: flex; gap: 5px; padding: 0;"></ul>
          </div>
        </div>
      </section>


@endsection
@section('scripts')

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

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
    // 修正你的 fetch 語法錯誤 (少了一個括號)
    // fetch('/check-identity')
    //   .then(res => res.json())
    //   .then(data => {
    //     console.log('Level:', data.level, 'Guild:', data.Guild,'guild_Id:', data.guild_Id);
    //     if(data.level == 1){
    //         $(".addEventHref").addClass("d-none");
    //     }else{
    //         alert("無權限")
    //         window.location.href = "/";
    //     }
    //   })
    //   .catch(err => console.error('Fetch error:', err));
</script>
<!-- 1️⃣ jQuery 先載入 -->
<!-- <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script> -->

<!-- 2️⃣ DataTables CSS -->

<!-- 3️⃣ DataTables JS -->


<script>
    let posts = []; // 全域變數

    const postsPerPage = 6;
    let currentPage = 1;

    // 渲染文章列表
    const list = document.getElementById("post-list");

    
    function renderPosts() {


        list.innerHTML = "";

        fetch('/api/guilds', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document
                        .querySelector('meta[name="csrf-token"]')
                        ?.getAttribute('content')
                },
                body: JSON.stringify({ identifier: "none" })
                // body: JSON.stringify({ identifier: "none",level:level })
            })
            .then(response => {
                // if (!response.ok) {
                //     if (response.status == 400) {
                //         window.location.href = "/login";  // 如果狀態碼是 400，跳轉到登入頁
                //     }
                //     else if (response.status == 404) {
                //       activitiesHtml = "尚未建立活動";  // 如果狀態碼是 400，跳轉到登入頁

                //       return;
                //     }
                //     throw new Error(`Network response was not ok, status: ${response.status}`);
                // }
                return response.json();  // 解析 JSON 響應
            })
            .then(data => {
                posts = Array.isArray(data.data) ? data.data : [];
                const start = (currentPage - 1) * postsPerPage;
                const end = start + postsPerPage;
                const currentPosts = posts.slice(start, end);
                console.log('Response data:', data);  // 查看完整響應
                console.log("目前顯示的資料：", currentPosts); // <--- 加這行
                currentPosts.forEach(post => {
                    let div = document.createElement("article");
                    div.className = "post-future post-future-horizontal";
                    div.innerHTML = `
                        <a class="post-future-figure" href="blog-post.html"><img src="${post.image}" alt="" width="370" height="325"></a>
                        <div class="post-future-main" style="border-left: 1px solid #e1e1e1;">
                            <h4 class="post-future-title"><a href="blog-post.html">${post.title}</a></h4>
                            <div class="post-future-meta">
                                <div class="post-future-time"><span class="icon mdi mdi-clock"></span>
                                <time datetime="2024">${post.date}</time>
                                </div>

                            </div>

                            <div class="post-future-text">
                                <div class="badge badge-shop"><span class="icon mdi mdi-fire"></span>${post.club_level_1}</div>
                                <div class="badge badge-shop"><span class="icon mdi mdi-fire"></span>${post.club_level_2}</div>
                                <div class="badge badge-shop"><span class="icon mdi mdi-fire"></span>${post.club_level_3}</div>
                            </div>
                            <hr>
                    
                            <div class="post-future-text">
                                <div class="unit-body">
                                <p>
                                    ${post.excerpt}
                                </p>
                                </div>
                                
                                <button class="button button-lg button-primary button-block" type="submit" onclick="read_club(${post.id})">
                                查看球隊
                                </button>
                                <button class="button button-lg button-primary button-block" type="submit" onclick="register_club(${post.id})">
                                申請加入
                                </button>
                            </div>

                        </div>
                        </div>
                    
                    `;
                    //<span><strong>${post.category}</strong> | ${post.date}</span>
                    // <h3>${post.title}</h3>
                    // <p>${post.excerpt}</p>

                    list.appendChild(div);  // 用 appendChild 加元素節點

                    console.log("目前顯示的資料：", list); // <--- 加這行

                });

            })
            .catch((error) => {
                console.error('Error:', error);
            });

    }

    // 渲染分頁按鈕
    function renderPagination() {
        const totalPages = Math.ceil(posts.length / postsPerPage);
        const pag = document.getElementById("pagination");
        pag.innerHTML = "";

        for (let i = 1; i <= totalPages; i++) {
            const li = document.createElement("li");
            li.className = i === currentPage ? "active" : "";

            const btn = document.createElement("button");
            btn.textContent = i;
            btn.addEventListener("click", () => {
            currentPage = i;
            renderPosts();
            renderPagination();
            });

            li.appendChild(btn);
            pag.appendChild(li);
        }
    }


    // 初始化
    document.addEventListener("DOMContentLoaded", function () {
        renderPosts();
        renderPagination();
    });
</script>

<script>
    function read_club(id){
        window.location.href = `./read_club?list_id=${id}`
    }
    function register_club(id){
        window.location.href = `./register_club?list_id=${id}`
    }
</script>
@endsection