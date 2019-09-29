<?php

/**
 * Render Time sale Countdown
 */
if(!function_exists('elessi_time_sale')) :
    function elessi_time_sale($time_sale = null, $gmt = true) {
        $result = '';
        
        if($time_sale) {
            $result .= '<div class="nasa-sc-pdeal-countdown">';
            $result .= $gmt ?
            '<span class="countdown" data-fomart="dhms" data-countdown="' . esc_attr(get_date_from_gmt(date('Y-m-d H:i:s', $time_sale), 'M j Y H:i:s O')) . '"></span>' : 
            '<span class="countdown" data-fomart="dhms" data-countdown="' . esc_attr(date('M j Y H:i:s O', $time_sale)) . '"></span>';
            
            $result .= '</div>';
        }
        
        return $result;
    }
endif;

// **********************************************************************//
// ! Get logo
// **********************************************************************//
if (!function_exists('elessi_logo')) :

    function elessi_logo($h1 = false) {
        global $nasa_logo, $nasa_root_term_id;
        
        if(!isset($nasa_logo) || !$nasa_logo) {
            global $nasa_opt, $wp_query;
            
            $logo_link = isset($nasa_opt['site_logo']) ? $nasa_opt['site_logo'] : '';
            $logo_retina = isset($nasa_opt['site_logo_retina']) ? $nasa_opt['site_logo_retina'] : '';
            $page_id = false;
            
            /*
             * Override Logo
             */
            $is_product = is_product();
            $is_product_cat = is_product_category();
            $is_product_taxonomy = is_product_taxonomy();
            $is_shop = is_shop();
            $pageShop = wc_get_page_id('shop');
            
            if($is_shop || $is_product_cat || $is_product_taxonomy || $is_product) {
                $term_id = false;
                $logo_retina_id = false;

                /**
                 * Check Single product
                 */
                if($is_product) {
                    if(!$nasa_root_term_id) {
                        $product_cats = get_the_terms($wp_query->get_queried_object_id(), 'product_cat');
                        if($product_cats) {
                            foreach ($product_cats as $cat) {
                                $term_id = $cat->term_id;
                                break;
                            }
                        }
                    } else {
                        $term_id = $nasa_root_term_id;
                    }
                }

                /**
                 * Check Category product
                 */
                elseif($is_product_cat) {
                    $query_obj = $wp_query->get_queried_object();
                    $term_id = isset($query_obj->term_id) ? $query_obj->term_id : false;
                }
                
                if($term_id) {
                    $logo_id = get_term_meta($term_id, 'cat_logo', true);

                    if(!$logo_id) {
                        if($nasa_root_term_id) {
                            $term_id = $nasa_root_term_id;
                        } else {
                            $ancestors = get_ancestors($term_id, 'product_cat');
                            $term_id = $ancestors ? end($ancestors) : 0;
                            $GLOBALS['nasa_root_term_id'] = $term_id;
                        }
                        
                        if($term_id) {
                            $logo_id = get_term_meta($term_id, 'cat_logo', true);
                            $logo_retina_id = $logo_id ? get_term_meta($term_id, 'cat_logo_retina', true) : false;
                        }
                    }

                    if($logo_id) {
                        $logo_link_overr = wp_get_attachment_image_url($logo_id, 'full');
                        $logo_link = $logo_link_overr ? $logo_link_overr : $logo_link;

                        $logo_retina_overr = $logo_retina_id ? wp_get_attachment_image_url($logo_retina_id, 'full') : false;
                        $logo_retina = $logo_retina_overr ? $logo_retina_overr : ($logo_link ? $logo_link : $logo_retina);
                    }
                }
                
                /**
                 * Check shop page
                 */
                elseif($pageShop > 0) {
                    $page_id = $pageShop;
                }
            }
            
            /**
             * Page
             */
            elseif(!$page_id) {
                $page_id = $wp_query->get_queried_object_id();
            }
            
            if($page_id) {
                $logo_link_overr = get_post_meta($page_id, '_nasa_custom_logo', true);
                $logo_link = $logo_link_overr ? $logo_link_overr : $logo_link;

                $logo_retina_overr = get_post_meta($page_id, '_nasa_custom_logo_retina', true);
                $logo_retina = $logo_retina_overr ? $logo_retina_overr : ($logo_link ? $logo_link : $logo_retina);
            }
            
            $attr_retina = $logo_retina != '' ? ' data-src-retina="' . esc_attr($logo_retina) . '"' : '';
            
            $site_title = esc_attr(get_bloginfo('name', 'display'));

            $content = '<a class="nasa-logo-retina" href="' . esc_url(home_url('/')) . '" title="' . $site_title . ' - ' . esc_attr(get_bloginfo('description', 'display')) . '" rel="' . esc_attr__('Home', 'elessi-theme') . '">';
            $content .= $logo_link != '' ? '<img src="' . esc_attr($logo_link) . '" class="header_logo" alt="' . $site_title . '"' . $attr_retina . ' />' : get_bloginfo('name', 'display');
            $content .= '</a>';
            
            $GLOBALS['nasa_logo'] = $content;
            
            return $h1 ? '<h1 class="logo nasa-logo-img">' . $content . '</h1>' : $content;
        }
        
        return $h1 ? '<h1 class="logo nasa-logo-img">' . $nasa_logo . '</h1>' : $nasa_logo;
    }

