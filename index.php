<?php get_header(); ?>
<div class="intro">
    <section class="right">
        <h2 class="title"><?php echo JetCode_get_theme_option('hero_title'); ?></h2>
        <p class="subtitle"><?php echo JetCode_get_theme_option('hero_description'); ?></p>
        <section class="row">
            <a class="btn secondary_btn" href="<?php echo JetCode_get_theme_option('hero_first_link'); ?>"><?php echo JetCode_get_theme_option('hero_first_link_text'); ?></a>
            <a class="btn primary_btn" href="<?php echo JetCode_get_theme_option('hero_second_link'); ?>"><?php echo JetCode_get_theme_option('hero_second_link_text'); ?></a>
        </section>
    </section>
    <section class="left">
        <img src="<?php echo get_template_directory_uri(); ?>/images/laptop_coding.svg" alt="gummy-programming">
    </section>
</div>
<div class="about">
    <div class="row">
        <img src="<?php echo get_template_directory_uri(); ?>/images/about_img.png" alt="edris_ranjbar" class="right">
        <section class="left">
            <h2 class="title"><?php echo JetCode_get_theme_option('about_title'); ?></h2>
            <p class="description"><?php echo JetCode_get_theme_option('about_description'); ?></p>
            <section class="btns">
                <a class="btn_resume" href="<?php echo JetCode_get_theme_option('resume_link') ?>">دانلود رزومه
                    <img src="<?php echo get_template_directory_uri(); ?>/images/Vector.png" alt="icon">
                </a>
                <a class="btn_connection" href="<?php echo JetCode_get_theme_option('contact_link') ?>">ارتباط با من</a>
            </section>
        </section>
    </div>


</div>
<div class="recent_post">
    <h2 class="title">آخرین های وبلاگ</h2>
    <div class="posts">
        <!-- Showing recent 6 posts -->
        <?php
        $query = new WP_Query(
            [
                'post_type' => 'post',
                'post_status' => 'publish',
                'posts_per_page' => 6,
            ]
        );
        if ($query->have_posts()) {
            while ($query->have_posts()) {
                set_query_var('query', $query);
                get_template_part('template-parts/content', 'none');
            }
        }
        ?>
    </div>
    <a href="<?php echo get_permalink(get_option('page_for_posts')); ?>" class="btn">رفتن به وبلاگ</a>
</div>
<div class="tutorials">
    <h2 class="title">دوره های آموزشی</h2>

    <div class="container">
        <div class="mini_cards">
            <!-- Show tutorials -->
            <?php
            $query = new WP_Query(
                [
                    'post_type' => 'tutorial',
                    'post_status' => 'publish',
                    'posts_per_page' => 4,
                ]
            );
            if ($query->have_posts()) {
                while ($query->have_posts()) {
                    set_query_var('query', $query);
                    get_template_part('template-parts/content', 'tutorial');
                }
            }
            ?>
        </div>


        <section class="heroic">
            <img src="<?php echo get_template_directory_uri(); ?>/images/heroic.png" alt="hero">
            <h2 class="heroic_title">یادگیری رو امروز شروع کن!</h2>
            <a href=""> تماشای ویدیوها:)</a>
        </section>
    </div>

</div>
<?php get_footer(); ?>