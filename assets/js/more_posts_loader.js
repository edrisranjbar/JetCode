let ppp = 4;
let pageNumber = 1;

function load_posts(reload = false, orderby = "modified") {
    let tag_title = document.querySelector("#tag_title").innerText ?? "";
    let str = `&pageNumber=${pageNumber}&ppp=${ppp}&orderby=${orderby}&tag_title=${tag_title}&page_type=${page_type}&action=more_post_ajax`;
    $.ajax({
        type: "POST",
        dataType: "html",
        url: ajax_posts.ajaxurl,
        data: str,
        success: function (data) {
            console.log(data);
            let $data = $(data);
            if ($data.length) {
                $("#ajax-posts").html($data);
                $("#more_posts").attr("disabled", false);
            } else {
                $("#more_posts").attr("disabled", true);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            console.error(jqXHR + " :: " + textStatus + " :: " + errorThrown);
        }

    });
    return false;
}
window.addEventListener('DOMContentLoaded', () => {
    document.querySelector("#more_posts").addEventListener("click", function () {
        this.setAttribute("disabled", true);
        pageNumber++;
        load_posts();
    });
});