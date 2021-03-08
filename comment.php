<div class="comments-list">
    <ul>
        <?php
        $comments = $comments_query->comments;
        if ($comments) {
        ?>
            <?php
            foreach ($comments as $comment) {
            ?>
                <li class="comment">
                    <div class="row">
                        <img src="<?php echo get_avatar_url($comment->get_comment_author_email_link) ?>" class="user-avatar">
                        <strong class="comment-title"><?php echo $comment->comment_author; ?></strong>
                    </div>
                    <div class="comment-text">
                        <span class="comment-date"><?php echo get_comment_date('Y/m/d'); ?></span>
                        <p><?php echo $comment->comment_content; ?></p>
                    </div>
                    <?php
                    $args = array(
                        'status' => 'approve',
                        'number' => '3',
                        'parent' => $comment->comment_ID
                    );
                    $replies = get_comments($args);
                    foreach ($replies as $reply) {
                    ?>
                        <ul>
                            <li class="reply comment">
                                <div class="row">
                                    <img src="<?php echo get_avatar_url($reply->get_comment_author_email_link) ?>" class="user-avatar">
                                    <strong class="comment-title"><?php echo $reply->comment_author; ?></strong>
                                </div>
                                <div class="comment-text">
                                    <span class="comment-date"><?php echo get_comment_date('Y/m/d'); ?></span>
                                    <p><?php echo $reply->comment_content; ?></p>
                                </div>
                            </li>
                        </ul>
                    <?php } ?>
                </li>
            <?php
            }
            ?>
    </ul>
    <div class="row more-comment-row">
        <button class="btn btn-sm btn-primary more-comment-btn">نمایش بیشتر
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bi_arrow-down-circle-fill.png" />
        </button>
    </div>
<?php
        };
?>
</div>