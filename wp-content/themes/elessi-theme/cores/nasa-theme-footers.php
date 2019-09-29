<?php

// **********************************************************************// 
// ! Footer Main
// **********************************************************************//
add_action('nasa_get_footer_theme', 'elessi_get_footer_theme');
if(!function_exists('elessi_get_footer_theme')) :
    function elessi_get_footer_theme() {
        global $nasa_opt;

        $file = ELESSI_CHILD_PATH . '/footers/footer-main.php';
        include_once is_file($file) ? $file : ELESSI_THEME_PATH . '/footers/footer-main.php';
    }
endif;

// **********************************************************************// 
// ! Footer Type
// **********************************************************************//
add_action('nasa_footer_layout_style', 'elessi_footer_layout_style_function');
if(!function_exists('elessi_footer_layout_style_function')) :
    function elessi_footer_layout_style_function() {
        global $nasa_opt, $wp_query, $nasa_root_term_id;
        
        $footer_slug = isset($nasa_opt['footer-type']) && $nasa_opt['footer-type'] != '' ? $nasa_opt['footer-type'] : '';
        
        $page_id = false;
        $footer_override = false;
        
        /*
         * Override Header
         */
        $is_product = is_product();
        $is_product_cat = is_product_category();
        $is_product_taxonomy = is_product_taxonomy();
        $is_shop = is_shop();
        $pageShop = wc_get_page_id('shop');
        if($is_shop || $is_product_cat || $is_product_taxonomy || $is_product) {
            $term_id = false;

            /**
             * Check Single product
             */
            if($is_product) {
                if(!$nasa_root_term_id) {
                    $product_cats = get_the_terms($wp_query->get_queried_object_id(), 'product_cat');
                    if($product_cats) {
                        foreach ($product_cats as $cat) {
                            $term_id = $cat->term_id;
                            break;
                        }
                    }
                } else {
                    $term_id = $nasa_root_term_id;
                }
            }

            /**
             * Check Category product
             */
            elseif($is_product_cat) {
                $query_obj = $wp_query->get_queried_object();
                $term_id = isset($query_obj->term_id) ? $query_obj->term_id : false;
            }

            if($term_id) {
                $footer_override = get_term_meta($term_id, 'cat_footer_type', true);

                if(!$footer_override) {
                    if($nasa_root_term_id) {
                        $term_id = $nasa_root_term_id;
                    } else {
                        $ancestors = get_ancestors($term_id, 'product_cat');
                        $term_id = $ancestors ? end($ancestors) : 0;
                        $GLOBALS['nasa_root_term_id'] = $term_id;
                    }
                    
                    if($term_id) {
                        $footer_override = get_term_meta($term_id, 'cat_footer_type', true);
                    }
                }
            }

            /**
             * Check shop page
             */
            elseif($pageShop > 0) {
                $page_id = $pageShop;
            }
        }
        
        /**
         * Page
         */
        elseif(!$page_id) {
            $page_id = $wp_query->get_queried_object_id();
        }
        
        /**
         * Swith header structure
         */
        if($page_id) {
            $footer_override = get_post_meta($page_id, '_nasa_custom_footer', true);
        }
        
        if ($footer_override) {
            $footer_slug = $footer_override;
        }
        
        $args = array(
            'posts_per_page' => 1,
            'post_type' => 'footer',
            'post_status' => 'publish'
        );
        if($footer_slug) {
            $args['name'] = $footer_slug;
        }
        
        $footers_type = get_posts($args);
        $footer = isset($footers_type[0]) ? $footers_type[0] : null;
        $footer_id = isset($footer->ID) ? (int) $footer->ID : null;
        $footer_pageID = $footer_id;

        if (class_exists('SitePress') && function_exists('icl_object_id') && (int) $footer_id) {
            $footer_langID = icl_object_id($footer_id, 'footer', true);
            if($footer_langID && $footer_langID != $footer_id) {
                $footerLang = get_post($footer_langID);
                $footer = $footerLang && $footerLang->post_status == 'publish' ? $footerLang : $footer;
                $footer_pageID = $footer_langID;
            }
        }
        
        if($footer_pageID) {
            $shortcodes_custom_css = get_post_meta($footer_pageID, '_wpb_shortcodes_custom_css', true);
            if (!empty($shortcodes_custom_css)) {
                $shortcodes_custom_css = strip_tags($shortcodes_custom_css);
                echo '<style type="text/css" data-type="vc_shortcodes-custom-css">';
                echo $shortcodes_custom_css;
                echo '</style>';
            }
        }

        /**
         * get_template_part('footers/default');
         */
        echo ($footer && isset($footer->post_content)) ? do_shortcode($footer->post_content) : '';
    }
