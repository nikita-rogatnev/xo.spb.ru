<?php
$_delay = 0;
$_delay_item = (isset($nasa_opt['delay_overlay']) && (int) $nasa_opt['delay_overlay']) ? (int) $nasa_opt['delay_overlay'] : 100;
?>
<div class="row group-blogs nasa-blog-wrap-all-items">
    <div class="large-12 columns">
        <div class="nasa-blog-sc blog-grid blog-grid-style">
            <ul class="small-block-grid-<?php echo esc_attr($columns_number_small); ?> medium-block-grid-<?php echo esc_attr($columns_number_tablet); ?> large-block-grid-<?php echo esc_attr($columns_number); ?> grid" data-product-per-row="<?php echo esc_attr($columns_number); ?>">
                <?php
                $k = 0;
                $count = wp_count_posts()->publish;
                if ($count > 0) {
                    while ($recentPosts->have_posts()) {
                        $recentPosts->the_post();
                        $title = get_the_title();
                        $link = get_the_permalink();
                        $postId = get_the_ID();
                        $categories = ($cats_enable == 'yes') ? get_the_category_list(esc_html__(', ', 'nasa-core')) : '';
                        
                        if($author_enable == 'yes') :
                            $author = get_the_author();
                            $author_id = get_the_author_meta('ID');
                            $link_author = get_author_posts_url($author_id);
                        endif;

                        if($date_enable == 'yes') :
                            $day = get_the_time('d', $postId);
                            $month = get_the_time('m', $postId);
                            $year = get_the_time('Y', $postId);
                            $link_date = get_day_link($year, $month, $day);
                            $date_post = get_the_time('d F', $postId);
                        endif;
                        
                        echo '<li class="wow fadeInUp" data-wow-duration="1s" data-wow-delay="' . esc_attr($_delay) . 'ms"><div class="nasa-item-blog-grid">';
                        ?>
                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>">
                                <div class="entry-blog">
                                    <div class="blog-image">
                                        <div class="blog-image-attachment" style="overflow:hidden;">
                                            <?php
                                            if (has_post_thumbnail()):
                                                the_post_thumbnail('380x380', array(
                                                    'alt' => esc_attr($title)
                                                ));
                                            else:
                                                echo '<img src="' . NASA_CORE_PLUGIN_URL . 'assets/images/placeholder.png" alt="' . esc_attr($title) . '" />';
                                            endif;
                                            ?>
                                            <div class="image-overlay"></div>
                                        </div>
                                    </div>
                                </div>
                            </a>
                            <div class="nasa-blog-info nasa-blog-img-top">
                                <?php echo ($cats_enable == 'yes') ? '<div class="nasa-post-cats-wrap">' . $categories . '</div>' : ''; ?>
                                <div class="blog_title">
                                    <h5>
                                        <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_attr($title); ?>"><?php echo $title; ?></a>
                                    </h5>
                                </div>
                                
                                <?php if($date_author == 'top') : ?>
                                    <div class="nasa-post-date-author-wrap">
                                        <?php if($date_enable == 'yes') : ?>
                                            <a href="<?php echo esc_url($link_date); ?>" title="<?php echo esc_html__('Posts at ', 'nasa-core') . esc_attr($date_post); ?>" class="nasa-post-date-author-link">
                                                <span class="nasa-post-date-author">
                                                    <i class="pe-7s-date"></i>
                                                    <?php echo $date_post; ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if($author_enable == 'yes') : ?>
                                            <a href="<?php echo esc_url($link_author); ?>" title="<?php echo esc_html__('Posted By ', 'nasa-core') . esc_attr($author); ?>" class="nasa-post-date-author-link">
                                                <span class="nasa-post-date-author nasa-post-author">
                                                    <i class="pe-7s-user"></i>
                                                    <?php echo $author; ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if($readmore == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_html__('Read more', 'nasa-core'); ?>" class="nasa-post-date-author-link hide-for-mobile nasa-post-read-more">
                                                <span class="nasa-post-date-author nasa-post-author">
                                                    <i class="pe-7s-news-paper margin-right-5"></i>
                                                    <?php echo esc_html__('Read more', 'nasa-core'); ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <div class="clearfix"></div>
                                
                                <?php if($des_enable == 'yes') : ?>
                                    <div class="nasa-info-short">
                                        <?php the_excerpt(); ?>
                                    </div>
                                <?php endif; ?>
                                
                                <?php if($date_author == 'bot') : ?>
                                    <div class="nasa-post-date-author-wrap">
                                        <?php if($date_enable == 'yes') : ?>
                                            <a href="<?php echo esc_url($link_date); ?>" title="<?php echo esc_html__('Posts at ', 'nasa-core') . esc_attr($date_post); ?>" class="nasa-post-date-author-link">
                                                <span class="nasa-post-date-author bottom">
                                                    <i class="pe-7s-date"></i>
                                                    <?php echo $date_post; ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if($author_enable == 'yes') : ?>
                                            <a href="<?php echo esc_url($link_author); ?>" title="<?php echo esc_html__('Posted By ', 'nasa-core') . esc_attr($author); ?>" class="nasa-post-date-author-link">
                                                <span class="nasa-post-date-author nasa-post-author bottom">
                                                    <i class="pe-7s-user"></i>
                                                    <?php echo $author; ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>

                                        <?php if($readmore == 'yes') : ?>
                                            <a href="<?php echo esc_url($link); ?>" title="<?php echo esc_html__('Read more', 'nasa-core'); ?>" class="nasa-post-date-author-link hide-for-mobile nasa-post-read-more">
                                                <span class="nasa-post-date-author nasa-post-author bottom">
                                                    <i class="pe-7s-news-paper"></i>
                                                    <?php echo esc_html__('Read more', 'nasa-core'); ?>
                                                </span>
                                            </a>
                                        <?php endif; ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        <?php
                        echo '</div></li>';
                        $k++;
                        $_delay += $_delay_item;
                    }
                }
                ?>
            </ul>
        </div>
    </div>
</div>

<?php if($page_blogs == 'yes') : ?>
    <div class="row">
        <div class="large-12 columns text-center margin-bottom-40">
            <a href="<?php echo esc_url(get_permalink(get_option('page_for_posts'))); ?>" title="<?php echo esc_html__('All blogs', 'nasa-core'); ?>" class="nasa-view-more button">
                <?php echo esc_html__('All blogs', 'nasa-core'); ?>
            </a>
        </div>
    </div>
<?php

endif;