endif;

if (!function_exists('elessi_search')) :
    function elessi_search_form_product($form) {
        return str_replace(
            '<input type="hidden" name="post_type" value="post" />',
            '<input type="hidden" name="post_type" value="product" />',
            $form
        );
    }
endif;

// **********************************************************************//
// ! Get header search
// **********************************************************************//
if (!function_exists('elessi_search')) :

    function elessi_search($search_type = 'icon', $return = true) {
        add_filter('get_search_form', 'elessi_search_form_product');
        
        $class_wrap = ' nasa_search_' . $search_type;
        $class = $search_type == 'icon' ? ' nasa-over-hide' : ' nasa-search-relative';
        $search = '';
        $search .= '<div class="nasa-search-space' . esc_attr($class_wrap) . '">';
        $search .= '<div class="nasa-show-search-form' . $class . '">';
        $search .= get_search_form(false);
        $search .= '</div>';
        $search .= '</div>';
        
        remove_filter('get_search_form', 'elessi_search_form_product');
        
        if($return) {
            return $search;
        }
        
        echo ($search);
    }

endif;

// **********************************************************************// 
// ! Get main menu
// **********************************************************************// 
if (!function_exists('elessi_get_main_menu')) :

    function elessi_get_main_menu($main = true) {
        global $nasa_main_menu;
        
        $mega = class_exists('Nasa_Nav_Menu');
        $walker = $mega ? new Nasa_Nav_Menu() : new Walker_Nav_Menu();
        if(!$nasa_main_menu) {
            if (has_nav_menu('primary')) :
                $GLOBALS['nasa_main_menu'] = wp_nav_menu(array(
                    'echo' => false,
                    'theme_location' => 'primary',
                    'container' => false,
                    'items_wrap' => '%3$s',
                    'depth' => 3,
                    'walker' => $walker
                ));
            else:
                $allowed_html = array(
                    'li' => array(),
                    'b' => array()
                );
                
                $GLOBALS['nasa_main_menu'] = wp_kses(__('<li>Please Define menu in <b>Apperance > Menus</b></li>', 'elessi-theme'), $allowed_html);
            endif;
        }
        
        echo '<div class="nav-wrapper inline-block main-menu-warpper">';
        echo '<ul' . ($main ? ' id="site-navigation" ' : ' ') . 'class="header-nav' . ($mega ? '' : ' nasa-wp-simple-nav-menu') . '">';
        echo $nasa_main_menu;
        echo '</ul>';
        echo '</div><!-- nav-wrapper -->';
    }

endif;

if (!function_exists('elessi_get_menu')) :

    function elessi_get_menu($menu_location, $class = "", $depth = 3) {
        if (has_nav_menu($menu_location)) :
            $mega = class_exists('Nasa_Nav_Menu');
            $walker = $mega ? new Nasa_Nav_Menu() : new Walker_Nav_Menu();
            $class .= $mega ? ' nasa-nav-menu' : ' nasa-wp-simple-nav-menu';
            echo '<ul class="' . esc_attr($class) . '">';
            wp_nav_menu(array(
                'theme_location' => $menu_location,
                'container' => false,
                'items_wrap' => '%3$s',
                'depth' => (int) $depth,
                'walker' => $walker
            ));
            echo '</ul>';
        endif;
    }

endif;

