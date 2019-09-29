<?php
/*
 * Get Header builder type
 */
function nasa_get_headers_options() {
    $headers_type = get_posts(array(
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_type' => 'header'
    ));
    $headers_option = array('' => esc_html__("Default", 'nasa-core'));
    if($headers_type) {
        foreach ($headers_type as $value) {
            $headers_option[$value->post_name] = $value->post_title;
        }
    }
    
    return $headers_option;
}

/*
 * Get Footer builder type
 */
function nasa_get_footers_options() {
    $footers_type = get_posts(array(
        'post_status' => 'publish',
        'posts_per_page' => -1,
        'post_type' => 'footer'
    ));
    $footers_option = array('' => esc_html__("Default", 'nasa-core'));
    if($footers_type) {
        foreach ($footers_type as $value) {
            $footers_option[$value->post_name] = $value->post_title;
        }
    }
    
    return $footers_option;
}

/**
 * Get header block
 */
function nasa_get_header_blocks_options() {
    $block_type = get_posts(array(
        'posts_per_page' => -1,
        'post_status' => 'publish',
        'post_type' => 'nasa_block'
    ));
    $header_blocks = array('' => esc_html__("Default", 'nasa-core'));
    if (!empty($block_type)) {
        foreach ($block_type as $value) {
            $header_blocks[$value->post_name] = $value->post_title;
        }
        
        $header_blocks['-1'] = esc_html__('No, thank', 'nasa-core');
    }
    
    return $header_blocks;
}

/**
 * Get menus
 */
function nasa_meta_getListMenus() {
    $menus = wp_get_nav_menus(array('orderby' => 'name'));
    $option_menu = array(
        '' => esc_html__('Default', 'nasa-core')
    );
    foreach ($menus as $menu_option) {
        $option_menu[$menu_option->term_id] = $menu_option->name;
    }
    
    $option_menu['-1'] = esc_html__("Don't show", 'nasa-core');

    return $option_menu;
}

/**
 * Delete cache variations
 * @return boolean
 */
function nasa_del_cache_variations() {
    return Nasa_Caching::delete_cache('products');
}

/**
 * Clear cache variations
 */
add_action('wp_ajax_nasa_clear_all_cache', 'nasa_manual_clear_cache');
function nasa_manual_clear_cache() {
    if(nasa_del_cache_variations()) {
        die('ok');
    }
    
    die('fail');
}

/**
 * Delete cache by product id
 * 
 * @param type $id
 * @return type
 */
function nasa_del_cache_by_product_id($id) {
    return Nasa_Caching::delete_cache_by_key($id, 'products');
}

/**
 * Style | Script in Back End
 */
add_action('admin_enqueue_scripts', 'nasa_admin_style_script_fw');
function nasa_admin_style_script_fw() {
    wp_enqueue_style('nasa_back_end-css', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-style.css');
    wp_enqueue_script('nasa_back_end-script', NASA_CORE_PLUGIN_URL . 'admin/assets/nasa-core-script.js');
    $nasa_core_js = 'var ajax_admin_nasa_core="' . esc_url(admin_url('admin-ajax.php')) . '";';
    wp_add_inline_script('nasa_back_end-script', $nasa_core_js, 'before');
}
