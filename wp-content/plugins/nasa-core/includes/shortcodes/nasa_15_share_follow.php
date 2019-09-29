<?php

add_shortcode('nasa_share', 'nasa_sc_share');
add_shortcode("nasa_follow", "nasa_sc_follow");

function nasa_sc_share($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'size' => '',
        'el_class' => ''
    ), $atts));
    
    global $post, $nasa_opt;
    
    if (isset($post->ID)) {
        $permalink = get_permalink($post->ID);
        $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'large');
        $featured_image_2 = isset($featured_image['0']) ? $featured_image['0'] : (isset($nasa_opt['site_logo']) ? $nasa_opt['site_logo'] : '#');
        $post_title = rawurlencode(get_the_title($post->ID));
    } else {
        global $wp;
        $permalink = home_url($wp->request);
        $featured_image_2 = isset($nasa_opt['site_logo']) ? $nasa_opt['site_logo'] : '#';
        $post_title = get_bloginfo('name', 'display');
    }
    
    $share_wrap_start = $title ? '<div class="nasa-share-title"><span>' . $title . '</span></div>' : '';
    $share_wrap_start .= '<ul class="social-icons nasa-share' . ($size != '' ? ' ' . esc_attr($size) : '') . ($el_class != '' ? ' ' . esc_attr($el_class) : '') . '">';
    
    $share = '';
    
    /**
     * Twitter
     */
    if (isset($nasa_opt['social_icons']['twitter']) && $nasa_opt['social_icons']['twitter']) {
        $share .=
        '<li>' .
            '<a href="//twitter.com/share?url=' . esc_url($permalink) . '" target="_blank" class="icon" title="' . esc_attr__('Share on Twitter', 'nasa-core') . '" rel="nofollow">' .
                '<i class="fa fa-twitter"></i>' .
            '</a>' .
        '</li>';
    }
        
    /**
     * FaceBook
     */
    if (isset($nasa_opt['social_icons']['facebook']) && $nasa_opt['social_icons']['facebook']) {
        $share .=
        '<li>' .
            '<a href="//www.facebook.com/sharer.php?u=' . esc_url($permalink) . '" target="_blank" class="icon" title="' . esc_attr__('Share on Facebook', 'nasa-core') . '" rel="nofollow">' .
                '<i class="fa fa-facebook"></i>' .
            '</a>' .
        '</li>';
    }
    
    /**
     * Google+
     */
    if (isset($nasa_opt['social_icons']['googleplus']) && $nasa_opt['social_icons']['googleplus']) {
        $share .=
        '<li>' .
            '<a href="//plus.google.com/share?url=' . esc_url($permalink) . '" target="_blank" class="icon" title="' . esc_attr__('Share on Google+', 'nasa-core') . '" rel="nofollow">' .
                '<i class="fa fa-google-plus"></i>' .
            '</a>' .
        '</li>';
    }
    
    /**
     * Email
     */
    if (isset($nasa_opt['social_icons']['email']) && $nasa_opt['social_icons']['email']) {
        $share .=
        '<li>' .
            '<a href="mailto:enter-your-mail@domain-here.com?subject=' . esc_attr($post_title) . '&amp;body=Check%20this%20out:%20' . esc_url($permalink) . '" target="_blank" class="icon" title="' . esc_attr__('Email to your friends', 'nasa-core') . '" rel="nofollow">' .
                '<i class="fa fa-envelope-o"></i>' .
            '</a>' .
        '</li>';
    }
    
    /**
     * Pinterest
     */
    if (isset($nasa_opt['social_icons']['pinterest']) && $nasa_opt['social_icons']['pinterest']) {
        $share .=
        '<li>' .
            '<a href="//pinterest.com/pin/create/button/?url=' . esc_url($permalink) . '&amp;media=' . esc_attr($featured_image_2) . '&amp;description=' . esc_attr($post_title) . '" target="_blank" class="icon" title="' . esc_attr__('Pin on Pinterest', 'nasa-core') . '" rel="nofollow">' .
                '<i class="fa fa-pinterest"></i>' .
            '</a>' .
        '</li>';
    }

    $share_content = apply_filters('nasa_share_content', $share);
    $share_wrap_end = '</ul>';

    $content = $share_wrap_start . $share_content . $share_wrap_end;
    
    return $content;
}

