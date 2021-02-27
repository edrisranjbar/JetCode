<?php
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
