<?php
/**
 * GeoBuddy Custom Fields for GeoDirectory
 *
 * @link       https://buddydevelopers.com
 * @since      1.0.0
 *
 * @package    Geobuddy
 * @subpackage Geobuddy/admin
 */

class Geobuddy_Custom_Fields {

    /**
     * Initialize the class and set its properties.
     *
     * @since    1.0.0
     */
    public function __construct() {
        // Add hook for GeoDirectory predefined custom fields
        add_filter('geodir_custom_fields_predefined', array($this, 'add_custom_field_types'), 10, 1);
        // add_filter('geodir_custom_field_output_text_key_bd_virtual_tour', array($this, 'custom_output_virtual_tour'), 10, 3);
    }

    /**
     * Add predefined custom fields to GeoDirectory
     */
    public function add_custom_field_types($fields) {
        // LinkedIn Profile Field
        $fields['linkedin'] = array(
            'field_type'  => 'url',
            'class'       => 'gd-url',
            'icon'        => 'fab fa-linkedin',
            'name'        => __('BD-LinkedIn Profile', 'geobuddy'),
            'description' => __('Adds a LinkedIn profile URL field', 'geobuddy'),
            'defaults'    => array(
                'data_type'      => 'TEXT',
                'title'          => __('BD-LinkedIn Profile', 'geobuddy'),
                'admin_title'    => __('BD-LinkedIn Profile', 'geobuddy'),
                'frontend_title' => __('LinkedIn', 'geobuddy'),
                'frontend_desc'  => __('Enter your LinkedIn profile URL', 'geobuddy'),
                'desc'           => __('Enter your LinkedIn profile URL', 'geobuddy'),
                'htmlvar_name'   => 'bd_linkedin',
                'placeholder'    => 'https://www.linkedin.com/in/username',
                'is_required'    => false,
                'is_active'      => true,
                'validation_pattern' => '^https:\/\/[a-z]{2,3}\.linkedin\.com\/.*$',
                'validation_msg' => __('Please enter a valid LinkedIn profile URL', 'geobuddy'),
                'default_value'  => '',
                'show_in' =>  '[detail],[mapbubble]',
                'field_icon'     => 'fab fa-linkedin',
            )
        );

        // YouTube Channel Field
        $fields['youtube'] = array(
            'field_type'  => 'url',
            'class'       => 'gd-url',
            'icon'        => 'fab fa-youtube',
            'name'        => __('BD-YouTube Channel', 'geobuddy'),
            'description' => __('Adds a YouTube channel URL field', 'geobuddy'),
            'defaults'    => array(
                'data_type'      => 'TEXT',
                'title'          => __('BD-YouTube Channel', 'geobuddy'),
                'admin_title'    => __('BD-YouTube Channel', 'geobuddy'),
                'frontend_title' => __('YouTube', 'geobuddy'),
                'frontend_desc'  => __('Enter your YouTube channel URL', 'geobuddy'),
                'desc'           => __('Enter your YouTube channel URL', 'geobuddy'),
                'htmlvar_name'   => 'bd_youtube',
                'placeholder'    => 'https://www.youtube.com/@channelname',
                'is_required'    => false,
                'is_active'      => true,
                'validation_pattern' => '^https:\/\/(www\.)?(youtube\.com\/(@)?|youtu\.be\/)([a-zA-Z0-9\-_]+)',
                'validation_msg' => __('Please enter a valid YouTube channel URL', 'geobuddy'),
                'default_value'  => '',
                'show_in' =>  '[detail],[mapbubble]',
                'field_icon'     => 'fab fa-youtube',
            )
        );

        // TikTok Profile Field
        $fields['tiktok'] = array(
            'field_type'  => 'url',
            'class'       => 'gd-url',
            'icon'        => 'fab fa-tiktok',
            'name'        => __('BD-TikTok Profile', 'geobuddy'),
            'description' => __('Adds a TikTok profile URL field', 'geobuddy'),
            'defaults'    => array(
                'data_type'      => 'TEXT',
                'title'          => __('BD-TikTok Profile', 'geobuddy'),
                'admin_title'    => __('BD-TikTok Profile', 'geobuddy'),
                'frontend_title' => __('TikTok', 'geobuddy'),
                'frontend_desc'  => __('Enter your TikTok profile URL', 'geobuddy'),
                'desc'           => __('Enter your TikTok profile URL', 'geobuddy'),
                'htmlvar_name'   => 'bd_tiktok',
                'placeholder'    => 'https://www.tiktok.com/@username',
                'is_required'    => false,
                'is_active'      => true,
                'validation_pattern' => '^https:\/\/(www\.)?tiktok\.com\/@[a-zA-Z0-9._-]+',
                'validation_msg' => __('Please enter a valid TikTok profile URL', 'geobuddy'),
                'default_value'  => '',
                'show_in' =>  '[detail],[mapbubble]',
                'field_icon'     => 'fab fa-tiktok',
            )
        );

        // 360° Virtual Tour Field
        $fields['virtual_tour'] = array(
            'field_type'  => 'url',
            'class'       => 'gd-url',
            'icon'        => 'fas fa-vr-cardboard',
            'name'        => __('BD-360° Virtual Tour URL', 'geobuddy'),
            'description' => __('Adds a link to a virtual tour of the business or property', 'geobuddy'),
            'defaults'    => array(
                'data_type'      => 'TEXT',
                'title'          => __('BD-360° Virtual Tour URL', 'geobuddy'),
                'admin_title'    => __('BD-360° Virtual Tour URL', 'geobuddy'),
                'frontend_title' => __('360° Virtual Tour', 'geobuddy'),
                'frontend_desc'  => __('Enter the URL for your 360° virtual tour', 'geobuddy'),
                'desc'           => __('Enter the URL for your 360° virtual tour (Matterport, Google Virtual Tour, etc.)', 'geobuddy'),
                'htmlvar_name'   => 'bd_virtual_tour',
                'placeholder'    => 'https://my.matterport.com/show/?m=example',
                'is_required'    => false,
                'is_active'      => true,
                'validation_pattern' => '^https:\/\/.*$',
                'validation_msg' => __('Please enter a valid HTTPS URL for your virtual tour', 'geobuddy'),
                'default_value'  => '',
                'show_in' =>  '',
                'field_icon'     => 'fas fa-vr-cardboard',
            )
        );

        return $fields;
    }
    
    /**
     * Custom output for Virtual Tour field
     */
    public function custom_output_virtual_tour($html, $location, $cf) {
        $value = esc_url(trim($html));
        if (!empty($value)) {
            $field_icon = !empty($cf['field_icon']) ? $cf['field_icon'] : 'fas fa-vr-cardboard';
            $output = '<div class="geodir_post_meta gd-virtual-tour clear">';
            $output .= '<span class="geodir_post_meta_icon"><i class="' . esc_attr($field_icon) . '" aria-hidden="true"></i></span>';
            $output .= '<span class="geodir_post_meta_title">' . esc_html($cf['frontend_title']) . ': </span>';
            $output .= '<span class="geodir_post_meta_content"><a href="' . $value . '" target="_blank" rel="nofollow noopener">' . __('View Virtual Tour', 'geobuddy') . '</a></span>';
            $output .= '</div>';
            return $output;
        }
        return '';
    }
} 