<?php
add_action('init', 'nasa_custom_option_themes', 11);
function nasa_custom_option_themes() {
    global $of_options;
    if (empty($of_options)) {
        $of_options = array();
    }

    $of_options[] = array(
        "name" => esc_html__("Nasa Core Options", 'nasa-core'),
        "target" => 'nasa-option',
        "type" => "heading"
    );

    $of_options[] = array(
        "name" => esc_html__("Nasa global options", 'nasa-core'),
        "std" => "<h4>" . esc_html__("Nasa global options", 'nasa-core') . "</h4>",
        "type" => "info"
    );

    $of_options[] = array(
        "name" => esc_html__("Enable Effect Pin Space (Pin Products Banner)", 'nasa-core'),
        "desc" => esc_html__("Yes, please!", 'nasa-core'),
        "id" => "effect_pin_product_banner",
        "std" => 0,
        "type" => "checkbox"
    );

    $of_options[] = array(
        "name" => esc_html__("Optimized speed", 'nasa-core'),
        "desc" => esc_html__("Enable (Only enable this IF YOU DO NOT use a caching plugin for this site.)", 'nasa-core'),
        "id" => "enable_optimized_speed",
        "std" => '0',
        "type" => "checkbox"
    );

    $of_options[] = array(
        "name" => esc_html__("Optimized Type", 'nasa-core'),
        "desc" => esc_html__("Optimized Type.", 'nasa-core'),
        "id" => "optimized_type",
        "std" => "sync",
        "type" => "select",
        "options" => array(
            "sync" => esc_html__("Synchronous", 'nasa-core'),
            "async" => esc_html__("Asynchronous", 'nasa-core')
        )
    );
    
    $of_options[] = array(
        "name" => esc_html__("Enable Size Guide Product", 'nasa-core'),
        "desc" => esc_html__("Enable Size Guide Product", 'nasa-core'),
        "id" => "enable_size_guide",
        "std" => '1',
        "type" => "checkbox"
    );
    
    $of_options[] = array(
        "name" => esc_html__("Size Guide Product", 'nasa-core'),
        "desc" => esc_html__("Size Guide for Product.", 'nasa-core'),
        "id" => "size_guide",
        "std" => '',
        "type" => "media"
    );

    $of_options[] = array(
        "name" => esc_html__("Nasa UX variations product's variable", 'nasa-core'),
        "std" => "<h4>" . esc_html__("Nasa UX variations product's variable", 'nasa-core') . "</h4>",
        "type" => "info"
    );

    $of_options[] = array(
        "name" => esc_html__('Enable UX Variations', 'nasa-core'),
        "desc" => esc_html__('Enable UX Variations.', 'nasa-core'),
        "id" => "enable_nasa_variations_ux",
        "std" => 1,
        "type" => "checkbox"
    );
    
    $of_options[] = array(
        "name" => esc_html__('Enable Cache file', 'nasa-core'),
        "desc" => esc_html__('Cache file.', 'nasa-core'),
        "id" => "enable_nasa_cache",
        "std" => 1,
        "type" => "checkbox"
    );
    
    $of_options[] = array(
        "name" => esc_html__('Expire Time (Seconds - Expire time live file.)', 'nasa-core'),
        "desc" => '<a href="javascript:void(0);" class="button-primary nasa-clear-variations-cache" data-ok="' . esc_html__('Clear Cache Success !', 'nasa-core') . '" data-miss="' . esc_html__('Cache Empty!', 'nasa-core') . '" data-fail="' . esc_html__('Error!', 'nasa-core') . '">' . esc_html__('Clear Cache', 'nasa-core') . '</a><span class="nasa-admin-loader hidden-tag"><img src="' . NASA_CORE_PLUGIN_URL . 'admin/assets/ajax-loader.gif" /></span>',
        "id" => "nasa_cache_expire",
        "std" => '3600',
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__('Enable UX Variations With Type Select', 'nasa-core'),
        "desc" => esc_html__('Enable UX Variations With Type Select In Loop Product.', 'nasa-core'),
        "id" => "enable_nasa_ux_select",
        "std" => 1,
        "type" => "checkbox"
    );

    $of_options[] = array(
        "name" => esc_html__("Display Type with Image Attribute", 'nasa-core'),
        "id" => "nasa_attr_display_type",
        "std" => "round",
        "type" => "select",
        "options" => array(
            "round" => esc_html__("Round", 'nasa-core'),
            "square" => esc_html__("Square", 'nasa-core')
        )
    );

    // limit_show num of 1 variation
    $of_options[] = array(
        "name" => esc_html__('Limit in product grid', 'nasa-core'),
        "desc" => esc_html__('Limit show variations/1 attribute in product grid. Empty input to show all', 'nasa-core'),
        "id" => "limit_nasa_variations_ux",
        "std" => "5",
        "type" => "text"
    );

    // Loading ux variations in loop by ajax
    $of_options[] = array(
        "name" => esc_html__('UX Variations Loop by Ajax', 'nasa-core'),
        "desc" => esc_html__('Loading UX Variations In Loop by Ajax.', 'nasa-core'),
        "id" => "load_variations_ux_ajax",
        "std" => 1,
        "type" => "checkbox"
    );

    $of_options[] = array(
        "name" => esc_html__('Enable Gallery for Variation', 'nasa-core'),
        "desc" => esc_html__('Enable', 'nasa-core'),
        "id" => "gallery_images_variation",
        "std" => 1,
        "type" => "checkbox"
    );

    $of_options[] = array(
        "name" => esc_html__("Nasa Options Archive product page", 'nasa-core'),
        "std" => "<h4>" . esc_html__("Nasa Options Archive product page", 'nasa-core') . "</h4>",
        "type" => "info"
    );

    /*
     * Elessi-theme not use
     */
    $of_options[] = array(
        "name" => esc_html__("Enable Recommend Products", 'nasa-core'),
        "id" => "enable_recommend_product",
        "desc" => esc_html__("Enable Recommend Products.", 'nasa-core'),
        "std" => "0",
        "type" => "checkbox"
    );

    $of_options[] = array(
        "name" => esc_html__('Title for Recommended', 'nasa-core'),
        "desc" => esc_html__('Title for Recommended.', 'nasa-core'),
        "id" => "recommend_product_title",
        "std" => "Recommend Products",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Limit Number of Visible Recommended Products", 'nasa-core'),
        "id" => "recommend_product_limit",
        "desc" => esc_html__("Input Limit Number of Visible Recommended Products.", 'nasa-core'),
        "std" => "9",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Desktop Columns Count", 'nasa-core'),
        "id" => "recommend_columns_desk",
        "std" => "5-cols",
        "type" => "select",
        "options" => array(
            "3-cols" => esc_html__("3 columns", 'nasa-core'),
            "4-cols" => esc_html__("4 columns", 'nasa-core'),
            "5-cols" => esc_html__("5 columns", 'nasa-core')
        )
    );

    $of_options[] = array(
        "name" => esc_html__("Mobile Columns Count", 'nasa-core'),
        "id" => "recommend_columns_small",
        "std" => "1-col",
        "type" => "select",
        "options" => array(
            "1-cols" => esc_html__("1 column", 'nasa-core'),
            "2-cols" => esc_html__("2 columns", 'nasa-core')
        )
    );

    $of_options[] = array(
        "name" => esc_html__("Tablet Columns Count", 'nasa-core'),
        "id" => "recommend_columns_tablet",
        "std" => "3-cols",
        "type" => "select",
        "options" => array(
            "1-col" => esc_html__("1 column", 'nasa-core'),
            "2-cols" => esc_html__("2 columns", 'nasa-core'),
            "3-cols" => esc_html__("3 columns", 'nasa-core')
        )
    );

    $of_options[] = array(
        "name" => esc_html__("Products Position", 'nasa-core'),
        "id" => "recommend_product_position",
        "std" => "bot",
        "type" => "select",
        "options" => array(
            "top" => esc_html__("Top", 'nasa-core'),
            "bot" => esc_html__("Bottom", 'nasa-core')
        )
    );

    /*
     * Share and follow
     */
    $of_options[] = array(
        "name" => esc_html__("Nasa Options Share & Follow", 'nasa-core'),
        "std" => "<h4>" . esc_html__("Nasa Options Share & Follow", 'nasa-core') . "</h4>",
        "type" => "info"
    );

    $of_options[] = array(
        "name" => esc_html__("Share Icons", 'nasa-core'),
        "desc" => esc_html__("Select icons to be shown on share icons on product page, blog page and [share] shortcode", 'nasa-core'),
        "id" => "social_icons",
        "std" => array(
            "facebook",
            "twitter",
            "email",
            "pinterest",
            "googleplus"
        ),
        "type" => "multicheck",
        "options" => array(
            "facebook" => esc_html__("Facebook", 'nasa-core'),
            "twitter" => esc_html__("Twitter", 'nasa-core'),
            "email" => esc_html__("Email", 'nasa-core'),
            "pinterest" => esc_html__("Pinterest", 'nasa-core'),
            "googleplus" => esc_html__("Google Plus", 'nasa-core')
        )
    );

    $of_options[] = array(
        "name" => esc_html__("Facebook URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Facebook link follow here.", 'nasa-core'),
        "id" => "facebook_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Twitter URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Twitter link follow here.", 'nasa-core'),
        "id" => "twitter_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Email URL", 'nasa-core'),
        "desc" => esc_html__("Input Email follow here.", 'nasa-core'),
        "id" => "email_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Pinterest URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input pinterest link follow here.", 'nasa-core'),
        "id" => "pinterest_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Google Plus URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Google Plus link follow here.", 'nasa-core'),
        "id" => "googleplus_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Instagram URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input instagram link follow here.", 'nasa-core'),
        "id" => "instagram_url",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("RSS URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input RSS link follow here.", 'nasa-core'),
        "id" => "rss_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Linkedin URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Linkedin link follow here.", 'nasa-core'),
        "id" => "linkedin_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Youtube URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Youtube link follow here.", 'nasa-core'),
        "id" => "youtube_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Flickr URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Flickr link follow here.", 'nasa-core'),
        "id" => "flickr_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Telegram URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Telegram link follow here.", 'nasa-core'),
        "id" => "telegram_url_follow",
        "std" => "",
        "type" => "text"
    );

    $of_options[] = array(
        "name" => esc_html__("Whatsapp URL Follow", 'nasa-core'),
        "desc" => esc_html__("Input Whatsapp link follow here.", 'nasa-core'),
        "id" => "whatsapp_url_follow",
        "std" => "",
        "type" => "text"
    );
}
