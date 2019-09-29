<?php

/**
 * 
 * @param type $font_families
 * @param type $font_set
 * @return string The cleaned URL.
 */
function elessi_google_fonts_url($font_families = array(), $font_set = array()) {
    if (empty($font_families) || empty($font_set)) {
        return false;
    }
    
    $query_args = array(
        'family' => urlencode(implode('|', $font_families)),
        'subset' => urlencode(implode(',', $font_set))
    );
    
    return esc_url_raw(add_query_arg($query_args, 'https://fonts.googleapis.com/css'));
}

/**
 * Select Font custom use load site
 */
if((!isset($nasa_opt['type_font_select']) || $nasa_opt['type_font_select'] == 'custom') && isset($nasa_opt['custom_font']) && $nasa_opt['custom_font']) {
    
    $nasa_upload_dir = !isset($nasa_upload_dir) ? wp_upload_dir() : $nasa_upload_dir;
    if(is_file($nasa_upload_dir['basedir'] . '/nasa-custom-fonts/' . $nasa_opt['custom_font'] . '/' . $nasa_opt['custom_font'] . '.css')) {
        
        add_action('wp_enqueue_scripts', 'elessi_custom_fonts_site');
        function elessi_custom_fonts_site() {
            global $nasa_opt, $nasa_upload_dir;
            wp_enqueue_style('nasa-customfonts', $nasa_upload_dir['baseurl'] . '/nasa-custom-fonts/' . $nasa_opt['custom_font'] . '/' . $nasa_opt['custom_font'] . '.css');
        }
    }
}

/**
 * Select Google Font use load site
 */
elseif ((isset($nasa_opt['type_font_select']) && $nasa_opt['type_font_select'] == 'google') && isset($nasa_opt['type_headings'])) {
    $default_fonts = array(
        "Open Sans",
        "Helvetica",
        "Arial",
        "Sans-serif"
    );

    $googlefonts = array(
        $nasa_opt['type_headings'],
        $nasa_opt['type_texts'],
        $nasa_opt['type_nav'],
        $nasa_opt['type_banner']
    );
    
    if(isset($nasa_opt['type_price'])) {
        $googlefonts[] = $nasa_opt['type_price'];
    }
    
    $nasa_font_family = array();
    $nasa_font_set = array('latin');

    if (!empty($nasa_opt['type_subset'])) {
        foreach ($nasa_opt['type_subset'] as $key => $val) {
            if($val && !in_array($key, $nasa_font_set)) {
                $nasa_font_set[] = $key;
            }
        }
    }

    foreach ($googlefonts as $googlefont) {
        if (!in_array($googlefont, $default_fonts)) {
            $default_fonts[] = $googlefont;
            $nasa_font_family[] = $googlefont . ':400,400italic,500,500italic,600,600italic,700,700italic,800,800italic,900,900italic';
        }
    }

    if (!empty($nasa_font_family) && !empty($nasa_font_set)) {
        add_action('wp_enqueue_scripts', 'elessi_google_fonts');
        function elessi_google_fonts() {
            global $nasa_font_family, $nasa_font_set;
            
            $font_google_url = elessi_google_fonts_url($nasa_font_family, $nasa_font_set);
            if($font_google_url) {
                wp_enqueue_style('nasa-googlefonts', $font_google_url);
            }
        }
    }
}
