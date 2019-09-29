<div id="product-<?php echo (int) $product->get_id(); ?>" <?php post_class(); ?>>
    <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
        <div class="div-toggle-sidebar center">
            <a class="toggle-sidebar" href="javascript:void(0);"><i class="fa fa-bars"></i> <?php esc_html_e('Sidebar', 'elessi-theme'); ?></a>
        </div>
    <?php endif; ?>
    
    <div class="row nasa-product-details-page">
        <div class="products-arrow">
            <?php do_action('next_prev_product'); ?>
        </div>

        <div class="<?php echo esc_attr($main_class); ?>" data-num_main="1" data-num_thumb="6" data-speed="300">
            <div class="row">
                <div class="large-7 small-12 columns product-gallery rtl-right"> 
                    <?php do_action('woocommerce_before_single_product_summary'); ?>
                </div>
                
                <div class="large-5 small-12 columns product-info summary entry-summary left rtl-left">
                    <?php do_action('woocommerce_single_product_summary'); ?>
                </div>
            </div>
            
            <?php do_action('woocommerce_after_single_product_summary'); ?>

        </div>

        <?php if ($nasa_actsidebar && $nasa_sidebar != 'no') : ?>
            <div class="<?php echo esc_attr($bar_class); ?>">     
                <div class="inner">
                    <?php dynamic_sidebar('product-sidebar'); ?>
                </div>
            </div>
        <?php endif; ?>

    </div>
</div>