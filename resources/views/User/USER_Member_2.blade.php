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
  margin-right: 39px;
  float: left;
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
.status.checkout {
  background-color: black;
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
                <div class="d-flex justify-content-center mb-4 border-b border-gray-300 dark:border-gray-700">
                <button class="py-2 px-4 text-sm font-medium " onclick="window.location.href='./USER_Member_3'" data-subtab="north">基礎</button>
                <button class="py-2 px-4 text-sm font-medium " onclick="window.location.href='./USER_Member_4'" data-subtab="central">樂踢</button>
                <button class="py-2 px-4 text-sm font-medium active" data-subtab="south">實戰</button>
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

<!-- <script src="{{ asset('js/event_level.js') }}"></script> -->


<script>
    const params = new URLSearchParams(window.location.search);
    const guildId = params.get('guild_id');

</script>
@endsection