// **********************************************************************// 
// ! Get Vertical menu
// **********************************************************************// 
if (!function_exists('elessi_get_vertical_menu')) :

    function elessi_get_vertical_menu() {
        global $nasa_vertical_menu;

        if(!$nasa_vertical_menu) {
            global $nasa_opt, $wp_query;
            $pageId = $wp_query->get_queried_object_id();
            
            $menu = isset($nasa_opt['vertical_menu_selected']) ? $nasa_opt['vertical_menu_selected'] : false;
            if($pageId) {
                $menu_overr = get_post_meta($pageId, '_nasa_vertical_menu_selected', true);
                if($menu_overr) {
                    $menu = $menu_overr;
                }
            }

            if (!$menu) {
                $locations = get_theme_mod('nav_menu_locations');
                $menu = isset($locations['vetical-menu']) && $locations['vetical-menu'] ? $locations['vetical-menu'] : null;
            }

            if ($menu && $menu != '-1') {
                $rtl = (isset($nasa_opt['nasa_rtl']) && $nasa_opt['nasa_rtl']) || (isset($_GET['rtl']) && $_GET['rtl'] == '1') ? true : false;
                $show = $pageId ? get_post_meta($pageId, '_nasa_vertical_menu_allways_show', true) : false;
                $nasa_wrap = 'vertical-menu nasa-vertical-header';
                $nasa_class = $show ? ' nasa-allways-show' : '';
                $nasa_wrap .= $show ? ' nasa-allways-show-warp' : '';
                $nasa_wrap .= $rtl ? ' nasa-menu-ver-align-right' : ' nasa-menu-ver-align-left';

                $mega = class_exists('Nasa_Nav_Menu');
                $walker = $mega ? new Nasa_Nav_Menu() : new Walker_Nav_Menu();
                $class = $mega ? '' : ' nasa-wp-simple-nav-menu';
                
                ob_start();
                ?>
                <div class="<?php echo esc_attr($nasa_wrap); ?>">
                    <div class="title-inner">
                        <h5 class="section-title nasa-title-vertical-menu">
                            <?php echo esc_html__('Browse Categories', 'elessi-theme'); ?>
                        </h5>
                    </div>
                    <div class="vertical-menu-container<?php echo esc_attr($nasa_class); ?>">
                        <ul class="vertical-menu-wrapper<?php echo esc_attr($class); ?>">
                            <?php
                            wp_nav_menu(array(
                                'menu' => $menu,
                                'container' => false,
                                'items_wrap' => '%3$s',
                                'depth' => 3,
                                'walker' => $walker
                            ));
                            ?>
                        </ul>
                    </div>
                </div>
                <?php
                
                $nasa_vertical_menu = ob_get_clean();
                $GLOBALS['nasa_vertical_menu'] = $nasa_vertical_menu;
            }
        }
        
        echo $nasa_vertical_menu ? $nasa_vertical_menu : '';
    }

endif;

if (!function_exists('elessi_tpl2id')) :

    function elessi_tpl2id($tpl) {
        $pages = get_pages(array(
            'meta_key' => '_wp_page_template',
            'meta_value' => $tpl
        ));

        if (empty($pages)) {
            return null;
        }

        foreach ($pages as $page) {
            return $page->ID;
        }
    }

endif;

if (!function_exists('elessi_back_to_page')) :

    function elessi_back_to_page() {
        echo '<a class="back-history" href="javascript: history.go(-1)">' . esc_html__('Return to Previous Page', 'elessi-theme') . '</a>';
    }

endif;

