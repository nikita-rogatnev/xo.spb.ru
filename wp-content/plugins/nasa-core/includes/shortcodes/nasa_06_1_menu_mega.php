<?php

add_shortcode('nasa_mega_menu', 'nasa_sc_mega_menu');
function nasa_sc_mega_menu($atts, $content = null) {
    global $nasa_opt;
    
    $dfAttr = array(
        'title' => '',
        'menu' => '',
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
            
            return nasa_shortcode_text('nasa_menu', $atts);
        }

        // Load ajax
        elseif($atts['is_ajax'] == 'yes' && $_REQUEST['nasa_load_ajax'] == '1') {
            extract(shortcode_atts($dfAttr, nasa_shortcode_vars($atts)));
        }
    }
    
    $content = '';
    if ($menu) {
        $nasa_main_menu = wp_nav_menu(array(
            'echo' => false,
            'menu' => $menu,
            'container' => false,
            'items_wrap' => '%3$s',
            'depth' => 3,
            'walker' => new Nasa_Nav_Menu()
        ));
        $content .= '<div class="hide-for-small nasa-nav-sc-mega-menu' . ($el_class != '' ? ' ' . esc_attr($el_class) : '') . '">';
        if ($title) :
            $content .= 
                '<div class="nasa-nav-sc-menu-title">' .
                    '<h5 class="section-title">' .
                        '<span>' . esc_attr($title) . '</span>' .
                    '</h5>' .
                '</div>';
        endif;

        $content .= '<div class="nasa-menus-wrapper-reponsive" data-padding_y="20" data-padding_x="15">';
        $content .= '<div class="nav-wrapper inline-block main-menu-warpper">';
        $content .= '<ul class="header-nav">';
        $content .= $nasa_main_menu;
        $content .= '</ul>';
        $content .= '</div><!-- nav-wrapper -->';
        $content .= '</div><!-- nasa-menus-wrapper-reponsive -->';
        $content .= '</div><!-- nasa-nav-sc-menu -->';
    }
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Mega Menu
// **********************************************************************//
add_action('init', 'nasa_register_mega_menu_shortcode');
function nasa_register_mega_menu_shortcode() {
    $menus = wp_get_nav_menus(array('orderby' => 'name'));
    $option_menu = array(esc_html__("Select menu", 'nasa-core') => '');
    foreach ($menus as $menu_option) {
        $option_menu[$menu_option->name] = $menu_option->slug;
    }

    $params = array(
        "name" => esc_html__("Mega Menu", 'nasa-core'),
        "base" => "nasa_mega_menu",
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Display shortcode mega menu.", 'nasa-core'),
        "category" => 'Header Builder',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Title", 'nasa-core'),
                "param_name" => "title"
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Menu', 'nasa-core'),
                'param_name' => 'menu',
                "value" => $option_menu,
                "description" => esc_html__("Select Menu.", 'nasa-core'),
                "admin_label" => true
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
                "heading" => esc_html__("Extra Class", 'nasa-core'),
                "param_name" => "el_class",
                "description" => esc_html__('If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.', 'nasa-core')
            )
        )
    );
    
    vc_map($params);
}
