<!DOCTYPE html>
<html class="wide wow-animation" lang="en">
<head>
    <title>@yield('title', 'Home')</title>
    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, user-scalable=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta charset="utf-8">
    <link rel="icon" href="{{ asset('images/favicon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link rel="stylesheet" type="text/css" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600,900%7CRoboto:400,900">

        <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">

    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.css" />
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

    @stack('styles')
</head>
<body>
    1111
    
    <!-- Navbar Header -->
    @include('partials.header') <!-- 我們可以把你這段 Header 拆成 partial -->
    @include('partials.Swiper') <!-- 我們可以把你這段 Header 拆成 partial -->

    <main>
        @yield('content')
    </main>

    <!-- JS -->
    <!-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script> -->


    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/rd-navbar.min.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script src="{{ asset('js/core.min.js') }}"></script>

    <script src="https://cdn.jsdelivr.net/npm/regula.js"></script>

    <!-- <script src="{{ asset('js/bootstrap.js') }}"></script> -->


    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
    <script src="{{ asset('js/my-component.js') }}" defer></script>
    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@8/swiper-bundle.min.js"></script>
    <script>
    $(document).ready(function() {
        if (plugins.rdNavbar.length) {
        plugins.rdNavbar.RDNavbar(); // 初始化 RDNavbar
        }
    });
    </script>
</body>
</html>
