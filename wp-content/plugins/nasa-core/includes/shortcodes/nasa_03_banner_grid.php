<?php
// add_shortcode('nasa_banner_grid', 'nasa_bannergrid');
// add_shortcode('nasa_banner_grid', 'bannergridShortcode');
function nasa_bannergrid($atts, $content = null) {
    extract(shortcode_atts(array(
        'width' => '',
        'height' => '600px',
        'grid' => '',
        'padding' => '15px'
    ), $atts));
    $shortcode_id = rand();
    ob_start();

    if ($padding && $grid):
        $padding_w = $padding / 2;
        ?>
        <style>
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner-grid {
                margin-left: -<?php echo esc_attr($padding_w); ?>px !important;
                margin-right: -<?php echo esc_attr($padding_w); ?>px !important;
            }
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner-grid .columns {
                margin-bottom: <?php echo esc_attr($padding); ?>!important;
            } 
            #banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner-grid .columns > .column-inner {
                padding-left: <?php echo esc_attr($padding_w); ?>px !important;
                padding-right: <?php echo esc_attr($padding_w); ?>px !important;
            }
        </style>
    <?php endif; ?>
    <div id="banner_grid_<?php echo esc_attr($shortcode_id); ?>">
        <div class="row">
            <div class="large-12 columns">
                <div class="row collapse nasa_banner-grid nasa_banner-grid-new">
                    <?php
                    if ($grid) {
                        $pattern = get_shortcode_regex();
                        if (preg_match_all('/' . $pattern . '/s', $content, $matches) && array_key_exists(2, $matches) && in_array('nasa_banner', $matches[2])) {
                            $tall_height = $height;
                            $less_tall_height = $height - ($height / 3) - ($padding / 2) . 'px';
                            $small_height = ($height / 2) - ($padding / 2) . 'px';
                            $smallest_height = ($height / 3) - ($padding / 1.5) . 'px';
                            $g_total = '';
                            $id = '1';

                            switch ($grid) {
                                case '2':
                                    $g_total = '4';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-12 small-12',
                                        'height2' => $smallest_height, 'span2' => 'large-4 small-12',
                                        'height3' => $smallest_height, 'span3' => 'large-4 small-12',
                                        'height4' => $smallest_height, 'span4' => 'large-4 small-12',
                                    );
                                    break;
                                case '3':
                                    $g_total = '3';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-6 small-12',
                                        'height2' => $small_height, 'span2' => 'large-6 small-6',
                                        'height3' => $small_height, 'span3' => 'large-3 small-6',
                                    );
                                    break;
                                case '4':
                                    $g_total = '1';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-3 small-6',
                                    );
                                    break;
                                case '5':
                                    $g_total = '1';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-4 small-6',
                                    );
                                    break;
                                case '6':
                                    $g_total = '3';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-9 small-12',
                                        'height2' => $small_height, 'span2' => 'large-3 small-6',
                                        'height3' => $small_height, 'span3' => 'large-3 small-6',
                                    );
                                    break;
                                case '7':
                                    $g_total = '3';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-3 small-6',
                                        'height2' => $tall_height, 'span2' => 'large-6 small-12',
                                        'height3' => $small_height, 'span3' => 'large-3 small-6',
                                    );
                                    break;
                                case '8':
                                    $g_total = '3';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-3 small-6',
                                        'height2' => $tall_height, 'span2' => 'large-6 small-12',
                                        'height3' => $tall_height, 'span3' => 'large-3 small-6',
                                    );
                                    break;
                                case '9':
                                    $g_total = '2';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-6 small-12',
                                        'height2' => $small_height, 'span2' => 'large-3 small-6',
                                    );
                                    break;
                                case '10':
                                    $g_total = '5';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-6 small-12',
                                        'height2' => $smallest_height, 'span2' => 'large-6 small-12',
                                        'height3' => $smallest_height, 'span3' => 'large-3 small-12',
                                        'height4' => $smallest_height, 'span4' => 'large-3 small-12',
                                        'height5' => $smallest_height, 'span5' => 'large-6 small-12',
                                    );
                                    break;
                                case '11':
                                    $g_total = '5';
                                    $g = array(
                                        'height1' => $less_tall_height, 'span1' => 'large-6 small-12',
                                        'height2' => $less_tall_height, 'span2' => 'large-3 small-12',
                                        'height3' => $tall_height, 'span3' => 'large-3 small-12',
                                        'height4' => $smallest_height, 'span4' => 'large-3 small-12',
                                        'height5' => $smallest_height, 'span5' => 'large-6 small-12',
                                    );
                                    break;
                                case '12':
                                    $g_total = '6';
                                    $g = array(
                                        'height1' => $smallest_height, 'span1' => 'large-8 small-12',
                                        'height2' => $smallest_height, 'span2' => 'large-4 small-12',
                                        'height3' => $smallest_height, 'span3' => 'large-4 small-12',
                                        'height4' => $smallest_height, 'span4' => 'large-8 small-12',
                                        'height5' => $smallest_height, 'span5' => 'large-8 small-12',
                                        'height6' => $smallest_height, 'span6' => 'large-4 small-12',
                                    );
                                    break;
                                case '13':
                                    $g_total = '6';
                                    $g = array(
                                        'height1' => $less_tall_height, 'span1' => 'large-6 small-12',
                                        'height2' => $small_height, 'span2' => 'large-3 small-12',
                                        'height3' => $tall_height, 'span3' => 'large-3 small-12',
                                        'height4' => $smallest_height, 'span4' => 'large-6 small-12',
                                        'height5' => $small_height, 'span5' => 'large-3 small-12',
                                        'height6' => $smallest_height, 'span6' => 'large-6 small-12',
                                    );
                                    break;
                                case '14':
                                    $g_total = '6';
                                    $g = array(
                                        'height1' => $smallest_height, 'span1' => 'large-9 small-12',
                                        'height2' => $tall_height, 'span2' => 'large-3 small-12',
                                        'height3' => $less_tall_height, 'span3' => 'large-3 small-12',
                                        'height4' => $smallest_height, 'span4' => 'large-3 small-12',
                                        'height5' => $smallest_height, 'span5' => 'large-3 small-12',
                                        'height6' => $smallest_height, 'span6' => 'large-6 small-12',
                                    );
                                    break;

                                case '1':
                                default :
                                    $g_total = '5';
                                    $g = array(
                                        'height1' => $tall_height, 'span1' => 'large-6 small-12',
                                        'height2' => $tall_height, 'span2' => 'large-3 small-6',
                                        'height3' => $small_height, 'span3' => 'large-3 small-6',
                                        'height4' => $small_height, 'span4' => 'large-3 small-6',
                                        'height5' => $small_height, 'span5' => 'large-3 small-6',
                                    );
                                    break;
                            }

                            foreach ($matches[0] as $shortcode) {
                                $grid_class = '';
                                if ($g['height' . $id] < '200px') {
                                    $grid_class = 'grid-small-height';
                                } elseif ($g['height' . $id] < '300px') {
                                    $grid_class = 'grid-medium-height';
                                }

                                echo '<div class="columns nasa-grid-column ' . $grid_class . ' ' . $g['span' . $id] . '"  style="height:' . $g['height' . $id] . '"><div class="column-inner">';
                                echo nasa_fixShortcode($shortcode);
                                echo '</div></div>';

                                if ($id < $g_total) {
                                    $id++;
                                }
                            }
                        }
                    } else {
                        echo nasa_fixShortcode($content);
                    }
                    ?>
                </div>
            </div>
        </div>
        <script>
            jQuery(document).ready(function ($) {
                var $container = $("#banner_grid_<?php echo esc_attr($shortcode_id); ?> .nasa_banner-grid");
                $container.packery({
                    itemSelector: ".columns",
                    gutter: 0
                });
            });
        </script>
    </div><!-- #banner-grid -->

    <?php
    $content = ob_get_clean();
    
    return $content;
}
