document.addEventListener('DOMContentLoaded', function() {
    window.page = window.location.pathname.split("/")[1].replace(".html","");
    document.querySelector(`.container#${window.page}`).classList.toggle("active");
});