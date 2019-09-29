<?php
/**
 * @package nasatheme
 */
global $nasa_opt;
$nasa_parallax = isset($nasa_opt['blog_parallax']) && $nasa_opt['blog_parallax'] ? true : false;

do_action('nasa_before_single_post');
?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php if (has_post_thumbnail()) : ?>
        <div class="entry-image margin-bottom-40">
            <?php if ($nasa_parallax) : ?>
                <div class="parallax_img" style="overflow:hidden">
                    <div class="parallax_img_inner" data-velocity="0.15">
                        <?php the_post_thumbnail(); ?>
                        <div class="image-overlay"></div>
                    </div>
                </div>
            <?php else : ?>
                <?php the_post_thumbnail(); ?>
                <div class="image-overlay"></div>
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <header class="entry-header text-center">
        <h1 class="entry-title nasa-title-single-post"><?php the_title(); ?></h1>
        <div class="entry-meta">
            <?php elessi_posted_on(); ?>
        </div>
    </header>

    <div class="entry-content">
        <?php
        the_content();
        wp_link_pages(array(
            'before' => '<div class="page-links">' . esc_html__('Pages:', 'elessi-theme'),
            'after' => '</div>',
        ));
        ?>
    </div>

    <footer class="entry-meta footer-entry-meta">
        <?php
        $category_list = get_the_category_list(esc_html__(', ', 'elessi-theme'));
        $tag_list = get_the_tag_list('', esc_html__(', ', 'elessi-theme'));
        $allowed_html = array(
            'a' => array('href' => array(), 'rel' => array(), 'title' => array())
        );

        if ('' != $tag_list) :
            $meta_text = esc_html__('Posted in %1$s and tagged %2$s.', 'elessi-theme');
        else :
            $meta_text = wp_kses(__('Posted in %1$s. Bookmark the <a href="%3$s" title="Permalink to %4$s" rel="bookmark">permalink</a>.', 'elessi-theme'), $allowed_html);
        endif;

        printf($meta_text, $category_list, $tag_list, get_permalink(), the_title_attribute('echo=0'));
        ?>
    </footer>

</article>

<div class="nasa-post-navigation">
    <?php
    the_post_navigation(array(
        'prev_text' => '<span class="screen-reader-text">' . esc_html__('Previous Post', 'elessi-theme') . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__('Previous', 'elessi-theme') . '</span>',
        'next_text' => '<span class="screen-reader-text">' . esc_html__('Next Post', 'elessi-theme') . '</span><span aria-hidden="true" class="nav-subtitle">' . esc_html__('Next', 'elessi-theme') . '</span>',
    ));
    ?>
</div>

<?php
if (comments_open() || '0' != get_comments_number()):
    comments_template();
endif;

do_action('nasa_after_single_post');
