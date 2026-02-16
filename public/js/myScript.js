function getURLParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}

document.querySelectorAll('[data-custom-toggle]').forEach(btn => {
    btn.addEventListener('click', () => {
        const target = document.querySelector(btn.dataset.customToggle);
        target.classList.toggle('active');
        btn?.classList.toggle('active');
    });
});
function ClockOut() {
    const currentUrl = window.location.href;

    // 使用 URLSearchParams 提取查詢參數
    const urlParams = new URLSearchParams(window.location.search);

    // 獲取 `list_id` 的值
    const activityId = urlParams.get('list_id');
    const guild_id = urlParams.get('guild_id');

    window.location.href ="./SignIn?list_id="+activityId+"&guild_id="+guild_id

}
function QrcodeSign(){
    const currentUrl = window.location.href;

    // 使用 URLSearchParams 提取查詢參數
    const urlParams = new URLSearchParams(window.location.search);

    // 獲取 `list_id` 的值
    const activityId = urlParams.get('list_id');
    const guild_id = urlParams.get('guild_id');

    window.location.href ="./SignIn_Qrcode?list_id="+activityId+"&guild_id="+guild_id

}
$(".btn_EventContent").on("click",  async function () {
    const urlParams = new URLSearchParams(window.location.search);

    // 獲取 `list_id` 的值Manager/EventContent?list_id=4&guild_id=4#
    const activityId = urlParams.get('list_id');
    const guild_id = urlParams.get('guild_id');
    window.location.href ='/Manager/EventContent?list_id='+activityId+'&guild_id='+guild_id


})
$(".btn_edit").on("click",  async function () {
    const urlParams = new URLSearchParams(window.location.search);

    // 獲取 `list_id` 的值Manager/EventContent?list_id=4&guild_id=4#
    const activityId = urlParams.get('list_id');
    const guild_id = urlParams.get('guild_id');
    window.location.href ='/Manager/EditEvent?list_id='+activityId+'&guild_id='+guild_id

})
$(".btn_delete").on("click",  async function () {
    console.log("delete clicked");

    const currentUrl = window.location.href;
    // 使用 URLSearchParams 提取查詢參數
    const urlParams = new URLSearchParams(window.location.search);

    // 獲取 `list_id` 的值
    const activityId = urlParams.get('list_id');
    const guild_id = urlParams.get('guild_id');
    try {
        const response = await fetch('/Mapi/EventDelete', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document
                    .querySelector('meta[name="csrf-token"]')
                    ?.getAttribute('content')
            },
            body: JSON.stringify({
                list_id: activityId,
                guild_id: guild_id
            })
        });

        if (!response.ok) {
            const res = await response.json();
            if (res.message === 'User session not found') {
                alert('請先登入');
                window.location.href = res.redirect;
                return;
            } 
            alert('讀取失敗');
            return;
        }
        if (response.ok) {
            const res = await response.json();

            if(res.status == 200){
                window.location.href ='/Manager/EventList'
            }
        } 


    } catch (err) {
        console.error(err);
        alert('系統錯誤');
    }
}); 