<?php
/**
 * The template for displaying search forms in nasatheme
 *
 * @package nasatheme
 */

$_id = rand();
// ob_start();
// do_action('nasa_root_cats');
// $nasa_cat_top = ob_get_clean();
?>

<div class="search-wrapper nasa-ajaxsearchform-container <?php echo esc_attr($_id); ?>_container">
    <div class="nasa-search-form-warp">
        <form method="get" class="nasa-ajaxsearchform" action="<?php echo esc_url(home_url('/')); ?>">
            <div class="search-control-group control-group">
                <label class="sr-only screen-reader-text">
                    <?php esc_html_e('Search here', 'elessi-theme'); ?>
                </label>
                <input id="nasa-input-<?php echo esc_attr($_id); ?>" type="text" class="search-field search-input live-search-input" value="<?php echo get_search_query(); ?>" name="s" placeholder="<?php esc_attr_e("I'm shopping for ...", 'elessi-theme'); ?>" />
                <span class="nasa-icon-submit-page"><input type="submit" name="page" value="<?php esc_attr_e('search', 'elessi-theme'); ?>" /></span>
                <input type="hidden" name="post_type" value="post" />
            </div>
        </form>
    </div>
    
    <a href="javascript:void(0);" title="<?php esc_attr_e('Close search', 'elessi-theme'); ?>" class="nasa-close-search"><i class="pe-7s-close"></i></a>
</div>