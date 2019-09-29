<?php
if (!function_exists('elessi_style_color_heading')) {
    add_action('init', 'elessi_style_color_heading');
    function elessi_style_color_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Style and Colors", 'elessi-theme'),
            "target" => 'style-color',
            "type" => "heading",
        );

        $of_options[] = array(
            "name" => esc_html__("Style and Colors Global Option", 'elessi-theme'),
            "std" => "<h4>" . esc_html__("Style and Colors Global Option", 'elessi-theme') . "</h4>",
            "type" => "info"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Primary Color", 'elessi-theme'),
            "desc" => esc_html__("Change primary color. Used for primary buttons, link hover, background, etc.", 'elessi-theme'),
            "id" => "color_primary",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Secondary Color", 'elessi-theme'),
            "desc" => esc_html__("Change secondary color. Used for sale bubble.", 'elessi-theme'),
            "id" => "color_secondary",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Success Color", 'elessi-theme'),
            "desc" => esc_html__("Change the success color. Used for global success messages.", 'elessi-theme'),
            "id" => "color_success",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Hot label Color", 'elessi-theme'),
            "desc" => esc_html__("Change the hot label color. Used for product hot.", 'elessi-theme'),
            "id" => "color_hot_label",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Deal label Color", 'elessi-theme'),
            "desc" => esc_html__("Change the deal label color. Used for product deal.", 'elessi-theme'),
            "id" => "color_deal_label",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Sale label Color", 'elessi-theme'),
            "desc" => esc_html__("Change the sale label color. Used for product sale.", 'elessi-theme'),
            "id" => "color_sale_label",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Price Color", 'elessi-theme'),
            "desc" => esc_html__("Change the Price color. Used for product.", 'elessi-theme'),
            "id" => "color_price_label",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Style and Color", 'elessi-theme'),
            "std" => "<h4>" . esc_html__("Buttons Style and Color", 'elessi-theme') . "</h4>",
            "type" => "info"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Background Color", 'elessi-theme'),
            "desc" => esc_html__("Change background color for buttons.", 'elessi-theme'),
            "id" => "color_button",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Background Color Hover", 'elessi-theme'),
            "desc" => esc_html__("Change background color hover for buttons. Default is primary color", 'elessi-theme'),
            "id" => "color_hover",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Border Color", 'elessi-theme'),
            "desc" => esc_html__("Change border color for buttons.", 'elessi-theme'),
            "id" => "button_border_color",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Border Color Hover", 'elessi-theme'),
            "desc" => esc_html__("Change border color hover for buttons.", 'elessi-theme'),
            "id" => "button_border_color_hover",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Text Color", 'elessi-theme'),
            "desc" => esc_html__("Change text color for buttons. Default is primary color", 'elessi-theme'),
            "id" => "button_text_color",
            "std" => "",
            "type" => "color"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons Text Color Hover", 'elessi-theme'),
            "desc" => esc_html__("Change text color hover for buttons.", 'elessi-theme'),
            "id" => "button_text_color_hover",
            "std" => "",
            "type" => "color"
        );
        $of_options[] = array(
            "name" => esc_html__("Buttons radius", 'elessi-theme'),
            "desc" => esc_html__("Change Buttons Radius. (px)", 'elessi-theme'),
            "id" => "button_radius",
            "std" => "0",
            "step" => "1",
            "max" => '100',
            "type" => "sliderui"
        );

        $of_options[] = array(
            "name" => esc_html__("Buttons border", 'elessi-theme'),
            "desc" => esc_html__("Change Buttons Border. (px)", 'elessi-theme'),
            "id" => "button_border",
            "std" => "1",
            "step" => "1",
            "max" => '5',
            "type" => "sliderui"
        );

        $of_options[] = array(
            "name" => esc_html__("Inputs radius", 'elessi-theme'),
            "desc" => esc_html__("Change Radius Inputs. (px)", 'elessi-theme'),
            "id" => "input_radius",
            "std" => "0",
            "step" => "1",
            "max" => "100",
            "type" => "sliderui"
        );
    }
}
