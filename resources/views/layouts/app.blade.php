<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>@yield('title', 'Home')</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="/images/favicon.ico" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600,900%7CRoboto:400,900">

        <!-- CSS -->
    <link rel="stylesheet" href="/css/bootstrap.css">
    <link rel="stylesheet" href="/css/style.css">
    <link rel="stylesheet" href="/css/fonts.css">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"/>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css"/>
    <style>
        .ie-panel { display: none; background: #212121; padding: 10px 0; box-shadow: 3px 3px 5px rgba(0,0,0,.3); clear: both; text-align:center; position: relative; z-index: 1; }
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel { display: block; }

        .object-container {
            width: 100%;
            max-width: 1212px;
            height: 200px;
            overflow: hidden;
            border: 2px solid #007BFF;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
            background-color: #ffffff;
            margin-bottom: 20px;
        }

        object {
            width: 100%;
            height: 100%;
            border: none;
            overflow: hidden !important;
        }

        .object-container::-webkit-scrollbar {
            display: none;
        }
    </style>
    @yield('style')
    @stack('styles')
</head>
<body>
    
    
    <!-- Navbar Header -->
    @include('partials.header') <!-- 我們可以把你這段 Header 拆成 partial -->
    @if (!request()->is('Manager/*'))
        @include('partials.Swiper') <!-- 我們可以把你這段 Header 拆成 partial -->
    @endif
    <main>
        @yield('content')

    </main>
    
    @yield('scripts') <!-- <<--- 一定要有 -->
    <!-- <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/smoothscroll.min.js') }}"></script>
    <script src="{{ asset('js/jquery.ui.totop.min.js') }}"></script>  -->
    <script src="https://cms.devoffice.com/coding-dev/rd-navbar/demo/js/core.min.js"></script>
    <script src="https://cms.devoffice.com/coding-dev/rd-navbar/demo/js/script.js"></script>
    <script src="https://cms.devoffice.com/coding-dev/rd-navbar/demo/js/smoothscroll.min.js"></script>
    <script src="https://cms.devoffice.com/coding-dev/rd-navbar/demo/js/jquery.ui.totop.min.js"></script>
    <!-- <script src="https://cms.devoffice.com/coding-dev/rd-navbar/demo/js/jquery.rd-parallax.min.js"></script>
    <script src="https://cms.devoffice.com/coding-dev/rd-navbar/dist/js/jquery.rd-navbar.js"></script> -->
    <script src="{{ asset('js/jquery.rd-parallax.min.js') }}"></script>
    <script src="{{ asset('js/rd-navbar.min.js') }}"></script>
    <script src="/js/myScript.js"></script>
    <!-- JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

    <!-- <script src="{{ asset('js/jquery.min.js') }}"></script>
    <script src="{{ asset('js/core.min.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>

    <script src="{{ asset('js/rd-navbar.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/regula.js"></script>

    <script src="{{ asset('js/bootstrap.js') }}"></script> -->


    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="{{ asset('js/my-component.js') }}" defer></script> -->
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>
    <script>
        const swiper = new Swiper(".swiper-container", {
            loop: true,                  // 循環滑動
            effect: "fade",              // 淡入淡出
            simulateTouch: true,         // 允許拖動，如果不想拖動可以改 false
            autoplay: {
            delay: 4000,               // 4 秒自動播放
            disableOnInteraction: false,
            },
            navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
            },
            pagination: {
            el: ".swiper-pagination",
            clickable: true,
            },
        });

        // 如果有文字動畫
        swiper.on('slideChange', function () {
            document.querySelectorAll('.swiper-slide-caption').forEach(caption => {
            caption.classList.remove('animated');
            void caption.offsetWidth;
            caption.classList.add('animated');
            });
        });


    </script>
    <script>
            // 修正你的 fetch 語法錯誤 (少了一個括號)
        fetch('/check-identity')
        .then(res => res.json())
        .then(data => {
            console.log('Level:', data.level, 'Guild:', data.Guild,'guild_Id:', data.guild_Id);
            if(data.level != 1){
                $(".Boss").addClass("d-none");
            }
        })
        .catch(err => console.error('Fetch error:', err));
    </script>
    <script>
        $(document).ready(function(){

            const $carousel = $('.owl-carousel-inline');

            $carousel.owlCarousel({
                items: 1,
                loop: true,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 3200,
                autoplayHoverPause: true,
                mouseDrag: false,
                touchDrag: false,
                navText: [
                '<button class="owl-arrow owl-arrow-prev"></button>',
                '<button class="owl-arrow owl-arrow-next"></button>'
                ]
            });

            // 如果想用自定義外部箭頭控制
            const $nav = $('.owl-carousel-navbar .owl-arrow');
            $nav.eq(0).click(function(){ $carousel.trigger('prev.owl.carousel'); });
            $nav.eq(1).click(function(){ $carousel.trigger('next.owl.carousel'); });

        });
    </script>
    
</body>
</html>
