function getURLParameter(name) {
    const urlParams = new URLSearchParams(window.location.search);
    return urlParams.get(name);
}
function event_content_href(id){
	window.location.href = `./event_content?list_id=${id}`
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
            if (response.message === 'User session not found') {
                alert('請先登入');
                window.location.href = data.redirect;
                return;
            } 
            alert('讀取失敗');
            return;
        }
        if (response.ok) {
            const res = await response.json();

            const data = res.event
            console.log(data)

        } 


    } catch (err) {
        console.error(err);
        alert('系統錯誤');
    }
}); 