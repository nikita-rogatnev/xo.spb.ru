<?php
/*
  Template name: My Account
  This templates add Account menu to the sidebar.
 */

$nasa_pageName = get_the_title();
$current_url = get_permalink();
$myaccount_page_id = get_option('woocommerce_myaccount_page_id');
$myaccount_page = get_permalink($myaccount_page_id);
$logout_url = wp_logout_url(home_url('/'));

get_header(); ?>

<div class="page-wrapper my-account">
    <div class="row">
        <div id="content" class="large-12 columns">
            <?php if (NASA_CORE_USER_LOGIGED) : ?>
                <div class="row collapse vertical-tabs">
                    <div class="large-3 columns nasa-menu-account-wrap">
                        <div class="account-user hide-for-small">
                            <?php
                            $current_user = wp_get_current_user();
                            $user_id = $current_user->ID;
                            echo get_avatar($user_id, 60);
                            ?>
                            <span class="user-name"><?php echo esc_attr($current_user->display_name); ?></span>
                            <span class="logout-link"><a href="<?php echo esc_url($logout_url); ?>" title="<?php esc_attr_e('Logout', 'elessi-theme'); ?>"><?php esc_html_e('Logout', 'elessi-theme'); ?></a></span>
                            <br />
                        </div>
                        <div class="account-nav">
                            <div class="menu-my-account-container">
                                <ul class="tabs-nav">
                                    <?php
                                    $nasa_wc_acc_items = wc_get_account_menu_items();
                                    if ($nasa_wc_acc_items) :
                                        foreach ($nasa_wc_acc_items as $endpoint => $label) :
                                            if (isset($wp->query_vars[$endpoint])) :
                                                $nasa_pageName = $label;
                                            endif;
                                            $href = $endpoint == 'customer-logout' ? $logout_url : wc_get_account_endpoint_url($endpoint);
                                            ?>
                                            
                                            <li class="<?php echo wc_get_account_menu_item_classes($endpoint); ?>">
                                                <a href="<?php echo esc_url($href); ?>" title="<?php echo esc_attr($label); ?>"><?php echo esc_html($label); ?></a>
                                            </li>
                                        <?php endforeach;
                                    endif;
                                    ?>
                                </ul>
                            </div>

                        </div><!-- .account-nav -->
                    </div><!-- .large-3 -->

                    <div class="large-9 columns nasa-info-account-wrap">
                        <div class="tabs-inner active nasa-my-acc-content">
                            <h4 class="heading-title"><span><?php echo esc_html($nasa_pageName); ?></span></h4>
                            <div class="nasa-hr medium"></div>
                            <?php
                            echo shortcode_exists('woocommerce_my_account') ?
                                do_shortcode('[woocommerce_my_account]') : '';
                            
                            while (have_posts()) :
                                the_post();
                                the_content();
                            endwhile; // end of the loop.
                            ?>
                        </div><!-- .tabs-inner -->
                    </div><!-- .large-9 -->
                </div><!-- .row .vertical-tabs -->

            <?php else : ?>
                <h1 class="margin-top-20 text-center"><?php echo esc_html__('Login or Register', 'elessi-theme'); ?></h1>
                <?php
                echo shortcode_exists('woocommerce_my_account') ?
                    do_shortcode('[woocommerce_my_account]') : '';
                while (have_posts()) :
                    the_post();
                    the_content();
                endwhile; // end of the loop.
                ?>
            <?php endif; ?>

        </div><!-- end #content large-12 -->
    </div><!-- end row -->
</div><!-- end page-right-sidebar container -->
<?php
get_footer();