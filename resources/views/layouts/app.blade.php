<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', '我的網站')</title>

    <!-- Google Fonts -->
    <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Kanit:300,400,500,500i,600,900%7CRoboto:400,900">
    
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/bootstrap.css') }}">
    <link rel="stylesheet" href="{{ asset('css/fonts.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    
    <style>
        .ie-panel{display: none;background: #212121;padding: 10px 0;box-shadow: 3px 3px 5px 0 rgba(0,0,0,.3);clear: both;text-align:center;position: relative;z-index: 1;} 
        html.ie-10 .ie-panel, html.lt-ie-10 .ie-panel {display: block;}
    </style>
</head>
<body>
    
    <!-- Navbar Header -->
    @include('partials.header') <!-- 我們可以把你這段 Header 拆成 partial -->

    <main>
        @yield('content')
    </main>

    <!-- JS -->
    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/bootstrap.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>
</html>
