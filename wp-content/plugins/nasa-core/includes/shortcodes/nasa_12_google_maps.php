<?php

add_shortcode('nasa_google_map', 'nasa_sc_google_maps');

function nasa_sc_google_maps($atts, $content = null) {
    global $nasa_google_map;
    
    extract(shortcode_atts(array(
        'api_key' => '',
        'lat' => '',
        'long' => '',
        'height' => '400px',
        'zoom' => '17',
        'zoom_control' => '0',
        'pan_control' => '0',
        'mapType' => '0',
        'type' => 'ROADMAP'
    ), $atts));
    
    $mapsrandomid = rand();
    $mapSrc = $api_key != '' ? 'https://maps.googleapis.com/maps/api/js?key=' . esc_attr($api_key) . '&sensor=false' : 'https://maps.googleapis.com/maps/api/js?key';
    ob_start();

    if (!isset($nasa_google_map) || !$nasa_google_map) :
        $GLOBALS['nasa_google_map'] = true;
        ?>
        <script src="<?php echo esc_attr($mapSrc); ?>"></script>
    <?php endif; ?>
    <script>
        function initialize() {
            var styles = {
                'nasatheme': [
                    {
                        "featureType": "administrative",
                        "stylers": [{"visibility": "on"}]
                    },
                    {
                        "featureType": "road",
                        "stylers": [{"visibility": "on"}]
                    },
                    {
                        "stylers": [
                            {"visibility": "on"},
                            {"saturation": -30}
                        ]
                    }
                ]
            };

            var myLatlng = new google.maps.LatLng(<?php echo esc_attr($lat); ?>, <?php echo esc_attr($long); ?>);
            var myOptions = {
                zoom: <?php echo esc_attr($zoom); ?>,
                center: myLatlng,
                mapTypeId: google.maps.MapTypeId.<?php echo esc_attr($type); ?>,
                disableDefaultUI: true,
                draggable: true,
                zoomControl: <?php if(!$zoom_control) : ?>false<?php else : ?>true<?php endif;?>,
                panControl: <?php if(!$pan_control) : ?>false<?php else : ?>true<?php endif;?>,
                mapTypeControl: <?php if(!$mapType) : ?>false<?php else : ?>true<?php endif;?>,
                scaleControl: false,
                streetViewControl: false,
                overviewMapControl: false,
                scrollwheel: false,
                disableDoubleClickZoom: true
            };
            var map = new google.maps.Map(document.getElementById("<?php echo esc_attr($mapsrandomid); ?>"), myOptions);
            var styledMapType = new google.maps.StyledMapType(styles['nasatheme'], {name: 'nasatheme'});
            map.mapTypes.set('nasatheme', styledMapType);

            var marker = new google.maps.Marker({
                position: myLatlng,
                map: map,
                title: ""
            });
        }

        google.maps.event.addDomListener(window, 'load', initialize);
        google.maps.event.addDomListener(window, 'resize', initialize);
    </script>

    <div class="map_container">
        <div id="<?php echo esc_attr($mapsrandomid); ?>" style="height: <?php echo esc_attr($height); ?>;"></div>
        <div class="map_overlay_top"></div>
        <div class="map_overlay_bottom"></div>
    </div>

    <?php
    $content = ob_get_clean();
    
    return $content;
}

// **********************************************************************// 
// ! Register New Element: Google Map
// **********************************************************************//
add_action('init', 'nasa_register_google_maps');
function nasa_register_google_maps(){
    $map_params = array(
        "name" => esc_html__("Google map", 'nasa-core'),
        "base" => "nasa_google_map",
        'icon' => 'icon-wpb-nasatheme',
        'description' => esc_html__("Display Google map address", 'nasa-core'),
        "content_element" => true,
        "category" => 'Nasa Core',
        "params" => array(
            array(
                "type" => "textfield",
                "heading" => esc_html__("Zoom", 'nasa-core'),
                "param_name" => "zoom",
                "value" => '17'
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("API Key", 'nasa-core'),
                "param_name" => "api_key",
                "value" => ''
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Lat", 'nasa-core'),
                "param_name" => "lat",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Long", 'nasa-core'),
                "param_name" => "long",
                "admin_label" => true
            ),
            array(
                "type" => "textfield",
                "heading" => esc_html__("Height", 'nasa-core'),
                "param_name" => "height",
                "value" => '400px'
            ),
            array(
                "type" => "colorpicker",
                "heading" => esc_html__("Color", 'nasa-core'),
                "param_name" => "color"
            ),
            
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Zoom control", 'nasa-core'),
                "param_name" => "zoom_control",
                "value" => array(
                    esc_html__('No', 'nasa-core') => '0',
                    esc_html__('Yes', 'nasa-core') => '1'
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Pan control", 'nasa-core'),
                "param_name" => "pan_control",
                "value" => array(
                    esc_html__('No', 'nasa-core') => '0',
                    esc_html__('Yes', 'nasa-core') => '1'
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Swith map type", 'nasa-core'),
                "param_name" => "mapType",
                "value" => array(
                    esc_html__('No', 'nasa-core') => '0',
                    esc_html__('Yes', 'nasa-core') => '1'
                )
            ),
            array(
                "type" => "dropdown",
                "heading" => esc_html__("Map type", 'nasa-core'),
                "param_name" => "type",
                "value" => array(
                    esc_html__('ROADMAP', 'nasa-core') => 'ROADMAP',
                    esc_html__('SATELLITE', 'nasa-core') => 'SATELLITE',
                    esc_html__('TERRAIN', 'nasa-core') => 'TERRAIN'
                )
            )
        )
    );
    vc_map($map_params);
}
