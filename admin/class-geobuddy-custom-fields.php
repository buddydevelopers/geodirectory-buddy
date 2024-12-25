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
    }

    /**
     * Add predefined custom fields to GeoDirectory
     */
    public function add_custom_field_types($fields) {
        // LinkedIn Profile Field
        $fields['linkedin'] = array(
            'field_type'  => 'text',
            'class'       => 'url-field',
            'icon'        => 'fab fa-linkedin',
            'name'        => __('BD-LinkedIn Profile', 'geobuddy'),
            'description' => __('Adds a LinkedIn profile URL field', 'geobuddy'),
            'defaults'    => array(
                'data_type'    => 'VARCHAR',
                'size'         => 100,
                'title'        => __('BD-LinkedIn Profile', 'geobuddy'),
                'desc'         => __('Enter your LinkedIn profile URL', 'geobuddy'),
                'placeholder'  => 'https://www.linkedin.com/in/username',
                'is_required'  => false,
                'is_active'    => true,
                'validation_pattern' => '^https:\/\/[a-z]{2,3}\.linkedin\.com\/.*$',
                'validation_msg' => __('Please enter a valid LinkedIn profile URL', 'geobuddy'),
                'default_value' => '',
                'show_in'      => array('listing', 'detail', 'preview'),
                'field_icon'   => 'fab fa-linkedin',
            )
        );

        // YouTube Channel Field
        $fields['youtube'] = array(
            'field_type'  => 'text',
            'class'       => 'url-field',
            'icon'        => 'fab fa-youtube',
            'name'        => __('BD-YouTube Channel', 'geobuddy'),
            'description' => __('Adds a YouTube channel URL field', 'geobuddy'),
            'defaults'    => array(
                'data_type'    => 'VARCHAR',
                'size'         => 100,
                'title'        => __('BD-YouTube Channel', 'geobuddy'),
                'desc'         => __('Enter your YouTube channel URL', 'geobuddy'),
                'placeholder'  => 'https://www.youtube.com/@channelname',
                'is_required'  => false,
                'is_active'    => true,
                'validation_pattern' => '^https:\/\/(www\.)?(youtube\.com\/(@)?|youtu\.be\/)([a-zA-Z0-9\-_]+)',
                'validation_msg' => __('Please enter a valid YouTube channel URL', 'geobuddy'),
                'default_value' => '',
                'show_in'      => array('listing', 'detail', 'preview'),
                'field_icon'   => 'fab fa-youtube',
            )
        );

        // TikTok Profile Field
        $fields['tiktok'] = array(
            'field_type'  => 'text',
            'class'       => 'url-field',
            'icon'        => 'fab fa-tiktok',
            'name'        => __('BD-TikTok Profile', 'geobuddy'),
            'description' => __('Adds a TikTok profile URL field', 'geobuddy'),
            'defaults'    => array(
                'data_type'    => 'VARCHAR',
                'size'         => 100,
                'title'        => __('BD-TikTok Profile', 'geobuddy'),
                'desc'         => __('Enter your TikTok profile URL', 'geobuddy'),
                'placeholder'  => 'https://www.tiktok.com/@username',
                'is_required'  => false,
                'is_active'    => true,
                'validation_pattern' => '^https:\/\/(www\.)?tiktok\.com\/@[a-zA-Z0-9._-]+',
                'validation_msg' => __('Please enter a valid TikTok profile URL', 'geobuddy'),
                'default_value' => '',
                'show_in'      => array('listing', 'detail', 'preview'),
                'field_icon'   => 'fab fa-tiktok',
            )
        );

        return $fields;
    }
} 