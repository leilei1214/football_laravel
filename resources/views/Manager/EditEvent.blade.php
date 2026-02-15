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
    .checkbox-custom:checked + .checkbox-custom-dummy:after {
        opacity: 1;
    }
    .form-select {
        display: block;
        width: 100%;
        height: calc(1.5em + 0.75rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        font-weight: 600;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 3px solid #707279;
        border-radius: 0.25rem;
    }
</style>
@endsection


@section('content')
<section class="section section-md bg-gray-100">
<div class="col-12 col-md-8 " style="margin:0 auto">
    <div class="card index_page_edit">

        <div class="card-body" style="background-color: #fff;border-radius: 0px 0px 16px 16px;">
        <!-- <h4 class="card-title">Horizontal Two column</h4> -->
        <div class="form-group row">
            <label for="exampleInputConfirmPassword2" class="col-sm-2 ">程度 : </label>
            <div class="col-sm-10  col-form-label">
            <ul class="list-md form-wrap">
                <li>
                <label class="checkbox-inline checkbox-inline-lg">
                    <input name="input-checkbox-1" value="基礎" type="checkbox" class="checkbox-custom"/>基礎
                    <span class="checkbox-custom-dummy"></span>
                </label>
                </li>
                <li>
                <label class="checkbox-inline checkbox-inline-lg">
                    <input name="input-checkbox-2" value="樂踢" type="checkbox" class="checkbox-custom"/>樂踢
                    <span class="checkbox-custom-dummy"></span>
                </label>
                </li>
                <li>
                <label class="checkbox-inline checkbox-inline-lg">
                    <input name="input-checkbox-3" value="實踐" type="checkbox"class="checkbox-custom" />實踐
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
                <select class="form-select form-select-sm address" id="activity_level" name="activity_level" aria-label="Default select example" style="height: 38px;padding: 0;">
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
        <button class=" button button-primary"  aria-label="Send" onclick="addEvent()">
        <span style="font-weight: 600;"> 更新</span>
        </button>
    </div>
</div>
</section>
@endsection
@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js" defer></script>
<!-- <script src="{{ asset('js/add_event.js') }}"></script> -->

<!-- <script src="{{ asset('js/event_level.js') }}"></script> -->

<script>
    async function loadEventContent() {
    const params = new URLSearchParams(window.location.search);
    const listId = params.get('list_id');
    const guildId = params.get('guild_id');

    if (!listId || !guildId) {
        alert("連結錯誤");
        setTimeout(() => {
            window.location.href = "/";
        }, 1000);
        return;
    }

    try {
        const response = await fetch('/api/event/content', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content')
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
        if (response.ok) {
            const res = await response.json();

            const data = res.event
            console.log(data)
            // 遍歷陣列並輸出每個元素
            // for (const item of data.activity_category) {
            //   document.getElementById('activity_level').innerHTML += `
            //     <div class="badge badge-secondary">${item}
            //     </div>
            //   `
            // }
            if (data.activity_level) {
                let rawData = data.activity_level
                let currentLevels = rawData.replace(/[{}]/g, "").split(",");
                console.log(rawData)
                // 取得所有 checkbox
                $('.checkbox-custom').each(function() {
                    // 檢查目前這個 checkbox 的 value 是否在陣列中
                    if (currentLevels.indexOf($(this).val()) !== -1) {
                        $(this).prop('checked', true); // 這裡會觸發 CSS 的 :checked 狀態
                    }
                });
            }
            // ====== 2️⃣ 填入時間 (datetime-local) ======
            if (data.time) {
                const date = new Date(data.time);
                date.setHours(date.getHours() - 7);

                const yyyy = date.getFullYear();
                const mm = String(date.getMonth() + 1).padStart(2, '0');
                const dd = String(date.getDate()).padStart(2, '0');
                const hh = String(date.getHours()).padStart(2, '0');
                const min = String(date.getMinutes()).padStart(2, '0');

                document.getElementById("date").value =
                    `${yyyy}-${mm}-${dd}T${hh}:${min}`;
            }

            // ====== 3️⃣ 填入其他欄位 ======
            document.getElementById("max_participants").value = data.max_participants ?? '';
            document.getElementById("activity_notice").value = data.activity_notice ?? '';
            document.getElementById("activity_intro").value = data.activity_intro ?? '';
            document.getElementById("phone").value = data.phone ?? '';
            document.getElementById("amount").value = data.amount ?? '';

            // ====== 4️⃣ 如果 location 對應 select ======
            if (data.location) {
                const select = document.getElementById("activity_level");
                for (let option of select.options) {
                    if (option.text === data.location) {
                        option.selected = true;
                    }
                }
            }


            
            // activity_level
            // eventContentDiv.innerHTML = `
            //     <p><strong>活動名稱：</strong> ${data.activity_name || '無資料'}</p>
            //     <p><strong>地點：</strong> ${data.location || '無資料'}</p>
            //     <p><strong>簡介：</strong> ${data.activity_intro || '無資料'}</p>
            //     <p><strong>時間：</strong> ${data.time || '無資料'}</p>
            //     <p><strong>參加人數：</strong> ${data.current_participants || 0} / ${data.max_participants || '無限制'}</p>
            // `;
        } 


    } catch (err) {
        console.error(err);
        alert('系統錯誤');
    }
}

// 頁面載入後執行
document.addEventListener('DOMContentLoaded', loadEventContent);
</script>

@endsection