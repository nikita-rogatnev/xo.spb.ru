<?php
/**
 * Show messages
 *
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */
if (!defined('ABSPATH')) :
    exit;
endif;

if (!$messages) :
    return;
endif;

foreach ($messages as $message) : ?>
    <div class="row">
        <div class="large-12 columns">
            <div class="woocommerce-message message-success" role="alert">
                <?php echo wp_kses_post($message); ?>
            </div>
        </div>
    </div>
<?php
endforeach;
