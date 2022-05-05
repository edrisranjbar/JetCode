<?php
$query->the_post();
$post_id = get_the_ID();

if (has_post_thumbnail($post_id)) {
    $thumbnail = get_the_post_thumbnail_url($post_id);
} else {
    $thumbnail = get_template_directory_uri() . "/images/no-thumbnail.png";
}
?>

<div class="tutorial">
    <div class="thmubnail">
        <a href="<?php echo get_the_permalink(); ?>">
            <img src='<?= $thumbnail ?>' alt="<?php the_title(); ?>" title="<?php the_title(); ?>">
        </a>
    </div>
    <div class="tutorial_body">
        <a href="<?php echo get_the_permalink(); ?>">
            <h3 class="tutorial_title"><?php the_title(); ?></h3>
        </a>
        <section class="price_tag">
            <span>رایگان</span>
        </section>
    </div>
</div>