endif;

/**
 * Footer run static content
 */
add_action('wp_footer', 'elessi_run_static_content', 9);
if (!function_exists('elessi_run_static_content')) :
    function elessi_run_static_content() {
        do_action('nasa_static_content');
    }
endif;

// **********************************************************************// 
// elessi_static_content_before
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_content_before', 10);
if (!function_exists('elessi_static_content_before')) :
    function elessi_static_content_before() {
        echo '<a href="javascript:void(0);" id="nasa-back-to-top" data-wow="bounceIn" class="wow bounceIn hidden-tag"><i class="pe-7s-angle-up"></i></a>';
        
        echo '<!-- Start static content -->' .
            '<div class="static-position">' .
                '<div class="nasa-check-reponsive nasa-desktop-check"></div>' .
                '<div class="nasa-check-reponsive nasa-taplet-check"></div>' .
                '<div class="nasa-check-reponsive nasa-mobile-check"></div>' .
                '<div class="nasa-check-reponsive nasa-switch-check"></div>' .
                '<div class="black-window hidden-tag"></div>' .
                '<div class="white-window hidden-tag"></div>' .
                '<div class="transparent-window hidden-tag"></div>' .
                '<div class="transparent-mobile hidden-tag"></div>' .
                '<div class="black-window-mobile"></div>';
    }
endif;

// **********************************************************************// 
// elessi_static_content_after
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_content_after', 999);
if (!function_exists('elessi_static_content_after')) :
    function elessi_static_content_after() {
        echo '</div><!-- End static content -->';
    }
endif;

// **********************************************************************// 
// elessi_static_for_mobile
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_for_mobile', 12);
if (!function_exists('elessi_static_for_mobile')) :

    function elessi_static_for_mobile() {
        global $nasa_opt;
        ?>
        <div class="warpper-mobile-search hidden-tag">
            <!-- for mobile -->
            <?php
            $search_form_file = ELESSI_CHILD_PATH . '/includes/nasa-mobile-product-searchform.php';
            include is_file($search_form_file) ? $search_form_file : ELESSI_THEME_PATH . '/includes/nasa-mobile-product-searchform.php';
            ?>
        </div>

        <div id="heading-menu-mobile" class="hidden-tag">
            <i class="fa fa-bars"></i><?php esc_html_e('Navigation','elessi-theme'); ?>
        </div>
        
        <?php if(!isset($nasa_opt['hide_tini_menu_acc']) || !$nasa_opt['hide_tini_menu_acc']) : ?>
            <div id="mobile-account" class="hidden-tag">
                <?php
                $mobile_acc_file = ELESSI_CHILD_PATH . '/includes/nasa-mobile-account.php';
                include is_file($mobile_acc_file) ? $mobile_acc_file : ELESSI_THEME_PATH . '/includes/nasa-mobile-account.php'; ?>
            </div>
        <?php endif;
    }

endif;

// **********************************************************************// 
// elessi_static_cart_sidebar
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_cart_sidebar', 13);
if (!function_exists('elessi_static_cart_sidebar')) :

    function elessi_static_cart_sidebar() {
        global $nasa_opt;
        if (!NASA_WOO_ACTIVED || (isset($nasa_opt['disable-cart']) && $nasa_opt['disable-cart'])) {
            return;
        }
        
        $nasa_cart_style = isset($nasa_opt['style-cart']) ? esc_attr($nasa_opt['style-cart']) : 'style-1'; ?>
        <div id="cart-sidebar" class="nasa-static-sidebar hidden-tag <?php echo esc_attr($nasa_cart_style); ?>">
            <div class="nasa-cart-fog hidden-tag"></div>
            <div class="cart-close nasa-sidebar-close">
                <h3 class="nasa-tit-mycart nasa-sidebar-tit"><?php echo esc_html__('My Cart', 'elessi-theme'); ?></h3>
                <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>"><?php esc_html_e('Close','elessi-theme'); ?></a>
                <hr />
            </div>
            
            <div class="widget_shopping_cart_content cart_sidebar"></div>
            
            <?php // echo elessi_loader_html('nasa-cart-sidebar-content'); ?>
            <?php if(isset($_REQUEST['nasa_cart_sidebar']) && $_REQUEST['nasa_cart_sidebar'] == 1) : ?>
                <input type="hidden" name="nasa_cart_sidebar_show" value="1" />
            <?php endif; ?>
        </div>
        <?php
    }

