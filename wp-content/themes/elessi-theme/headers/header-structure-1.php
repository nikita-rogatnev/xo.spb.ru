<div class="<?php echo esc_attr($header_classes); ?>">
    <?php //!-- Top bar --
    elessi_header_topbar();
    //!-- End Top bar --
    
    //!-- Masthead --?>
    <div class="sticky-wrapper">
        <header id="masthead" class="site-header">
            <div class="row">
                <div class="large-12 columns header-container">
                    <!-- Mobile Menu -->
                    <div class="mobile-menu">
                        <?php elessi_mobile_header(); ?>
                    </div>
                    <div class="row nasa-hide-for-mobile">
                        <div class="large-12 columns nasa-wrap-event-search">
                            <div class="nasa-relative nasa-elements-wrap nasa-wrap-width-main-menu">
                                <div class="nasa-transition nasa-left-main-header nasa-float-left">
                                    <!-- Logo -->
                                    <div class="logo-wrapper nasa-float-left">
                                        <?php echo elessi_logo(true); ?>
                                    </div>

                                    <!-- Main menu -->
                                    <div class="wide-nav nasa-float-right nasa-bg-wrap<?php echo esc_attr($menu_warp_class); ?>">
                                        <div class="nasa-menus-wrapper-reponsive" data-padding_y="<?php echo (int) $data_padding_y; ?>" data-padding_x="<?php echo (int) $data_padding_x; ?>">
                                            <?php elessi_get_main_menu(); ?>
                                        </div>
                                    </div>
                                </div>

                                <!-- Group icon header -->
                                <div class="nasa-right-main-header nasa-float-right">
                                    <?php echo ($nasa_header_icons); ?>
                                </div>
                                
                                <div class="nasa-clear-both"></div>
                            </div>
                            
                            <!-- Search form in header -->
                            <div class="nasa-header-search-wrap nasa-hide-for-mobile">
                                <?php echo elessi_search('icon'); ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <?php if(isset($show_cat_top_filter) && $show_cat_top_filter) : ?>
                <div class="nasa-top-cat-filter-wrap">
                    <?php echo elessi_get_all_categories(false, true); ?>
                    <a href="javascript:void(0);" title="<?php esc_attr_e('Close categories filter', 'elessi-theme'); ?>" class="nasa-close-filter-cat"><i class="pe-7s-close"></i></a>
                </div>
            <?php endif; ?>
        </header>
    </div>
</div>