// **********************************************************************// 
// ! Get breadcrumb
// **********************************************************************//
if (!function_exists('elessi_get_breadcrumb')) :

    function elessi_get_breadcrumb() {
        if (!NASA_WOO_ACTIVED) {
            return;
        }

        global $wp_query, $post, $nasa_opt, $nasa_root_term_id;
        $enable = (isset($nasa_opt['breadcrumb_show']) && !$nasa_opt['breadcrumb_show']) ? false : true;
        $override = false;
        
        // Theme option
        $has_bg = (isset($nasa_opt['breadcrumb_type']) && $nasa_opt['breadcrumb_type'] == 'has-background') ? true : false;

        $bg = (isset($nasa_opt['breadcrumb_bg']) && trim($nasa_opt['breadcrumb_bg']) != '') ?
            $nasa_opt['breadcrumb_bg'] : false;

        $bg_cl = (isset($nasa_opt['breadcrumb_bg_color']) && $nasa_opt['breadcrumb_bg_color']) ?
            $nasa_opt['breadcrumb_bg_color'] : false;
        
        $bg_lax = (isset($nasa_opt['breadcrumb_bg_lax']) && $nasa_opt['breadcrumb_bg_lax'] == 1) ? true : false;

        $h_bg = (isset($nasa_opt['breadcrumb_height']) && (int) $nasa_opt['breadcrumb_height']) ?
            (int) $nasa_opt['breadcrumb_height'] : false;

        $txt_color = (isset($nasa_opt['breadcrumb_color']) && $nasa_opt['breadcrumb_color']) ?
            $nasa_opt['breadcrumb_color'] : false;

        /*
         * Override breadcrumb BG
         */
        $is_product = is_product();
        $is_product_cat = is_product_category();
        $is_product_taxonomy = is_product_taxonomy();
        $is_shop = is_shop();
        
        if($is_shop || $is_product_cat || $is_product_taxonomy || $is_product) {
            $pageShop = wc_get_page_id('shop');
            
            if($pageShop > 0) {
                $show_breadcrumb = get_post_meta($pageShop, '_nasa_show_breadcrumb', true);
                $enable = ($show_breadcrumb != 'on') ? false : true;
                if ($enable === false) {
                    return;
                }
            }
            
            $term_id = false;
            
            /**
             * Check Single product
             */
            if($is_product) {
                if(!$nasa_root_term_id) {
                    $product_cats = get_the_terms($wp_query->get_queried_object_id(), 'product_cat');
                    if($product_cats) {
                        foreach ($product_cats as $cat) {
                            $term_id = $cat->term_id;
                            break;
                        }
                    }
                } else {
                    $term_id = $nasa_root_term_id;
                }
            }
            
            /**
             * Check Archive product
             */
            elseif($is_product_cat) {
                $query_obj = get_queried_object();
                $term_id = isset($query_obj->term_id) ? $query_obj->term_id : false;
            }
            
            if($term_id) {
                $bg_cat_enable = get_term_meta($term_id, 'cat_breadcrumb', true);

                if(!$bg_cat_enable) {
                    if($nasa_root_term_id) {
                        $term_id = $nasa_root_term_id;
                    } else {
                        $ancestors = get_ancestors($term_id, 'product_cat');
                        $term_id = $ancestors ? end($ancestors) : 0;
                        $GLOBALS['nasa_root_term_id'] = $term_id;
                    }
                    
                    if($term_id) {
                        $bg_cat_enable = get_term_meta($term_id, 'cat_breadcrumb', true);
                    }
                }

                if($bg_cat_enable) {
                    $bgImgId = get_term_meta($term_id, 'cat_breadcrumb_bg', true);
                    if ($bgImgId) {
                        $bg = wp_get_attachment_image_url($bgImgId, 'full');
                        $has_bg = true;
                    }

                    $text_color_cat = get_term_meta($term_id, 'cat_breadcrumb_text_color', true);
                    $txt_color = $text_color_cat != '' ? $text_color_cat : $txt_color;
                }
            }
            
            /**
             * Breadcrumb shop page
             */
            elseif($is_shop && $pageShop > 0) {
                $queryObj = $pageShop;
                $override = true;
            }
        }
        
        else {
            $pageBlog = get_option('page_for_posts');
            /**
             * Check page
             */
            if (isset($post->ID) && $post->post_type == 'page') {
                $queryObj = $post->ID;
                $show_breadcrumb = get_post_meta($queryObj, '_nasa_show_breadcrumb', true);
                $enable = ($show_breadcrumb != 'on') ? false : true;
                $override = true;
            }
            
            /**
             * Check Blog | archive post | single post
             */
            elseif($pageBlog && isset($post->post_type) && $post->post_type == 'post' && (is_category() || is_tag() || is_date() || is_home() || is_single())) {
                $show_breadcrumb = get_post_meta($pageBlog, '_nasa_show_breadcrumb', true);
                $enable = ($show_breadcrumb != 'on') ? false : true;
                $queryObj = $pageBlog;
                $override = true;
            }

            if ($enable === false) {
                return;
            }
        }
        
        // Override
        if ($override) {
            $type_bg = get_post_meta($queryObj, '_nasa_type_breadcrumb', true);
            $bg_override = get_post_meta($queryObj, '_nasa_bg_breadcrumb', true);
            $bg_cl_override = get_post_meta($queryObj, '_nasa_bg_color_breadcrumb', true);
            $h_override = get_post_meta($queryObj, '_nasa_height_breadcrumb', true);
            $color_override = get_post_meta($queryObj, '_nasa_color_breadcrumb', true);

            if ($type_bg == '1') {
                $bg = $bg_override ? $bg_override : $bg;
            }

            $bg_cl = $bg_cl_override ? $bg_cl_override : $bg_cl;
            $txt_color = $color_override ? $color_override : $txt_color;
            $h_bg = (int) $h_override ? (int) $h_override : $h_bg;
        }

        // set style by option breadcrumb
        $style_custom = '';
        if ($has_bg) {
            $style_custom .= $bg ? 'background:url(\'' . esc_url($bg) . '\') center center repeat-y;' : '';
        }
        
        $style_custom .= $bg_cl ? 'background-color:' . $bg_cl . ';' : '';
        $style_custom .= $txt_color ? 'color:' . $txt_color . ';' : '';
        $style_height = $h_bg ? 'height:' . $h_bg . 'px;' : 'height:auto;';
        
        $defaults = apply_filters('nasa_breadcrumb_args', array(
            'delimiter' => '<span class="fa fa-angle-right"></span>',
            'wrap_before' => '<h3 class="breadcrumb">',
            'wrap_after' => '</h3>',
            'before' => '',
            'after' => '',
            'home' => esc_html__('Home', 'elessi-theme'),
        ));
        
        $parallax = ($has_bg && $bg && $bg_lax) ? true : false;
        $bread_align = !isset($nasa_opt['breadcrumb_align']) ? 'text-center' : $nasa_opt['breadcrumb_align'];
        $args = wp_parse_args($defaults);
        
        $wc_breadcrumbs = new WC_Breadcrumb();

        if (!empty($args['home'])) {
            $wc_breadcrumbs->add_crumb(
                $args['home'],
                apply_filters('woocommerce_breadcrumb_home_url', home_url('/'))
            );
        }
        $args['breadcrumb'] = $wc_breadcrumbs->generate();
        do_action('woocommerce_breadcrumb', $wc_breadcrumbs, $args);
        ?>
        <div id="nasa-breadcrumb-site" class="bread nasa-breadcrumb<?php echo ($has_bg ? ' nasa-breadcrumb-has-bg' : '') . ($parallax ? ' nasa-parallax' : ''); ?>"<?php echo ($style_custom) ? ' style="' . esc_attr($style_custom) . '"' : ''; ?><?php echo ($parallax ? ' data-stellar-background-ratio="0.6"' : ''); ?>>
            <div class="row">
                <div class="large-12 columns nasa-display-table">
                    <div class="breadcrumb-row <?php echo esc_attr($bread_align); ?>" style="<?php echo esc_attr($style_height); ?>">
                        <?php wc_get_template('global/breadcrumb.php', $args); ?>
                    </div>
                </div>
            </div>
        </div>

        <?php
    }

