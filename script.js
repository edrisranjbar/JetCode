document.addEventListener('DOMContentLoaded', function () {
    let elms = document.getElementsByClassName('splide');
    for (let i = 0; i < elms.length; i++) {
        new Splide(elms[i], {
            arrows: false,
            pagination: false,
            rewind: true,
            direction: 'rtl',
            drag: 'free',
        }).mount();
    }

});