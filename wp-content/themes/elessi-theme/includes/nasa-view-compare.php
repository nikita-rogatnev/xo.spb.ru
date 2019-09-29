<?php
global $product;
$products = $nasa_compare->get_products_list();
$fields = $nasa_compare->fields();
?>
<div class="nasa-wrap-table-compare">
    <?php
    if ($products) :
        $add_to_cart = array();?>
        <table class="nasa-table-compare">
            <?php 
            foreach ($fields as $field => $name) :
                if ($field == 'title') :
                    continue;
                endif;
                ?>
                <tr class="<?php echo esc_attr($field); ?>">
                    <th>
                        <?php echo ($field == 'image') ? esc_html__('Product', 'elessi-theme') : $name; ?>
                        <?php echo ($field == 'image') ? '<div class="fixed-th"></div>' : ''; ?>
                    </th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id;
                        ?>
                        <td class="<?php echo esc_attr($product_class); ?>">
                            <?php
                            switch ($field) :
                                case 'image':
                                    $nasa_title = isset($product->fields['title']) ? $product->fields['title'] : '';
                                    $href = get_permalink($product_id);
                                    echo '<a href="' . esc_url($href) . '" title="' . esc_attr($product->fields['title']) . '">';

                                    echo '<div class="image-wrap">' . $product->get_image('thumbnail', array('alt' => esc_attr($nasa_title))) . '</div>';
                                    echo ($nasa_title != '') ? '<h5>' . $nasa_title . '</h5>' : '';
                                    echo '</a>';
                                    break;

                                case 'title':

                                    break;

                                case 'add-to-cart':
                                    $add_to_cart[$product_id] = elessi_product_group_button('popup');
                                    echo ($add_to_cart[$product_id]);
                                    break;

                                default:
                                    echo empty($product->fields[$field]) ? '&nbsp;' : $product->fields[$field];
                                    break;
                            endswitch;
                            ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach;
                    ?>

                </tr>

            <?php endforeach; ?>

            <?php if (get_option('yith_woocompare_price_end') == 'yes' && isset($fields['price'])) : ?>
                <tr class="price repeated">
                    <th><?php echo ($fields['price']); ?></th>

                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id
                        ?>
                        <td class="<?php echo esc_attr($product_class); ?>">
                            <?php echo ($product->fields['price']); ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach;
                    ?>

                </tr>
            <?php endif; ?>

            <?php if (get_option('yith_woocompare_add_to_cart_end') == 'yes' && isset($fields['add-to-cart'])) : ?>
                <tr class="add-to-cart repeated">
                    <th><?php echo ($fields['add-to-cart']); ?></th>
                    <?php
                    $index = 0;
                    foreach ($products as $product_id => $product) :
                        $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id
                        ?>
                        <td class="<?php echo ($product_class); ?>">
                            <?php
                            if (isset($add_to_cart[$product_id])) :
                                echo ($add_to_cart[$product_id]);
                            else:
                                woocommerce_template_loop_add_to_cart();
                            endif;
                            ?>
                        </td>
                        <?php
                        ++$index;
                    endforeach;
                    ?>
                </tr>
            <?php endif; ?>
            <tr class="remove-item">
                <th>&nbsp;</th>

                <?php
                $index = 0;
                foreach ($products as $product_id => $product) :
                    $product_class = ($index % 2 == 0 ? 'odd' : 'even') . ' nasa-compare-view-product_' . $product_id
                    ?>
                    <td class="<?php echo esc_attr($product_class); ?>">
                        <a href="javascript:void(0);" class="nasa-remove-compare" data-prod="<?php echo esc_attr($product_id); ?>"><?php echo esc_html__('Remove', 'elessi-theme'); ?><i class="pe-7s-close"></i></a>
                    </td>
                    <?php
                    ++$index;
                endforeach;
                ?>
            </tr>
        </table>
    <?php
    else:
        echo '<h5 class="text-center">' . esc_html__('No product added to compare !', 'elessi-theme') . '</h5>';
    endif;
    ?>
</div>