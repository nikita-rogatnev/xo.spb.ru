<?php

// add_shortcode('nasa_feedburner_subscription', 'nasa_feedburner_subscription_shortcode');
if (!function_exists('nasa_feedburner_subscription_shortcode')) {

    function nasa_feedburner_subscription_shortcode($atts, $content = null) {
        extract(shortcode_atts(array(
            'title' => 'Newsletter',
            'intro_text' => '',
            'intro_text_2' => '',
            'button_text' => 'Subscribe',
            'placeholder_text' => 'Enter your email address',
            'feedburner_id' => '',
            'style' => 'style-1',
            'el_class' => ''
        ), $atts));

        if (!class_exists('Nasa_Feedburner_Subscription_Widget')) {
            return $content;
        }

        $instance = compact('title', 'intro_text', 'intro_text_2', 'button_text', 'placeholder_text', 'feedburner_id');

        ob_start();
        echo '<div class="nasa-feedburner-subscription-shortcode ' . $style . ' ' . $el_class . '">';
        the_widget('Nasa_Feedburner_Subscription_Widget', $instance);
        echo '</div>';

        return ob_get_clean();
    }

}

// **********************************************************************// 
// ! Register New Element: nasa Feedburner Subscription - nasa Newsletter
// **********************************************************************//
// add_action('init', 'nasa_register_feedburner_subscription');
function nasa_register_feedburner_subscription(){
    $feedburner_subcription = array(
        'name' => esc_html__('Feedburner', 'nasa-core'),
        'base' => 'nasa_feedburner_subscription',
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Feedburner Subscription.", 'nasa-core'),
        'class' => '',
        'category' => 'Nasa Core',
        'params' => array(
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Feedburner ID', 'nasa-core'),
                'param_name' => 'feedburner_id',
                'admin_label' => true,
                'value' => '',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Title', 'nasa-core'),
                'param_name' => 'title',
                'admin_label' => true,
                'value' => 'Newsletter',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Intro Text Line 1', 'nasa-core'),
                'param_name' => 'intro_text',
                'admin_label' => true,
                'value' => '',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Intro Text Line 2', 'nasa-core'),
                'param_name' => 'intro_text_2',
                'admin_label' => true,
                'value' => '',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Button Text', 'nasa-core'),
                'param_name' => 'button_text',
                'admin_label' => true,
                'value' => 'Subscribe',
                'description' => ''
            ),
            array(
                'type' => 'textfield',
                'heading' => esc_html__('Placeholder Text', 'nasa-core'),
                'param_name' => 'placeholder_text',
                'admin_label' => true,
                'value' => 'Enter your email address',
                'description' => ''
            ),
            array(
                'type' => 'dropdown',
                'heading' => esc_html__('Style', 'nasa-core'),
                'param_name' => 'style',
                'admin_label' => false,
                'value' => array(
                    'Style 1' => 'style-1',
                    'Style 2' => 'style-2',
                    'Style 3' => 'style-3'
                ),
                'description' => ''
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra Class", 'nasa-core'),
                "param_name" => "el_class"
            )
        )
    );
    vc_map($feedburner_subcription);
}