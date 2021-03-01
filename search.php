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
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" class="blog-left-search">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/search.svg" class="blog-right-search">
<main class="search-results">
    <h1 class="title">
        نتایج برچسب
        <a href=""><span class="text-orange">#<?php the_search_query(); ?></span></a>
    </h1>
    <div class="blog-posts">
        <?php
        global $query_string;
        wp_parse_str($query_string, $search_query);
        $query = new WP_Query($search_query);
        if ($query->have_posts()) {
        ?>
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
            <div class="wrapper">
                <?php
                while ($query->have_posts()) {
                    set_query_var('query', $query);
                    get_template_part('template_parts/content', 'none');
                }
                ?>
            </div>
            <div class="wrapper">
                <a href="#" class="btn btn-sm btn-primary">
                    نمایش بیشتر
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bi_arrow-down-circle-fill.png" alt="">
                </a>
            </div>
        <?php
        } else {
            echo "<h3 class='text-center'>نتیجه ای یافت نشد!</h3>";
        }
        ?>
    </div>
</main>
<?php
get_footer();
