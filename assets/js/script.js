let body = document.querySelector('body');
let header = document.querySelector('header');
let humberger_menu = document.querySelector('.humberger-menu');
let humberger_menu_bars = document.querySelectorAll('.humberger-menu > .bar');
let menu = document.querySelector('.menu');
let menu_footer = document.querySelector('.menu_footer');
let blog_hero = document.querySelector('.blog-hero');
let is_open = false;

if (document.querySelector('.glider')) {
    new Glider(document.querySelector('.glider'), {
        slidesToShow: "auto",
        draggable: true,
        dots: '.dots',
    });
}

// Toggle Humberger menu
function toggle_menu(is_open) {
    if (!is_open) {
        header.style.height = "unset";
        body.style.height = "unset";
        body.style.overflowY = "unset";
        menu.classList.remove('menu-open');
        menu_footer.style.display = "none";
        humberger_menu_bars.forEach((element) => {
            menu.classList.remove('menu-open');
            element.style.display = "block";
            element.style.transform = "unset";
            element.style.top = "unset";
        });
    } else {
        header.style.height = "100vh";
        menu_footer.style.display = "initial";
        body.style.height = "100vh";
        body.style.overflowY = "hidden";
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

// Swipe up blog hero section
if (document.querySelectorAll('main.blog').length > 0) {
    try {
        let swipe = new Swipe('.handler-line');
        swipe.onUp(() => {
            console.log("Moved Up")
            blog_hero.style.marginTop = "-385px";
            window.setTimeout(() => {
                window.scrollTo({
                    top: 0,
                    left: 0,
                    behavior: 'smooth'
                });
            }, 500)
        });
        swipe.onDown(() => {
            console.log("Moved Down")
            blog_hero.style.marginTop = "-68px";
        });
        swipe.run();
    } catch (err) {
        console.error(err);
    }
}
// Light mode in blog page
is_blog_page = document.querySelectorAll('main.blog').length;
is_tag_page = document.querySelectorAll('main.tag').length;
is_category_page = document.querySelectorAll('main.category').length;
is_search_results_page = document.querySelectorAll('main.search-results').length;
is_singular = document.querySelectorAll('main.post').length;
if (is_blog_page > 0 || is_tag_page > 0 || is_category_page > 0 || is_search_results_page > 0 || is_singular > 0) {
    body.classList.remove('bg-dark');
    body.classList.add('bg-light');
}

// Order by form submision
if (is_blog_page > 0 || is_tag_page > 0 || is_category_page > 0 || is_search_results_page > 0) {
    let orderby = document.querySelector('#orderby');
    orderby.addEventListener('change', (e) => {
        if (orderby.value == "views") {
            sortBy("views");
        } else {
            orderby.parentElement.submit();
        }
    })
}

function sortBy(query) {
    if (query = "views") {
        let views = [];
        document.querySelectorAll('.blog-posts .card .views span').forEach((elem) => {
            views.push(elem.innerHTML)
        });
        let posts = document.querySelectorAll('.blog-posts .card');

        // sort posts
        for (let i = 0; i < views.length; i++) {
            if (Number(views[i]) < Number(views[i + 1])) {
                posts[i].parentElement.appendChild(posts[i]);
                views.push(views.splice(i, 1)[0]);
                sortBy(query);
            }
        }
    }
}

// Load more comments
let comments_count = document.querySelectorAll("ul>li.comment:not(.reply)").length;
let more_comments_btn = document.querySelector('.more-comment-btn');
let max_comments = 4;
if (comments_count > max_comments) {
    more_comments_btn.setAttribute("disabled", "false");
} else {
    more_comments_btn.setAttribute("disabled", "true");
}
// Limit displaying comments
document.querySelectorAll(`ul>.comment:nth-child(-n+${max_comments})`).forEach(comments => {
    comments.style.display = "initial";
});

more_comments_btn.addEventListener('click', () => {
    max_comments += 4;
    load_more_comments();
});

function load_more_comments() {
    document.querySelectorAll(`ul>.comment:nth-child(-n+${max_comments})`).forEach(comments => {
        comments.style.display = "initial";
    });
    if (comments_count > max_comments) {
        more_comments_btn.setAttribute("disabled", "false");
    } else {
        more_comments_btn.setAttribute("disabled", "true");
    }
}