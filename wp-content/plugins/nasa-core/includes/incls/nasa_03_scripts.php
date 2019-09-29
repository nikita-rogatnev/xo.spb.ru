<?php
/**
 * Send headers for Ajax Requests.
 */
function nasa_ajax_headers() {
    send_origin_headers();
    @header('Content-Type: text/html; charset=' . get_option('blog_charset'));
    @header('X-Robots-Tag: noindex');
    send_nosniff_header();
    wc_nocache_headers();
    status_header(200);
}

/**
 * Shop Ajax loadMore
 * ========================================================================
 */
// add_action('wp_ajax_nasa_more_product', 'nasa_loadmore_products');
// add_action('wp_ajax_nopriv_nasa_more_product', 'nasa_loadmore_products');
function nasa_loadmore_products() {
    nasa_ajax_headers();
    $type = $_REQUEST['type'];
    $post_per_page = $_REQUEST['post_per_page'];
    $page = $_REQUEST['page'];
    $cat = (isset($_REQUEST['cat']) && $_REQUEST['cat'] != '') ? $_REQUEST['cat'] : null;
    $is_deals = $_REQUEST['is_deals'];
    $columns_number = $_REQUEST['columns_number'];
    $columns_number_tablet = $_REQUEST['columns_number_medium'];
    $columns_number_small = $_REQUEST['columns_number_small'];

    $loop = nasa_woocommerce_query($type, $post_per_page, $cat, $page);
    if ($loop->found_posts):
        global $nasa_opt;
        $start_row = $end_row = '';
        include NASA_CORE_PRODUCT_LAYOUTS . 'globals/row_layout.php';
    endif;
    wp_reset_postdata();
    
    die();
}

/**
 * Shortcode load Ajax All
 */
add_action('wp_ajax_nasa_load_ajax_all', 'nasa_load_sc_ajax_all');
add_action('wp_ajax_nopriv_nasa_load_ajax_all', 'nasa_load_sc_ajax_all');
function nasa_load_sc_ajax_all() {
    nasa_ajax_headers();
    
    if (!isset($_REQUEST['shortcode']) || empty($_REQUEST['shortcode'])) {
        die('');
    }
    
    $result = array();
    foreach ($_REQUEST['shortcode'] as $key => $shortcode) {
        $result[$key] = do_shortcode($shortcode);
    }
    
    die(json_encode($result));
}

/**
 * Short code load Ajax item
 */
add_action('wp_ajax_nasa_load_ajax_item', 'nasa_load_sc_ajax');
add_action('wp_ajax_nopriv_nasa_load_ajax_item', 'nasa_load_sc_ajax');
function nasa_load_sc_ajax() {
    nasa_ajax_headers();
    
    if (!isset($_REQUEST['shortcode']) || empty($_REQUEST['shortcode']) || !isset($_REQUEST['shortcode_name']) || empty($_REQUEST['shortcode_name'])) {
        die();
    }
    
    $result = shortcode_exists($_REQUEST['shortcode_name']) ? do_shortcode($_REQUEST['shortcode']) : '';
    
    die($result);
}

// **********************************************************************//
//	Support Multi currency - AJAX
// **********************************************************************//
if(class_exists('WCML_Multi_Currency')) :
    add_filter('wcml_multi_currency_ajax_actions', 'nasa_multi_currency_ajax', 10, 1);
    if(!function_exists('nasa_multi_currency_ajax')) :
        function nasa_multi_currency_ajax($ajax_actions) {
            return nasa_ajax_actions($ajax_actions);
        }
    endif;
endif;

/**
 * Register Ajax Actions
 * 
 * @param type $ajax_actions
 * @return string
 */
function nasa_ajax_actions($ajax_actions = array()) {
    // $ajax_actions[] = 'nasa_more_product';
    $ajax_actions[] = 'nasa_load_ajax_all';
    $ajax_actions[] = 'nasa_load_ajax_item';

    return $ajax_actions;
}
