<?php
// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

// Add menu
function JetCode_menu()
{
    $locations = [
        'primary' => "منوی اصلی"
    ];
    register_nav_menus($locations);
}
add_action('init', 'JetCode_menu');

// get menu items
function JetCode_get_menu_items($menu_name)
{
    if (($locations = get_nav_menu_locations()) && isset($locations[$menu_name])) {
        $menu = wp_get_nav_menu_object($locations[$menu_name]);
        $menu_items = wp_get_nav_menu_items($menu->term_id);
        $menu_list = '<ul>';
        foreach ((array) $menu_items as $key => $menu_item) {
            $title = $menu_item->title;
            $url = $menu_item->url;
            $menu_list .= '<a href="' . $url . '"><li>' . $title . '</li></a>';
        }
        $menu_list .= '</ul>';
    }
    return $menu_list ? $menu_list : [];
}

// Add theme supports
function JetCode_theme_support()
{
    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
}
add_action('after_setup_theme', 'JetCode_theme_support');

// customize the excerpt
function JetCode_custom_excerpt_length($length)
{
    return ($length <= 40) ? $length : 40;
}
add_filter('excerpt_length', 'JetCode_custom_excerpt_length', 999);
function JetCode_excerpt_more($more)
{
    return ' ...';
}
add_filter('excerpt_more', 'JetCode_excerpt_more');


// Enqueue assets
function JetCode_register_styles()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_style('JetCode_style', get_template_directory_uri() . "/assets/css/style.css", ['JetCode_glider_style'], $version, 'all');
    wp_enqueue_style('JetCode_glider_style', get_template_directory_uri() . "/assets/css/glider.min.css", [], '1.0', 'all');
}
add_action('wp_enqueue_scripts', 'JetCode_register_styles');

function JetCode_register_scripts()
{
    $version = wp_get_theme()->get('Version');
    wp_enqueue_script('JetCode_script', get_template_directory_uri() . "/assets/js/script.js", ['JetCode_glider_script'], $version, true);
    wp_enqueue_script('JetCode_glider_script', get_template_directory_uri() . "/assets/js/glider.min.js", [], '1.0', true);
}
add_action('wp_enqueue_scripts', 'JetCode_register_scripts');

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

                // Checkbox
                if (!empty($options['checkbox_example'])) {
                    $options['checkbox_example'] = 'on';
                } else {
                    unset($options['checkbox_example']); // Remove from options if not checked
                }

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
                if (!empty($options['instagram'])) {
                    $options['instagram'] = sanitize_text_field($options['instagram']);
                } else {
                    unset($options['instagram']);
                }
                if (!empty($options['twitter'])) {
                    $options['twitter'] = sanitize_text_field($options['twitter']);
                } else {
                    unset($options['twitter']);
                }
                if (!empty($options['email'])) {
                    $options['email'] = sanitize_text_field($options['email']);
                } else {
                    unset($options['email']);
                }
                if (!empty($options['linkedin'])) {
                    $options['linkedin'] = sanitize_text_field($options['linkedin']);
                } else {
                    unset($options['linkedin']);
                }
                if (!empty($options['github'])) {
                    $options['github'] = sanitize_text_field($options['github']);
                } else {
                    unset($options['github']);
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

                    <table class="form-table wpex-custom-admin-login-table">
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('Checkbox Example', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('checkbox_example'); ?>
                                <input type="checkbox" name="theme_options[checkbox_example]" <?php checked($value, 'on'); ?>> <?php esc_html_e('Checkbox example description.', 'text-domain'); ?>
                            </td>
                        </tr>
                    </table>

                    <!-- Hero Section -->
                    <table class="form-table wpex-custom-admin-login-table">
                        <caption>قسمت هیرو</caption>
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
                        <caption>درباره ما</caption>
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
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('اینستاگرام', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('instagram'); ?>
                                <input type="url" name="theme_options[instagram]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('توییتر', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('twitter'); ?>
                                <input type="url" name="theme_options[twitter]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('ایمیل', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('email'); ?>
                                <input type="url" name="theme_options[email]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('لینکدین', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('linkedin'); ?>
                                <input type="url" name="theme_options[linkedin]" value="<?php echo esc_attr($value); ?>">
                            </td>
                        </tr>
                        <tr valign="top">
                            <th scope="row"><?php esc_html_e('گیت هاب', 'text-domain'); ?></th>
                            <td>
                                <?php $value = self::get_theme_option('github'); ?>
                                <input type="url" name="theme_options[github]" value="<?php echo esc_attr($value); ?>">
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
