new Glider(document.querySelector('.glider'), {
    slidesToShow: "auto",
    draggable: true,
    dots: '.dots',
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