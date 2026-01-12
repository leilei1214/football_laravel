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
        btn.querySelector('.card-toggle')?.classList.toggle('active');
        target?.classList.toggle('active');
    });
});