endif;

/**
 * Build breadcrumb Portfolio
 */
if(!function_exists('elessi_rebuilt_breadcrumb_portfolio')) :
    function elessi_rebuilt_breadcrumb_portfolio($orgBreadcrumb, $single = true) {
        global $nasa_opt, $post;
        
        $breadcrumb = array($orgBreadcrumb[0]);
        
        $portfolio = null;
        if(isset($nasa_opt['nasa-page-view-portfolio']) && (int) $nasa_opt['nasa-page-view-portfolio']) {
            $portfolio = get_post((int) $nasa_opt['nasa-page-view-portfolio']);
        } else {
            $pages = get_pages(array(
                'meta_key' => '_wp_page_template',
                'meta_value' => 'portfolio.php'
            ));

            if($pages) {
                foreach ($pages as $page) {
                    $portfolio = get_post((int) $page->ID);
                    break;
                }
            }
        }

        if ($portfolio) {
            $breadcrumb[] = array(
                0 => $portfolio->post_title,
                1 => get_permalink($portfolio)
            );
        }

        $terms = wp_get_post_terms(
            $post->ID,
            'portfolio_category',
            array(
                'orderby' => 'parent',
                'order' => 'DESC'
            )
        );

        if ($terms) {
            $main_term = $terms[0];
            $ancestors = get_ancestors($main_term->term_id, 'portfolio_category');
            $ancestors = array_reverse($ancestors);
            if (count($ancestors)) {
                foreach ($ancestors as $ancestor) {
                    $ancestor = get_term($ancestor, 'portfolio_category');

                    if($ancestor) {
                        $breadcrumb[] = array(
                            0 => $ancestor->name,
                            1 => get_term_link($ancestor, 'portfolio_category')
                        );
                    }
                }
            }

            if($single) {
                $breadcrumb[] = array(
                    0 => $main_term->name,
                    1 => get_term_link($main_term, 'portfolio_category')
                );
            }
        }

        return $breadcrumb;
    }
endif;

// **********************************************************************// 
// ! Add body class
// **********************************************************************//
add_filter('body_class', 'elessi_body_classes');
if (!function_exists('elessi_body_classes')) :

    function elessi_body_classes($classes) {
        global $nasa_opt;

        $classes[] = 'antialiased';
        if (is_multi_author()) {
            $classes[] = 'group-blog';
        }

        if (isset($nasa_opt['site_layout']) && $nasa_opt['site_layout'] == 'boxed') {
            $classes[] = 'boxed';
        }

        if (isset($nasa_opt['promo_popup']) && $nasa_opt['promo_popup'] == 1) {
            $classes[] = 'open-popup';
        }

        if (NASA_WOO_ACTIVED && function_exists('is_product')) {
            if (is_product() && isset($nasa_opt['product-zoom']) && $nasa_opt['product-zoom']) {
                $classes[] = 'product-zoom';
            }
        }

        if (
            (isset($nasa_opt['nasa_rtl']) && $nasa_opt['nasa_rtl']) ||
            (isset($_REQUEST['rtl']) && $_REQUEST['rtl'] == '1')
        ) {
            $classes[] = 'nasa-rtl';
        }

        return $classes;
    }

endif;

// **********************************************************************// 
// ! Add hr to the widget title
// **********************************************************************//
if (!function_exists('elessi_widget_title')) :

    function elessi_widget_title($title) {
        return !empty($title) ? $title . '<span class="nasa-hr small primary-color"></span>' : '';
    }

endif;

