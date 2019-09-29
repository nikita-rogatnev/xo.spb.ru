<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo('charset'); ?>" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />

<?php if (function_exists('wp_site_icon')) : ?>
    <link rel="shortcut icon" href="<?php echo (isset($nasa_opt['site_favicon']) && $nasa_opt['site_favicon']) ? esc_attr($nasa_opt['site_favicon']) : ELESSI_THEME_URI . '/favicon.ico'; ?>" />
<?php endif; ?>

<?php wp_head(); ?>  
</head>

<body <?php body_class(); ?>>
<?php do_action('nasa_theme_before_load'); ?>
<div id="wrapper" class="fixNav-enabled">
<div id="header-content" class="site-header">
<?php do_action('nasa_before_header_structure'); ?>
<?php do_action('nasa_header_structure'); ?>
<?php do_action('nasa_after_header_structure'); ?>
</div>

<div id="main-content" class="site-main light">
    