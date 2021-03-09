<?php
$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_POST['orderby']) && in_array($_POST['orderby'], $orderby_allowed_list)) {
    $orderby = $_POST['orderby'];
}
global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));
get_header();
?>
<section class="header_bg"></section>
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Hashtag.svg" class="blog-left-hashtag">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Hashtag.svg" class="blog-right-hashtag">
<main class="tag">
    <h1 class="title">
        نتایج برچسب
        <a href=""><span class="text-orange">#<span id="tag_title"><?php single_tag_title(); ?></span></span></a>
    </h1>
    <div class="order-by-box">
        <form action="<?php echo  $current_url; ?>" method="POST">
            <label for="order" class="order">مرتب بر اساس:</label>
            <select name="orderby" class="order" id="orderby">
                <option <?php if ($orderby == "date") {
                            echo "selected";
                        } ?> value="date">تاریخ انتشار</option>
                <option <?php if ($orderby == "modified") {
                            echo "selected";
                        } ?> value="modified">تاریخ بروزرسانی</option>
                <option value="views">بازدید</option>
            </select>
        </form>
    </div>
    <div class="blog-posts">
        <div class="wrapper" id="ajax-posts">
            <?php
            $query = new WP_Query(
                [
                    'tag'       => single_tag_title('', false),
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'orderby' => $orderby,
                ]
            );
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    set_query_var('query', $query);
                    get_template_part('template_parts/content', 'none');
                }
            }
            ?>
        </div>
        <div class="wrapper">
            <button id="more_posts" class="btn btn-sm btn-primary">
                نمایش بیشتر
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bi_arrow-down-circle-fill.png" alt="">
            </button>
        </div>
    </div>
</main>
<?php
get_footer();