endif;

// **********************************************************************// 
// elessi_static_wishlist_sidebar
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_wishlist_sidebar', 14);
if (!function_exists('elessi_static_wishlist_sidebar')) :

    function elessi_static_wishlist_sidebar() {
        if (!NASA_WOO_ACTIVED || !NASA_WISHLIST_ENABLE) {
            return;
        }
        
        global $nasa_opt;
        $nasa_wishlist_style = isset($nasa_opt['style-wishlist']) ? esc_attr($nasa_opt['style-wishlist']) : 'style-1'; ?>
        <div id="nasa-wishlist-sidebar" class="nasa-static-sidebar hidden-tag <?php echo esc_attr($nasa_wishlist_style); ?>">
            <div class="nasa-wishlist-fog hidden-tag"></div>
            <div class="wishlist-close nasa-sidebar-close">
                <h3 class="nasa-tit-wishlist nasa-sidebar-tit"><?php echo esc_html__('Wishlist', 'elessi-theme'); ?></h3>
                <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>"><?php esc_html_e('Close', 'elessi-theme'); ?></a>
                <hr />
            </div>
            
            <?php echo elessi_loader_html('nasa-wishlist-sidebar-content'); ?>
        </div>
        <?php
    }

endif;

// **********************************************************************// 
// elessi_static_viewed_sidebar
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_viewed_sidebar', 15);
if (!function_exists('elessi_static_viewed_sidebar')) :

    function elessi_static_viewed_sidebar() {
        global $nasa_opt;
        if (!defined('NASA_COOKIE_VIEWED') || !NASA_WOO_ACTIVED || (isset($nasa_opt['disable-viewed']) && $nasa_opt['disable-viewed'])) {
            return;
        } ?>
        
        <?php $nasa_viewed_icon = isset($nasa_opt['style-viewed-icon']) ? esc_attr($nasa_opt['style-viewed-icon']) : 'style-1'; ?>
        <a id="nasa-init-viewed" class="<?php echo esc_attr($nasa_viewed_icon); ?>" href="javascript:void(0);" title="<?php esc_attr_e('Products viewed', 'elessi-theme'); ?>">
            <i class="pe-icon pe-7s-clock"></i>
            <span class="nasa-init-viewed-text"><?php esc_html_e('Viewed', 'elessi-theme'); ?></span>
        </a>
    
        <?php $nasa_viewed_style = isset($nasa_opt['style-viewed']) ? esc_attr($nasa_opt['style-viewed']) : 'style-1'; ?>
        <!-- viewed product -->
        <div id="nasa-viewed-sidebar" class="nasa-static-sidebar hidden-tag <?php echo esc_attr($nasa_viewed_style); ?>">
            <div class="viewed-close nasa-sidebar-close">
                <h3 class="nasa-tit-viewed nasa-sidebar-tit"><?php echo esc_html__("Recently Viewed", 'elessi-theme'); ?></h3>
                <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>"><?php esc_html_e('Close', 'elessi-theme'); ?></a>
                <hr />
            </div>
            
            <?php echo elessi_loader_html('nasa-viewed-sidebar-content'); ?>
        </div>
        <?php
    }

endif;

