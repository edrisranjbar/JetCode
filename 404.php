<?php get_header(); ?>
<main class="page_404">
    <div class="wrapper">
        <img src="<?php echo get_template_directory_uri(); ?>/assets/images/404.png" alt="404" class="image_404">
        <p class="error-404-text text-white">صفحه مورد نظر یافت نشد.</p>
        <a class="error-404-link-back" href="<?php echo get_bloginfo('url'); ?>">رفتن به صفحه اصلی</a>
    </div>
</main>
<?php get_footer(); ?>