// **********************************************************************// 
// ! Comments
// **********************************************************************//  
if (!function_exists('elessi_comment')) :

    function elessi_comment($comment, $args, $depth) {
        $GLOBALS['comment'] = $comment;
        switch ($comment->comment_type) :
            case 'pingback' :
            case 'trackback' : ?>
                <li class="post pingback">
                    <p><?php esc_html_e('Pingback:', 'elessi-theme'); ?> <?php comment_author_link(); ?><?php edit_comment_link(esc_html__('Edit', 'elessi-theme'), '<span class="edit-link">', '<span>'); ?></p>
                <?php
                break;
            default : ?>
                <li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">
                    <article id="comment-<?php comment_ID(); ?>" class="comment-inner">
                        <div class="row collapse">
                            <div class="large-2 columns">
                                <div class="comment-author">
                                    <?php echo get_avatar($comment, 80); ?>
                                </div>
                            </div>
                            <div class="large-10 columns">
                                <?php printf('<cite class="fn">%s</cite>', get_comment_author_link()); ?>
                                <div class="comment-meta commentmetadata right">
                                    <i class="fa fa-clock-o"></i>
                                    <time datetime="<?php comment_time('c'); ?>">
                                        <?php printf(_x('%1$s at %2$s', '1: date, 2: time', 'elessi-theme'), get_comment_date(), get_comment_time()); ?>
                                    </time>
                                    <?php edit_comment_link(esc_html__('Edit', 'elessi-theme'), '<span class="edit-link">', '<span>'); ?>
                                </div>
                                <div class="reply">
                                    <?php
                                    comment_reply_link(array_merge($args, array(
                                        'depth' => $depth,
                                        'max_depth' => $args['max_depth'],
                                    )));
                                    ?>
                                </div>
                                <?php if ($comment->comment_approved == '0') : ?>
                                    <em><?php esc_html_e('Your comment is awaiting moderation.', 'elessi-theme'); ?></em><br />
                                <?php endif; ?>

                                <div class="comment-content"><?php comment_text(); ?></div>
                            </div>
                        </div>
                    </article>
                <?php
                break;
        endswitch;
    }

endif;

// **********************************************************************// 
// ! Post meta top
// **********************************************************************//  
if (!function_exists('elessi_posted_on')) :

    function elessi_posted_on() {
        $allowed_html = array(
            'span' => array('class' => array()),
            'strong' => array(),
            'a' => array('class' => array(), 'href' => array(), 'title' => array(), 'rel' => array()),
            'time' => array('class' => array(), 'datetime' => array())
        );
        $day = get_the_date('d');
        $month = get_the_date('m');
        $year = get_the_date('Y');
        $author = get_the_author();
        printf(
            wp_kses(
                __('<span class="meta-author">By <strong><a class="url fn n" href="%5$s" title="%6$s" rel="author">%7$s</a></strong>.</span> Posted on <a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a>', 'elessi-theme'), $allowed_html
            ),
            esc_url(get_day_link($year, $month, $day)),
            esc_attr(get_the_time()),
            esc_attr(get_the_date('c')),
            esc_html(get_the_date()),
            esc_url(get_author_posts_url(get_the_author_meta('ID'))),
            esc_attr(
                sprintf(
                    esc_html__('View all posts by %s', 'elessi-theme'),
                    $author
                )
            ),
            $author
        );
    }

endif;

// **********************************************************************// 
// ! Promo Popup
// **********************************************************************// 
add_action('nasa_before_page_wrapper', 'elessi_promo_popup');
if (!function_exists('elessi_promo_popup')) :

    function elessi_promo_popup() {
        global $nasa_opt;
        if(!isset($nasa_opt['promo_popup']) || !$nasa_opt['promo_popup']) {
            return;
        }
        
        $popup_closed = isset($_COOKIE['nasatheme_popup_closed']) ? $_COOKIE['nasatheme_popup_closed'] : '';
        if($popup_closed === 'do-not-show') {
            return;
        }
        
        $nasa_opt['pp_background_image'] = (isset($nasa_opt['pp_background_image']) && $nasa_opt['pp_background_image'] != '') ? $nasa_opt['pp_background_image'] : ELESSI_THEME_URI . '/assets/images/newsletter_bg.jpg';
        
        $delay = (!isset($nasa_opt['delay_promo_popup']) || (int) $nasa_opt['delay_promo_popup'] <= 0) ? 0 : (int) $nasa_opt['delay_promo_popup'];
        
        //disable_popup_mobile
        $disableMobile = (isset($nasa_opt['disable_popup_mobile']) && (int) $nasa_opt['disable_popup_mobile']) ? 'true' : 'false';
        
        echo '<div class="popup_link hidden-tag"><a class="nasa-popup open-click" href="#nasa-popup" data-delay="' . esc_attr($delay) . '" data-disable_mobile="' . esc_attr($disableMobile) . '">' . esc_html__('Newsletter', 'elessi-theme') . '</a></div>';
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-promo-popup.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-promo-popup.php';
    }

endif;

