<?php 
$topbar_left = !isset($topbar_left) ? '' : $topbar_left;
$class_topbar = !isset($class_topbar) ? '' : $class_topbar;
?>
<div class="nasa-topbar-wrap<?php echo esc_attr($class_topbar); ?>">
    <div id="top-bar" class="top-bar">
        <div class="row">
            <div class="large-12 columns">
                <div class="left-text left rtl-right">
                    <div class="inner-block">
                        <?php echo $topbar_left; ?>
                    </div>
                </div>
                <div class="right-text nasa-hide-for-mobile right rtl-left">
                    <div class="topbar-menu-container">
                        <?php echo elessi_language_flages(); ?>
                        <?php elessi_get_menu('topbar-menu', 'nasa-topbar-menu', 1); ?>
                        <?php echo elessi_tiny_account(true); ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div class="nasa-hide-for-mobile">
        <a class="nasa-icon-toggle" href="javascript:void(0);">
            <i class="nasa-topbar-up pe-7s-angle-up"></i>
            <i class="nasa-topbar-down pe-7s-angle-down"></i>
        </a>
    </div>
</div>
