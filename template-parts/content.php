<?php
$query->the_post();
$post_id = get_the_ID();
if (has_post_thumbnail($post_id)) {
    $thumbnail = get_the_post_thumbnail_url($post_id);
} else {
    $thumbnail = get_template_directory_uri() . "/images/no-thumbnail.png";
}
?>
<li class="card splide__slide">
    <div class="card_header">
        <a href="<?php echo get_the_permalink(); ?>">
            <img src='<?= $thumbnail ?>' alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
        </a>
    </div>
    <div class="card_body">
        <section>
            <?php
            $post_categories = wp_get_post_categories($post_id);
            $category_counter = 1;
            foreach ($post_categories as $category) {
                if ($category_counter++ > 1) {
                    break;
                }
                $this_category = get_category($category);
                $category_link = get_category_link($this_category);
                echo "<a href='" . $category_link . "'><span class='badge'>" . $this_category->name . "</span></a>";
            }
            ?>
        </section>
        <a href="<?php echo get_the_permalink(); ?>">
            <h3 class="card_title"><?php the_title(); ?></h3>
        </a>
    </div>
    <div class="card_footer">
        <div class="veiw">
            <span><?php echo wp_statistics_pages("total", "", $post_id); ?></span>
            <span>بار دیده شده</span>
        </div>
    </div>
</li>