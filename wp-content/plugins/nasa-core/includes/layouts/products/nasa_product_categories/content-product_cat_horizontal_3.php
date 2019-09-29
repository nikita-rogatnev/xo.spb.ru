<div class="product-category wow fadeInUp" data-wow-duration="1s" data-wow-delay="<?php echo esc_attr($delay_animation_product); ?>ms">
    <a class="nasa-cat-link" href="<?php echo get_term_link($category, 'product_cat'); ?>" title="<?php echo esc_attr($category->name); ?>">
        <div class="nasa-cat-thumb">
            <?php nasa_category_thumbnail($category, '380x380'); ?>
        </div>
        <h3 class="header-title"><?php echo $category->name; ?></h3>
        <?php do_action('woocommerce_after_subcategory_title', $category); ?>
    </a>
</div>