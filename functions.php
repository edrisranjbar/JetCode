<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}
if (file_exists(WP_PLUGIN_DIR . "/wp-statistics" . "/includes/template-functions.php"))
    require_once(WP_PLUGIN_DIR . "/wp-statistics" . "/includes/template-functions.php");
require_once("includes/texonomy_images.php");

// Add theme supports
function JetCode_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('custom-logo');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'JetCode_theme_support');

function JetCode_menu()
{
    $locations = [
        'primary' => "منوی اصلی",
        'footer' => "منوی فوتر موبایل",
    ];
    register_nav_menus($locations);
}
add_action('init', 'JetCode_menu');

function JetCode_get_menu_items($menu_name)
{
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        if ($menu_name === "footer") {
            foreach ((array) $menu_items as $key => $menu_item) {
                $title = $menu_item->title;
                $url = $menu_item->url;
                $thumbnail_src = wp_get_attachment_image_src($menu_item->thumbnail_id)[0] ?? get_template_directory_uri() . "/images/no-icon.png";
                $menu_list .= '<a href="' . $url . '">
                <div class="navbar_icon">
                    <div class="container" id="index">
                        <img src="' . $thumbnail_src . '" alt="icon">
                        <span>' . $title . '</span>
                    </div>
                </div>
            </a>';
            }
        } else {
            $menu_list = '<ul>';
            foreach ((array) $menu_items as $key => $menu_item) {
                $title = $menu_item->title;
                $url = $menu_item->url;
                $menu_list .= '<li> <a href="' . $url . '">' . $title . '</a> </li>';
            }
            $menu_list .= '</ul>';
        }
    }
    return $menu_list ? $menu_list : "";
}

