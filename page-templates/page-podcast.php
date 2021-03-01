<?php
/*
    Template Name: پادکست
*/
get_header(); ?>
<main class="podcasts">
    <div class="wrapper">
        <div class="right">
            <h2 class="title"><?php echo JetCode_get_theme_option('podcast-title'); ?></h2>
            <p class="description"><?php echo JetCode_get_theme_option('podcast-description'); ?></p>
            <div class="icons">
                <a href="https://www.breaker.audio/jetcode-cast"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Breaker.png" alt="Breaker logo"></a>
                <a href="https://www.google.com/podcasts?feed=aHR0cHM6Ly9hbmNob3IuZm0vcy8yZmI0YzIwNC9wb2RjYXN0L3Jzcw=="><img src="<?php echo get_template_directory_uri(); ?>/assets/images/GooglePodcast.png" alt="Google Google Podcast logo"></a>
                <a href="https://overcast.fm/itunes1526700406/jetcode-cast"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/OverCast.png" alt="OverCast logo"></a>
                <a href="https://pca.st/3c1trys7"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/PocketCast.png" alt="PocketCast logo"></a>
                <a href="https://radiopublic.com/jetcode-cast-69xr13"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/RadioPublic.png" alt="RadioPublic logo"></a>
                <a href="https://open.spotify.com/show/0r7zZ4ryETvUF7PUViQXPL"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/Spotify.png" alt="Spotify logo"></a>
                <a href="https://castbox.fm/channel/JetCode-cast-id3224095"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/CastBox.png" alt="CastBox logo"></a>
                <a href="https://anchor.fm/s/2fb4c204/podcast/rss"><img src="<?php echo get_template_directory_uri(); ?>/assets/images/RSS.png" alt="RSS logo"></a>
            </div>
            <div class="row">
                <a href="#podcast_frame" class="btn btn-primary">شروع به گوش دادن کنید
                    <img src="<?php echo get_template_directory_uri(); ?>/assets/images/bi_arrow-down-circle-fill.png"></a>
            </div>
        </div>
        <div class="left">
            <img src="<?php echo get_template_directory_uri(); ?>/assets/images/Podcast Illustration.png" class="podcast_illustration">
        </div>
    </div>
    <div class="wrapper">
        <iframe id="podcast_frame" class="podcast_frame" src="<?php echo JetCode_get_theme_option('podcast-frame'); ?>" frameborder="0" width="100%" height="500"></iframe>
    </div>
</main>
<?php get_footer(); ?>