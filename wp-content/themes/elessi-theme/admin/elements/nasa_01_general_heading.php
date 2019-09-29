<?php
if (!function_exists('elessi_general_heading')) {
    add_action('init', 'elessi_general_heading');
    function elessi_general_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("General", 'elessi-theme'),
            "target" => 'general',
            "type" => "heading"
        );

        if(get_option('nasatheme_imported') !== 'imported') {
            $of_options[] = array(
                "name" => esc_html__("Import Demo Content", 'elessi-theme'),
                "desc" => esc_html__("Click for import. Please ensure our plugins are activated before content is imported.", 'elessi-theme'),
                "id" => "demo_data",
                'href' => '#',
                "std" => "",
                "btntext" => esc_html__("Import Demo Content", 'elessi-theme'),
                "type" => "button"
            );
        }
        else {
            $of_options[] = array(
                "name" => esc_html__("Demo data imported", 'elessi-theme'),
                "std" => '<h3 style="background: #fff; margin: 0; padding: 5px 10px;">' . esc_html__("Demo data was imported. If you want import demo data again, You should need reset data of your site.", 'elessi-theme') . "</h3>",
                "type" => "info"
            );
        }

        $of_options[] = array(
            "name" => esc_html__("Site Layout", 'elessi-theme'),
            "desc" => esc_html__("Selects site layout.", 'elessi-theme'),
            "id" => "site_layout",
            "std" => "wide",
            "type" => "select",
            "options" => array(
                "wide" => esc_html__("Wide", 'elessi-theme'),
                "boxed" => esc_html__("Boxed", 'elessi-theme')
            ),
            'class' => 'nasa-theme-option-parent'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Add more width site (px)", 'elessi-theme'),
            "desc" => esc_html__("The max-width of your site will be INPUT + 1200 (pixel).", 'elessi-theme'),
            "id" => "plus_wide_width",
            "std" => "",
            "type" => "text"
        );

        $of_options[] = array(
            "name" => esc_html__("Site Background Color", 'elessi-theme'),
            "id" => "site_bg_color",
            "std" => "#eee",
            "type" => "color",
            'class' => 'nasa-site_layout nasa-site_layout-boxed nasa-theme-option-child'
        );

        $of_options[] = array(
            "name" => esc_html__("Site Background Image", 'elessi-theme'),
            "id" => "site_bg_image",
            "std" => ELESSI_THEME_URI . "/assets/images/bkgd1.jpg",
            "type" => "media",
            'class' => 'nasa-site_layout nasa-site_layout-boxed nasa-theme-option-child'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Site RTL", 'elessi-theme'),
            "desc" => esc_html__("Yes, please!", 'elessi-theme'),
            "id" => "nasa_rtl",
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Hide Login or Register menu", 'elessi-theme'),
            "desc" => esc_html__("Hide Login or Register menu.", 'elessi-theme'),
            "id" => "hide_tini_menu_acc",
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Login or Register by Ajax form", 'elessi-theme'),
            "desc" => esc_html__("Enable Login or Register by Ajax form", 'elessi-theme'),
            "id" => "login_ajax",
            "std" => 1,
            "type" => "checkbox"
        );

        $of_options[] = array(
            "name" => esc_html__("Disable Transition Loading", 'elessi-theme'),
            "desc" => esc_html__("Disable transition loading for all page", 'elessi-theme'),
            "id" => "disable_wow",
            "std" => 0,
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Delay overlay items", 'elessi-theme'),
            "desc" => esc_html__("(ms) Delay overlay items.", 'elessi-theme'),
            "id" => "delay_overlay",
            "std" => "100",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Effect before load site", 'elessi-theme'),
            "desc" => esc_html__("Enable Effect before load site", 'elessi-theme'),
            "id" => "effect_before_load",
            "std" => 1,
            "type" => "checkbox"
        );
    }
}
