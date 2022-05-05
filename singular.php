<?php get_header();
?>
<div class="post_container">
    <div class="row wrapper">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post();
                $post_id = get_the_ID();
        ?>
                <article>
                    <div class="post_header">
                        <h1 class="post_title"><?php the_title(); ?></h1>
                        <?php
                        $post_categories = wp_get_post_categories($post_id);
                        $category_counter = 1;
                        foreach ($post_categories as $category) {
                            if ($category_counter++ > 2) {
                                break;
                            }
                            $this_category = get_category($category);
                            $category_link = get_category_link($this_category);
                            echo " <a href='" . $category_link . "'><span class='badge'>" . $this_category->name . "</span> </a>";
                        }
                        ?>
                    </div>
                    <div class="post_content"><?php the_content(); ?></div>
                    <div class="comments">
                        <div class="row comment_form">
                            <form action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                                <div class="row">
                                    <label for="author">نام</label>
                                    <input type="text" name="author" id="author">
                                </div>

                                <div class="row">
                                    <label for="email">ایمیل</label>
                                    <input type="email" name="email" id="email">
                                </div>

                                <div class="row">
                                    <label for="comment_text">دیدگاه</label>
                                    <textarea name="comment" id="comment_text"></textarea>
                                </div>

                                <div class="row">
                                    <button name="submit" class="btn">ارسال نظر</button>
                                </div>

                            </form>
                            <img src="<?php echo get_template_directory_uri(); ?>/images/comment_illustration.svg" class="comment_illustration">

                        </div>
                        <?php
                        $comments_query = new WP_Comment_Query([
                            'status'    => 'approve',
                            'parent'    => 0,
                            'post_id'   => $post_id
                        ]);
                        set_query_var('comments_query', $comments_query);
                        get_template_part('comment');
                        ?>
                    </div>
                </article>
        <?php }
        }
        get_template_part('sidebar');
        ?>
    </div>
</div>
<?php get_footer(); ?>