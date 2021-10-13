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
            $query = new WP_Query(
                [
                    'post_type' => 'post',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                ]
            );
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    set_query_var('query', $query);
                    get_template_part('template_parts/content', 'none');
                }
            }
            ?>
            &nbsp;
        </div>
        <div class="wrapper">
            <a href="<?php echo JetCode_get_theme_option('hero_first_link'); ?>" class="btn btn-secondary">رفتن به وبلاگ</a>
        </div>
    </section>
    <?php get_template_part('tutorials'); ?>
</main>
<?php get_footer(); ?>
