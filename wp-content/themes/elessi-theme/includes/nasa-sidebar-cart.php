<?php if (!isset($woocommerce) || !$woocommerce) :
    esc_html_e('Install WooCommerce plugin and active, Please!', 'elessi-theme');
else :
    $nasa_cart = wc()->cart;
    $cart_items = $nasa_cart->get_cart();
    ?>

    <div class="widget_shopping_cart_content cart_sidebar">
        <?php if (sizeof($cart_items) > 0) : ?>
            <div class="cart_list">
                <?php
                foreach ($cart_items as $cart_item_key => $cart_item) :
                    $_product = apply_filters('woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key);
                    $product_id = apply_filters('woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key);
                    if ($_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters('woocommerce_cart_item_visible', true, $cart_item, $cart_item_key)) :
                        
                        $priceProduct = apply_filters(
                            'woocommerce_cart_item_price',
                            $nasa_cart->get_product_price($_product),
                            $cart_item,
                            $cart_item_key
                        );
                        ?>
                
                        <div class="row mini-cart-item collapse" id="item-<?php echo (int) $product_id; ?>">
                            <div class="small-3 large-3 columns nasa-image-cart-item">
                                <?php echo str_replace(array('http:', 'https:'), '', $_product->get_image('thumbnail')); ?>
                            </div>
                            <div class="small-7 large-8 columns nasa-info-cart-item">
                                <div class="mini-cart-info">
                                    <?php
                                    if (!$_product->is_visible()):
                                        echo apply_filters('woocommerce_cart_item_name', $_product->get_title(), $cart_item, $cart_item_key);
                                    else:
                                        echo apply_filters('woocommerce_cart_item_name', sprintf('<a href="%s">%s</a>', $_product->get_permalink(), $_product->get_title()), $cart_item, $cart_item_key);
                                    endif;
                                    
                                    // Meta data
                                    echo function_exists('wc_get_formatted_cart_item_data') ? wc_get_formatted_cart_item_data($cart_item) : $woocommerce->cart->get_item_data($cart_item);
                                    
                                    echo '<div class="cart_list_product_quantity">' . $priceProduct . esc_html__(' x ', 'elessi-theme') . $cart_item['quantity'] . '</div>';
                                    ?>
                                </div>
                            </div>
                            <div class="small-2 large-1 columns text-right">
                                <?php
                                echo apply_filters(
                                    'woocommerce_cart_item_remove_link',
                                    sprintf(
                                        '<a href="javascript:void(0);" data-key="%s" data-id="%s" class="remove item-in-cart" title="%s"><i class="pe-7s-close"></i></a>', // pe-7s-trash
                                        $cart_item_key,
                                        $product_id,
                                        esc_html__('Remove this item', 'elessi-theme')
                                    ),
                                    $cart_item_key
                                );
                                ?>
                            </div>
                        </div>
                    <?php endif; ?>                                     
                <?php endforeach; ?>
            </div>

            <div class="minicart_total_checkout">
                <span class="total-price-label"><?php esc_html_e('Subtotal', 'elessi-theme'); ?></span>
                <span class="total-price right"><?php wc_cart_totals_subtotal_html(); ?></span>
            </div>
            
            <div class="btn-mini-cart inline-lists text-center">
                <div class="row collapse">
                    <div class="small-12 large-12 columns">
                        <a href="<?php echo esc_url(wc_get_cart_url()); ?>" class="button btn-viewcart" title="<?php esc_attr_e('VIEW CART', 'elessi-theme'); ?>"><?php esc_html_e('VIEW CART', 'elessi-theme'); ?></a>
                    </div>
                    <?php if (sizeof($woocommerce->cart->cart_contents) > 0): ?>
                        <div class="small-12 large-12 columns">
                            <a href="<?php echo esc_url(wc_get_checkout_url()); ?>" class="button btn-checkout" title="<?php esc_attr_e('CHECKOUT', 'elessi-theme'); ?>"><?php esc_html_e('CHECKOUT', 'elessi-theme'); ?></a>
                        </div>
                    <?php endif; ?>
                </div>
            </div>
        <?php
    else:
        echo ($empty);
    endif;
    ?>
    </div>
<?php
endif;
