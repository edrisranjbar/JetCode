let humberger_menu = document.querySelector('.humberger-menu');
let humberger_menu_bars = document.querySelectorAll('.humberger-menu > .bar');
let menu = document.querySelector('.menu');
let is_open = false;
new Glider(document.querySelector('.glider'), {
    slidesToShow: "auto",
    draggable: true,
    dots: '.dots',
});

// Toggle Humberger menu
function toggle_menu(is_open) {
    if (!is_open) {
        menu.classList.remove('menu-open');
        humberger_menu_bars.forEach((element) => {
            element.style.display = "block";
            element.style.transform = "unset";
            element.style.top = "unset";
        });
    } else {
        menu.classList.add('menu-open');
        humberger_menu_bars[0].style.transform = "rotate(45deg)";
        humberger_menu_bars[0].style.top = "11px";
        humberger_menu_bars[1].style.display = "none";
        humberger_menu_bars[2].style.transform = "rotate(-45deg)";
    }
}
humberger_menu.addEventListener('click', function () {
    toggle_menu(is_open);
    is_open = !is_open;
});

// Categories shadow colors
let colors = ["yellow", "blue", "black", "red", "green"]
let categories = document.querySelectorAll(".blog-category");
let i = 0;
categories.forEach((element) => {
    if (i >= 5) {
        i = 0;
    }
    let color = colors[i++];
    element.classList.add(`${color}-bg`);
});