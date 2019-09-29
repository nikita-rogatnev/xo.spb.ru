<?php
/**
 * Cross-sells
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.0.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if ($cross_sells) :
    global $nasa_opt;
    $_delay = 0;
    $_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
    ?>
    <div class="nasa-cross-sells">
        <div class="title-block">
            <h5 class="heading-title">
                <span><?php esc_html_e('You may be interested in&hellip;', 'elessi-theme') ?></span>
            </h5>
            <div class="nasa-hr medium"></div>
        </div>
        <ul class="products grid large-block-grid-4 small-block-grid-2">
            <?php
            foreach ($cross_sells as $cross_sell) :
                $post_object = get_post($cross_sell->get_id());
                setup_postdata($GLOBALS['post'] = & $post_object);
                wc_get_template('content-product.php', array(
                    'is_deals' => false,
                    '_delay' => $_delay,
                    'wrapper' => 'li'
                ));
                $_delay += $_delay_item;
            endforeach; // end of the loop. 
            ?>
        </ul>
    </div>
    <?php
endif;
