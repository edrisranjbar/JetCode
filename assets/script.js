new Glider(document.querySelector('.glider'), {
    slidesToScroll: 1,
    slidesToShow: 4,
    draggable: true,
    dots: '.dots',
    arrows: {
        prev: '.glider-prev',
        next: '.glider-next'
    }
});