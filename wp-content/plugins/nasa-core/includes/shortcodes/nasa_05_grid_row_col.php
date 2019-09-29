<?php

// add_shortcode('nasa_row', 'nasa_sc_rows');
// add_shortcode('nasa_col', 'nasa_sc_cols');
function nasa_sc_rows($atts, $content = null) {
    extract(shortcode_atts(array(
        'style' => '',
        'margin' => '',
        'padding' => ''
    ), $atts));

    $css = array();
    if($margin != '') {
        $margin = is_numeric($margin) ? $margin . 'px' : $margin;
        $css[] = 'margin-top:' . $margin . '!important;margin-bottom:' . $margin . '!important';
    }
    
    if($padding != '') {
        $padding = is_numeric($padding) ? $padding . 'px' : $padding;
        $css[] = 'padding-left: ' . $padding . ' !important; padding-right: ' . $padding . ' !important';
    }
    
    $css_string = !empty($css) ? ' style="' . implode('; ', $css) . '"' : '';
    $style = $style != '' ? ' ' . $style : '';
    
    return '<div class="row container' . $style . '"' . $css_string . '>' . do_shortcode($content) . '</div>';
}

function nasa_sc_cols($atts, $content = null) {
    extract(shortcode_atts(array(
        'span' => '1/4',
        'animate' => '',
    ), $atts));

    switch ($span) {
        case "1/1":
            $span = "12";
            break;
        
        case "1/2":
        case "2/4":
        case "3/6":
        case "6/12":
            $span = '6';
            break;
        
        case "3/4":
        case "9/12":
            $span = '9';
            break;
        
        case "1/3":
        case "2/6":
        case "4/12":
            $span = '4';
            break;
        
        case "2/3":
        case "4/6":
        case "8/12":
            $span = '8';
            break;
        
        case "1/6":
            $span = '2';
            break;
        
        case "5/6":
            $span = '10';
            break;
        
        case "1/12":
            $span = '1';
            break;
        
        case "2/12":
            $span = '2';
            break;
        
        case "5/12":
            $span = '5';
            break;
        
        case "7/12":
            $span = '7';
            break;
        
        case "10/12":
            $span = '10';
            break;
        
        case "11/12":
            $span = '11';
            break;
        
        case "1/4":
        case "3/12":
        default:
            $span = '3';
            break;
    }

    return '<div class="large-' . $span . ' columns">' . do_shortcode($content) . '</div>';
}

function nasa_sc_grid($atts, $content = null) {
    extract(shortcode_atts(array(
        'padding' => '10px',
        'width' => '',
        'el_class' => ''
    ), $atts));
    $shortcode_id = rand();
    ob_start();
    if ($padding) {
        $padding_w = $padding / 2;
        ?>
        <style>
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner-grid .columns > div {
                margin-left: <?php echo esc_attr($padding_w); ?>px !important;
                margin-right: <?php echo esc_attr($padding_w) ?>px !important;
            }
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner {
                margin-bottom: <?php echo esc_attr($padding); ?>px;
            }
        </style>
    <?php }
    if ($width) { ?>
        <style>
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> > .row {
                max-width:<?php echo esc_attr($width); ?>;
            }
            <?php if ($width == '100%') { ?>
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> > .row > .large-12 {
                padding:0!important;
            }
            <?php } ?>
        </style>
    <?php } ?>

    <div id="banner_grid_<?php echo esc_attr($shortcode_id); ?>">
        <div class="row">
            <div class="large-12 columns">
                <div class="row collapse nasa_banner-grid<?php echo ($el_class != '') ? ' ' . $el_class : ''; ?>"><?php echo do_shortcode($content); ?></div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function ($) {
                var $container = $("#banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner-grid");
                $container.packery({
                    itemSelector: ".columns",
                    gutter: 0
                });
            });
        </script>
    </div><!-- .banner-grid -->

    <?php
    $content = ob_get_clean();
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Banner Grid
// **********************************************************************//
// add_action('init', 'nasa_register_grid');
function nasa_register_grid(){
    // **********************************************************************// 
    // ! Register New Element: nasa Row
    // **********************************************************************//
    $row_params = array(
        "name" => "Nasa Row",
        "base" => "nasa_row",
        "icon" => "icon-wpb-nasatheme",
        'description' => esc_html__("Create an row.", 'nasa-core'),
        "category" => "Nasa Core",
        "content_element" => true,
        "show_settings_on_create" => false,
        "as_parent" => array('only' => 'nasa_col'),
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__('Row padding', 'nasa-core'),
                "param_name" => "padding",
                "description" => esc_html__("Insert a style row padding.", 'nasa-core')
            )
        ),
        "js_view" => 'VcColumnView'
    );
    vc_map($row_params);
    
    // **********************************************************************// 
    // ! Register New Element: nasa Columns
    // **********************************************************************//
    $columns_params = array(
        "name" => "Nasa Column",
        "base" => "nasa_col",
        "icon" => "icon-wpb-nasatheme",
        'description' => esc_html__("Create a column.", 'nasa-core'),
        "category" => "Nasa Core",
        "content_element" => true,
        "as_parent" => array('only', 'nasa_banner'),
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Column', 'nasa-core'),
                "param_name" => "span",
                "value" => array(
                    esc_html__('1 Column', 'nasa-core') => '1/12',
                    esc_html__('2 Columns', 'nasa-core') => '1/6',
                    esc_html__('3 Columns', 'nasa-core') => '1/4',
                    esc_html__('4 Columns', 'nasa-core') => '1/3',
                    esc_html__('5 Columns', 'nasa-core') => '5/12',
                    esc_html__('6 Columns', 'nasa-core') => '1/2',
                    esc_html__('7 Columns', 'nasa-core') => '7/12',
                    esc_html__('8 Columns', 'nasa-core') => '2/3',
                    esc_html__('9 Columns', 'nasa-core') => '3/4',
                    esc_html__('10 Columns', 'nasa-core') => '5/6',
                    esc_html__('11 Columns', 'nasa-core') => '11/12',
                    esc_html__('12 Columns', 'nasa-core') => '1/1'
                )
            )
        ),
        "js_view" => 'VcColumnView'
    );
    vc_map($columns_params);
}
