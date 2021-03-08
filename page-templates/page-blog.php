<?php
/*
    Template Name: وبلاگ
*/
$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_POST['orderby']) && in_array($_POST['orderby'], $orderby_allowed_list)) {
    $orderby = $_POST['orderby'];
}
get_header();
?>
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Left Square.svg" class="blog-left-square">
<img src="<?php echo get_template_directory_uri(); ?>/assets/images/Right Square.svg" class="blog-right-square">
<main class="blog bg-light">
    <div class="blog-hero">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Blog_Hero_Image.svg" class="blog-hero-image">
        <p class="description">
            اینجا جاییست که من از تکنولوژی تا روزمرگی هام رو مینویسم.
            <br>
            دفترچه ای از یادداشت های گوناگون!
        </p>
        <div class="blog-search-box">
            <form role="search" method="GET" action="<?php echo home_url('/'); ?>">
                <button class="blog-search-btn" type="submit">
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Search_Icon.png" alt="search">
                </button>
                <input id="s" name="s" class="blog-search" placeholder="جست و جو کنید..." value="<?php echo get_search_query() ?>">
            </form>
        </div>
        <div class="handler-line"></div>
    </div>
    <div class="glider-contain">
        <section class="blog-categories glider">
            <?php
            $categories = get_categories(
                [
                    'orderby' => 'name',
                    'order'   => 'ASC'
                ]
            );
            foreach ($categories as $category) {
                echo "<a href='" . esc_url(get_category_link($category->term_id)) . "'>";
                echo "<span class='blog-category slide'>";
                $image_id = get_term_meta($category->cat_ID, 'category-image-id', true);
                if ($image_id != 0) {
                    echo "<img src='" . wp_get_attachment_image_src($image_id)[0] . "'>";
                }
                echo "$category->name</span>";
                echo "</a>";
            }
            ?>
        </section>
    </div>
    <div class="order-by-box">
        <?php
        global $wp;
        $current_url = home_url(add_query_arg(array(), $wp->request));
        ?>
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
                    'post_type'         => 'post',
                    'post_status'       => 'publish',
                    'posts_per_page'    => 4,
                    'orderby'           => $orderby,
                ]
            );
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    set_query_var('query', $query);
                    get_template_part('template_parts/content', 'none');
                }
                wp_reset_postdata();
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
