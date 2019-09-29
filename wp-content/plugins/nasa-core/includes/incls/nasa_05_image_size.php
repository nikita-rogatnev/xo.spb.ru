<?php
// Custom image size
add_image_size('380x380', 380, 380, true);
add_image_size('480x900', 480, 900, true);
add_image_size('280x150', 280, 150, true);
add_image_size('590x320', 590, 320, true);
add_image_size('nasa-medium', 450, '', false);
add_image_size('nasa-large', 595, '', false);

// Remove SRCSET imgs
// add_action('init', 'nasa_remove_srcset_img');
function nasa_remove_srcset_img() {
    add_filter('wp_calculate_image_srcset', '__return_false');
}