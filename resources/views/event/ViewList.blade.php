@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')
<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">
@endsection


@section('content')
<section class="section section-variant-1 bg-gray-100">
    <div class="container">
        <!-- 更改成管理中心 -->
        <!-- <a class="button-icon-alternate button-icon-alternate-google" style="height: 50px;" href="/add_event">
        <span class="icon mdi mdi-plus"></span>
        <div class="button-icon-alternate-title" style="font-size: 17px;">新建活動</div>
        </a> -->
        <div class="row row-50">
            <div class="col-md-12">
            <div class="main-component">

                <div class="owl-carousel-outer-navigation">
                <!-- Heading Component-->
                <article class="heading-component">
                    <div class="heading-component-inner">
                    <h5 class="heading-component-title">活動</h5>
                    <div class="owl-carousel-arrows-outline">
                        <div class="owl-nav">
                        <button class="owl-arrow owl-arrow-prev"></button>
                        <button class="owl-arrow owl-arrow-next"></button>
                        </div>
                    </div>
                    </div>
                </article>
                <div id="tabs-modern">
                    <ul class="nav nav-tabs" role="tablist">
                        <li class="nav-item" role="presentation" onclick="show_level('總攬')"><a class="nav-link active show " href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="true" role="tab">總覽</a></li>
                        <li class="nav-item" role="presentation" onclick="show_level('基礎')"><a class="nav-link " href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">基礎</a></li>
                        <li class="nav-item" role="presentation" onclick="show_level('樂踢')"><a class="nav-link" href="#tabs-modern-2" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">樂踢</a></li>
                        <li class="nav-item" role="presentation" onclick="show_level('實戰')"><a class="nav-link" href="#tabs-modern-3" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">實戰</a></li>
                    </ul>                    
                </div>

                <!-- Owl Carousel-->
                <div class="owl-carousel owl-spacing-1 owl-loaded" data-items="3" data-dots="false" data-nav="true" data-autoplay="true" data-autoplay-speed="4000" data-stage-padding="0" data-loop="false" data-margin="30" id="myCarousel"  data-mouse-drag="false" data-nav-custom=".owl-carousel-outer-navigation">
                    
                    
                <div class="owl-carousel owl-spacing-1" id="myCarousel"></div>

                </div>


            </div>

            </div>
            <!-- Aside Block-->

        </div>
    </div>
</section>


@endsection
@section('scripts')

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
@endsection