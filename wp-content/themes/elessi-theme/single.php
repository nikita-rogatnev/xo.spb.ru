<?php
/**
 * The Template for displaying all single posts.
 *
 * @package nasatheme
 */
$nasa_sidebar = isset($nasa_opt['single_blog_layout']) ? $nasa_opt['single_blog_layout'] : '';

// Check $_GET['sidebar']
if (isset($_GET['sidebar'])):
    switch ($_GET['sidebar']) :
        case 'right' :
            $nasa_sidebar = 'right';
            break;
        
        case 'no' :
            $nasa_sidebar = 'no';
            break;
        
        case 'left' :
        default:
            $nasa_sidebar = 'left';
            break;
    endswitch;
endif;

$hasSidebar = true;
$left = true;
switch ($nasa_sidebar):
    case 'right':
        $left = false;
        $attr = 'large-9 desktop-padding-right-30 left columns';
        break;
    
    case 'no':
        $hasSidebar = false;
        $left = false;
        $attr = 'large-12 columns';
        break;
    
    case 'left':
    default:
        $attr = 'large-9 desktop-padding-left-30 right columns';
        break;
endswitch;

get_header();
?>

<div class="container-wrap page-<?php echo ($nasa_sidebar) ? esc_attr($nasa_sidebar) : 'left'; ?>-sidebar">
    
    <?php if ($hasSidebar): ?>
        <div class="div-toggle-sidebar center">
            <a class="toggle-sidebar" href="javascript:void(0);"><i class="fa fa-bars"></i> <?php esc_html_e('Sidebar', 'elessi-theme'); ?></a>
        </div>
    <?php endif; ?>

    <div class="row">
        <div id="content" class="<?php echo esc_attr($attr); ?>">
            <div class="page-inner">
                <?php
                while (have_posts()) : the_post();
                    include ELESSI_THEME_PATH . '/content-single.php';
                endwhile;
                ?>
            </div>
        </div>

        <?php if ($nasa_sidebar != 'no') : ?>
            <div class="large-3 columns <?php echo ($left) ? 'left' : 'right'; ?> col-sidebar">
                <?php get_sidebar(); ?>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php
get_footer();