// Wordpress Theme customization panel
if (!class_exists('WPEX_Theme_Options')) {
    class WPEX_Theme_Options
    {
        public function __construct()
        {

            // We only need to register the admin panel on the back-end
            if (is_admin()) {
                add_action('admin_menu', array('WPEX_Theme_Options', 'add_admin_menu'));
                add_action('admin_init', array('WPEX_Theme_Options', 'register_settings'));
            }
        }
        public static function get_theme_options()
        {
            return get_option('theme_options');
        }
        public static function get_theme_option($id)
        {
            $options = self::get_theme_options();
            if (isset($options[$id])) {
                return $options[$id];
            }
        }
        public static function add_admin_menu()
        {
            add_menu_page(
                esc_html__('Theme Settings', 'text-domain'),
                esc_html__('تنظیمات قالب', 'text-domain'),
                'manage_options',
                'theme-settings',
                array('WPEX_Theme_Options', 'create_admin_page')
            );
        }
        public static function register_settings()
        {
            register_setting('theme_options', 'theme_options', array('WPEX_Theme_Options', 'sanitize'));
        }

        /**
         * Sanitization callback
         *
         * @since 1.0.0
         */
        public static function sanitize($options)
        {
            // If we have options lets sanitize them
            if ($options) {

                // Hero Section
                if (!empty($options['hero_title'])) {
                    $options['hero_title'] = sanitize_text_field($options['hero_title']);
                } else {
                    unset($options['hero_title']);
                }
                if (!empty($options['hero_description'])) {
                    $options['hero_description'] = sanitize_text_field($options['hero_description']);
                } else {
                    unset($options['hero_description']);
                }
                if (!empty($options['hero_first_link'])) {
                    $options['hero_first_link'] = sanitize_text_field($options['hero_first_link']);
                } else {
                    unset($options['hero_first_link']);
                }
                if (!empty($options['hero_first_link_text'])) {
                    $options['hero_first_link_text'] = sanitize_text_field($options['hero_first_link_text']);
                } else {
                    unset($options['hero_first_link_text']);
                }
                if (!empty($options['hero_second_link'])) {
                    $options['hero_second_link'] = sanitize_text_field($options['hero_second_link']);
                } else {
                    unset($options['hero_second_link']);
                }
                if (!empty($options['hero_second_link_text'])) {
                    $options['hero_second_link_text'] = sanitize_text_field($options['hero_second_link_text']);
                } else {
                    unset($options['hero_second_link_text']);
                }

                // About Section
                if (!empty($options['about_title'])) {
                    $options['about_title'] = sanitize_text_field($options['about_title']);
                } else {
                    unset($options['about_title']);
                }
                if (!empty($options['about_description'])) {
                    $options['about_description'] = sanitize_text_field($options['about_description']);
                } else {
                    unset($options['about_description']);
                }

                if (!empty($options['contact_link'])) {
                    $options['contact_link'] = sanitize_text_field($options['contact_link']);
                } else {
                    unset($options['contact_link']);
                }

                if (!empty($options['resume_link'])) {
                    $options['resume_link'] = sanitize_text_field($options['resume_link']);
                } else {
                    unset($options['resume_link']);
                }

                // Podcast
                if (!empty($options['podcast_title'])) {
                    $options['podcast_title'] = sanitize_text_field($options['podcast_title']);
                } else {
                    unset($options['podcast_title']);
                }
                if (!empty($options['podcast_description'])) {
                    $options['podcast_description'] = sanitize_text_field($options['podcast_description']);
                } else {
                    unset($options['podcast_description']);
                }
                if (!empty($options['podcast_frame'])) {
                    $options['podcast_frame'] = sanitize_text_field($options['podcast_frame']);
                } else {
                    unset($options['podcast_frame']);
                }

                // Select
                if (!empty($options['select_example'])) {
                    $options['select_example'] = sanitize_text_field($options['select_example']);
                }
            }
            // Return sanitized options
            return $options;
        }
        public static function create_admin_page()
        { ?>

            <div class="wrap">

                <h1><?php esc_html_e('تنظیمات قالب', 'text-domain'); ?></h1>

                <form method="post" action="options.php">

                    <?php settings_fields('theme_options'); ?>

                    <!-- Hero Section -->
                    <table class="form-table wpex-custom-admin-login-table">
                        <h1>قسمت هیرو</h1>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('عنوان', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('hero_title'); ?>
                                <input type="text" name="theme_options[hero_title]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('توضیحات', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('hero_description'); ?>
                                <textarea name="theme_options[hero_description]"><?php echo esc_attr($value); ?></textarea>
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('متن لینک اول', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('hero_first_link_text'); ?>
                                <input type="text" name="theme_options[hero_first_link_text]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('لینک اول', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('hero_first_link'); ?>
                                <input type="url" name="theme_options[hero_first_link]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('متن لینک دوم', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('hero_second_link_text'); ?>
                                <input type="text" name="theme_options[hero_second_link_text]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('لینک دوم', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('hero_second_link'); ?>
                                <input type="url" name="theme_options[hero_second_link]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                    </table>
                    <!-- About Section -->
                    <table class="form-table wpex-custom-admin-login-table">
                        <h1>درباره ما</h1>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('عنوان درباره ما', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('about_title'); ?>
                                <input type="text" name="theme_options[about_title]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('توضیحات درباره ما', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('about_description'); ?>
                                <textarea name="theme_options[about_description]"><?php echo esc_attr($value); ?></textarea>
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><?php esc_html_e('لینک دکمه رزومه', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('resume_link'); ?>
                                <input name="theme_options[resume_link]" type="url" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr>
                            <th scope="row"><?php esc_html_e('لینک دکمه ارتباط با من', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('contact_link'); ?>
                                <input name="theme_options[contact_link]" type="url" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>

                        <tr>
                            <th scope="row"><?php esc_html_e('توضیحات درباره ما', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('about_description'); ?>
                                <textarea name="theme_options[about_description]"><?php echo esc_attr($value); ?></textarea>
                            </td>
                        </tr>
                    </table>

                    <table class="form-table wpex-custom-admin-login-table">
                        <tr valign="top" class="wpex-custom-admin-screen-background-section">
                            <th scope="row"><?php esc_html_e('Select Example', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('select_example'); ?>
                                <select name="theme_options[select_example]">
                                    <?php
                                    $options = array(
                                        '1' => esc_html__('Option 1', 'text-domain'),
                                        '2' => esc_html__('Option 2', 'text-domain'),
                                        '3' => esc_html__('Option 3', 'text-domain'),
                                    );
                                    foreach ($options as $id => $label) { ?>
                                        <option value="<?php echo esc_attr($id); ?>" <?php selected($value, $id, true); ?>>
                                            <?php echo strip_tags($label); ?>
                                        </option>
                                    <?php } ?>
                                </select>
                            </td>
                        </tr>

                    </table>

                    <?php submit_button(); ?>

                </form>

            </div><!-- .wrap -->
<?php }
    }
}
new WPEX_Theme_Options();
// Helper function to use in your theme to return a theme option value
function JetCode_get_theme_option($id = '')
{
    return WPEX_Theme_Options::get_theme_option($id);
}


// Add Tutorial post type
function JetCode_setup_tutorial_post_type()
{
    $args = array(
        'public'    => true,
        'label'     => __('دوره ها', 'textdomain'),
        'menu_icon' => 'dashicons-welcome-learn-more',
        'menu_position' => 5,
        'supports'      => array('title', 'editor', 'thumbnail', 'excerpt', 'comments'),
        'labels' => [
            'name'                  => _x('دوره ها', 'Post type general name', 'textdomain'),
            'singular_name'         => _x('دوره', 'Post type singular name', 'textdomain'),
            'menu_name'             => _x('دوره ها', 'Admin Menu text', 'textdomain'),
            'name_admin_bar'        => _x('دوره', 'Add New on Toolbar', 'textdomain'),
            'add_new'               => __('افزودن', 'textdomain'),
            'add_new_item'          => __('افزودن دوره جدید', 'textdomain'),
            'new_item'              => __('دوره جدید', 'textdomain'),
            'edit_item'             => __('ویرایش دوره', 'textdomain'),
            'view_item'             => __('نمایش دوره', 'textdomain'),
            'all_items'             => __('همه دوره ها', 'textdomain'),
            'search_items'          => __('جست و جوی دوره ها', 'textdomain'),
            'parent_item_colon'     => __('دوره های والد:', 'textdomain'),
            'not_found'             => __('دوره ای یافت نشد!', 'textdomain'),
            'not_found_in_trash'    => __('دوره ای در سطل زباله یافت نشد!', 'textdomain'),
            'featured_image'        => _x('تصویر کاور دوره', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain'),
            'set_featured_image'    => _x('تنظیم تصویر دوره', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'remove_featured_image' => _x('حذف کاور دوره', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'use_featured_image'    => _x('استفاده از یک تصویر برای دوره', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain'),
            'archives'              => _x('Book archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain'),
            'insert_into_item'      => _x('Insert into book', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain'),
            'uploaded_to_this_item' => _x('Uploaded to this book', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain'),
            'filter_items_list'     => _x('فیلتر لیست دوره ها', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain'),
            'items_list_navigation' => _x('Books list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain'),
            'items_list'            => _x('لیست دوره ها', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain'),
        ],
    );
    register_post_type('tutorial', $args);
}
add_action('init', 'JetCode_setup_tutorial_post_type');


// Sidebar widgets
function JetCode_register_sidebars()
{
    register_sidebar([
        'id'            => 'sidebar',
        'name'          => __('ستون کناری', 'JetCode'),
        'before_widget' => '<section class="widget">',
        'after_widget'  => '</div></section>',
        'before_title'  => '<div class="widget_title"><h3>',
        'after_title'   => '</h3></div><div class="widget_body">',
    ]);
}
add_action('widgets_init', 'JetCode_register_sidebars');


// footer copyright
function JetCode_footer_copyright()
{
    $site_name = get_bloginfo('name');
    $site_url = get_bloginfo('url');
    return "<p>تمامی حقوق برای وب سایت <a href='$site_url'>$site_name</a> محفوظ است.</p>";
}

// footer widgets
function JetCode_footer_widgets()
{
    register_sidebar(array(
        'name' => __('ستون اول', 'JetCode'),
        'id' => 'footer-1',
        'description' => __('در ستون اول پابرگ سایت نمایش داده می شود', 'JetCode'),
        'before_widget' => '<div class="">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('ستون دوم', 'JetCode'),
        'id' => 'footer-2',
        'description' => __('در ستون دوم پابرگ سایت نمایش داده می شود', 'JetCode'),
        'before_widget' => '<div class="">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="title">',
        'after_title' => '</h4>',
    ));
    register_sidebar(array(
        'name' => __('ستون سوم', 'JetCode'),
        'id' => 'footer-3',
        'description' => __('در ستون سوم پابرگ سایت نمایش داده می شود', 'JetCode'),
        'before_widget' => '<div class="">',
        'after_widget' => '</div>',
        'before_title' => '<h4 class="title">',
        'after_title' => '</h4>',
    ));
}
add_action('widgets_init', 'JetCode_footer_widgets');

add_filter('use_widgets_block_editor', '__return_false');
