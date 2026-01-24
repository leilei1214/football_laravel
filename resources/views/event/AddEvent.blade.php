@extends('layouts.app')

@section('title', 'EventViewList')
@section('style')
<link rel="stylesheet" href="{{ asset('css/event/style.css') }}">
<style>
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
    .select2-container .select2-choice{
    display: block;
    width: 100%;
    height: calc(1.5em + 0.75rem + 2px);
    padding: 0.375rem 0.75rem;
    font-size: 1rem;
    font-weight: 400;
    line-height: 1.5;
    color: #495057;
    background-color: #fff;
    background-clip: padding-box;
    border: 3px solid #707279;
    border-radius: 0.25rem;
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
    .checkbox-inline .checkbox-custom-dummy::after {
        content: '\f222';
        font-family: "Material Design Icons";
        position: absolute;
        top: -1px;
        left: 1px;
        font-size: 18px;
        line-height: 18px;
        color: #35ad79;
    }
    .checkbox-inline input {

        position: absolute;
        left: 0;
        width: 14px;
        height: 14px;
        outline: none;
        cursor: pointer;
        top:0;
        opacity: 0;
    }
    .checkbox-inline .checkbox-custom-dummy {
        top: 1px;
        left: 0;
        width: 21px;
        height: 21px;
        margin: 0;
        border: 1px solid #e1e1e1;
    }
        
</style>
@endsection


@section('content')
<section class="section section-md bg-gray-100">
<div class="col-12">
    <div class="card index_page_edit">

        <div class="card-body" style="background-color: #fff;border-radius: 0px 0px 16px 16px;">
        <!-- <h4 class="card-title">Horizontal Two column</h4> -->
        <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2 ">程度 : </label>
            <div class="col-sm-10  col-form-label">
            <ul class="list-md form-wrap">
                <li>
                <label class="checkbox-inline checkbox-inline-lg">
                    <input name="input-checkbox-1" value="基礎" type="checkbox"/>基礎
                    <span class="checkbox-custom-dummy"></span>
                </label>
                </li>
                <li>
                <label class="checkbox-inline checkbox-inline-lg">
                    <input name="input-checkbox-2" value="樂踢" type="checkbox"/>樂踢
                    <span class="checkbox-custom-dummy"></span>
                </label>
                </li>
                <li>
                <label class="checkbox-inline checkbox-inline-lg">
                    <input name="input-checkbox-3" value="實踐" type="checkbox"/>實踐
                    <span class="checkbox-custom-dummy"></span>
                </label>
                </li>
            </ul>
            </div>
        </div>
        <form class="forms-sample">
            <div class="form-group row">
            <label for="exampleInputUsername2" class="col-sm-2 ">舉辦時間 : </label>
            <div class="col-sm-10  col-form-label">
            <input type="datetime-local" class="form-control" id="date" name="date" style="border: 3px solid #707279;">                              </div>
            </div>

            <div class="form-group row">
            <label for="exampleInputMobile" class="col-sm-2 ">參加人數 : </label>
            <div class="col-sm-10  col-form-label">
                <input type="number" class="form-control" id="max_participants" placeholder="0">
            </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputPassword2" class="col-sm-2 ">活動標題 : </label>
            <div class="col-sm-10  col-form-label">
                <input type="text" class="form-control" id="activity_notice" value="新手課程，會有教練上課">
            </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2">活動內容 : </label>
            <div class="col-sm-10">
                <textarea class="form-control " id="activity_intro" rows="5" >
                    我們熱烈歡迎各行各業的人參加，無論工作有多繁忙，每週都有一天專門為足球而設，我們迫不及待地期待每個人的加入，一同體驗這份樂趣。
                    鼓勵朋友們一同走出家門，放下手機，融入體育運動的懷抱中，共同享受運動所帶來的樂趣。
                </textarea>
            </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2">聯絡電話 : </label>
            <div class="col-sm-10  col-form-label">
                <input type="text" class="form-control" id="phone" value="0912345678">
            </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2">活動地點 : </label>
            <div class="col-sm-10  col-form-label">
                <select class="form-select form-select-sm address"  aria-label="Default select example" style="height: 38px;padding: 0;">
                <option value="1">西屯足球場</option>
                <option value="2">朝馬足球場</option>
                <option value="3">太原足球場</option>
                </select>
            </div>
            </div>
            <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2">費用 : </label>
            <div class="col-sm-10  col-form-label">
                <input type="number" class="form-control" id="amount" >
            </div>
            </div>
            <!-- <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2 col-form-label">訂單備註 : </label>
            <div class="col-sm-10">
            <textarea class="form-control" id="exampleTextarea1" rows="4" placeholder="訂單備註"></textarea>                              </div>
            </div> -->
            
        </form>
        </div>
    </div>
    <div class="form-button pt-5 d-flex justify-content-center form-button">
        <button class=" button button-primary" type="submit" aria-label="Send" onclick="addEvent()">
        <span style="font-weight: 600;"> 確認送出</span>
        </button>
    </div>
</div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- <script src="{{ asset('js/event_level.js') }}"></script> -->
<script>
    function show_level(level){
        var tabEl = document.querySelectorAll('#tabs-modern .nav-link');
        consol
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

@endsection