<?php
defined('ABSPATH') or die(); // Exit if accessed directly

/**
 * @class 		Nasa_WC_Term_Data_Fields
 * @version		1.0
 * @author 		nasaTheme
 */
if (!class_exists('Nasa_WC_Term_Data_Fields')) {

    class Nasa_WC_Term_Data_Fields {
        
        /**
         * Nasa Descriptions category
         */
        private $_cat_header = 'cat_header';
        
        /**
         * Nasa Enable breadcrumb category
         */
        private $_cat_bread_enable = 'cat_breadcrumb';
        
        /**
         * Nasa Background breadcrumb category
         */
        private $_cat_bread_bg = 'cat_breadcrumb_bg';
        
        /**
         * Nasa Text color breadcrumb category
         */
        private $_cat_bread_text = 'cat_breadcrumb_text_color';
        
        /**
         * Nasa Sidebar category
         */
        private $_cat_sidebar = 'cat_sidebar_override';
        
        /**
         * Nasa Primary Color category
         */
        private $_cat_primary_color = 'cat_primary_color';
        
        /**
         * Nasa Logo category
         */
        private $_cat_logo = 'cat_logo';
        
        /**
         * Nasa Logo retina category
         */
        private $_cat_logo_retina = 'cat_logo_retina';
        
        /**
         * Nasa Header type category
         */
        private $_cat_header_type = 'cat_header_type';
        
        /**
         * Nasa Header builder category
         */
        private $_cat_header_builder = 'cat_header_builder';
        
        /**
         * Nasa Footer type category
         */
        private $_cat_footer_type = 'cat_footer_type';
        
        /**
         * Nasa hover effect product category
         */
        private $_cat_effect_hover = 'cat_effect_hover';
        
        /**
         * Display Type of Attribute Color | Image
         */
        private $_cat_attr_display_type = 'cat_attr_display_type';
        
        /**
         * Size Guide
         */
        private $_cat_size_guide = 'cat_size_guide';
        
        /**
         * Nasa init Object category
         */
        private static $_instance = null;

        /*
         * Intance start contructor
         */
        public static function getInstance() {
            if (!class_exists('WooCommerce') || !function_exists('get_term_meta')) {
                return null;
            }

            if (is_null(self::$_instance)) {
                self::$_instance = new self();
            }

            return self::$_instance;
        }

        /*
         * Contructor
         */
        public function __construct() {
            // Cat header
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_header'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_header'), 10, 1);
            
            // Cat Logo
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_logo_create'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_logo_edit'), 10, 1);

            // Cat breadcrumb
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_background_breadcrumb_create'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_background_breadcrumb_edit'), 10, 1);
            
            // Override sidebar for Category
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_sidebar'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_sidebar'), 10, 1);
            
            // Override primary for Category
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_primary_color'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_primary_color'), 10, 1);
            
            // Override Header & Footer
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_cat_header_footer_type'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_cat_header_footer_type'), 10, 1);
            
            // Override Effect hover product
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_effect_hover_product'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_effect_hover_product'), 10, 1);
            
            // Override Attribute Color Image display type Round | Square
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_attr_display_type'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_attr_display_type'), 10, 1);
            
            // Cat Size Chars
            add_action('product_cat_add_form_fields', array($this, 'taxonomy_size_guide_create'), 10, 1);
            add_action('product_cat_edit_form_fields', array($this, 'taxonomy_size_guide_edit'), 10, 1);

            // Save or Edit Term
            add_action('created_term', array($this, 'save_taxonomy_custom_fields'), 10, 3);
            add_action('edit_term', array($this, 'save_taxonomy_custom_fields'), 10, 3);
        }
        
        /*
         * Create custom Override effect hover product
         */
        public function taxonomy_attr_display_type($term = null) {
            $display_type = array(
                "" => esc_html__("Default", 'nasa-core'),
                "round" => esc_html__("Round", 'nasa-core'),
                "square" => esc_html__("Square", 'nasa-core')
            );
            
            if (is_object($term) && $term) {
                if (!$cat_attr_display_type = get_term_meta($term->term_id, $this->_cat_attr_display_type)) {
                    $cat_attr_display_type = add_term_meta($term->term_id, $this->_cat_attr_display_type, '');
                }
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_attr_display_type; ?>"><?php esc_html_e('Display Type Attribule Image', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $selected = isset($cat_attr_display_type[0]) ? $cat_attr_display_type[0] : '';
                        echo '<p><select id="' . $this->_cat_attr_display_type . '" name="' . $this->_cat_attr_display_type . '">';
                        foreach ($display_type as $slug => $name) {
                            echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
                        }
                        echo '</select></p>';
                        ?>
                    </td>
                </tr>
            <?php } else { ?>
                <div class="form-field">
                    <label for="<?php echo $this->_cat_attr_display_type; ?>"><?php esc_html_e('Display Type Attribule Image', 'nasa-core'); ?></label>
                    <?php
                    echo '<p><select id="' . $this->_cat_attr_display_type . '" name="' . $this->_cat_attr_display_type . '">';
                    foreach ($display_type as $slug => $name) {
                        echo '<option value="' . $slug . '">' . $name . '</option>';
                    }
                    echo '</select></p>';
                    ?>
                </div>
                <?php
            }
        }
        
        /*
         * Create custom Override effect hover product
         */
        public function taxonomy_effect_hover_product($term = null) {
            $effect_type = array(
                "" => esc_html__("Default", 'nasa-core'),
                "hover-fade" => esc_html__("Fade", 'nasa-core'),
                "hover-flip" => esc_html__("Flip Horizontal", 'nasa-core'),
                "hover-bottom-to-top" => esc_html__("Bottom To Top", 'nasa-core'),
                "no" => esc_html__("None", 'nasa-core')
            );
            
            if (is_object($term) && $term) {
                if (!$cat_effect_type = get_term_meta($term->term_id, $this->_cat_effect_hover)) {
                    $cat_effect_type = add_term_meta($term->term_id, $this->_cat_effect_hover, '');
                }
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_effect_hover; ?>"><?php esc_html_e('Override effect hover product', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $selected = isset($cat_effect_type[0]) ? $cat_effect_type[0] : '';
                        echo '<p><select id="' . $this->_cat_effect_hover . '" name="' . $this->_cat_effect_hover . '">';
                        foreach ($effect_type as $slug => $name) {
                            echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
                        }
                        echo '</select></p>';
                        ?>
                    </td>
                </tr>
            <?php } else { ?>
                <div class="form-field">
                    <label for="<?php echo $this->_cat_effect_hover; ?>"><?php esc_html_e('Override effect hover product', 'nasa-core'); ?></label>
                    <?php
                    echo '<p><select id="' . $this->_cat_effect_hover . '" name="' . $this->_cat_effect_hover . '">';
                    foreach ($effect_type as $slug => $name) {
                        echo '<option value="' . $slug . '">' . $name . '</option>';
                    }
                    echo '</select></p>';
                    ?>
                </div>
                <?php
            }
        }
        
        /*
         * Create custom Override Header & Footer Type
         */
        public function taxonomy_cat_header_footer_type($term = null) {
            $header_builder = nasa_get_headers_options();
            $footer_builder = nasa_get_footers_options();
            
            if (is_object($term) && $term) {
                if (!$cat_header_type = get_term_meta($term->term_id, $this->_cat_header_type)) {
                    $cat_header_type = add_term_meta($term->term_id, $this->_cat_header_type, '');
                }
                if (!$cat_header_builder = get_term_meta($term->term_id, $this->_cat_header_builder)) {
                    $cat_header_builder = add_term_meta($term->term_id, $this->_cat_header_builder, '');
                }
                if (!$cat_footer_type = get_term_meta($term->term_id, $this->_cat_footer_type)) {
                    $cat_footer_type = add_term_meta($term->term_id, $this->_cat_footer_type, '');
                }
                ?>
                <!-- Header type -->
                <tr class="form-field term-cat_header-type-wrap">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_header_type; ?>"><?php esc_html_e('Override Header type', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $selected = isset($cat_header_type[0]) ? $cat_header_type[0] : '';
                        echo '<p><select id="' . $this->_cat_header_type . '" name="' . $this->_cat_header_type . '">';
                        echo '<option value="">' . esc_html__("Default", 'nasa-core') . '</option>';
                        echo '<option value="1"' . ($selected == '1' ? ' selected' : '') . '>' . esc_html__('Header Type 1', 'nasa-core') . '</option>';
                        echo '<option value="2"' . ($selected == '2' ? ' selected' : '') . '>' . esc_html__('Header Type 2', 'nasa-core') . '</option>';
                        echo '<option value="3"' . ($selected == '3' ? ' selected' : '') . '>' . esc_html__('Header Type 3', 'nasa-core') . '</option>';
                        echo '<option value="4"' . ($selected == '4' ? ' selected' : '') . '>' . esc_html__('Header Type 4', 'nasa-core') . '</option>';
                        echo '<option value="nasa-custom"' . ($selected == 'nasa-custom' ? ' selected' : '') . '>' . esc_html__('Header Builder', 'nasa-core') . '</option>';
                        echo '</select></p>';
                        ?>
                    </td>
                </tr>
                <tr class="form-field term-cat_header-builder-wrap hidden-tag">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_header_builder; ?>"><?php esc_html_e('Header Builder', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $selected = isset($cat_header_builder[0]) ? $cat_header_builder[0] : '';
                        echo '<p><select id="' . $this->_cat_header_builder . '" name="' . $this->_cat_header_builder . '">';
                        foreach ($header_builder as $slug => $name) {
                            echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
                        }
                        echo '</select></p>';
                        ?>
                    </td>
                </tr>
                <!-- End Header type -->
                
                <!-- Footer type -->
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_footer_type; ?>"><?php esc_html_e('Override Footer type', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $selected = isset($cat_footer_type[0]) ? $cat_footer_type[0] : '';
                        echo '<p><select id="' . $this->_cat_footer_type . '" name="' . $this->_cat_footer_type . '">';
                        foreach ($footer_builder as $slug => $name) {
                            echo '<option value="' . $slug . '"' . ($selected == $slug ? ' selected' : '') . '>' . $name . '</option>';
                        }
                        echo '</select></p>';
                        ?>
                    </td>
                </tr>
                <!-- End Footer type -->
                <?php
            } else {
                ?>
                <!-- Header type -->
                <div class="form-field term-cat_header-type-wrap">
                    <label for="<?php echo $this->_cat_header_type; ?>"><?php esc_html_e('Override Header type', 'nasa-core'); ?></label>
                    <?php
                    echo '<p><select id="' . $this->_cat_header_type . '" name="' . $this->_cat_header_type . '">';
                    echo '<option value="">' . esc_html__("Default", 'nasa-core') . '</option>';
                    echo '<option value="1">' . esc_html__('Header Type 1', 'nasa-core') . '</option>';
                    echo '<option value="2">' . esc_html__('Header Type 2', 'nasa-core') . '</option>';
                    echo '<option value="3">' . esc_html__('Header Type 3', 'nasa-core') . '</option>';
                    echo '<option value="4">' . esc_html__('Header Type 4', 'nasa-core') . '</option>';
                    echo '<option value="nasa-custom">' . esc_html__('Header Builder', 'nasa-core') . '</option>';
                    echo '</select></p>';
                    ?>
                </div>
                <div class="form-field hidden-tag term-cat_header-builder-wrap">
                    <label for="<?php echo $this->_cat_header_builder; ?>"><?php esc_html_e('Header Builder', 'nasa-core'); ?></label>
                    <?php
                    echo '<p><select id="' . $this->_cat_header_builder . '" name="' . $this->_cat_header_builder . '">';
                    foreach ($header_builder as $slug => $name) {
                        echo '<option value="' . $slug . '">' . $name . '</option>';
                    }
                    echo '</select></p>';
                    ?>
                </div>
                <!-- End Header type -->
                
                <!-- Footer type -->
                <div class="form-field">
                    <label for="<?php echo $this->_cat_footer_type; ?>"><?php esc_html_e('Override Footer type', 'nasa-core'); ?></label>
                    <?php
                    echo '<p><select id="' . $this->_cat_footer_type . '" name="' . $this->_cat_footer_type . '">';
                    foreach ($footer_builder as $slug => $name) {
                        echo '<option value="' . $slug . '">' . $name . '</option>';
                    }
                    echo '</select></p>';
                    ?>
                </div>
                <!-- End Footer type -->
                <?php
            } ?>
            <script>
                jQuery(document).ready(function ($){
                    if($('.term-cat_header-type-wrap select[name="<?php echo $this->_cat_header_type; ?>"]').val() === 'nasa-custom') {
                        $('.term-cat_header-builder-wrap').show();
                    } else {
                        $('.term-cat_header-builder-wrap').hide();
                    }

                    $('body').on('change', '.term-cat_header-type-wrap select[name="<?php echo $this->_cat_header_type; ?>"]', function() {
                        var _val = $(this).val();
                        if(_val === 'nasa-custom') {
                            $('.term-cat_header-builder-wrap').show();
                        } else {
                            $('.term-cat_header-builder-wrap').hide();
                        }
                    });
                });
            </script>
            <?php
        }
        
        /**
         * Custom primary color
         * @param type $term
         */
        public function taxonomy_primary_color($term = null) {
            if (is_object($term) && $term) {
                if (!$primary_color = get_term_meta($term->term_id, $this->_cat_primary_color)) {
                    $primary_color = add_term_meta($term->term_id, $this->_cat_primary_color, '');
                }
                ?>
                <tr class="form-field nasa-term-primary_color hidden-tag">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_primary_color; ?>"><?php _e('Override primary color', 'nasa-core'); ?></label>
                    </th>
                    <td>
                        <div class="nasa_p_color">
                            <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_primary_color; ?>" name="<?php echo $this->_cat_primary_color; ?>" value="<?php echo isset($primary_color[0]) ? esc_attr($primary_color[0]) : ''; ?>" />
                        </div>
                   </td>
                </tr>
            <?php } else { ?>
                <div class="form-field nasa-term-primary_color hidden-tag">
                    <label for="<?php echo $this->_cat_primary_color; ?>"><?php _e('Override primary color', 'nasa-core'); ?></label>
                    <div class="nasa_p_color">
                        <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_primary_color; ?>" name="<?php echo $this->_cat_primary_color; ?>" value="" />
                    </div>
                </div>
            <?php } ?>
            <script>
                jQuery(document).ready(function ($){
                    if($('.term-parent-wrap select[name="parent"]').val() === '-1') {
                        $('.nasa-term-primary_color').show();
                    } else {
                        $('.nasa-term-primary_color').hide();
                    }
                    
                    $('body').on('change', '.term-parent-wrap select[name="parent"]', function() {
                        var _val = $(this).val();
                        if(_val === '-1') {
                            $('.nasa-term-primary_color').show();
                        } else {
                            $('.nasa-term-primary_color').hide();
                        }
                    });
                });
            </script>
            <?php
        }
        
        /*
         * Create custom Override sidebar
         */
        public function taxonomy_cat_sidebar($term = null) {
            if (is_object($term) && $term) {
                if (!$cat_sidebar = get_term_meta($term->term_id, $this->_cat_sidebar)) {
                    $cat_sidebar = add_term_meta($term->term_id, $this->_cat_sidebar, '0');
                }
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_sidebar; ?>"><?php esc_html_e('Override Shop Sidebar', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $checked = isset($cat_sidebar[0]) && $cat_sidebar[0] == '1' ? ' checked' : '';
                        echo '<p><input type="checkbox" id="' . $this->_cat_sidebar . '" name="' . $this->_cat_sidebar . '" value="1"' . $checked . ' />' . '<label for="' . $this->_cat_sidebar . '" style="display: inline;">' . esc_html__('Yes, please!', 'nasa-core') . '</label></p>';
                        ?>
                        <p><?php esc_html_e('Please checked, save and built sidebar at: Appearance > Widgets', 'nasa-core'); ?></p>
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <div class="form-field term-cat_header-wrap">
                    <label for="<?php echo $this->_cat_sidebar; ?>"><?php esc_html_e('Override Shop Sidebar', 'nasa-core'); ?></label>
                    <p><input type="checkbox" id="<?php echo $this->_cat_sidebar; ?>" name="<?php echo $this->_cat_sidebar; ?>" value="1" /><label for="<?php echo $this->_cat_sidebar; ?>" style="display: inline;"><?php esc_html_e('Yes, please!', 'nasa-core'); ?></label></p>
                    <p><?php esc_html_e('Please checked, save and built sidebar at: Appearance > Widgets', 'nasa-core'); ?></p>
                </div>
                <?php
            }
        }

        /*
         * Create custom cat header
         */
        public function taxonomy_cat_header($term = null) {
            if (is_object($term) && $term) {
                if (!$cat_header = get_term_meta($term->term_id, $this->_cat_header)) {
                    $cat_header = add_term_meta($term->term_id, $this->_cat_header, '');
                }
                ?>
                <tr class="form-field">
                    <th scope="row" valign="top">
                        <label for="<?php echo $this->_cat_header; ?>"><?php esc_html_e('Top Content', 'nasa-core'); ?></label>
                    </th>
                    <td>             
                        <?php
                        $content = isset($cat_header[0]) ? $cat_header[0] : '';
                        echo '<textarea id="' . $this->_cat_header . '" name="' . $this->_cat_header . '">' . $content . '</textarea>';
                        ?>
                        <p class="description"><?php esc_html_e('Enter a value for this field. Shortcodes are allowed. This will be displayed at top of the category.', 'nasa-core'); ?></p>
                    </td>
                </tr>
                <?php
            } else {
                ?>
                <div class="form-field term-cat_header-wrap">
                    <label for="<?php echo $this->_cat_header; ?>"><?php esc_html_e('Top Content', 'nasa-core'); ?></label>
                    <textarea id="<?php echo $this->_cat_header; ?>" name="<?php echo $this->_cat_header; ?>"></textarea>
                    <p class="description"><?php esc_html_e('Enter a value for this field. Shortcodes are allowed. This will be displayed at top of the category.', 'nasa-core'); ?></p>
                </div>
                <?php
            }
        }
        
        /*
         * Create custom logo
         * Case create category
         */
        public function taxonomy_logo_create() { ?>
            <div class="form-field term-logo-wrap with-logo_type">
                <label><?php _e('Override Logo', 'nasa-core'); ?></label>
                <div id="nasa-logo_thumbnail" style="float: left; margin-right: 10px;">
                    <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" height="30" />
                </div>
                
                <div style="line-height: 60px;">
                    <input type="hidden" id="<?php echo $this->_cat_logo; ?>" name="<?php echo $this->_cat_logo; ?>" />
                    <button type="button" class="upload_image_button_logo button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                    <button type="button" class="remove_image_button_logo button"><?php _e('Remove image', 'nasa-core'); ?></button>
                </div>
                <div class="clear"></div>
            </div>
                
            <div class="form-field term-logo-retina-wrap with-logo-retina_type">
                <label><?php _e('Override Logo Retina', 'nasa-core'); ?></label>
                <div id="nasa-logo-retina_thumbnail" style="float: left; margin-right: 10px;">
                    <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" height="30" />
                </div>
                
                <div style="line-height: 60px;">
                    <input type="hidden" id="<?php echo $this->_cat_logo_retina; ?>" name="<?php echo $this->_cat_logo_retina; ?>" />
                    <button type="button" class="upload_image_button_logo_retina button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                    <button type="button" class="remove_image_button_logo_retina button"><?php _e('Remove image', 'nasa-core'); ?></button>
                </div>
                <div class="clear"></div>
            </div>
                
            <script>
                jQuery(document).ready(function ($){
                    // Only show the "remove image" button when needed
                    if (!$('#<?php echo $this->_cat_logo; ?>').val()) {
                        $('.remove_image_button_logo').hide();
                    }
                    
                    if (!$('#<?php echo $this->_cat_logo_retina; ?>').val()) {
                        $('.remove_image_button_logo_retina').hide();
                    }

                    // Uploading files
                    var file_frame_logo;

                    /**
                     * Logo
                     */
                    $('body').on('click', '.upload_image_button_logo', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_logo) {
                            file_frame_logo.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_logo = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_logo.on('select', function () {
                            var attachment = file_frame_logo.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_logo; ?>').val(attachment.id);
                            $('#nasa-logo_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_logo').show();
                        });

                        // Finally, open the modal.
                        file_frame_logo.open();
                    });

                    $('body').on('click', '.remove_image_button_logo', function () {
                        $('#nasa-logo_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_logo; ?>').val('');
                        $('.remove_image_button_logo').hide();
                        return false;
                    });
                    
                    // Uploading files retina
                    var file_frame_logo_retina;
                    
                    /**
                     * Logo Retina
                     */
                    $('body').on('click', '.upload_image_button_logo_retina', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_logo_retina) {
                            file_frame_logo_retina.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_logo_retina = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_logo_retina.on('select', function () {
                            var attachment = file_frame_logo_retina.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_logo_retina; ?>').val(attachment.id);
                            $('#nasa-logo-retina_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_logo_retina').show();
                        });

                        // Finally, open the modal.
                        file_frame_logo_retina.open();
                    });

                    $('body').on('click', '.remove_image_button_logo_retina', function () {
                        $('#nasa-logo-retina_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_logo_retina; ?>').val('');
                        $('.remove_image_button_logo_retina').hide();
                        return false;
                    });

                    $(document).ajaxComplete(function (event, request, options) {
                        if (request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                            var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                            if (!res || res.errors) {
                                return;
                            }
                            // Clear Thumbnail fields on submit
                            $('#nasa-logo_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#nasa-logo-retina_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#<?php echo $this->_cat_logo; ?>').val('');
                            $('#<?php echo $this->_cat_logo_retina; ?>').val('');
                            $('.remove_image_button_logo').hide();
                            $('.remove_image_button_logo_retina').hide();
                            // Clear Display type field on submit
                            $('#display_type').val('');
                            return;
                        }
                    });
                });
            </script>
        <?php
        }
        
        /*
         * Edit custom logo
         * Case edit category
         */
        public function taxonomy_logo_edit($term) {
            $logo_id = get_term_meta($term->term_id, $this->_cat_logo);
            $logo_id = isset($logo_id[0]) && (int) $logo_id[0] ? (int) $logo_id[0] : '0';
            $logo = $logo_id ? wp_get_attachment_thumb_url($logo_id) : wc_placeholder_img_src();
            
            $logo_retina_id = get_term_meta($term->term_id, $this->_cat_logo_retina);
            $logo_retina_id = isset($logo_retina_id[0]) && (int) $logo_retina_id[0] ? (int) $logo_retina_id[0] : '0';
            $logo_retina = $logo_retina_id ? wp_get_attachment_thumb_url($logo_retina_id) : wc_placeholder_img_src();
            ?>
            
            <tr class="form-field with-logo">
                <th scope="row" valign="top"><label><?php _e('Override logo', 'nasa-core'); ?></label></th>
                <td>
                    <div id="nasa-logo_thumbnail" style="float: left; margin-right: 10px;">
                        <img src="<?php echo esc_url($logo); ?>" height="30" />
                    </div>
                    <div style="line-height: 60px;">
                        <input type="hidden" id="<?php echo $this->_cat_logo; ?>" name="<?php echo $this->_cat_logo; ?>" value="<?php echo $logo_id; ?>" />
                        <button type="button" class="upload_image_button_logo button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                        <button type="button" class="remove_image_button_logo button"><?php _e('Remove image', 'nasa-core'); ?></button>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
            
            <tr class="form-field with-logo-retina">
                <th scope="row" valign="top"><label><?php _e('Override logo retina', 'nasa-core'); ?></label></th>
                <td>
                    <div id="nasa-logo-retina_thumbnail" style="float: left; margin-right: 10px;">
                        <img src="<?php echo esc_url($logo_retina); ?>" height="30" />
                    </div>
                    <div style="line-height: 60px;">
                        <input type="hidden" id="<?php echo $this->_cat_logo_retina; ?>" name="<?php echo $this->_cat_logo_retina; ?>" value="<?php echo $logo_retina_id; ?>" />
                        <button type="button" class="upload_image_button_logo_retina button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                        <button type="button" class="remove_image_button_logo_retina button"><?php _e('Remove image', 'nasa-core'); ?></button>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
                
            <script>
                jQuery(document).ready(function ($){
                    // Only show the "remove image" button when needed
                    if (!$('#<?php echo $this->_cat_logo; ?>').val()) {
                        $('.remove_image_button_logo').hide();
                    }
                    
                    if (!$('#<?php echo $this->_cat_logo_retina; ?>').val()) {
                        $('.remove_image_button_logo_retina').hide();
                    }

                    // Uploading files
                    var file_frame_logo;

                    /**
                     * Logo
                     */
                    $('body').on('click', '.upload_image_button_logo', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_logo) {
                            file_frame_logo.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_logo = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_logo.on('select', function () {
                            var attachment = file_frame_logo.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_logo; ?>').val(attachment.id);
                            $('#nasa-logo_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_logo').show();
                        });

                        // Finally, open the modal.
                        file_frame_logo.open();
                    });

                    $('body').on('click', '.remove_image_button_logo', function () {
                        $('#nasa-logo_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_logo; ?>').val('');
                        $('.remove_image_button_logo').hide();
                        return false;
                    });
                    
                    // Uploading files retina
                    var file_frame_logo_retina;
                    
                    /**
                     * Logo Retina
                     */
                    $('body').on('click', '.upload_image_button_logo_retina', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_logo_retina) {
                            file_frame_logo_retina.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_logo_retina = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_logo_retina.on('select', function () {
                            var attachment = file_frame_logo_retina.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_logo_retina; ?>').val(attachment.id);
                            $('#nasa-logo-retina_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_logo_retina').show();
                        });

                        // Finally, open the modal.
                        file_frame_logo_retina.open();
                    });

                    $('body').on('click', '.remove_image_button_logo_retina', function () {
                        $('#nasa-logo-retina_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_logo_retina; ?>').val('');
                        $('.remove_image_button_logo_retina').hide();
                        return false;
                    });

                    $(document).ajaxComplete(function (event, request, options) {
                        if (request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                            var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                            if (!res || res.errors) {
                                return;
                            }
                            // Clear Thumbnail fields on submit
                            $('#nasa-logo_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#nasa-logo-retina_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#<?php echo $this->_cat_logo; ?>').val('');
                            $('#<?php echo $this->_cat_logo_retina; ?>').val('');
                            $('.remove_image_button_logo').hide();
                            $('.remove_image_button_logo_retina').hide();
                            // Clear Display type field on submit
                            $('#display_type').val('');
                            return;
                        }
                    });
                });
            </script>
        <?php
        }

        /*
         * Create custom breadcrumb
         * Case create category
         */
        public function taxonomy_background_breadcrumb_create() { ?>
            <div class="form-field term-breadcrumb_type-wrap">
                <label><?php _e('Breadcrumb type', 'nasa-core'); ?></label>
                <div class="nasa_breadcrumb_type">
                    <select name="<?php echo $this->_cat_bread_enable; ?>" id="<?php echo $this->_cat_bread_enable; ?>" class="postform">
                        <option value=""><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                        <option value="1"><?php echo esc_html__('Has breadcrumb background', 'nasa-core'); ?></option>
                    </select>
                </div>
                <div class="clear"></div>
            </div>
            
            <div class="form-field term-breadcrumb_bg-wrap with-breadcrumb_type">
                <label><?php _e('Background Breadcrumb', 'nasa-core'); ?></label>
                <div id="breadcrumb_bg_thumbnail" style="float: left; margin-right: 10px;">
                    <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" height="50" />
                </div>
                
                <div style="line-height: 60px;">
                    <input type="hidden" id="<?php echo $this->_cat_bread_bg; ?>" name="<?php echo $this->_cat_bread_bg; ?>" />
                    <button type="button" class="upload_image_button_bread button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                    <button type="button" class="remove_image_button_bread button"><?php _e('Remove image', 'nasa-core'); ?></button>
                </div>
                <div class="clear"></div>
            </div>
                
            <div class="form-field term-breadcrumb_text_color-wrap with-breadcrumb_type">
                <label><?php _e('Text color breadcrumb', 'nasa-core'); ?></label>
                <div class="nasa_p_color">
                    <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_bread_text; ?>" name="<?php echo $this->_cat_bread_text; ?>" value="" />
                </div>
                <div class="clear"></div>
            </div>
                
            <script>
                jQuery(document).ready(function ($){
                    if ('' === $('#<?php echo $this->_cat_bread_enable; ?>').val()) {
                        $('.with-breadcrumb_type').hide();
                    }
                    
                    $('body').on('change', '#<?php echo $this->_cat_bread_enable; ?>', function() {
                        if ('' === $(this).val()) {
                            $('.with-breadcrumb_type').fadeOut(200);
                        } else {
                            $('.with-breadcrumb_type').fadeIn(200);
                        }
                    });
                    
                    // Only show the "remove image" button when needed
                    if (!$('#<?php echo $this->_cat_bread_bg; ?>').val()) {
                        $('.remove_image_button_bread').hide();
                    }

                    // Uploading files
                    var file_frame_bread;

                    $('body').on('click', '.upload_image_button_bread', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_bread) {
                            file_frame_bread.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_bread = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_bread.on('select', function () {
                            var attachment = file_frame_bread.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_bread_bg; ?>').val(attachment.id);
                            $('#breadcrumb_bg_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_bread').show();
                        });

                        // Finally, open the modal.
                        file_frame_bread.open();
                    });

                    $('body').on('click', '.remove_image_button_bread', function () {
                        $('#breadcrumb_bg_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_bread_bg; ?>').val('');
                        $('.remove_image_button_bread').hide();
                        return false;
                    });

                    $(document).ajaxComplete(function (event, request, options) {
                        if (request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                            var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                            if (!res || res.errors) {
                                return;
                            }
                            // Clear Thumbnail fields on submit
                            $('#breadcrumb_bg_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#<?php echo $this->_cat_bread_bg; ?>').val('');
                            $('.remove_image_button_bread').hide();
                            // Clear Display type field on submit
                            $('#display_type').val('');
                            return;
                        }
                    });
                });
            </script>
        <?php
        }

        /*
         * Edit custom breadcrumb
         * Case edit category
         */
        public function taxonomy_background_breadcrumb_edit($term) {
            $bread_type = get_term_meta($term->term_id, $this->_cat_bread_enable, true);
            $bread_type = $bread_type == 1 ? 1 : '';
            ?>
            
            <tr class="form-field breadcrumb_type">
                <th scope="row" valign="top"><label><?php _e('Breadcrumb type', 'nasa-core'); ?></label></th>
                <td>
                    <div class="nasa_breadcrumb_type">
                        <select name="<?php echo $this->_cat_bread_enable; ?>" id="<?php echo $this->_cat_bread_enable; ?>" class="postform">
                            <option value=""<?php echo $bread_type == '' ? ' selected' : ''; ?>><?php echo esc_html__('Default', 'nasa-core'); ?></option>
                            <option value="1"<?php echo $bread_type == 1 ? ' selected' : ''; ?>><?php echo esc_html__('Has breadcrumb background', 'nasa-core'); ?></option>
                        </select>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
            
            <?php
            $thumbnail_id = get_term_meta($term->term_id, $this->_cat_bread_bg);
            $thumbnail_id = isset($thumbnail_id[0]) && (int) $thumbnail_id[0] ? (int) $thumbnail_id[0] : '0';
            $image = $thumbnail_id ? wp_get_attachment_thumb_url($thumbnail_id) : wc_placeholder_img_src();
            ?>
            <tr class="form-field with-breadcrumb_type">
                <th scope="row" valign="top"><label><?php _e('Background Breadcrumb', 'nasa-core'); ?></label></th>
                <td>
                    <div id="breadcrumb_bg_thumbnail" style="float: left; margin-right: 10px;">
                        <img src="<?php echo esc_url($image); ?>" height="50" />
                    </div>
                    <div style="line-height: 60px;">
                        <input type="hidden" id="<?php echo $this->_cat_bread_bg; ?>" name="<?php echo $this->_cat_bread_bg; ?>" value="<?php echo $thumbnail_id; ?>" />
                        <button type="button" class="upload_image_button_bread button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                        <button type="button" class="remove_image_button_bread button"><?php _e('Remove image', 'nasa-core'); ?></button>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
            
            <?php
            $text_color = get_term_meta($term->term_id, $this->_cat_bread_text, true);
            $text_color = !$text_color ? '' : $text_color;
            ?>
            <tr class="form-field with-breadcrumb_type">
                <th scope="row" valign="top"><label><?php _e('Text color breadcrumb', 'nasa-core'); ?></label></th>
                <td>
                    <div class="nasa_p_color">
                        <input type="text" class="widefat nasa-color-field" id="<?php echo $this->_cat_bread_text; ?>" name="<?php echo $this->_cat_bread_text; ?>" value="<?php echo $text_color; ?>" />
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
            
            <script>
                jQuery(document).ready(function ($){
                    if ('' === $('#<?php echo $this->_cat_bread_enable; ?>').val()) {
                        $('.with-breadcrumb_type').hide();
                    }
                    
                    $('body').on('change', '#<?php echo $this->_cat_bread_enable; ?>', function() {
                        if ('' === $(this).val()) {
                            $('.with-breadcrumb_type').fadeOut(200);
                        } else {
                            $('.with-breadcrumb_type').fadeIn(200);
                        }
                    });
                    
                    // Only show the "remove image" button when needed
                    if ('0' === $('#<?php echo $this->_cat_bread_bg; ?>').val()) {
                        $('.remove_image_button_bread').hide();
                    }

                    // Uploading files
                    var file_frame_bread;

                    $('body').on('click', '.upload_image_button_bread', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_bread) {
                            file_frame_bread.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_bread = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_bread.on('select', function () {
                            var attachment = file_frame_bread.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_bread_bg; ?>').val(attachment.id);
                            $('#breadcrumb_bg_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_bread').show();
                        });

                        // Finally, open the modal.
                        file_frame_bread.open();
                    });

                    $('body').on('click', '.remove_image_button_bread', function () {
                        $('#breadcrumb_bg_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_bread_bg; ?>').val('');
                        $('.remove_image_button_bread').hide();
                        return false;
                    });
                });
            </script>
            <?php
        }
        
        /*
         * Create size guide
         * Case create category
         */
        public function taxonomy_size_guide_create() { ?>
            <div class="form-field term-size_guide-wrap">
                <label><?php _e('Size guide image', 'nasa-core'); ?></label>
                <div id="size_guide_thumbnail" style="float: left; margin-right: 10px;">
                    <img src="<?php echo esc_url(wc_placeholder_img_src()); ?>" height="150" />
                </div>
                
                <div style="line-height: 60px;">
                    <input type="hidden" id="<?php echo $this->_cat_size_guide; ?>" name="<?php echo $this->_cat_size_guide; ?>" />
                    <button type="button" class="upload_image_button_size_guide button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                    <button type="button" class="remove_image_button_size_guide button"><?php _e('Remove image', 'nasa-core'); ?></button>
                </div>
                <div class="clear"></div>
            </div>
                
            <script>
                jQuery(document).ready(function ($){
                    // Only show the "remove image" button when needed
                    if (!$('#<?php echo $this->_cat_size_guide; ?>').val()) {
                        $('.remove_image_button_bread').hide();
                    }
                    
                    // Uploading files
                    var file_frame_size_guide;

                    $('body').on('click', '.upload_image_button_size_guide', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_size_guide) {
                            file_frame_size_guide.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_size_guide = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_size_guide.on('select', function () {
                            var attachment = file_frame_size_guide.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_size_guide; ?>').val(attachment.id);
                            $('#size_guide_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_size_guide').show();
                        });

                        // Finally, open the modal.
                        file_frame_size_guide.open();
                    });

                    $('body').on('click', '.remove_image_button_size_guide', function () {
                        $('#size_guide_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_size_guide; ?>').val('');
                        $('.remove_image_button_size_guide').hide();
                        return false;
                    });

                    $(document).ajaxComplete(function (event, request, options) {
                        if (request && 4 === request.readyState && 200 === request.status && options.data && 0 <= options.data.indexOf('action=add-tag')) {

                            var res = wpAjax.parseAjaxResponse(request.responseXML, 'ajax-response');
                            if (!res || res.errors) {
                                return;
                            }
                            // Clear Thumbnail fields on submit
                            $('#size_guide_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                            $('#<?php echo $this->_cat_size_guide; ?>').val('');
                            $('.remove_image_button_size_guide').hide();
                            // Clear Display type field on submit
                            $('#display_type').val('');
                            return;
                        }
                    });
                });
            </script>
        <?php
        }
        
        /*
         * Edit size guide
         * Case edit category
         */
        public function taxonomy_size_guide_edit($term) {
            $thumbnail_id = get_term_meta($term->term_id, $this->_cat_size_guide);
            $thumbnail_id = isset($thumbnail_id[0]) && (int) $thumbnail_id[0] ? (int) $thumbnail_id[0] : '0';
            $image = $thumbnail_id ? wp_get_attachment_thumb_url($thumbnail_id) : wc_placeholder_img_src();
            ?>
            <tr class="form-field">
                <th scope="row" valign="top"><label><?php _e('Size Chars Image', 'nasa-core'); ?></label></th>
                <td>
                    <div id="size_guide_thumbnail" style="float: left; margin-right: 10px;">
                        <img src="<?php echo esc_url($image); ?>" height="150" />
                    </div>
                    <div style="line-height: 60px;">
                        <input type="hidden" id="<?php echo $this->_cat_size_guide; ?>" name="<?php echo $this->_cat_size_guide; ?>" value="<?php echo $thumbnail_id; ?>" />
                        <button type="button" class="upload_image_button_size_guide button"><?php _e('Upload/Add image', 'nasa-core'); ?></button>
                        <button type="button" class="remove_image_button_size_guide button"><?php _e('Remove image', 'nasa-core'); ?></button>
                    </div>
                    <div class="clear"></div>
                </td>
            </tr>
            
            <script>
                jQuery(document).ready(function ($){
                    // Only show the "remove image" button when needed
                    if ('0' === $('#<?php echo $this->_cat_size_guide; ?>').val()) {
                        $('.remove_image_button_size_guide').hide();
                    }

                    // Uploading files
                    var file_frame_size_guide;

                    $('body').on('click', '.upload_image_button_size_guide', function (event) {

                        event.preventDefault();

                        // If the media frame already exists, reopen it.
                        if (file_frame_size_guide) {
                            file_frame_size_guide.open();
                            return;
                        }

                        // Create the media frame.
                        file_frame_size_guide = wp.media.frames.downloadable_file = wp.media({
                            title: '<?php _e("Choose an image", "nasa-core"); ?>',
                            button: {
                                text: '<?php _e("Use image", "nasa-core"); ?>'
                            },
                            multiple: false
                        });

                        // When an image is selected, run a callback.
                        file_frame_size_guide.on('select', function () {
                            var attachment = file_frame_size_guide.state().get('selection').first().toJSON();
                            var attachment_thumbnail = attachment.sizes.thumbnail || attachment.sizes.full;

                            $('#<?php echo $this->_cat_size_guide; ?>').val(attachment.id);
                            $('#size_guide_thumbnail').find('img').attr('src', attachment_thumbnail.url);
                            $('.remove_image_button_size_guide').show();
                        });

                        // Finally, open the modal.
                        file_frame_size_guide.open();
                    });

                    $('body').on('click', '.remove_image_button_size_guide', function () {
                        $('#size_guide_thumbnail').find('img').attr('src', '<?php echo esc_js(wc_placeholder_img_src()); ?>');
                        $('#<?php echo $this->_cat_size_guide; ?>').val('');
                        $('.remove_image_button_size_guide').hide();
                        return false;
                    });
                });
            </script>
            <?php
        }

        /*
         * Save taxonomy custom fields
         */
        public function save_taxonomy_custom_fields($term_id, $tt_id = '', $taxonomy = '') {
            if('product_cat' == $taxonomy) {
                
                /*
                 * Header
                 */
                if (isset($_POST[$this->_cat_header])) {
                    update_term_meta($term_id, $this->_cat_header, $_POST[$this->_cat_header]);
                }
                
                /*
                 * Logo
                 */
                if (isset($_POST[$this->_cat_logo])) {
                    update_term_meta($term_id, $this->_cat_logo, $_POST[$this->_cat_logo]);
                }
                
                /*
                 * Logo retina
                 */
                if (isset($_POST[$this->_cat_logo_retina])) {
                    update_term_meta($term_id, $this->_cat_logo_retina, $_POST[$this->_cat_logo_retina]);
                }

                /*
                 * Breadcrumb type
                 */
                if (isset($_POST[$this->_cat_bread_enable])) {
                    update_term_meta($term_id, $this->_cat_bread_enable, absint($_POST[$this->_cat_bread_enable]));
                }
                
                /*
                 * Breadcrumb Background
                 */
                if (isset($_POST[$this->_cat_bread_bg])) {
                    update_term_meta($term_id, $this->_cat_bread_bg, absint($_POST[$this->_cat_bread_bg]));
                }

                /*
                 * Breadcrumb text color
                 */
                if (isset($_POST[$this->_cat_bread_text])) {
                    update_term_meta($term_id, $this->_cat_bread_text, $_POST[$this->_cat_bread_text]);
                }
                
                /*
                 * Header type
                 */
                if (isset($_POST[$this->_cat_header_type])) {
                    update_term_meta($term_id, $this->_cat_header_type, $_POST[$this->_cat_header_type]);
                }
                
                /*
                 * Footer type
                 */
                if (isset($_POST[$this->_cat_footer_type])) {
                    update_term_meta($term_id, $this->_cat_footer_type, $_POST[$this->_cat_footer_type]);
                }
                
                /*
                 * Primary color
                 */
                if (isset($_POST[$this->_cat_primary_color])) {
                    update_term_meta($term_id, $this->_cat_primary_color, $_POST[$this->_cat_primary_color]);
                }
                
                /*
                 * Effect hover product
                 */
                if (isset($_POST[$this->_cat_effect_hover])) {
                    update_term_meta($term_id, $this->_cat_effect_hover, $_POST[$this->_cat_effect_hover]);
                }
                
                /*
                 * Attribute Color, Image display Type
                 */
                if (isset($_POST[$this->_cat_attr_display_type])) {
                    update_term_meta($term_id, $this->_cat_attr_display_type, $_POST[$this->_cat_attr_display_type]);
                }
                
                /*
                 * Size Chars image
                 */
                if (isset($_POST[$this->_cat_size_guide])) {
                    update_term_meta($term_id, $this->_cat_size_guide, absint($_POST[$this->_cat_size_guide]));
                }
                
                /*
                 * Override side bar
                 */
                $value = isset($_POST[$this->_cat_sidebar]) && $_POST[$this->_cat_sidebar] == '1' ? '1' : '0';
                update_term_meta($term_id, $this->_cat_sidebar, $value);

                $term = get_term($term_id , 'product_cat');
                if($term) {
                    $sidebar_cats = get_option('nasa_sidebars_cats');
                    $sidebar_cats = empty($sidebar_cats) ? array() : $sidebar_cats;

                    if($value === '1' && !isset($sidebar_cats[$term->slug])) {
                        $sidebar_cats[$term->slug] = array(
                            'slug' => $term->slug,
                            'name' => $term->name
                        );
                    } else if($value === '0' && isset($sidebar_cats[$term->slug])) {
                        unset($sidebar_cats[$term->slug]);
                    }

                    update_option('nasa_sidebars_cats', $sidebar_cats);
                }
                
                /**
                 * Delete old side bar
                 */
                $this->delete_sidebar_cats();
            }
        }
        
        /*
         * Check term and delete sidebar category not exist
         */
        protected function delete_sidebar_cats() {
            $sidebar_cats = get_option('nasa_sidebars_cats');
            
            if(!empty($sidebar_cats)) {
                foreach ($sidebar_cats as $sidebar) {
                    if(!term_exists($sidebar['slug'])) {
                        unset($sidebar_cats[$sidebar['slug']]);
                    }
                }
                
                update_option('nasa_sidebars_cats', $sidebar_cats);
            }
        }
    }

    /**
     * Instantiate Class
     */
    add_action('init', array('Nasa_WC_Term_Data_Fields', 'getInstance'), 0);
}
