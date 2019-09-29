<?php
if (!function_exists('elessi_product_global_heading')) {
    add_action('init', 'elessi_product_global_heading');
    function elessi_product_global_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Product Global Options", 'elessi-theme'),
            "target" => 'product-global',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => esc_html__("Hover product effect", 'elessi-theme'),
            "desc" => esc_html__("Select if you want change hover product image.", 'elessi-theme'),
            "id" => "animated_products",
            "std" => "hover-fade",
            "type" => "select",
            "options" => array(
                "hover-fade" => esc_html__("Fade", 'elessi-theme'),
                "hover-flip" => esc_html__("Flip Horizontal", 'elessi-theme'),
                "hover-bottom-to-top" => esc_html__("Bottom to top", 'elessi-theme'),
                "" => esc_html__("No effect", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => esc_html__("Catalog Mode", 'elessi-theme'),
            "id" => "disable-cart",
            "desc" => esc_html__("Disable.", 'elessi-theme'),
            "std" => "0",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Icon Mini Cart in Header", 'elessi-theme'),
            "desc" => esc_html__("Select Icon Mini Cart", 'elessi-theme'),
            "id" => "mini-cart-icon",
            "std" => "1",
            "type" => "images",
            "options" => array(
                // icon-nasa-cart-3 - default
                '1' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-1.jpg',
                // icon-nasa-cart-2
                '2' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-2.jpg',
                // icon-nasa-cart-4
                '3' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-3.jpg',
                // pe-7s-cart
                '4' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-4.jpg',
                // fa fa-shopping-cart
                '5' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-5.jpg',
                // fa fa-shopping-bag
                '6' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-6.jpg',
                // fa fa-shopping-basket
                '7' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-7.jpg'
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Icon Add To Cart in Grid", 'elessi-theme'),
            "desc" => esc_html__("Select Add To Cart in Grid", 'elessi-theme'),
            "id" => "cart-icon-grid",
            "std" => "1",
            "type" => "images",
            "options" => array(
                // fa fa-plus - default
                '1' => ELESSI_ADMIN_DIR_URI . 'assets/images/cart-plus.jpg',
                // icon-nasa-cart-3
                '2' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-1.jpg',
                // icon-nasa-cart-2
                '3' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-2.jpg',
                // icon-nasa-cart-4
                '4' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-3.jpg',
                // pe-7s-cart
                '5' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-4.jpg',
                // fa fa-shopping-cart
                '6' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-5.jpg',
                // fa fa-shopping-bag
                '7' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-6.jpg',
                // fa fa-shopping-basket
                '8' => ELESSI_ADMIN_DIR_URI . 'assets/images/mini-cart-7.jpg'
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Hide quickview icon in loop products", 'elessi-theme'),
            "id" => "disable-quickview",
            "desc" => esc_html__("Hide quickview icon in loop products.", 'elessi-theme'),
            "std" => "0",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Style Quickview", 'elessi-theme'),
            "desc" => esc_html__("Style Quickview.", 'elessi-theme'),
            "id" => "style_quickview",
            "std" => "sidebar",
            "type" => "select",
            "options" => array(
                'popup' => esc_html__('Popup Classical', 'elessi-theme'),
                'sidebar' => esc_html__('Sidebar holder', 'elessi-theme')
            ),
            
            'class' => 'nasa-theme-option-parent'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Number Show Quickview Thumbnail", 'elessi-theme'),
            "desc" => esc_html__("Number show thumbnail.", 'elessi-theme'),
            "id" => "quick_view_item_thumb",
            "std" => "1-item",
            "type" => "select",
            "options" => array(
                '1-item' => esc_html__('Single Thumbnail', 'elessi-theme'),
                '2-items' => esc_html__('Double Thumbnails', 'elessi-theme')
            ),
            
            'class' => 'nasa-style_quickview nasa-style_quickview-sidebar nasa-theme-option-child'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Style cart sidebar", 'elessi-theme'),
            "desc" => esc_html__("Style cart sidebar.", 'elessi-theme'),
            "id" => "style-cart",
            "std" => "style-1",
            "type" => "select",
            "options" => array(
                'style-1' => esc_html__('Light', 'elessi-theme'),
                'style-2' => esc_html__('Dark', 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Style wishlist sidebar", 'elessi-theme'),
            "desc" => esc_html__("Style wishlist sidebar.", 'elessi-theme'),
            "id" => "style-wishlist",
            "std" => "style-1",
            "type" => "select",
            "options" => array(
                'style-1' => esc_html__('Light', 'elessi-theme'),
                'style-2' => esc_html__('Dark', 'elessi-theme')
            )
        );
        
        if(defined('YITH_WCPB')) {
            // Enable Gift in grid
            $of_options[] = array(
                "name" => esc_html__("Enable Promotion Gifts featured icon", 'elessi-theme'),
                "desc" => esc_html__("Enable Promotion Gifts featured icon products", 'elessi-theme'),
                "id" => "enable_gift_featured",
                "std" => 1,
                "type" => "checkbox"
            );

            // Enable effect Gift featured
            $of_options[] = array(
                "name" => esc_html__("Enable Promotion Gifts effect featured icon", 'elessi-theme'),
                "desc" => esc_html__("Enable Promotion Gifts effect featured icon.", 'elessi-theme'),
                "id" => "enable_gift_effect",
                "std" => 0,
                "type" => "checkbox"
            );
        }

        // Options live search products
        $of_options[] = array(
            "name" => esc_html__("Enable live search products", 'elessi-theme'),
            "desc" => esc_html__("Enable live search ajax", 'elessi-theme'),
            "id" => "enable_live_search",
            "std" => 1,
            "type" => "checkbox"
        );
        
        // limit_results_search
        $of_options[] = array(
            "name" => esc_html__("Results Ajax search products limit", 'elessi-theme'),
            "id" => "limit_results_search",
            "desc" => esc_html__("Input number limit products ajax search result.", 'elessi-theme'),
            "std" => "5",
            "type" => "text"
        );
        // End Options live search products
        
        $of_options[] = array(
            "name" => esc_html__("Disable ajax Shop", 'elessi-theme'),
            "id" => "disable_ajax_product",
            "desc" => esc_html__("Disable ajax archive product", 'elessi-theme'),
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Disable ajax Shop Progress bar loading", 'elessi-theme'),
            "id" => "disable_ajax_product_progress_bar",
            "desc" => esc_html__("Disable ajax Shop Progress bar loading.", 'elessi-theme'),
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Display top icon filter categories", 'elessi-theme'),
            "desc" => esc_html__("Display top icon filter categories.", 'elessi-theme'),
            "id" => "show_icon_cat_top",
            "std" => "show-in-shop",
            "type" => "select",
            "options" => array(
                'show-in-shop' => esc_html__('Only show in shop', 'elessi-theme'),
                'show-all-site' => esc_html__('Always show all pages', 'elessi-theme'),
                'not-show' => esc_html__('Disabled', 'elessi-theme'),
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Disable top level of categories follow current category archive (Use for Multi stores)", 'elessi-theme'),
            "desc" => esc_html__("Disable", 'elessi-theme'),
            "id" => "disable_top_level_cat",
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Show Uncategorized", 'elessi-theme'),
            "id" => "show_uncategorized",
            "desc" => esc_html__("Show Uncategorized", 'elessi-theme'),
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Disable Viewed products", 'elessi-theme'),
            "id" => "disable-viewed",
            "desc" => esc_html__("Disable Viewed products", 'elessi-theme'),
            "std" => 0,
            "type" => "checkbox"
        );
        
        // limit_product_viewed
        $of_options[] = array(
            "name" => esc_html__("Viewed products limit", 'elessi-theme'),
            "id" => "limit_product_viewed",
            "desc" => esc_html__("Input number limit product viewed.", 'elessi-theme'),
            "std" => "12",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Style viewed icon", 'elessi-theme'),
            "desc" => esc_html__("Style viewed icon.", 'elessi-theme'),
            "id" => "style-viewed-icon",
            "std" => "style-1",
            "type" => "select",
            "options" => array(
                'style-1' => esc_html__('Light', 'elessi-theme'),
                'style-2' => esc_html__('Dark', 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Style viewed sidebar", 'elessi-theme'),
            "desc" => esc_html__("Style viewed sidebar.", 'elessi-theme'),
            "id" => "style-viewed",
            "std" => "style-1",
            "type" => "select",
            "options" => array(
                'style-1' => esc_html__('Light', 'elessi-theme'),
                'style-2' => esc_html__('Dark', 'elessi-theme')
            )
        );
    }
}