add_filter('wp_nav_menu_objects', 'elessi_add_menu_parent_class');
if (!function_exists('elessi_add_menu_parent_class')) :
    function elessi_add_menu_parent_class($items) {
        $parents = array();
        foreach ($items as $item) {
            if ($item->menu_item_parent && $item->menu_item_parent > 0) {
                $parents[] = $item->menu_item_parent;
            }
        }

        foreach ($items as $item) {
            if (in_array($item->ID, $parents)) {
                $item->classes[] = 'menu-parent-item';
            }
        }

        return $items;
    }
endif;

// **********************************************************************// 
// ! Language Flags
// **********************************************************************//
if (!function_exists('elessi_language_flages')) :

    function elessi_language_flages() {
        global $nasa_opt;
        
        if(!isset($nasa_opt['switch_lang']) || $nasa_opt['switch_lang'] != 1) {
            return '';
        }
        
        $language_output = '<select name="nasa_switch_languages" class="nasa-select-language" data-active="0">';
        $options = '';
        if (function_exists('icl_get_languages')) {
            $current = defined('ICL_LANGUAGE_CODE') ? ICL_LANGUAGE_CODE : 'en';
            
            $language_output = '<select name="nasa_switch_languages" class="nasa-select-language" data-active="1">';
            $languages = icl_get_languages('skip_missing=0&orderby=code');
            if (!empty($languages)) {
                foreach ($languages as $l) {
                    $selected = $current == $l['language_code'] ? ' selected' : '';
                    $options .= '<option data-code="' . $l['language_code'] . '" value="' . $l['url'] . '"' . $selected . '>' . $l['native_name'] . '</option>';
                }
            }
        } else {
            $options .=
                '<option value="en">' . esc_html__('English', 'elessi-theme') . '</option>' .
                '<option value="gr">' . esc_html__('German', 'elessi-theme') . '</option>' .
                '<option value="fr">' . esc_html__('French', 'elessi-theme') . '</option>';
        }
        
        $language_output .= $options;
        $language_output .= '</select>';

        echo '<ul class="header-switch-languages"><li>' . $language_output . '</li></ul>';
    }

endif;

add_action('pre_get_posts', 'elessi_pre_get_posts_action');
if (!function_exists('elessi_pre_get_posts_action')) :
    function elessi_pre_get_posts_action($query) {
        $action = isset($_GET['action']) ? $_GET['action'] : '';
        if ($action == 'woocommerce_json_search_products') {
            return;
        }
        if (defined('DOING_AJAX') && DOING_AJAX && !empty($query->query_vars['s'])) {
            if (isset($query->query_vars['post_type'])) {
                $query->query_vars['post_type'] = array($query->query_vars['post_type'], 'post', 'page');
            }
            if (isset($query->query_vars['meta_query'])) {
                $query->query_vars['meta_query'] = new WP_Meta_Query(array('relation' => 'OR', $query->query_vars['meta_query']));
            }
        }
    }
endif;

/* cut string limit */
if (!function_exists('elessi_limit_words')) :

    function elessi_limit_words($string, $word_limit) {
        $words = explode(' ', $string, ($word_limit + 1));
        if (count($words) <= $word_limit) {
            return $string;
        }
        array_pop($words);
        return implode(' ', $words) . ' ...';
    }

endif;

// **********************************************************************// 
// ! Blog post navigation
// **********************************************************************//  
if (!function_exists('elessi_content_nav')) :

    function elessi_content_nav($nav_id) {
        global $wp_query, $post;
        $allowed_html = array(
            'span' => array('class' => array())
        );
        
        $is_single = is_single();

        if ($is_single) {
            $previous = (is_attachment()) ? get_post($post->post_parent) : get_adjacent_post(false, '', true);
            $next = get_adjacent_post(false, '', false);

            if (!$next && !$previous) {
                return;
            }
        }

        if ($wp_query->max_num_pages < 2 && (is_home() || is_archive() || is_search())) {
            return;
        }

        $nav_class = $is_single ? 'navigation-post' : 'navigation-paging';
        ?>
        <nav role="navigation" id="<?php echo esc_attr($nav_id); ?>" class="<?php echo esc_attr($nav_class); ?>">
            <?php
            if ($is_single) {
                previous_post_link('<div class="nav-previous left">%link</div>', '<span class="fa fa-caret-left">' . _x('', 'Previous post link', 'elessi-theme') . '</span> %title');
                next_post_link('<div class="nav-next right">%link</div>', '%title <span class="fa fa-caret-right">' . _x('', 'Next post link', 'elessi-theme') . '</span>');
            } elseif ($wp_query->max_num_pages > 1 && (is_home() || is_archive() || is_search())) {
                // navigation links for home, archive, and search pages
                if (get_next_posts_link()) {
                    ?>
                    <div class="nav-previous"><?php next_posts_link(wp_kses(__('Next <span class="fa fa-caret-right"></span>', 'elessi-theme'), $allowed_html)); ?></div>
                    <?php
                }
                if (get_previous_posts_link()) {
                    ?>
                    <div class="nav-next"><?php previous_posts_link(wp_kses(__('<span class="fa fa-caret-left"></span> Previous', 'elessi-theme'), $allowed_html)); ?></div>
                    <?php
                }
            }
            ?>
        </nav>
        <?php
    }

