<?php
$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_GET['orderby']) && in_array($_GET['orderby'], $orderby_allowed_list)) {
    $orderby = $_GET['orderby'];
}
global $wp;
$current_url = home_url(add_query_arg(array(), $wp->request));
get_header();
?>
<section class="header_bg"></section>
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Folder.svg" class="blog-left-folder">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Folder.svg" class="blog-right-folder">
<main class="category">
    <h1 class="title">
        نتایج دسته بندی
        <a href=""><span class="text-orange"><?php single_tag_title(); ?></span></a>
    </h1>
    <div class="order-by-box">
        <form action="<?php echo  $current_url; ?>" method="GET">
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
        <div class="wrapper">
            <?php
            $query = new WP_Query(
                [
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => -1,
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
            <a href="#" class="btn btn-sm btn-primary">
                نمایش بیشتر
                <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bi_arrow-down-circle-fill.png" alt="">
            </a>
        </div>
    </div>
</main>
<?php
get_footer();
