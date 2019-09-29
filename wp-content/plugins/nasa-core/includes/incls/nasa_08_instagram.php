<?php
Class Nasa_Instagram {

    public $_username;
    public $_number;
    public $_size;
    public $_target;
    public $_link;
    protected $outPut = '';

    /**
     * Construction
     * 
     * @param type $instance
     */
    public function __construct($instance = array()) {
        $this->_username = !isset($instance['username']) ? '' : $instance['username'];
        $this->_number = !isset($instance['number']) ? 6 : (int) $instance['number'];
        $this->_size = !isset($instance['size']) ? 'large' : $instance['size'];
        $this->_target = !isset($instance['target']) ? '_blank' : $instance['target'];
        $this->_link = !isset($instance['link']) ? '' : $instance['link'];
    }

    /**
     * Out Put
     * 
     * @return type
     */
    public function outPut() {
        if ('' !== trim($this->_username)) {
            $media_array = $this->scrape_instagram();

            if (is_wp_error($media_array)) {
                $this->outPut .= wp_kses_post($media_array->get_error_message());
            } else {
                // filter for images only?
                if ($images_only = apply_filters('nasa_instagram_images_only', false)) {
                    $media_array = array_filter($media_array, array($this, 'images_only'));
                }
                
                // slice list down to required limit.
                $media_array = array_slice($media_array, 0, $this->_number);

                // filters for custom classes.
                $ulclass = 'instagram-pics instagram-size-' . $this->_size;
                $liclass = 'instagram-li';
                $aclass = 'instagram-a';
                $imgclass = 'instagram-img';
                
                $this->outPut .= '<ul class="' . esc_attr($ulclass) . '">';
                
                foreach ($media_array as $item) {
                    $this->outPut .= 
                        '<li class="' . esc_attr($liclass) . '">' .
                            '<a href="' . esc_url($item['link']) . '" target="' . esc_attr($this->_target) . '"  class="' . esc_attr($aclass) . '">' .
                                '<img src="' . esc_url($item[$this->_size]) . '" alt="' . esc_attr($item['description']) . '" class="' . esc_attr($imgclass) . '" />' .
                            '</a>' .
                        '</li>';
                }
                
                $this->outPut .= '</ul>';
            }
        }

        if ('' !== $this->_link) {
            switch (substr($this->_username, 0, 1)) {
                case '#':
                    $url = '//instagram.com/explore/tags/' . str_replace('#', '', $this->_username);
                    break;

                default:
                    $url = '//instagram.com/' . str_replace('@', '', $this->_username);
                    break;
            }
            
            $this->outPut .= '<p class="clear"><a href="' . trailingslashit(esc_url($url)) . '" rel="me" target="' . esc_attr($this->_target) . '">' . wp_kses_post($this->_link) . '</a></p>';
        }
        
        return $this->outPut;
    }

    // based on https://gist.github.com/cosmocatalano/4544576.
    public function scrape_instagram() {

        $username = trim(strtolower($this->_username));

        switch (substr($username, 0, 1)) {
            case '#':
                $url = 'https://instagram.com/explore/tags/' . str_replace('#', '', $username);
                $transient_prefix = 'h';
                break;

            default:
                $url = 'https://instagram.com/' . str_replace('@', '', $username);
                $transient_prefix = 'u';
                break;
        }

        if (false === ($instagram = get_transient('insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes($username)))) {

            $remote = wp_remote_get($url);

            if (is_wp_error($remote)) {
                return new WP_Error('site_down', esc_html__('Unable to communicate with Instagram.', 'nasa-core'));
            }

            if (200 !== wp_remote_retrieve_response_code($remote)) {
                return new WP_Error('invalid_response', esc_html__('Instagram did not return a 200.', 'nasa-core'));
            }

            $shards = explode('window._sharedData = ', $remote['body']);
            $insta_json = explode(';</script>', $shards[1]);
            $insta_array = json_decode($insta_json[0], true);

            if (!$insta_array) {
                return new WP_Error('bad_json', esc_html__('Instagram has returned invalid data.', 'nasa-core'));
            }

            if (isset($insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'])) {
                $images = $insta_array['entry_data']['ProfilePage'][0]['graphql']['user']['edge_owner_to_timeline_media']['edges'];
            } elseif (isset($insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'])) {
                $images = $insta_array['entry_data']['TagPage'][0]['graphql']['hashtag']['edge_hashtag_to_media']['edges'];
            } else {
                return new WP_Error('bad_json_2', esc_html__('Instagram has returned invalid data.', 'nasa-core'));
            }

            if (!is_array($images)) {
                return new WP_Error('bad_array', esc_html__('Instagram has returned invalid data.', 'nasa-core'));
            }

            $instagram = array();

            foreach ($images as $image) {
                $type = true === $image['node']['is_video'] ? 'video' : 'image';

                $caption = __('Instagram Image', 'nasa-core');
                if (!empty($image['node']['edge_media_to_caption']['edges'][0]['node']['text'])) {
                    $caption = wp_kses($image['node']['edge_media_to_caption']['edges'][0]['node']['text'], array());
                }

                $instagram[] = array(
                    'description' => $caption,
                    'link' => trailingslashit('//instagram.com/p/' . $image['node']['shortcode']),
                    'time' => $image['node']['taken_at_timestamp'],
                    'comments' => $image['node']['edge_media_to_comment']['count'],
                    'likes' => $image['node']['edge_liked_by']['count'],
                    'thumbnail' => preg_replace('/^https?\:/i', '', $image['node']['thumbnail_resources'][0]['src']),
                    'small' => preg_replace('/^https?\:/i', '', $image['node']['thumbnail_resources'][2]['src']),
                    'large' => preg_replace('/^https?\:/i', '', $image['node']['thumbnail_resources'][4]['src']),
                    'original' => preg_replace('/^https?\:/i', '', $image['node']['display_url']),
                    'type' => $type,
                );
            } // End foreach().
            // do not set an empty transient - should help catch private or empty accounts.
            if (!empty($instagram)) {
                $instagram = base64_encode(serialize($instagram));
                set_transient('insta-a10-' . $transient_prefix . '-' . sanitize_title_with_dashes($username), $instagram, apply_filters('null_instagram_cache_time', HOUR_IN_SECONDS * 2));
            }
        }

        return !empty($instagram) ? unserialize(base64_decode($instagram)) : new WP_Error('no_images', esc_html__('Instagram did not return any images.', 'nasa-core'));
    }

    /**
     * Type instagram item
     * 
     * @param type $media_item
     * @return boolean
     */
    public function images_only($media_item) {
        if ('image' === $media_item['type']) {
            return true;
        }

        return false;
    }

}
