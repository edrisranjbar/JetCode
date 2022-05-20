<?php
/*
    Template Name: وبلاگ
*/
$orderby_allowed_list = ['modified', 'date'];
$orderby = "modified";
if (isset($_GET['orderby']) && in_array($_GET['orderby'], $orderby_allowed_list)) {
    $orderby = $_GET['orderby'];
}
get_header();
$category_ids = get_all_category_ids();
$categories = get_categories(["orderby" => "count", "order" => "DESC", "number" => 3, "parent" => 0]);
?>
<script>
    document.body.classList.add("bg_light");
</script>
<div class="blog_container">
    <section class="custom_btns">
        <?php
        foreach ($categories as $category) {
            echo '<a href="' . get_category_link($category) . '">';
            $image_id = get_term_meta($category->cat_ID, 'category-image-id', true);
            if ($image_id != 0 && wp_get_attachment_image_src($image_id)[0] != null) {
                echo "<img src='" . wp_get_attachment_image_src($image_id)[0] . "' class='category_thumbnail'>";
            } else {
                echo "<img src='" . get_template_directory_uri() . "/images/no-thumbnail.png' class='category_thumbnail'>";
            }
            echo '<span>' . $category->name . '</span>';
            echo '</a>';
        }
        ?>
    </section>
    <div class="order_by_box">
        <form action="<?php echo  $current_url; ?>" method="GET">
            <label for="order" class="order">مرتب بر اساس:</label>
            <select name="orderby" class="order" id="orderby">
                <option <?php if ($orderby == "date") {
                            echo "selected";
                        } ?> value="date">تاریخ انتشار</option>
                <option <?php if ($orderby == "modified") {
                            echo "selected";
                        } ?> value="modified">تاریخ بروزرسانی</option>
            </select>
        </form>
    </div>

    <?php
    global $query;
    foreach ($category_ids as $category_id) {
        $category = get_category($category_id);
        if ($category->category_count > 0) {
            $args = [
                "cat"           => $category_id,
                "post_type"     => "post",
                "post_status"   => "publish",
                "orderby"       => $orderby
            ];
            $query = new WP_Query($args);
            if ($query->have_posts()) {
                echo '<div class="posts_by_category_row row">';
                echo '<h2 class="posts_category_title">' . $category->name . '</h2>';
                echo '<a class="btn_view_more_posts" href="' . get_category_link($category) . '">نمایش بیشتر</a>';
                echo '</div>';
                echo "<div class='posts_by_category'>";
                while ($query->have_posts()) {
                    set_query_var('query', $query);
                    get_template_part('template-parts/content', 'none');
                }
                echo "</div>";
            }
        } else {
            continue;
        }
    }
    ?>
</div>
<?php get_footer(); ?>
