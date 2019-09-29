<?php
global $nasa_opt, $product;

$attachment_ids = $product->get_gallery_image_ids();
$style_quickview = isset($nasa_opt['style_quickview']) && in_array($nasa_opt['style_quickview'], array('sidebar', 'popup')) ? $nasa_opt['style_quickview'] : 'sidebar';
$style_quickview = isset($_REQUEST['quickview']) && in_array($_REQUEST['quickview'], array('sidebar', 'popup')) ? $_REQUEST['quickview'] : $style_quickview;
$class = $style_quickview == 'sidebar' ? 'large-12 columns' : 'large-6 columns rtl-right';

$column_thumbs = isset($nasa_opt['quick_view_item_thumb']) ? (int) $nasa_opt['quick_view_item_thumb'] : 1;
$show_images = ($style_quickview == 'sidebar' && $attachment_ids && count($attachment_ids) > 1) ?
    apply_filters('nasa_quickview_number_imgs', $column_thumbs) : 1;

$hasThumb = has_post_thumbnail();
$thumbNailId = get_post_thumbnail_id();
$image_link = wp_get_attachment_url($thumbNailId);
$image_large = wp_get_attachment_image_src($thumbNailId, 'shop_single');
$src_large = isset($image_large[0]) ? $image_large[0] : $image_link;

$imageMain = get_the_post_thumbnail($product->get_id(), apply_filters('single_product_large_thumbnail_size', 'shop_single'));
?>
<div class="row collapse">
    <?php do_action('woocommerce_single_product_lightbox_before'); ?>
    
    <div class="<?php echo esc_attr($class); ?> product-quickview-img">
        <div class="product-img nasa-product-gallery-lightbox" data-o_href="<?php echo $src_large; ?>">
            <?php
            $file = ELESSI_CHILD_PATH . '/includes/nasa-single-product-lightbox-gallery.php';
            include is_file($file) ? $file : ELESSI_THEME_PATH . '/includes/nasa-single-product-lightbox-gallery.php';
            ?>
        </div>
    </div>
    
    <div class="<?php echo esc_attr($class); ?> product-quickview-info">
        <div class="product-lightbox-inner product-info summary entry-summary">
            <h1 class="entry-title"><a href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h1>
            <?php do_action('woocommerce_single_product_lightbox_summary'); ?>
        </div>
    </div>
    
    <?php do_action('woocommerce_single_product_lightbox_after'); ?>
</div>
