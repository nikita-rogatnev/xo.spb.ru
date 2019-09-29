<?php
add_shortcode("nasa_tag_cloud", "nasa_sc_tag_cloud");
function nasa_sc_tag_cloud($atts, $content = null) {
    global $nasa_opt;
    
    $dfAttr = array(
        'number' => 'All',
        'title' => '',
        'parent' => '0',
        'disp_type' => 'product_tag',
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
            
            return nasa_shortcode_text('nasa_tag_cloud', $atts);
        }

        // Load ajax
        elseif($atts['is_ajax'] == 'yes' && $_REQUEST['nasa_load_ajax'] == '1') {
            extract(shortcode_atts($dfAttr, nasa_shortcode_vars($atts)));
        }
    }

    $disp_type = in_array($disp_type, array('product_cat', 'product_tag')) ? $disp_type : 'product_cat';

    $args = array(
        'taxonomy' => $disp_type,
        'echo' => false
    );

    if ((int) $number) {
        $args['number'] = (int) $number;
    }

    $tag_cloud = wp_tag_cloud(apply_filters('widget_tag_cloud_args', $args));
    $el_class = trim($el_class) != '' ? ' ' . esc_attr($el_class) : '';
    $tag_class = ' nasa-tag-cloud';
    $tag_class .= $disp_type == 'product_tag' ? ' nasa-tag-products-cloud' : '';
    
    $content = '<div class="widget_tag_cloud' . $el_class . '">';
    if ($title) {
        $content .= '<div class="row">';
        $content .= '<div class="large-12 columns">';
        $content .= '<h3 class="section-title"><span>' . esc_attr($title) . '</span></h3>';
        $content .= '<div class="nasa-hr full"></div>';
        $content .= '</div>';
        $content .= '</div>';
    }
    $content .= '<div class="tagcloud' . $tag_class . '" data-taxonomy="' . $disp_type . '">' . $tag_cloud . '</div></div>';

    return $content;
}

// **********************************************************************// 
// ! Register New Element: nasa Product Tag Cloud
// **********************************************************************//
add_action('init', 'nasa_register_tagcloud');
function nasa_register_tagcloud(){
    $tag_cloud_params = array(
        "name" => esc_html__("Product tags", 'nasa-core'),
        "base" => "nasa_tag_cloud",
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Display tags cloud (product tag, product categories).", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title text', 'nasa-core'),
                'param_name' => 'title',
                'admin_label' => true,
                'value' => '',
                'description' => esc_html__('What text use as a element title.', 'nasa-core')
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Taxonomy', 'nasa-core'),
                "param_name" => 'disp_type',
                "value" => array(
                    esc_html__('Product Categories', 'nasa-core') => 'product_cat',
                    esc_html__('Product Tags', 'nasa-core') => 'product_tag'
                ),
                "description" => esc_html__('Select source for tag cloud.', 'nasa-core')
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Numbers', 'nasa-core'),
                'param_name' => 'number',
                'value' => 'All',
                'description' => esc_html__('Maximum numbers tag to display (Show all insert "0" or "All")', 'nasa-core')
            ),
            
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
    );
    vc_map($tag_cloud_params);
}