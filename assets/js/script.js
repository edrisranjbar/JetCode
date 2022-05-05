//     document.querySelector(`.container#${window.page}`).classList.toggle("active");
is_blog_page = document.querySelectorAll('.blog_container').length >= 1;
is_tag_page = document.querySelectorAll('.tag_container').length >= 1;
is_category_page = document.querySelectorAll('.category_container').length >= 1;
is_search_results_page = document.querySelectorAll('.search_container').length >= 1;
is_singular = document.querySelectorAll('.post_container').length >= 1;
if (is_blog_page || is_tag_page || is_category_page || is_search_results_page || is_singular) {
    document.body.classList.add('bg_light');
}

// Order by form submision
if (is_blog_page|| is_tag_page|| is_category_page|| is_search_results_page) {
    let orderby = document.querySelector('#orderby');
    orderby.addEventListener('change', (e) => {
        load_posts(true, orderby.value);
    })
}

// Load more comments
let comments_count = document.querySelectorAll("ul>li.comment:not(.reply)").length;
let more_comments_btn = document.querySelector('.more_comment_btn');
let max_comments = 4;
if (comments_count > max_comments) {
    more_comments_btn.removeAttribute("disabled");
} else {
    if (more_comments_btn !== null) {
        more_comments_btn.setAttribute("disabled", "true");
    }
}

// Limit displaying comments
document.querySelectorAll(`ul>.comment:nth-child(-n+${max_comments})`).forEach(comments => {
    comments.style.display = "initial";
});

if (more_comments_btn !== null) {
    console.log(max_comments);
    more_comments_btn.addEventListener('click', (e) => {
        console.log(max_comments);
        max_comments += 4;
        load_more_comments();
    });
}

function load_more_comments() {
    document.querySelectorAll(`ul>.comment:nth-child(-n+${max_comments})`).forEach(comments => {
        comments.style.display = "initial";
    });
    if (comments_count > max_comments) {
        more_comments_btn.removeAttribute("disabled");
    } else {
        more_comments_btn.setAttribute("disabled", "true");
    }
}

function load_posts(reload = true, orderby = "modified") {
        location.href += (location.href.split('?')[1] ? '&':'?') + "orderby=" + orderby;
}