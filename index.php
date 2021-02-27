<?php get_header(); ?>
<main>
    <section class="hero">
        <div class="right">
            <h2 class="title">به دنیای برنامه نویسی خوش آمدید</h2>
            <p class="subtitle">کجا بهتر از اینجا برای شروع یادگیری، رایگان و آزاد</p>
            <div class="row justify-center">
                <button class="btn btn-secondary-outline">وبلاگ</button>
                <button class="btn btn-primary">یادگیری رو شروع کن!</button>
            </div>
        </div>
        <div class="left">
            <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/laptop_coding.svg">
        </div>
    </section>
    <section class="about">
        <div class="right">
            <div class="circle"></div>
            <h2 class="title">درباره ادریس رنجبر</h2>
            <p class="description">لورم ایپسوم متن ساختگی با تولید سادگی نامفهوم از صنعت چاپ، و با استفاده از طراحان
                گرافیک است، چاپگرها و متون بلکه
                روزنامه و مجله در ستون و سطرآنچنان که لازم است، و برای شرایط فعلی تکنولوژی مورد نیاز، و کاربردهای
                متنوع با هدف بهبود
                ابزار</p>
            <div class="icons">
                <a target="_blank" href="http://instagram.com/edrisranjbar">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Instagram.svg" alt="Instagram">
                </a>
                <a target="_blank" href="https://twitter.com/edris__ranjbar">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Twitter.svg" alt="Twitter">
                </a>
                <a target="_blank" href="mailto:edris.qeshm2@gmail.com"><img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Email.svg" alt="Email"></a>
                <a target="_blank" href="https://linkedin.com/in/edris-ranjbar"><img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/Linkedin.svg" alt="Linkedin"></a>
                <a target="_blank" href="https://github.com/edrisranjbar"><img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/GitHub.svg" alt="GitHub"></a>
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
                        <img src='<?= $thumbnail ?>' class='thumbnail'>
                        <div class='card-body'>
                            <h4 class='card-title'><?php the_title(); ?></h4>
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
                <div class="slide">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/web_browsing.png">
                </div>
                <div class="slide">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/html5.png">
                </div>
                <div class="slide">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/linux.png">
                </div>
                <div class="slide">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/web_browsing.png">
                </div>
                <div class="slide">
                    <img src="<?php echo get_template_directory_uri() . '/assets/' ?>images/html5.png">
                </div>
            </div>
            <div class="">
                <div role="tablist" class="dots"></div>
            </div>
        </div>
    </section>
</main>
<?php get_footer(); ?>