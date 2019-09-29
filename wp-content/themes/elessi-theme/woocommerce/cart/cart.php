<?php
/**
 * Cart Page
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.5.0
 */
if (!defined('ABSPATH')) :
    exit; // Exit if accessed directly
endif;
$nasa_cart = wc()->cart;
do_action('woocommerce_before_cart');
?>

<form class="woocommerce-cart-form nasa-shopping-cart-form" action="<?php echo esc_url(wc_get_cart_url()); ?>" method="post">
    <div class="row">
        <div class="large-12 small-12 columns">
            <div class="cart-wrapper">
                
                <?php do_action('woocommerce_before_cart_table'); ?>
                
                <table class="shop_table cart responsive woocommerce-cart-form__contents">
                    <thead>
                        <tr>
                            <th class="product-name" colspan="3"><?php esc_html_e('Product', 'elessi-theme'); ?></th>
                            <th class="product-price hide-for-small"><?php esc_html_e('Price', 'elessi-theme'); ?></th>
                            <th class="product-quantity"><?php esc_html_e('Quantity', 'elessi-theme'); ?></th>
                            <th class="product-subtotal hide-for-small"><?php esc_html_e('Total', 'elessi-theme'); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php do_action('woocommerce_before_cart_contents'); ?>
                        <?php
                        $cart_items = $nasa_cart->get_cart();
                        foreach ($cart_items as $cart_item_key => $cart_item) {
                            $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                            $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);

                            if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) {
                                $priceProduct = apply_filters(
                                    'woocommerce_cart_item_price',
                                    $nasa_cart->get_product_price($_product),
                                    $cart_item,
                                    $cart_item_key
                                );
                                
                                ?>
                                <tr class="woocommerce-cart-form__cart-item <?php echo esc_attr(apply_filters('woocommerce_cart_item_class', 'cart_item', $cart_item, $cart_item_key)); ?>">
                                    <td class="product-remove remove-product">
                                        <?php echo apply_filters(
                                            'woocommerce_cart_item_remove_link',
                                            sprintf('<a href="%s" class="remove" title="%s" data-product_id="%s" data-product_sku="%s"><span class="pe-7s-close"></span></a>',
                                                esc_url(function_exists('wc_get_cart_remove_url') ? wc_get_cart_remove_url($cart_item_key) : $nasa_cart->get_remove_url($cart_item_key)),
                                                esc_html__('Remove this item', 'elessi-theme'),
                                                esc_attr($product_id),
                                                esc_attr($_product->get_sku())
                                            ), $cart_item_key
                                        ); ?>
                                    </td>
                                    <td class="product-thumbnail">
                                        <?php
                                        $thumbnail = apply_filters('woocommerce_cart_item_thumbnail', str_replace(array('http:', 'https:'), '', $_product->get_image()), $cart_item, $cart_item_key);
                                        if (!$_product->is_visible()) :
                                            echo ($thumbnail);
                                        else :
                                            printf('<a href="%s">%s</a>', $_product->get_permalink(), $thumbnail);
                                        endif;
                                        ?>
                                    </td>

                                    <td class="product-name">
                                        <?php
                                        if (!$_product->is_visible()):
                                            echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                                        else:
                                            echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title()), $cart_item, $cart_item_key);
                                        endif;

                                        // Meta data
                                        echo function_exists('wc_get_formatted_cart_item_data') ? wc_get_formatted_cart_item_data($cart_item) : $nasa_cart->get_item_data($cart_item);

                                        // Backorder notification
                                        if ($_product->backorders_require_notification() && $_product->is_on_backorder($cart_item['quantity'])) :
                                            echo '<p class="backorder_notification">' . esc_html__('Available on backorder', 'elessi-theme') . '</p>';
                                        endif;
                                        ?>
                                        <div class="mobile-price text-center show-for-small">
                                            <?php echo ($priceProduct); ?>
                                        </div>
                                    </td>

                                    <td class="product-price hide-for-small">
                                        <?php echo ($priceProduct); ?>
                                    </td>

                                    <td class="product-quantity">
                                        <?php
                                        if ($_product->is_sold_individually()) :
                                            $product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $cart_item_key);
                                        else :
                                            $product_quantity = woocommerce_quantity_input(array(
                                                'input_name'  => "cart[{$cart_item_key}][qty]",
                                                'input_value' => $cart_item['quantity'],
                                                'max_value'   => $_product->get_max_purchase_quantity(),
                                                'min_value'   => '0',
                                                'product_name' => $_product->get_name(),
                                            ), $_product, false);
                                        endif;

                                        echo apply_filters('woocommerce_cart_item_quantity', $product_quantity, $cart_item_key, $cart_item);
                                        ?>
                                    </td>

                                    <td class="product-subtotal hide-for-small">
                                        <?php
                                            echo apply_filters('woocommerce_cart_item_subtotal', $nasa_cart->get_product_subtotal($_product, $cart_item['quantity']), $cart_item, $cart_item_key);
                                        ?>
                                    </td>
                                </tr>
                                <?php
                            }
                        }
                        do_action('woocommerce_cart_contents');
                        do_action('woocommerce_after_cart_contents');
                        ?>
                    </tbody>
                </table>
                
                <?php do_action('woocommerce_after_cart_table'); ?>
                
                <input type="submit" class="button right margin-bottom-20" name="update_cart" value="<?php esc_attr_e('Update Cart', 'elessi-theme'); ?>" />
                
                <?php do_action('woocommerce_cart_actions'); ?>
                
            </div><!-- .cart-wrapper -->
        </div><!-- .large-12 -->
    </div><!-- .row -->

    <div class="row">
        <div class="large-12 columns">
            <?php if ($nasa_cart->coupons_enabled()) { ?>
                <p class="nasa-p-show-coupon"><?php echo esc_html__('Have a coupon?&nbsp;', 'elessi-theme') ;?><a href="javascript:void(0);" class="nasa-show-coupon"><?php echo esc_html__('Click here to enter your code', 'elessi-theme') ;?></a></p>
                <div class="coupon nasa-coupon-wrap">
                    <h5 class="heading-title"><?php esc_html_e('Coupon', 'elessi-theme'); ?></h5>
                    <div class="nasa-hr medium  margin-bottom-30 text-left"></div>
                    <input type="text" name="coupon_code" id="coupon_code" value="" placeholder="<?php esc_attr_e('Enter Coupon', 'elessi-theme'); ?>" /> 
                    <input type="submit" class="button" name="apply_coupon" value="<?php esc_attr_e('Apply Coupon', 'elessi-theme'); ?>" />
                    <?php do_action('woocommerce_cart_coupon'); ?>
                </div>
            <?php } ?>
        </div><!-- .large-12 -->
    </div>
    <?php echo '<input type="hidden" name="_wpnonce" value="' . wp_create_nonce('woocommerce-cart') . '" />'; ?>
</form>

<hr class="margin-top-10 margin-bottom-40" />

<div class="row">
    <div class="large-12 columns">
        <div class="cart-sidebar cart-collaterals">
            <?php do_action('woocommerce_cart_collaterals'); ?>
        </div><!-- .cart-sidebar -->
    </div><!-- .large-12 -->
</div><!-- .row -->

<?php
do_action('woocommerce_after_cart');
