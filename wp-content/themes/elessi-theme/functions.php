<?php
/*
 *
 * @package nasatheme - elessi-theme
 */

/* Define DIR AND URI OF THEME */
define('ELESSI_THEME_PATH', get_template_directory());
define('ELESSI_CHILD_PATH', get_stylesheet_directory());
define('ELESSI_THEME_URI', get_template_directory_uri());

/* Global $content_width */
if (!isset($content_width)){
    $content_width = 1200; /* pixels */
}

/**
 * Options theme
 */
require_once ELESSI_THEME_PATH . '/options/nasa-options.php';

add_action('after_setup_theme', 'elessi_setup');
if (!function_exists('elessi_setup')) :

    function elessi_setup() {
        load_theme_textdomain('elessi-theme', ELESSI_THEME_PATH . '/languages');
        add_theme_support('woocommerce');
        add_theme_support('automatic-feed-links');

        add_theme_support('post-thumbnails');
        add_theme_support('title-tag');
        add_theme_support('custom-background');
        add_theme_support('custom-header');

        register_nav_menus(
            array(
                'primary' => esc_html__('Main Menu', 'elessi-theme'),
                'vetical-menu' => esc_html__('Vertical Menu', 'elessi-theme'),
                'topbar-menu' => esc_html__('Top Menu - Only show level 1', 'elessi-theme')
            )
        );
        
        require_once ELESSI_THEME_PATH . '/cores/nasa-custom-wc-ajax.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-dynamic-style.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-widget-functions.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-theme-options.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-theme-functions.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-woo-functions.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-shop-ajax.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-theme-headers.php';
        require_once ELESSI_THEME_PATH . '/cores/nasa-theme-footers.php';
    }

endif;
