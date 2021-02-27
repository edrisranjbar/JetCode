<?php get_header(); ?>
<main>
    <section class="hero">
        <div class="right">
            <h2 class="title"><?php echo JetCode_get_theme_option('hero_title'); ?></h2>
            <p class="subtitle"><?php echo JetCode_get_theme_option('hero_description'); ?></p>
            <div class="row justify-center">
                <a href="<?php echo JetCode_get_theme_option('hero_first_link'); ?>" class="btn btn-secondary-outline"><?php echo JetCode_get_theme_option('hero_first_link_text'); ?></a>
                <a href="<?php echo JetCode_get_theme_option('hero_second_link'); ?>" class="btn btn-primary"><?php echo JetCode_get_theme_option('hero_second_link_text'); ?></a>
            </div>
        </div>
        <div class="left">
            <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/laptop_coding.svg">
        </div>
    </section>
    <section class="about">
        <div class="right">
            <div class="circle"></div>
            <h2 class="title"><?php echo JetCode_get_theme_option('about_title'); ?></h2>
            <p class="description"><?php echo JetCode_get_theme_option('about_description'); ?></p>
            <div class="icons">
                <a target="_blank" href="<?php echo JetCode_get_theme_option('instagram'); ?>">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Instagram.png" alt="Instagram">
                </a>
                <a target="_blank" href="<?php echo JetCode_get_theme_option('twitter'); ?>">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Twitter.png" alt="Twitter">
                </a>
                <a target="_blank" href="<?php echo JetCode_get_theme_option('email'); ?>">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Email.png" alt="Email">
                </a>
                <a target="_blank" href="<?php echo JetCode_get_theme_option('linkedin'); ?>">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Linkedin.png" alt="Linkedin">
                </a>
                <a target="_blank" href="<?php echo JetCode_get_theme_option('github'); ?>">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/GitHub.png" alt="GitHub">
                </a>
            </div>
        </div>
        <div class="left">
            <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/man_with_code.svg">
        </div>
    </section>
    <section class="posts">
        <h3 class="title">آخرین های وبلاگ</h3>
        <div class="wrapper">
            <?php
            if (have_posts()) {
                $post_counter = 1;
                while (have_posts() && $post_counter++ < 4) {
                    the_post();
                    $post_id = get_the_ID();
            ?>
                    <div class='card'>
                        <div class='overlay'></div>
                        <?php if (has_post_thumbnail($post_id)) {
                            $thumbnail = get_the_post_thumbnail_url($post_id);
                        } else {
                            $thumbnail = get_template_directory_uri() . "/assets/images/no-thumbnail.png";
                        }
                        ?>
                        <a href="<?php echo get_the_permalink(); ?>"><img src='<?= $thumbnail ?>' class='thumbnail' alt="<?php the_title(); ?>" title="<?php the_title(); ?>"></a>
                        <div class='card-body'>
                            <a href="<?php echo get_the_permalink(); ?>">
                                <h4 class='card-title'><?php the_title(); ?></h4>
                            </a>
                            <?php
                            $post_categories = wp_get_post_categories($post_id);
                            $category_counter = 1;
                            foreach ($post_categories as $category) {
                                if ($category_counter++ > 2) {
                                    break;
                                }
                                $this_category = get_category($category);
                                echo "<a href='" . get_site_url() . "/category/" . $this_category->slug . "'><span class='badge'>" . $this_category->name . "</span></a>";
                            }
                            ?>
                            <p class='card-description'>
                                <?php the_excerpt(); ?>
                            </p>
                            <div class='views'>
                                21 بار دیده شده
                            </div>
                        </div>
                    </div>
            <?php }
            }
            ?>
            &nbsp;
        </div>
        <div class="wrapper">
            <button class="btn btn-secondary">رفتن به وبلاگ</button>
        </div>
    </section>
    <section class="tutorials">
        <h3 class="title">دوره های آموزشی</h3>
        <div class="glider-contain">
            <div class="glider">
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
                        <a href="<?php echo get_the_permalink(); ?>">
                            <div class="slide">
                                <?php if (has_post_thumbnail($post_id)) {
                                    $thumbnail = get_the_post_thumbnail_url($post_id);
                                } else {
                                    $thumbnail = get_template_directory_uri() . "/assets/images/no-thumbnail.png";
                                } ?>

                                <img src="<?php echo $thumbnail; ?>" alt="<?php echo get_the_title(); ?>">
                            </div>
                        </a>
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
            <div class="">
                <div role="tablist" class="dots"></div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>