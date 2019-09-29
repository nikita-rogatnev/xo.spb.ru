<?php
if (!function_exists('elessi_logo_icon_heading')) {
    add_action('init', 'elessi_logo_icon_heading');
    function elessi_logo_icon_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Logo and Favicon", 'elessi-theme'),
            "target" => 'logo-icons',
            "type" => "heading"
        );

        $of_options[] = array(
            "name" => esc_html__("Logo", 'elessi-theme'),
            "desc" => esc_html__("Upload logo here.", 'elessi-theme'),
            "id" => "site_logo",
            "std" => ELESSI_THEME_URI . "/assets/images/logo.png",
            "type" => "media"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Retina Logo", 'elessi-theme'),
            "desc" => esc_html__("Upload retina logo.", 'elessi-theme'),
            "id" => "site_logo_retina",
            "std" => ELESSI_THEME_URI . "/assets/images/logo-retina.png",
            "type" => "media"
        );

        $of_options[] = array(
            "name" => esc_html__("Max height logo", 'elessi-theme'),
            "desc" => esc_html__("Max height logo", 'elessi-theme'),
            "id" => "max_height_logo",
            "std" => "40px",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Max height logo in Mobile", 'elessi-theme'),
            "desc" => esc_html__("Max height logo in Mobile", 'elessi-theme'),
            "id" => "max_height_mobile_logo",
            "std" => "25px",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Max height logo in header Sticky", 'elessi-theme'),
            "desc" => esc_html__("Max height logo in header Sticky", 'elessi-theme'),
            "id" => "max_height_sticky_logo",
            "std" => "25px",
            "type" => "text"
        );

        $of_options[] = array(
            "name" => esc_html__("Favicon", 'elessi-theme'),
            "desc" => esc_html__("Add your custom Favicon image. 16x16px .ico or .png required. (Recommend *.ico)", 'elessi-theme'),
            "id" => "site_favicon",
            "std" => "",
            "type" => "media"
        );
    }
}