function nasa_sc_follow($atts, $content = null) {
    extract(shortcode_atts(array(
        'title' => '',
        'twitter' => '',
        'facebook' => '',
        'pinterest' => '',
        'email' => '',
        'googleplus' => '',
        'instagram' => '',
        'rss' => '',
        'linkedin' => '',
        'youtube' => '',
        'flickr' => '',
        'telegram' => '',
        'whatsapp' => '',
        'el_class' => ''
    ), $atts));
    
    global $nasa_opt;
    $facebook = $facebook ? $facebook : (isset($nasa_opt['facebook_url_follow']) ? $nasa_opt['facebook_url_follow'] : '');
    $twitter = $twitter ? $twitter : (isset($nasa_opt['twitter_url_follow']) ? $nasa_opt['twitter_url_follow'] : '');
    $email = $email ? $email : (isset($nasa_opt['email_url_follow']) ? $nasa_opt['email_url_follow'] : '');
    $pinterest = $pinterest ? $pinterest : (isset($nasa_opt['pinterest_url_follow']) ? $nasa_opt['pinterest_url_follow'] : '');
    $googleplus = $googleplus ? $googleplus : (isset($nasa_opt['googleplus_url_follow']) ? $nasa_opt['googleplus_url_follow'] : '');
    $instagram = $instagram ? $instagram : (isset($nasa_opt['instagram_url']) ? $nasa_opt['instagram_url'] : '');
    $rss = $rss ? $rss : (isset($nasa_opt['rss_url_follow']) ? $nasa_opt['rss_url_follow'] : '');
    $linkedin = $linkedin ? $linkedin : (isset($nasa_opt['linkedin_url_follow']) ? $nasa_opt['linkedin_url_follow'] : '');
    $youtube = $youtube ? $youtube : (isset($nasa_opt['youtube_url_follow']) ? $nasa_opt['youtube_url_follow'] : '');
    $flickr = $flickr ? $flickr : (isset($nasa_opt['flickr_url_follow']) ? $nasa_opt['flickr_url_follow'] : '');
    $telegram = $telegram ? $telegram : (isset($nasa_opt['telegram_url_follow']) ? $nasa_opt['telegram_url_follow'] : '');
    $whatsapp = $whatsapp ? $whatsapp : (isset($nasa_opt['whatsapp_url_follow']) ? $nasa_opt['whatsapp_url_follow'] : '');
    
    $follow_wrap_start = '<div class="social-icons nasa-follow' . ($el_class ? ' ' . esc_attr($el_class) : '') . '">';
    $follow_wrap_start .= $title ? '<div class="nasa-follow-title">' . $title . '</div>' : '';
    $follow_wrap_start .= '<div class="follow-icon">';
    
    $follow = '';

    /**
     * Twitter
     */
    if ($twitter) {
        $follow .= '<a href="' . esc_url($twitter) . '" target="_blank" class="icon icon_twitter" title="' . esc_attr__('Follow us on Twitter', 'nasa-core') . '" rel="nofollow"><i class="fa fa-twitter"></i></a>';
    }

    /**
     * FaceBook
     */
    if ($facebook) {
        $follow .= '<a href="' . esc_url($facebook) . '" target="_blank" class="icon icon_facebook" title="' . esc_attr__('Follow us on Facebook', 'nasa-core') . '" rel="nofollow"><i class="fa fa-facebook"></i></a>';
    }

    /**
     * Google+
     */
    if ($googleplus) {
        $follow .= '<a href="' . esc_url($googleplus) . '" target="_blank" class="icon icon_googleplus" title="' . esc_attr__('Follow us on Google+', 'nasa-core') . '" rel="nofollow"><i class="fa fa-google-plus"></i></a>';
    }

    /**
     * Email
     */
    if ($email) {
        $follow .= '<a href="mailto:' . $email . '" target="_blank" class="icon icon_email" title="' . esc_attr__('Send us an email', 'nasa-core') . '" rel="nofollow"><i class="fa fa-envelope-o"></i></a>';
    }

    /**
     * Pinterest
     */
    if ($pinterest) {
        $follow .= '<a href="' . esc_url($pinterest) . '" target="_blank" class="icon icon_pintrest" title="' . esc_attr__('Follow us on Pinterest', 'nasa-core') . '" rel="nofollow"><i class="fa fa-pinterest"></i></a>';
    }

    /**
     * Instagram
     */
    if ($instagram) {
        $follow .= '<a href="' . esc_url($instagram) . '" target="_blank" class="icon icon_instagram" title="' . esc_attr__('Follow us on Instagram', 'nasa-core') . '" rel="nofollow"><i class="fa fa-instagram"></i></a>';
    }

    /**
     * Rss
     */
    if ($rss) {
        $follow .= '<a href="' . esc_url($rss) . '" target="_blank" class="icon icon_rss" title="' . esc_attr__('Subscribe to RSS', 'nasa-core') . '" rel="nofollow"><i class="fa fa-rss"></i></a>';
    }

    /**
     * LinkedIn
     */
    if ($linkedin) {
        $follow .= '<a href="' . esc_url($linkedin) . '" target="_blank" class="icon icon_linkedin" title="' . esc_attr__('LinkedIn', 'nasa-core') . '" rel="nofollow"><i class="fa fa-linkedin-square"></i></a>';
    }

    /**
     * YouTube
     */
    if ($youtube) {
        $follow .= '<a href="' . esc_url($youtube) . '" target="_blank" class="icon icon_youtube" title="' . esc_attr__('YouTube', 'nasa-core') . '" rel="nofollow"><i class="fa fa-youtube-play"></i></a>';
    }

    /**
     * Flickr
     */
    if ($flickr) {
        $follow .= '<a href="' . esc_url($flickr) . '" target="_blank" class="icon icon_flickr" title="' . esc_attr__('Flickr', 'nasa-core') . '" rel="nofollow"><i class="fa fa-flickr"></i></a>';
    }

    /**
     * Telegram
     */
    if ($telegram) {
        $follow .= '<a href="' . esc_url($telegram) . '" target="_blank" class="icon icon_telegram" title="' . esc_attr__('Telegram', 'nasa-core') . '" rel="nofollow"><i class="fa fa-telegram"></i></a>';
    }

    /**
     * Whatsapp
     */
    if ($whatsapp) {
        $follow .= '<a href="' . esc_url($whatsapp) . '" target="_blank" class="icon icon_whatsapp" title="' . esc_attr__('Whatsapp', 'nasa-core') . '" rel="nofollow"><i class="fa fa-whatsapp"></i></a>';
    }

    $follow_content = apply_filters('nasa_follow_content', $follow);
    $follow_wrap_end = '</div></div>';

    $content = $follow_wrap_start . $follow_content . $follow_wrap_end;
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Share
// **********************************************************************//
add_action('init', 'nasa_register_share_follow');
function nasa_register_share_follow(){
    $share_params = array(
        "name" => esc_html__("Share", 'nasa-core'),
        "base" => "nasa_share",
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Display share icon social.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "show_settings_on_create" => false,
        "params" => array(
            array(
                "type" => "dropdown",
                "heading" => esc_html__('Size', 'nasa-core'),
                "param_name" => 'size',
                "value" => array(
                    esc_html__('Normal', 'nasa-core') => '',
                    esc_html__('Large', 'nasa-core') => 'large'
                )
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );
    vc_map($share_params);

    // **********************************************************************// 
    // ! Register New Element: Follow
    // **********************************************************************//
    $follow = array(
        "name" => esc_html__("Follow", 'nasa-core'),
        "base" => "nasa_follow",
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Display Follow icon social.", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "show_settings_on_create" => false,
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__('Title', 'nasa-core'),
                "param_name" => 'title'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Twitter', 'nasa-core'),
                "param_name" => 'twitter'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Facebook', 'nasa-core'),
                "param_name" => 'facebook'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Pinterest', 'nasa-core'),
                "param_name" => 'pinterest'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Email', 'nasa-core'),
                "param_name" => 'email'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Google Plus', 'nasa-core'),
                "param_name" => 'googleplus'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Instagram', 'nasa-core'),
                "param_name" => 'instagram'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('RSS', 'nasa-core'),
                "param_name" => 'rss'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Linkedin', 'nasa-core'),
                "param_name" => 'linkedin'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Youtube', 'nasa-core'),
                "param_name" => 'youtube'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Flickr', 'nasa-core'),
                "param_name" => 'flickr'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Telegram', 'nasa-core'),
                "param_name" => 'telegram'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__('Whatsapp', 'nasa-core'),
                "param_name" => 'whatsapp'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Extra class name", 'nasa-core'),
                "param_name" => "el_class",
                "description" => esc_html__("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", 'nasa-core')
            )
        )
    );
    
    vc_map($follow);
}