// **********************************************************************// 
// elessi_static_login_register
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_login_register', 16);
if (!function_exists('elessi_static_login_register')) :

    function elessi_static_login_register() {
        global $nasa_opt;
        
        if(!NASA_CORE_USER_LOGIGED && shortcode_exists('woocommerce_my_account') && (!isset($nasa_opt['login_ajax']) || $nasa_opt['login_ajax'] == 1)) : ?>
            <div class="nasa-login-register-warper hidden-tag">
                <div id="nasa-login-register-form">
                    <div class="nasa-form-logo-log nasa-no-fix-size-retina">
                        <?php echo elessi_logo(); ?>
                    </div>

                    <div class="login-register-close">
                        <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>"><i class="pe-7s-angle-up"></i></a>
                    </div>
                    <div class="nasa-message"></div>
                    <div class="nasa-form-content">
                        <?php echo elessi_loader_html('nasa_customer_login'); ?>
                    </div>
                </div>
            </div>
        <?php
        endif;
    }

endif;

// **********************************************************************// 
// elessi_static_quick_sidebar
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_quickview_sidebar', 16);
if (!function_exists('elessi_static_quickview_sidebar')) :

    function elessi_static_quickview_sidebar() {
        global $nasa_opt;
        if ((isset($nasa_opt['style_quickview']) && $nasa_opt['style_quickview'] == 'sidebar') || (isset($_GET['quickview']) && $_GET['quickview'] == 'sidebar')) : ?>
        <div id="nasa-quickview-sidebar" class="nasa-static-sidebar hidden-tag style-1">
            <div class="nasa-quickview-fog hidden-tag"></div>
            <div class="quickview-close nasa-sidebar-close hidden-tag">
                <h3 class="nasa-tit-quickview"><?php echo esc_html__('Quickview', 'elessi-theme'); ?></h3>
                <a href="javascript:void(0);" title="<?php esc_attr_e('Close', 'elessi-theme'); ?>"><?php esc_html_e('Close', 'elessi-theme'); ?></a>
                <hr />
            </div>
            
            <?php echo elessi_loader_html('nasa-quickview-sidebar-content', false); ?>
        </div>
        <?php
        endif;
    }

endif;

// **********************************************************************// 
// elessi_static_compare_sidebar
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_compare_sidebar', 17);
if (!function_exists('elessi_static_compare_sidebar')) :

    function elessi_static_compare_sidebar() { ?>
        <div class="nasa-compare-list-bottom">
            <div id="nasa-compare-sidebar-content" class="nasa-relative">
                <div class="nasa-loader"></div>
            </div>
            <p class="nasa-compare-mess nasa-compare-success hidden-tag"></p>
            <p class="nasa-compare-mess nasa-compare-exists hidden-tag"></p>
        </div>
        <?php
    }

endif;

// **********************************************************************// 
// elessi_static_menu_vertical_mobile
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_menu_vertical_mobile', 19);
if (!function_exists('elessi_static_menu_vertical_mobile')) :

    function elessi_static_menu_vertical_mobile() { ?>
        <div id="nasa-menu-sidebar-content">
            <div class="nasa-mobile-nav-wrap">
                <div id="mobile-navigation" class="nasa-loader"></div>
            </div>
        </div>
        <?php
    }

endif;

// **********************************************************************// 
// Top Categories filter
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_top_cat_filter', 20);
if (!function_exists('elessi_static_top_cat_filter')) :

    function elessi_static_top_cat_filter() {
        ?>
        <div class="nasa-top-cat-filter-wrap-mobile">
            <h3 class="nasa-tit-filter-cat"><?php echo esc_html__("Categories", 'elessi-theme'); ?></h3>
            
            <div id="nasa-mobile-cat-filter">
                <div class="nasa-loader"></div>
            </div>
            <?php // echo elessi_get_all_categories(); ?>
            <a href="javascript:void(0);" title="<?php esc_attr_e('Close categories filter', 'elessi-theme'); ?>" class="nasa-close-filter-cat"><i class="pe-7s-close"></i></a>
        </div>
        <?php
    }

endif;

