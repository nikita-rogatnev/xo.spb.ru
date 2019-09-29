<?php
if (!function_exists('elessi_product_compare_heading')) {
    add_action('init', 'elessi_product_compare_heading');
    function elessi_product_compare_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Products Compare ", 'elessi-theme'),
            "target" => 'product-compare',
            "type" => "heading",
        );
        
        global $yith_woocompare;
        if($yith_woocompare) {
            $of_options[] = array(
                "name" => esc_html__("Enable Nasa compare products Extends Yith Plugin Compare", 'elessi-theme'),
                "id" => "nasa-product-compare",
                "desc" => esc_html__("Enable Nasa compare products", 'elessi-theme'),
                "std" => 1,
                "type" => "checkbox"
            );
            
            $of_options[] = array(
                "name" => esc_html__("Page view compare products", 'elessi-theme'),
                "desc" => esc_html__("Select page view compare products.", 'elessi-theme'),
                "id" => "nasa-page-view-compage",
                "type" => "select",
                "options" => get_pages_temp_compare()
            );

            $of_options[] = array(
                "name" => esc_html__("Max products compare", 'elessi-theme'),
                "desc" => esc_html__("Change max number display compare products", 'elessi-theme'),
                "id" => "max_compare",
                "std" => "4",
                "type" => "select",
                "options" => array("2" => "2", "3" => "3", "4" => "4")
            );
        } else {
            $of_options[] = array(
                "name" => esc_html__("Install Yith Plugin Compare, Please", 'elessi-theme'),
                "std" => '<h4 style="color: red">' . esc_html__("Please, Install Yith Plugin Compare!", 'elessi-theme') . "</h4>",
                "type" => "info"
            );
        }
    }
}
