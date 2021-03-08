<?php
get_header();
?>
<main class="post">
    <div class="row">
        <?php if (have_posts()) {
            while (have_posts()) {
                the_post();
                $post_id = get_the_ID();
        ?>
                <article>
                    <div class="post-header">
                        <h2 class="post-title"><?php the_title(); ?></h2>
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
                    </div>
                    <div class="post-content"><?php the_content(); ?></div>
                    <div class="comments">
                        <div class="row comment-form">
                            <form id="commentform" action="<?php echo get_option('siteurl'); ?>/wp-comments-post.php" method="post" id="commentform">
                                <div class="row">
                                    <label for="author">نام</label>
                                    <input type="text" name="author" id="author" />
                                </div>
                                <div class="row">
                                    <label for="email">ایمیل</label>
                                    <input type="email" name="email" id="email" />
                                </div>
                                <div class="row">
                                    <label for="comment-text">دیدگاه</label>
                                    <textarea name="comment" id="comment-text"></textarea>
                                </div>
                                <input type="hidden" name="comment_post_ID" value="<?php echo $post_id ?>" id="comment_post_ID">
                                <input type="hidden" name="comment_parent" id="comment_parent" value="0">
                                <div class="row">
                                    <button name="submit" type="submit" class="btn btn-sm btn-primary">
                                        ارسال نظر
                                    </button>
                                </div>
                            </form>
                            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Comment.svg" class="comment-illustration" />
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
</main>
<?php get_footer();
?>