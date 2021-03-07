<?php
$query->the_post();
$post_id = get_the_ID();
?>
<div class='card'>
    <div class="card-header">
        <div class='overlay'></div>
        <?php if (has_post_thumbnail($post_id)) {
            $thumbnail = get_the_post_thumbnail_url($post_id);
        } else {
            $thumbnail = get_template_directory_uri() . "/assets/images/no-thumbnail.png";
        }
        ?>
        <a href="<?php echo get_the_permalink(); ?>"><img src='<?= $thumbnail ?>' class='thumbnail' alt="<?php the_title(); ?>" title="<?php the_title(); ?>"></a>
        <a href="<?php echo get_the_permalink(); ?>">
            <h4 class='card-title'><?php the_title(); ?></h4>
        </a>
    </div>
    <div class='card-body'>
        <?php
        $post_categories = wp_get_post_categories($post_id);
        $category_counter = 1;
        foreach ($post_categories as $category) {
            if ($category_counter++ > 1) {
                break;
            }
            $this_category = get_category($category);
            echo "<a href='" . get_site_url() . "/category/" . $this_category->slug . "'><span class='badge'>" . $this_category->name . "</span></a>";
        }
        ?>
        <p class='card-description'>
            <?php echo get_the_excerpt(); ?>
        </p>
        <div class='views'>
            <?php
            echo "<span>" . wp_statistics_pages("total", "", $post_id) . "</span>";
            ?>
            بار دیده شده
        </div>
    </div>
</div>