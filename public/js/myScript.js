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
