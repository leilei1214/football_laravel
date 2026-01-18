@extends('layouts.app')

@section('title', 'Login Page')

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
                    <h5 class="heading-component-title">活動
                        
                    </h5>
                    <div class="d-flex justify-content-center mb-4 border-b border-gray-300 dark:border-gray-700">
                        <button class="py-2 px-4 text-sm font-medium active" onclick="show_level('基礎')" data-subtab="north">基礎</button>
                        <button class="py-2 px-4 text-sm font-medium " onclick="show_level('樂踢')" data-subtab="central">樂踢</button>
                        <button class="py-2 px-4 text-sm font-medium " onclick="show_level('實戰')" data-subtab="south">實戰</button>
                    </div>
                    <div class="owl-carousel-arrows-outline">
                        <div class="owl-nav">
                        <button class="owl-arrow owl-arrow-prev"></button>
                        <button class="owl-arrow owl-arrow-next"></button>
                        </div>
                    </div>
                    </div>
                </article>
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

<script>

</script>

@endsection