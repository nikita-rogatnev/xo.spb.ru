<?php
if (!function_exists('elessi_product_detail_heading')) {
    add_action('init', 'elessi_product_detail_heading');
    function elessi_product_detail_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Single Product Page", 'elessi-theme'),
            "target" => 'product-detail',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => esc_html__("Single Product Layout", 'elessi-theme'),
            "id" => "product_detail_layout",
            "std" => "new",
            "type" => "select",
            "options" => array(
                "new" => esc_html__("New layout (sidebar - holder)", 'elessi-theme'),
                "classic" => esc_html__("Classic layout (Sidebar - columns)", 'elessi-theme')
            ),
            
            'class' => 'nasa-theme-option-parent'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Images number show", 'elessi-theme'),
            "id" => "product_image_layout",
            "std" => "double",
            "type" => "select",
            "options" => array(
                "double" => esc_html__("Double images", 'elessi-theme'),
                "single" => esc_html__("Single image", 'elessi-theme')
            ),
            
            'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Images style show", 'elessi-theme'),
            "id" => "product_image_style",
            "std" => "slide",
            "type" => "select",
            "options" => array(
                "slide" => esc_html__("Slide images", 'elessi-theme'),
                "scroll" => esc_html__("Scroll images", 'elessi-theme')
            ),
            
            'class' => 'nasa-theme-option-child nasa-product_detail_layout nasa-product_detail_layout-new'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Enable Hover product Zoom", 'elessi-theme'),
            "id" => "product-zoom",
            "desc" => esc_html__("Enable product hover zoom on product detail page", 'elessi-theme'),
            "std" => 1,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Focus main image", 'elessi-theme'),
            "id" => "enable_focus_main_image",
            "desc" => esc_html__("Scroll to main image when active variable product", 'elessi-theme'),
            "std" => "0",
            "type" => "checkbox"
        );

        $of_options[] = array(
            "name" => esc_html__("Product Sidebar", 'elessi-theme'),
            "id" => "product_sidebar",
            "std" => "left",
            "type" => "select",
            "options" => array(
                "left" => esc_html__("Left Sidebar", 'elessi-theme'),
                "right" => esc_html__("Right Sidebar", 'elessi-theme'),
                "no" => esc_html__("No sidebar", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Enable Deal Time", 'elessi-theme'),
            "id" => "single-product-deal",
            "desc" => esc_html__("Enable deal on single product page", 'elessi-theme'),
            "std" => 1,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Buy Now", 'elessi-theme'),
            "id" => "enable_buy_now",
            "desc" => esc_html__("Buy Now product", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Buy Now Background Color", 'elessi-theme'),
            "desc" => esc_html__("Change Buy Now Background Color.", 'elessi-theme'),
            "id" => "buy_now_bg_color",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Buy Now Background Color Hover", 'elessi-theme'),
            "desc" => esc_html__("Change Buy Now Background Color Hover.", 'elessi-theme'),
            "id" => "buy_now_bg_color_hover",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Buy Now Shadow Color", 'elessi-theme'),
            "desc" => esc_html__("Change Buy Now Shadow Color.", 'elessi-theme'),
            "id" => "buy_now_color_shadow",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Quick Buy Add To Cart", 'elessi-theme'),
            "id" => "enable_fixed_add_to_cart",
            "desc" => esc_html__("Fixed Add To Cart In Bottom", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Stock Process Bar", 'elessi-theme'),
            "id" => "enable_progess_stock",
            "desc" => esc_html__("Show Stock with Process Bar", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Enable Technical Specifications", 'elessi-theme'),
            "id" => "enable_specifications",
            "desc" => esc_html__("Enable Technical Specifications", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );

        $of_options[] = array(
            "name" => esc_html__("Show the Specifications in the Desciption tab", 'elessi-theme'),
            "id" => "merge_specifi_to_desc",
            "desc" => esc_html__("Show the Specifications in the Desciption tab", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Tabs style", 'elessi-theme'),
            "id" => "tab_style_info",
            "std" => "2d-no-border",
            "type" => "select",
            "options" => array(
                "2d-no-border" => esc_html__("Classic 2D - No border", 'elessi-theme'),
                "2d" => esc_html__("Classic 2D", 'elessi-theme'),
                "3d" => esc_html__("Classic 3D", 'elessi-theme'),
                "slide" => esc_html__("Slide", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Tabs align", 'elessi-theme'),
            "id" => "tab_align_info",
            "std" => "center",
            "type" => "select",
            "options" => array(
                "center" => esc_html__("Center", 'elessi-theme'),
                "left" => esc_html__("Left", 'elessi-theme'),
                "right" => esc_html__("Right", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Number for relate products", 'elessi-theme'),
            "id" => "release_product_number",
            "std" => "12",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Columns Relate | Upsell Products", 'elessi-theme'),
            "id" => "relate_columns_desk",
            "std" => "5-cols",
            "type" => "select",
            "options" => array(
                "3-cols" => esc_html__("3 columns", 'elessi-theme'),
                "4-cols" => esc_html__("4 columns", 'elessi-theme'),
                "5-cols" => esc_html__("5 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Columns Relate | Upsell Products for Mobile", 'elessi-theme'),
            "id" => "relate_columns_small",
            "std" => "1-col",
            "type" => "select",
            "options" => array(
                "1-cols" => esc_html__("1 column", 'elessi-theme'),
                "2-cols" => esc_html__("2 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Columns Relate | Upsell Products for Tablet", 'elessi-theme'),
            "id" => "relate_columns_tablet",
            "std" => "3-cols",
            "type" => "select",
            "options" => array(
                "1-col" => esc_html__("1 column", 'elessi-theme'),
                "2-cols" => esc_html__("2 columns", 'elessi-theme'),
                "3-cols" => esc_html__("3 columns", 'elessi-theme')
            )
        );
        
        // Enable AJAX add to cart buttons on Detail OR Quickview
        $of_options[] = array(
            "name" => esc_html__("Enable AJAX add to cart button on Detail And Quickview", 'elessi-theme'),
            "id" => "enable_ajax_addtocart",
            "desc" => esc_html__("Enable AJAX add to cart button on Detail And Quickview", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
    }
}
