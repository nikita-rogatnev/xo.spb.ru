<div class="product-category wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($delay_animation_product); ?>ms">
    <a href="<?php echo get_term_link($category, 'product_cat'); ?>" title="<?php echo esc_attr($category->name); ?>">
        <?php nasa_category_thumbnail($category, '480x900'); ?>
        <h3 class="header-title"><?php echo $category->name; ?></h3>
        <div class="hover-overlay"></div>
        <?php do_action('woocommerce_after_subcategory_title', $category); ?>
    </a>
</div>