// **********************************************************************// 
// elessi_static_config_info
// **********************************************************************//
add_action('nasa_static_content', 'elessi_static_config_info', 21);
if (!function_exists('elessi_static_config_info')) :

    function elessi_static_config_info() {
        global $nasa_opt, $loadmoreStyle;
        
        if(isset($_REQUEST['paging-style']) && in_array($_REQUEST['paging-style'], $loadmoreStyle)) {
            echo '<input type="hidden" name="nasa_loadmore_style" value="' . $_REQUEST['paging-style'] . '" />';
        }
        
        if (!isset($nasa_opt['enable_fixed_add_to_cart']) || $nasa_opt['enable_fixed_add_to_cart']) {
            echo '<input type="hidden" name="nasa_fixed_single_add_to_cart" value="1" />';
        }
        ?>
        
        <input type="hidden" name="nasa_currency_pos" value="<?php echo get_option('woocommerce_currency_pos'); ?>" />
        <input type="hidden" name="nasa_logout_menu" value="<?php echo wp_logout_url(get_home_url()); ?>" />

        <!-- Enable countdown -->
        <input type="hidden" name="nasa-count-down-enable" value="1" />

        <!-- Enable WOW -->
        <input type="hidden" name="nasa-enable-wow" value="<?php echo (!isset($nasa_opt['disable_wow']) || !$nasa_opt['disable_wow']) ? '1' : '0'; ?>" />

        <!-- Enable Portfolio -->
        <input type="hidden" name="nasa-enable-portfolio" value="<?php echo (isset($nasa_opt['enable_portfolio']) && $nasa_opt['enable_portfolio'] == 1) ? '1' : '0'; ?>" />

        <!-- Enable gift effect -->
        <input type="hidden" name="nasa-enable-gift-effect" value="<?php echo (isset($nasa_opt['enable_gift_effect']) && $nasa_opt['enable_gift_effect'] == 1) ? '1' : '0'; ?>" />
        
        <!-- Enable focus main image -->
        <input type="hidden" name="nasa-enable-focus-main-image" value="<?php echo (isset($nasa_opt['enable_focus_main_image']) && $nasa_opt['enable_focus_main_image'] == 1) ? '1' : '0'; ?>" />
        
        <!-- Select option to quickview -->
        <input type="hidden" name="nasa-disable-quickview-ux" value="<?php echo (isset($nasa_opt['disable-quickview']) && $nasa_opt['disable-quickview'] == 1) ? '1' : '0'; ?>" />

        <!-- optimized type load -->
        <input type="hidden" name="nasa-optimized-type" value="<?php echo isset($nasa_opt['optimized_type']) ? $nasa_opt['optimized_type'] : 'sync'; ?>" />
        
        <!-- Close popup string -->
        <input type="hidden" name="nasa-close-string" value="<?php echo esc_attr__('Close (Esc)', 'elessi-theme'); ?>" />

        <p class="hidden-tag" id="nasa-empty-result-search"><?php esc_html_e('Sorry. No results match your search.', 'elessi-theme'); ?></p>

        <?php
        $shop_url   = NASA_WOO_ACTIVED ? wc_get_page_permalink('shop') : '';
        $base_url   = home_url('/');
        $friendly   = preg_match('/\?post_type\=/', $shop_url) ? '0' : '1';
        if(preg_match('/\?page_id\=/', $shop_url)){
            $friendly = '0';
            $shop_url = $base_url . '?post_type=product';
        }
        
        echo '<input type="hidden" name="nasa-shop-page-url" value="' . esc_url($shop_url) . '" />';
        echo '<input type="hidden" name="nasa-base-url" value="' . esc_url($base_url) . '" />';
        echo '<input type="hidden" name="nasa-friendly-url" value="' . esc_attr($friendly) . '" />';
        
        if (defined('NASA_PLG_CACHE_ACTIVE') && NASA_PLG_CACHE_ACTIVE) :
            echo '<input type="hidden" name="nasa-caching-enable" value="1" />';
        endif;
        
        echo
        '<script type="text/template" id="tmpl-variation-template-nasa">
            <div class="woocommerce-variation-description">{{{data.variation.variation_description}}}</div>
            <div class="woocommerce-variation-price">{{{data.variation.price_html}}}</div>
            <div class="woocommerce-variation-availability">{{{data.variation.availability_html}}}</div>
        </script>
        <script type="text/template" id="tmpl-unavailable-variation-template-nasa">
            <p>' . esc_html__('Sorry, this product is unavailable. Please choose a different combination.', 'elessi-theme') . '</p>
        </script>';
    }

endif;
