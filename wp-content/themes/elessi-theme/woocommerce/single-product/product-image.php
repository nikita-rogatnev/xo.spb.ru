<?php
/**
 * Custom Product image
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.1
 */
global $product, $nasa_opt;

$productId = $product->get_id();
$attachment_ids = $product->get_gallery_image_ids();
$data_rel = '';
$thumbNailId = get_post_thumbnail_id();
$image_title = esc_attr(get_the_title($thumbNailId));
$image_link = wp_get_attachment_url($thumbNailId);
$image_large = wp_get_attachment_image_src($thumbNailId, 'shop_single');
$src_large = isset($image_large[0]) ? $image_large[0] : $image_link;
$image = get_the_post_thumbnail($productId, apply_filters('single_product_large_thumbnail_size', 'shop_single'), array('title' => $image_title));
$attachment_count = count($attachment_ids);

//$columns = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
//$post_thumbnail_id = $product->get_image_id();
//$wrapper_classes = apply_filters('woocommerce_single_product_image_gallery_classes', array(
//    'woocommerce-product-gallery',
//    'woocommerce-product-gallery--' . ($post_thumbnail_id ? 'with-images' : 'without-images'),
//    'woocommerce-product-gallery--columns-' . absint($columns),
//    'images',
//));
?>
<div class="images">
    <div class="row">
        <div class="large-12 columns">
            <div class="nasa-thumb-wrap rtl-right">
                <?php do_action('woocommerce_product_thumbnails'); ?>
            </div>
            
            <div class="nasa-main-wrap rtl-left">
                <div class="product-images-slider images-popups-gallery">
                    <div class="nasa-main-image-default-wrap">
                        <div class="main-images nasa-single-product-main-image nasa-main-image-default">
                            <div class="item-wrap">
                                <div class="nasa-item-main-image-wrap" id="nasa-main-image-0" data-key="0">
                                    <?php if (has_post_thumbnail()) : ?>
                                        <div class="easyzoom first">
                                            <?php echo apply_filters(
                                                'woocommerce_single_product_image_html',
                                                sprintf(
                                                    '<a href="%s" class="woocommerce-main-image product-image" data-o_href="%s" data-full_href="%s" title="%s">%s</a>',
                                                    $image_link,
                                                    $src_large,
                                                    $image_link,
                                                    $image_title,
                                                    $image
                                                ),
                                                $productId
                                            ); ?>
                                        </div>
                                    <?php else :
                                        $noimage = wc_placeholder_img_src();
                                        ?>
                                        <div class="easyzoom">
                                            <?php echo apply_filters(
                                                'woocommerce_single_product_image_html',
                                                sprintf(
                                                    '<a href="%s" class="woocommerce-main-image product-image" data-o_href="%s"><img src="%s" /></a>',
                                                        $noimage,
                                                        $noimage,
                                                        $noimage
                                                    ),
                                                $productId
                                            ); ?>
                                        </div>
                                    <?php endif; ?>
                                </div>
                            </div>
                            <?php
                            $_i = 0;
                            if ($attachment_count > 0) :
                                foreach ($attachment_ids as $id) :
                                    $_i++;
                                    ?>
                                    <div class="item-wrap">
                                        <div class="nasa-item-main-image-wrap" id="nasa-main-image-<?php echo (int) $_i; ?>" data-key="<?php echo (int) $_i; ?>">
                                            <div class="easyzoom">
                                                <?php
                                                $image_title = esc_attr(get_the_title($id));
                                                $image_link = wp_get_attachment_url($id);
                                                $image = wp_get_attachment_image_src($id, 'shop_single');
                                                echo sprintf(
                                                    '<a href="%s" class="woocommerce-additional-image product-image" title="%s"><img alt="%s" src="%s" class="lazyOwl"/></a>',
                                                    $image_link,
                                                    $image_title,
                                                    $image_title,
                                                    $image[0]
                                                );
                                                ?>
                                            </div>
                                        </div>
                                    </div>
                                    <?php
                                endforeach;
                            endif;
                            ?>
                        </div>
                    </div>

                    <div class="product-image-btn">
                        <a class="product-lightbox-btn tip-top" data-tip="<?php esc_html_e('Zoom', 'elessi-theme'); ?>" href="<?php echo esc_url_raw($image_link); ?>"></a>
                        
                        <?php do_action('product_video_btn'); ?>
                    </div>
                </div>
                
                <div class="nasa-end-scroll"></div>
            </div>
            
        </div>
    </div>
</div>