<footer>
    <?php if (is_active_sidebar('footer-1') or is_active_sidebar('footer-2') or is_active_sidebar('footer-3') or is_active_sidebar('footer-4')) : ?>
        <section>
            <div class="widget">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php endif; ?>
            </div>
            <div class="widget">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php endif; ?>
            </div>
            <div class="widget">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php endif; ?>
            </div>
        </section>
    <?php endif; ?>

    <div class="copyright">
        <?php echo JetCode_footer_copyright(); ?>
        <p>طراحی و توسعه با ☕ و ❤️ توسط ادریس رنجبر</p>
    </div>
</footer>

<nav class="bottom_nav_bar">
    <div class="row icons">
        <?php echo JetCode_get_menu_items('footer'); ?>
    </div>
</nav>

</main>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/splide.min.js"></script>
<script src="<?php echo get_template_directory_uri(); ?>/assets/js/script.js"></script>
</body>

</html>