<?php

add_shortcode('nasa_products_main', 'nasa_sc_products_main');
function nasa_sc_products_main($atts, $content = null) {
    global $woocommerce, $nasa_opt;
    
    if (!$woocommerce) {
        return $content;
    }
    
    $dfAttr = array(
        'type_main' => 'deals',
        'type_extra' => 'recent_product',
        'cat' => '',
        'style' => 'list',
        'is_ajax' => 'yes',
        'min_height' => 'auto',
        'el_class' => ''
    );
    extract(shortcode_atts($dfAttr, $atts));
    
    // Optimized speed
    if (isset($nasa_opt['enable_optimized_speed']) && $nasa_opt['enable_optimized_speed'] == 1) {
        $atts['is_ajax'] = !isset($atts['is_ajax']) ? $is_ajax : $atts['is_ajax'];
        if (isset($atts['is_ajax']) && $atts['is_ajax'] == 'yes' &&
            (!isset($_REQUEST['nasa_load_ajax']) || $_REQUEST['nasa_load_ajax'] != '1')) {
            
            return nasa_shortcode_text('nasa_products_main', $atts);
        }

        // Load ajax
        elseif($atts['is_ajax'] == 'yes' && $_REQUEST['nasa_load_ajax'] == '1') {
            extract(shortcode_atts($dfAttr, nasa_shortcode_vars($atts)));
        }
    }
    
    if ($type_main == '') {
        return $content;
    }
    
    $type_extra = !isset($type_extra) ? 'recent_product' : $type_extra;
    $main = nasa_woocommerce_query($type_main, 1, $cat);
    
    if ($_total = $main->post_count) :
        $style = 'list';
        $_id = rand();
        $post_notin = array();
        foreach ($main->posts as $item) :
            $post_notin[] = $item->ID;
        endforeach;
        $others = nasa_woocommerce_query($type_extra, 4, $cat, 1, $post_notin);
        $file = NASA_CORE_PRODUCT_LAYOUTS . 'nasa_products_main/products_main_' . $style . '.php';
        
        ob_start();
        ?>
        <div class="woocommerce nasa-sc-main-extra-product<?php echo ($el_class != '') ? ' ' . $el_class : ''; ?>">
            <?php include is_file($file) ? $file : NASA_CORE_PRODUCT_LAYOUTS . 'nasa_products_main/products_main_grid.php'; ?>
        </div>
        <?php
        $content = ob_get_clean();
        wp_reset_postdata();
    endif;
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: nasa products main
// **********************************************************************//
add_action('init', 'nasa_register_products_main');
function nasa_register_products_main(){
    vc_map(array(
        "name" => esc_html__("Products Main Extra", 'nasa-core'),
        "base" => "nasa_products_main",
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Display 1 main and 4 extra products.", 'nasa-core'),
        "class" => "",
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Type main", 'nasa-core'),
                "param_name" => "type_main",
                "std" => 'deals',
                "value" => array(
                    'Product Deals' => 'deals',
                    'Best Selling' => 'best_selling',
                    'Featured Products' => 'featured_product',
                    'Top Rate' => 'top_rate',
                    'Recent Products' => 'recent_product',
                    'On Sale' => 'on_sale',
                    'Recent Review' => 'recent_review'
                ),
                "admin_label" => true,
                "description" => esc_html__("Select type main product to show.", 'nasa-core')
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Type Extra", 'nasa-core'),
                "param_name" => "type_extra",
                "std" => 'recent_product',
                "value" => array(
                    'Product Deals' => 'deals',
                    'Best Selling' => 'best_selling',
                    'Featured Products' => 'featured_product',
                    'Top Rate' => 'top_rate',
                    'Recent Products' => 'recent_product',
                    'On Sale' => 'on_sale',
                    'Recent Review' => 'recent_review'
                ),
                "admin_label" => true,
                "description" => esc_html__("Select type extra product to show.", 'nasa-core')
            ),
            
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Product Category", 'nasa-core'),
                "param_name" => "cat",
                "admin_label" => true,
                "value" => nasa_get_cat_product_array(),
                "description" => esc_html__("Input the category name here.", 'nasa-core')
            ),
            
            /* array(
                "type" => "dropdown",
                "heading" => esc_html__("Style", 'nasa-core'),
                "param_name" => "style",
                "value" => array(
                    esc_html__('Grid', 'nasa-core') => 'grid',
                    esc_html__('List', 'nasa-core') => 'list'
                ),
                'std' => 'grid',
                "admin_label" => true
            ), */
            
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Optimized speed", 'nasa-core'),
                "param_name" => "is_ajax",
                "value" => array(
                    esc_html__('Yes', 'nasa-core') => 'yes',
                    esc_html__('No', 'nasa-core') => 'no'
                ),
                "std" => 'yes',
                "admin_label" => true
            ),
            
            array(
                "type" => "textfield",
                "heading" => esc_html__('Min height (px)', 'nasa-core'),
                "param_name" => "min_height",
                "std" => 'auto',
                "description" => esc_html__('Only use when Optimized speed "Yes"', 'nasa-core')
            ),
            
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    ));
}