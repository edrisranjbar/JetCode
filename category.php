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
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Folder.svg" class="blog-left-folder">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Folder.svg" class="blog-right-folder">
<main class="category">
    <h1 class="title">
        نتایج دسته بندی
        <a href=""><span class="text-orange"><?php single_cat_title(); ?></span></a>
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
        <div class="wrapper" id="ajax-posts">
            <?php
            $query = new WP_Query(
                [
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'category__and'      =>  $wp_query->get_queried_object_id(),
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