endif;

/**
 * Get relates post
 */
add_action('nasa_after_single_post', 'elessi_relate_post');
if(!function_exists('elessi_relate_post')) :
    function elessi_relate_post() {
        global $nasa_opt, $post;
        
        if(isset($nasa_opt['relate_blogs']) && !$nasa_opt['relate_blogs']) {
            return;
        }
        
        $numberPost = isset($nasa_opt['relate_blogs_number']) && (int) $nasa_opt['relate_blogs_number'] ? (int) $nasa_opt['relate_blogs_number'] : 10;
        
        $relate = get_posts(
            array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'category__in' => wp_get_post_categories($post->ID),
                'numberposts' => $numberPost,
                'post__not_in' => array($post->ID),
                'orderby' => 'date',
                'order' => 'DESC'
            )
        );
        
        $columns_number_small = isset($nasa_opt['relate_blogs_columns_small']) && (int) $nasa_opt['relate_blogs_columns_small'] ? (int) $nasa_opt['relate_blogs_columns_small'] : 1;
        $columns_number_tablet = isset($nasa_opt['relate_blogs_columns_tablet']) && (int) $nasa_opt['relate_blogs_columns_tablet'] ? (int) $nasa_opt['relate_blogs_columns_tablet'] : 2;
        $columns_number = isset($nasa_opt['relate_blogs_columns_desk']) && (int) $nasa_opt['relate_blogs_columns_desk'] ? (int) $nasa_opt['relate_blogs_columns_desk'] : 3;
        
        $file = ELESSI_CHILD_PATH . '/includes/nasa-blog-relate.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-blog-relate.php';
    }
endif;

//Add shortcode Top bar Promotion news
if (!function_exists('elessi_promotion_recent_post')):
    function elessi_promotion_recent_post() {
        global $nasa_opt;

        if (isset($nasa_opt['enable_post_top']) && !$nasa_opt['enable_post_top']) {
            return '';
        }

        $content = '';
        $posts = null;

        if (!isset($nasa_opt['type_display']) || $nasa_opt['type_display'] == 'custom') {
            $content = isset($nasa_opt['content_custom']) ? $nasa_opt['content_custom'] : '';
        } elseif (isset($nasa_opt['type_display']) && $nasa_opt['type_display'] == 'list-posts') {
            if (!isset($nasa_opt['category_post']) || !$nasa_opt['category_post']) {
                $nasa_opt['category_post'] = null;
            }

            if (!isset($nasa_opt['number_post']) || !$nasa_opt['number_post']) {
                $nasa_opt['number_post'] = 4;
            }

            $args = array(
                'post_status' => 'publish',
                'post_type' => 'post',
                'orderby' => 'date',
                'order' => 'DESC',
                'category' => ((int) $nasa_opt['category_post'] != 0) ? (int) $nasa_opt['category_post'] : null,
                'posts_per_page' => $nasa_opt['number_post']
            );

            $posts = get_posts($args);
        }

        $file = ELESSI_CHILD_PATH . '/includes/nasa-blog-promotion.php';
        include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-blog-promotion.php';
    }
endif;

/**
 * Nasa Block
 */
if (!function_exists('elessi_get_block')):

    function elessi_get_block($slug) {
        $post = $slug ? get_posts(
            array(
                'name'              => $slug,
                'posts_per_page'    => 1,
                'post_type'         => 'nasa_block',
                'post_status'       => 'publish'
            )
        ) : null;
        
        /**
         * With WPML
         */
        if (class_exists('SitePress') && function_exists('icl_object_id') && isset($post->ID)) {
            $postLangID = icl_object_id($post->ID, 'nasa_block', true);
            
            if($postLangID) {
                $postLang = get_post($postLangID);
                $post = $postLang && $postLang->post_status == 'publish' ? $postLang : $post;
            }
        }
        
        $postReal = !empty($post) ? $post[0] : null;
        
        return isset($postReal->post_content) ? do_shortcode($postReal->post_content) : '';
    }

endif;

/**
 * Before load effect site
 */
add_action('nasa_theme_before_load', 'elessi_theme_before_load');
if (!function_exists('elessi_theme_before_load')):

    function elessi_theme_before_load() {
        global $nasa_opt;

        if (!isset($nasa_opt['effect_before_load']) || $nasa_opt['effect_before_load'] == 1) {
            echo 
            '<div id="nasa-before-load">' .
                '<div class="nasa-relative nasa-center">' .
                    '<div class="nasa-loader"></div>' .
                '</div>' .
            '</div>';
        }
    }

endif;
