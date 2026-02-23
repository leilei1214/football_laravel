@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')
<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">
    <style>
      .player-feature-title{
        padding-top: 7px !important;
      }
      img{
        max-width: 75%;
      }
      .form-group .col-sm-2 {
        color: #35ad79;
        font-weight: 600;
      }
      .radio .radio-custom, .radio .radio-custom-dummy, .radio-inline .radio-custom, .radio-inline .radio-custom-dummy, .checkbox .checkbox-custom, .checkbox .checkbox-custom-dummy, .checkbox-inline .checkbox-custom, .checkbox-inline .checkbox-custom-dummy{
          border: 1px solid #707279;
          box-shadow: 0 0 1px 1px #707279;
      }
      .select2-chosen{
        font-family: "Kanit", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-weight: 600;
        
      }
      
      .form-control{
        border: 3px solid #707279;
        font-family: "Kanit", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
        font-weight: 600;
      }
      .stepper{
        max-width: 300px;
        width: auto;
      } 
      .select2-container{
        display: block;
      }
      .table-roster tbody td:nth-child(1) {
         
          font-weight: 900;
      }
      .select2-container .select2-choice{
        display: block;
        width: 87px;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 13px;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 3px solid #707279;
        border-radius: 0.25rem;
        
      }

      .list_class_table button{
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        line-height: 1.5;
        font-size: 13px;
      }
      .list_class_table tr td div{
        padding-left: 0 !important;
        padding-right: 0 !important;
      }
      .table-roster tbody td:nth-child(1) {
          width: 30%;
          padding-left: 13px !important;
      }
        .product-header {

            background: #d5deeb;
        }
        .object-container {
            width: 100%;
            max-width: 1212px; /* 限制最大寬度 */
            height: 200px; /* 固定高度 */
            overflow: hidden; /* 隱藏滾動條 */
            border: 2px solid #007BFF;
            border-radius: 8px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
            margin-bottom: 20px;
        }
        object {
            width: 100%; /* 設定為 100% 寬度 */
            height: 100%; /* 設定為 100% 高度 */
            border: none; /* 去掉邊框 */
            overflow: hidden !important; /* 強制隱藏滾動條 */
        }

        .object-container::webkit-scrollbar {
            display: none; /* 隱藏滾動條 */
        }
        .select2-drop{
          width: 87px !important;
        }
        

        .row + .row {
            width: 100%;
            margin: 12px auto;
        }
        @media (max-width: 991.98px){
            .table-roster tbody td:nth-child(1) {
                min-width: 90px;
                font-weight: 900;
            }
            .table-roster tbody td:nth-child(2) {
                min-width: 102px;
            }
        } 

    </style>
@endsection


@section('content')
<section class="section section-md bg-gray-100">
    <div class="container">
        <div class="row row-50">
        <div class="col-md-12">
            <div class="main-component">

            <div class="owl-carousel-outer-navigation">
                <!-- Heading Component-->
                <article class="heading-component">
                <div class="heading-component-inner">
                    <h5 class="heading-component-title">參加級別
                    </h5>
                    <!-- <div class="owl-carousel-arrows-outline">
                    <div class="owl-nav">
                        <button class="owl-arrow owl-arrow-prev"></button>
                        <button class="owl-arrow owl-arrow-next"></button>
                    </div>
                    </div> -->
                </div>
                </article>
                <div class="row">
                    <div id="tabs-modern" >
                        <ul class="nav nav-tabs" role="tablist">
                            <li class="nav-item" role="presentation" onclick="window.location.href='./USER_Member_3'"><a class="nav-link " href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="true" role="tab">基礎</a></li>
                            <li class="nav-item" role="presentation" onclick="window.location.href='./USER_Member_4'"><a class="nav-link active show" href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="true" role="tab">樂踢</a></li>
                            <li class="nav-item" role="presentation" onclick="window.location.href='./USER_Member_2'"><a class="nav-link " href="#tabs-modern-1" data-bs-toggle="tab" aria-selected="false" tabindex="-1" role="tab">實戰</a></li>
                        </ul>                    
                    </div>
                </div>
                <!-- Owl Carousel-->
                <div class="col-12" style="padding-left: 0;padding-right: 0;">
                <div class="row row-30 list_member" >


                </div>
                <!-- <table id="example" class="table table-striped" style="overflow-x: auto;display: block;width:100%;margin: 0 auto;">
                    <thead>
                    <tr>
                        <th style="min-width: 144px;text-align: center;">姓名</th>
                        <th style="text-align: center;">級別</th>
                        <th style="min-width: 70px;text-align: center;">位置1</th>
                        <th style="min-width: 70px;text-align: center;">位置2</th>
                        <th style="min-width: 200px;text-align: center;">申請日期</th>
                        <th style="min-width: 90px;text-align: center;">參加次數</th>
                        <th style="min-width: 90px;text-align: center;">未到次數</th>
                        <th style="text-align: center;text-align: center;">更新</th>
                    </tr>
                    </thead>
                    <tbody style="text-align: center;">
                    <tr>
                        <td>王小明</td>
                        <td>
                            <div class="col-sm-10">
                            <select class="form-select form-select-sm address"  aria-label="Default select example" style="height: 34px;padding: 0;">
                                <option value="1">新手</option>
                                <option value="2">復健</option>
                                <option value="3">自由</option>
                            </select>
                            </div>
                        </td>
                        <td>研發部</td>
                        <td>2020-06-15</td>
                        <td>
                            <button class=" button button-primary" type="submit" aria-label="Send" onclick="addEvent()">
                            <span style="font-weight: 600;"> 確認送出</span>
                            </button>
                        </td>
                    </tr>
                    <tr>
                        <td>林美華</td>
                        <td>產品設計師</td>
                        <td>設計部</td>
                        <td>32</td>
                        <td>2019-03-22</td>
                    </tr>
                    <tr>
                        <td>張大偉</td>
                        <td>後端工程師</td>
                        <td>研發部</td>
                        <td>35</td>
                        <td>2018-11-10</td>
                    </tr>
                    </tbody>
                </table> -->
                <!-- <div class="form-button pt-5 d-flex justify-content-center form-button">
                    <button class=" button button-primary" type="submit" aria-label="Send" onclick="addEvent()">
                    <span style="font-weight: 600;"> 確認送出</span>
                    </button>
                </div> -->
                </div>
                <div class="owl-carousel owl-spacing-1 owl-loaded" data-items="3" data-dots="false" data-nav="true" data-autoplay="true" data-autoplay-speed="4000" data-stage-padding="0" data-loop="false" data-margin="30" id="myCarousel"  data-mouse-drag="false" data-nav-custom=".owl-carousel-outer-navigation">
                
                
                <div id="select_event">

                </div>


            </div>

        </div>
        <!-- Aside Block-->

        </div>
    </div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="{{ asset('js/User_ListMember.js') }}"></script>

<!-- <script src="{{ asset('js/event_level.js') }}"></script> -->


<script>
    const params = new URLSearchParams(window.location.search);
    const guildId = params.get('guild_id');

</script>
@endsection