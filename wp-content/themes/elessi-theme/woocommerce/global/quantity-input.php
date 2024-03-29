<?php
/**
 * @see 	http://docs.woothemes.com/document/template-structure/
 * @author 	WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.6.0
 */
if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

if ($max_value && $min_value === $max_value) {
    ?>
    <div class="quantity hidden">
        <input type="hidden" id="<?php echo esc_attr($input_id); ?>" class="qty" name="<?php echo esc_attr($input_name); ?>" value="<?php echo esc_attr($min_value); ?>" />
    </div>
    <?php
} else {
    /* translators: %s: Quantity. */
    $labelledby = ! empty($args['product_name']) ? sprintf(esc_html__('%s quantity', 'elessi-theme'), strip_tags($args['product_name'])) : '';
    ?>
    <div class="quantity buttons_added">
        <a href="javascript:void(0)" class="plus">+</a>
        <input 
            type="number" 
            class="input-text qty text" 
            id="<?php echo esc_attr( $input_id ); ?>"
            step="<?php echo esc_attr($step); ?>" 
            min="<?php echo esc_attr($min_value); ?>" 
            max="<?php echo esc_attr(0 < $max_value ? $max_value : ''); ?>" 
            name="<?php echo esc_attr($input_name); ?>" 
            value="<?php echo esc_attr($input_value); ?>" 
            title="<?php echo esc_attr_x('Qty', 'Product quantity input tooltip', 'elessi-theme'); ?>" 
            size="4" 
            pattern="<?php echo esc_attr($pattern); ?>"
            inputmode="<?php echo esc_attr($inputmode); ?>"
            aria-labelledby="<?php echo esc_attr($labelledby); ?>" />
        <a href="javascript:void(0)" class="minus">-</a>
    </div>
    <?php
}