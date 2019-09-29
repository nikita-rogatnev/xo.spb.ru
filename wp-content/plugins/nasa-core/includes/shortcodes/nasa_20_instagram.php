<?php
add_shortcode('nasa_instagram', 'nasa_sc_instagram');
/**
 * INSTAGRAM
 */
function nasa_sc_instagram($atts, $content = null) {
    extract(shortcode_atts(array(
        'photos' => '10',
        'username' => '',
        'username_show' => '',
        'instagram_text' => '',
        'el_class' => ''
    ), $atts));
    
    // echo $photos; die;

    if (class_exists('Nasa_Instagram')) {
        $content = '<div class="nasa-intagram-wrap' . ($el_class != '' ? ' ' . $el_class : '') . '">';
        $content .= '<div class="nasa-instagram items-' . $photos . ' ' . $el_class . '"><div class="username-text text-center hide-for-small"><i class="fa fa-instagram"></i><span>' . $username_show . '</span> ' . $instagram_text . ' </div>';
        
        $instagram = new Nasa_Instagram(
            array(
                'username' => trim($username),
                'target' => '_blank',
                'number' => $photos,
            )
        );
        
        $content .= $instagram->outPut();
        
        $content .= '</div></div>';
    }
    
    return $content;
}

add_action('init', 'nasa_register_instagram');
function nasa_register_instagram(){
    // **********************************************************************// 
    // ! Register New Element: Instagram
    // **********************************************************************//
    $instagram_params = array(
        "name" => esc_html__("Instagram", 'nasa-core'),
        'base' => 'nasa_instagram',
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Create info Instagram.", 'nasa-core'),
        'category' => 'Nasa Core',
        'params' => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("User name", 'nasa-core'),
                "param_name" => "username",
                "value" => "",
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("User name for display show", 'nasa-core'),
                "param_name" => "username_show",
                "value" => "",
                "admin_label" => true,
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Text display", 'nasa-core'),
                "param_name" => "instagram_text",
                "value" => "",
                "admin_label" => true,
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Picture numbers", 'nasa-core'),
                "param_name" => "photos",
                "value" => array(
                    esc_html__('4', 'nasa-core') => '4',
                    esc_html__('5', 'nasa-core') => '5',
                    esc_html__('6', 'nasa-core') => '6',
                    esc_html__('7', 'nasa-core') => '7',
                    esc_html__('8', 'nasa-core') => '8',
                    esc_html__('9', 'nasa-core') => '9',
                    esc_html__('10', 'nasa-core') => '10'
                ),
                "admin_label" => true,
                'std' => '10'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'nasa-core'),
                "param_name" => "el_class"
            )
        )
    );
    
    vc_map($instagram_params);
}
