<section class="tutorials">
    <h2 class="title">دوره های آموزشی</h2>
    <div class="row" style="overflow-x: scroll;">
        <?php
        $args = array(
            'post_type' => 'tutorial'
        );
        $query = new WP_Query($args);
        // The Loop
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                $query->the_post();
                $post_id = $query->get_the_ID();
        ?>
                <div class="tutorial">
                    <div class="thumbnail">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <?php if (has_post_thumbnail($post_id)) {
                                $thumbnail = get_the_post_thumbnail_url($post_id);
                            } else {
                                $thumbnail = get_template_directory_uri() . "/assets/images/no-thumbnail.png";
                            } ?>
                            <img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
                        </a>
                    </div>
                    <div class="tutorial_body">
                        <a href="<?php echo get_the_permalink(); ?>">
                            <h2 class="tutorial_title"><?php echo get_the_title(); ?></h2>
                        </a>
                        <div class="row">
                            <span class="price_tag">رایگان</span>
                        </div>
                    </div>
                </div>
        <?php
            }
        } else {
            // no tutorial found
            echo "<h3 class='text-center text-orange m-0'>دوره ای یافت نشد</h3>";
        }
        /* Restore original Post Data */
        wp_reset_postdata();
        ?>
    </div>
</section>