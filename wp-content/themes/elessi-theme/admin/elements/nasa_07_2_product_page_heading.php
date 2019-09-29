<?php
if (!function_exists('elessi_product_page_heading')) {
    add_action('init', 'elessi_product_page_heading');
    function elessi_product_page_heading() {
        /* ----------------------------------------------------------------------------------- */
        /* The Options Array */
        /* ----------------------------------------------------------------------------------- */
        // Set the Options Array
        global $of_options;
        if(empty($of_options)) {
            $of_options = array();
        }
        
        $of_options[] = array(
            "name" => esc_html__("Archive Products Page", 'elessi-theme'),
            "target" => 'product-page',
            "type" => "heading",
        );
        
        $of_options[] = array(
            "name" => esc_html__("Shop sidebar", 'elessi-theme'),
            "desc" => esc_html__("Select if you want a sidebar on product categories.", 'elessi-theme'),
            "id" => "category_sidebar",
            "std" => "top",
            "type" => "select",
            "options" => array(
                "top" => esc_html__("Top Bar", 'elessi-theme'),
                "top-2" => esc_html__("Top Bar Type 2", 'elessi-theme'),
                "left" => esc_html__("Left Sidebar Off-canvas", 'elessi-theme'),
                "left-classic" => esc_html__("Left sidebar Classic", 'elessi-theme'),
                "right" => esc_html__("Right Sidebar Off-canvas", 'elessi-theme'),
                "right-classic" => esc_html__("Right Sidebar Classic", 'elessi-theme'),
                "no" => esc_html__("No Sidebar", 'elessi-theme'),
            ),
            
            'class' => 'nasa-theme-option-parent'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Top Bar Label", 'elessi-theme'),
            "id" => "top_bar_archive_label",
            "desc" => esc_html__("Top Bar Label value.", 'elessi-theme'),
            "std" => "Filter by:",
            "type" => "text",
            'class' => 'nasa-category_sidebar nasa-category_sidebar-top nasa-theme-option-child'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Top Bar Limit widgets to Show More", 'elessi-theme'),
            "id" => "limit_widgets_show_more",
            "desc" => esc_html__('Limit widgets to show more. (Input "All" will be show all widgets)', 'elessi-theme'),
            "std" => "4",
            "type" => "text",
            'class' => 'nasa-category_sidebar nasa-category_sidebar-top nasa-theme-option-child'
        );
        
        $of_options[] = array(
            "name" => esc_html__("Position filter categories", 'elessi-theme'),
            "id" => "top_bar_cat_pos",
            "desc" => esc_html__("Position filter categories.", 'elessi-theme'),
            "std" => "left-bar",
            "type" => "select",
            "options" => array(
                "top" => esc_html__("Top", 'elessi-theme'),
                "left-bar" => esc_html__("Left bar", 'elessi-theme')
            ),
            'class' => 'nasa-category_sidebar nasa-category_sidebar-top nasa-theme-option-child'
        );

        $of_options[] = array(
            "name" => esc_html__("Products Per Row", 'elessi-theme'),
            "desc" => esc_html__("Change products number display per row for the Shop page", 'elessi-theme'),
            "id" => "products_per_row",
            "std" => "4-cols",
            "type" => "select",
            "options" => array(
                "3-cols" => esc_html__("3 column", 'elessi-theme'),
                "4-cols" => esc_html__("4 column", 'elessi-theme'),
                "5-cols" => esc_html__("5 column", 'elessi-theme'),
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Products Per Row for Mobile", 'elessi-theme'),
            "id" => "products_per_row_small",
            "std" => "1-col",
            "type" => "select",
            "options" => array(
                "1-cols" => esc_html__("1 column", 'elessi-theme'),
                "2-cols" => esc_html__("2 columns", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Products Per Row for Tablet", 'elessi-theme'),
            "id" => "products_per_row_tablet",
            "std" => "2-cols",
            "type" => "select",
            "options" => array(
                "1-col" => esc_html__("1 column", 'elessi-theme'),
                "2-cols" => esc_html__("2 columns", 'elessi-theme'),
                "3-cols" => esc_html__("3 columns", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => esc_html__("Products Per Page", 'elessi-theme'),
            "id" => "products_pr_page",
            "desc" => esc_html__("Change products per page.", 'elessi-theme'),
            "std" => "16",
            "type" => "text"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Select type view", 'elessi-theme'),
            "desc" => esc_html__("Select type view.", 'elessi-theme'),
            "id" => "products_type_view",
            "std" => "grid",
            "type" => "select",
            "options" => array(
                "grid" => esc_html__("Grid view default", 'elessi-theme'),
                "list" => esc_html__("List view default", 'elessi-theme')
            )
        );
        
        $of_options[] = array(
            "name" => esc_html__("Enable show info in top", 'elessi-theme'),
            "id" => "showing_info_top",
            "desc" => esc_html__("Enable show info in top. (don't using for Sidebar Off-canvas)", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Enable change view as", 'elessi-theme'),
            "id" => "enable_change_view",
            "desc" => esc_html__("Enable change view grid or list.", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );
        
        $of_options[] = array(
            "name" => esc_html__("Layout style", 'elessi-theme'),
            "desc" => esc_html__("Select Layout style.", 'elessi-theme'),
            "id" => "products_layout_style",
            "std" => "grid_row",
            "type" => "select",
            "options" => array(
                "grid-row" => esc_html__("Grid row", 'elessi-theme'),
                "masonry-isotope" => esc_html__("Masonry isotope", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => esc_html__("Pagination page style", 'elessi-theme'),
            "id" => "pagination_style",
            "desc" => esc_html__("Select style for pagination", 'elessi-theme'),
            "std" => 'style-2',
            "type" => "select",
            "options" => array(
                "style-2" => esc_html__("Simple", 'elessi-theme'),
                "style-1" => esc_html__("Full", 'elessi-theme'),
                "infinite" => esc_html__("Infinite - Only using for Ajax", 'elessi-theme'),
                "load-more" => esc_html__("Load More - Only using for Ajax", 'elessi-theme')
            )
        );

        $of_options[] = array(
            "name" => esc_html__("Show title in one line", 'elessi-theme'),
            "id" => "cutting_product_name",
            "desc" => esc_html__("Only show title product if it is too long.", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );

        $of_options[] = array(
            "name" => esc_html__("Top content Products page", 'elessi-theme'),
            "std" => "<h4>" . esc_html__("Top content Products page", 'elessi-theme') . "</h4>",
            "type" => "info"
        );

        $of_options[] = array(
            "name" => esc_html__("Enable Category top content", 'elessi-theme'),
            "id" => "enable_cat_header",
            "desc" => esc_html__("Enable Category top content", 'elessi-theme'),
            "std" => "1",
            "type" => "checkbox"
        );

        $of_options[] = array(
            "name" => esc_html__("Category top content", 'elessi-theme'),
            "id" => "cat_header",
            "desc" => esc_html__("Input anything shortcode or text here. Recommend to use the Static Blocks to create banner or anything that you want to show the top content in the Shop page", 'elessi-theme'),
            "std" => "",
            "type" => "textarea"
        );
        
    }
}
