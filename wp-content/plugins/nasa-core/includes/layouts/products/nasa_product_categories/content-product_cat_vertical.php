<div class="product-category">
    <div class="hover-overlay">
        <a href="<?php echo get_term_link($category, 'product_cat'); ?>" title="<?php echo esc_attr($category->name); ?>">
            <?php nasa_category_thumbnail($category, '280x150'); ?>
            <div class="header-title">
                <h3><?php echo $category->name; ?></h3>
                <?php echo apply_filters('woocommerce_subcategory_count_html', ' <span class="count">' . $category->count . ' ' . esc_html__('items', 'nasa-core') . '</span>', $category); ?>
            </div>
            <?php do_action('woocommerce_after_subcategory_title', $category); ?>
        </a>
    </div>
</div>