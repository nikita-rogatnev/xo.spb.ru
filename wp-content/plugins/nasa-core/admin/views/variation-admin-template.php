<?php
defined('ABSPATH') or die();

foreach ($gallery_images as $image_id):
    $image = wp_get_attachment_image_src($image_id); ?>
    <li class="image" data-attachment_id="<?php echo $image_id; ?>">
        <img src="<?php echo esc_url($image[0]) ?>" />
        <ul class="actions">
            <li>
                <a href="javascript:void(0);" class="delete"><?php echo esc_html__('Delete', 'nasa-core'); ?></a>
            </li>
        </ul>
    </li>
<?php

endforeach;
