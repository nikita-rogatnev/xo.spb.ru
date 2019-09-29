<?php
if (!function_exists('elessi_breadcrumb_heading')) {
    add_action('init', 'elessi_breadcrumb_heading');
    function elessi_breadcrumb_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Breadcrumb", 'elessi-theme'),
            "target" => 'breadcumb',
            "type" => "heading"
        );

        $of_options[] = array(
            "name" => esc_html__("Show breadcrumb", 'elessi-theme'),
            "desc" => esc_html__("Show breadcrumb", 'elessi-theme'),
            "id" => "breadcrumb_show",
            "std" => 1,
            "type" => "checkbox",
            'class' => 'nasa-breadcrumb-flag-option'
        );

        $of_options[] = array(
            "name" => esc_html__("Breadcrumb type", 'elessi-theme'),
            "desc" => esc_html__("Choose breadcrumb type.", 'elessi-theme'),
            "id" => "breadcrumb_type",
            "std" => "has-background",
            "type" => "select",
            "options" => array(
                "default" => esc_html__("Without Background", 'elessi-theme'),
                "has-background" => esc_html__("With Background", 'elessi-theme')
            ),
            'class' => 'hidden-tag nasa-breadcrumb-type-option'
        );

        $of_options[] = array(
            "name" => esc_html__("Breadcrumb background image", 'elessi-theme'),
            "desc" => esc_html__("Breadcrumb background image.", 'elessi-theme'),
            "id" => "breadcrumb_bg",
            "std" => ELESSI_ADMIN_DIR_URI . 'assets/images/breadcrumb-bg.jpg',
            "type" => "media",
            'class' => 'hidden-tag nasa-breadcrumb-bg-option'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Breadcrumb background parallax", 'elessi-theme'),
            "desc" => esc_html__("Enable breadcrumb background parallax", 'elessi-theme'),
            "id" => "breadcrumb_bg_lax",
            "std" => 1,
            "type" => "checkbox",
            'class' => 'hidden-tag nasa-breadcrumb-bg-lax'
        );

        $of_options[] = array(
            "name" => esc_html__("Breadcrumb background color", 'elessi-theme'),
            "desc" => esc_html__("Breadcrumb background color.", 'elessi-theme'),
            "id" => "breadcrumb_bg_color",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Breadcrumb Text Color", 'elessi-theme'),
            "desc" => esc_html__("Change Breadcrumb Text Color", 'elessi-theme'),
            "id" => "breadcrumb_color",
            "std" => "",
            "type" => "color"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Breadcrumb Text Align", 'elessi-theme'),
            "desc" => esc_html__("Select if you want change Text Align.", 'elessi-theme'),
            "id" => "breadcrumb_align",
            "std" => "text-center",
            "type" => "select",
            "options" => array(
                "text-center" => esc_html__("Center", 'elessi-theme'),
                "text-left" => esc_html__("Left", 'elessi-theme'),
                "text-right" => esc_html__("Right", 'elessi-theme')
            ),
            'class' => 'hidden-tag nasa-breadcrumb-align-option'
        );

        $of_options[] = array(
            "name" => esc_html__("Height breadcrumb", 'elessi-theme'),
            "desc" => esc_html__("Height breadcrumb. (px)", 'elessi-theme'),
            "id" => "breadcrumb_height",
            "std" => "130",
            "type" => "text"
        );
    }
}
