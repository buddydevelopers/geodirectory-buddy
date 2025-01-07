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
		// Add hook for GeoDirectory predefined custom fields.
		add_filter( 'geodir_custom_fields_predefined', array( $this, 'add_custom_field_types' ), 10, 1 );
		// add_filter('geodir_custom_field_output_text_key_bd_virtual_tour', array($this, 'custom_output_virtual_tour'), 10, 3);
		add_filter( 'geodir_custom_field_output_phone_key_whatsapp', array( $this, 'custom_output_whatsapp' ), 10, 4 );
		add_filter( 'geodir_custom_field_output_text_key_skype', array( $this, 'custom_output_skype' ), 10, 4 );
	}

	/**
	 * Add predefined custom fields to GeoDirectory.
	 *
	 * @param  Array $fields Fields.
	 */
	public function add_custom_field_types( $fields ) {
		$options = get_option( 'geobuddy_custom_fields', array() );

		// Only add fields that are enabled.
		if ( empty( $options['linkedin'] ) && isset( $fields['linkedin'] ) ) {
			unset( $fields['linkedin'] );
		}
		if ( empty( $options['whatsapp'] ) && isset( $fields['whatsapp'] ) ) {
			unset( $fields['whatsapp'] );
		}
		if ( empty( $options['tiktok'] ) && isset( $fields['tiktok'] ) ) {
			unset( $fields['tiktok'] );
		}
		if ( empty( $options['youtube'] ) && isset( $fields['youtube'] ) ) {
			unset( $fields['youtube'] );
		}
		if ( empty( $options['skype'] ) && isset( $fields['skype'] ) ) {
			unset( $fields['skype'] );
		}
		if ( empty( $options['virtual_tour'] ) && isset( $fields['virtual_tour'] ) ) {
			unset( $fields['virtual_tour'] );
		}

		// LinkedIn Profile Field.
		$fields['linkedin'] = array(
			'field_type'  => 'url',
			'class'       => 'gd-url',
			'icon'        => 'fab fa-linkedin',
			'name'        => __( 'BD-LinkedIn Profile', 'geobuddy' ),
			'description' => __( 'Adds a LinkedIn profile URL field', 'geobuddy' ),
			'defaults'    => array(
				'data_type'          => 'TEXT',
				'title'              => __( 'BD-LinkedIn Profile', 'geobuddy' ),
				'admin_title'        => __( 'BD-LinkedIn Profile', 'geobuddy' ),
				'frontend_title'     => __( 'LinkedIn', 'geobuddy' ),
				'frontend_desc'      => __( 'Enter your LinkedIn profile URL', 'geobuddy' ),
				'desc'               => __( 'Enter your LinkedIn profile URL', 'geobuddy' ),
				'htmlvar_name'       => 'bd_linkedin',
				'placeholder'        => 'https://www.linkedin.com/in/username',
				'is_required'        => false,
				'is_active'          => true,
				'validation_pattern' => '^https:\/\/[a-z]{2,3}\.linkedin\.com\/.*$',
				'validation_msg'     => __( 'Please enter a valid LinkedIn profile URL', 'geobuddy' ),
				'default_value'      => '',
				'show_in'            => '[detail],[mapbubble]',
				'field_icon'         => 'fab fa-linkedin',
			),
		);

		// YouTube Channel Field.
		$fields['youtube'] = array(
			'field_type'  => 'url',
			'class'       => 'gd-url',
			'icon'        => 'fab fa-youtube',
			'name'        => __( 'BD-YouTube Channel', 'geobuddy' ),
			'description' => __( 'Adds a YouTube channel URL field', 'geobuddy' ),
			'defaults'    => array(
				'data_type'          => 'TEXT',
				'title'              => __( 'BD-YouTube Channel', 'geobuddy' ),
				'admin_title'        => __( 'BD-YouTube Channel', 'geobuddy' ),
				'frontend_title'     => __( 'YouTube', 'geobuddy' ),
				'frontend_desc'      => __( 'Enter your YouTube channel URL', 'geobuddy' ),
				'desc'               => __( 'Enter your YouTube channel URL', 'geobuddy' ),
				'htmlvar_name'       => 'bd_youtube',
				'placeholder'        => 'https://www.youtube.com/@channelname',
				'is_required'        => false,
				'is_active'          => true,
				'validation_pattern' => '^https:\/\/(www\.)?(youtube\.com\/(@)?|youtu\.be\/)([a-zA-Z0-9\-_]+)',
				'validation_msg'     => __( 'Please enter a valid YouTube channel URL', 'geobuddy' ),
				'default_value'      => '',
				'show_in'            => '[detail],[mapbubble]',
				'field_icon'         => 'fab fa-youtube',
			),
		);

		// TikTok Profile Field.
		$fields['tiktok'] = array(
			'field_type'  => 'url',
			'class'       => 'gd-url',
			'icon'        => 'fab fa-tiktok',
			'name'        => __( 'BD-TikTok Profile', 'geobuddy' ),
			'description' => __( 'Adds a TikTok profile URL field', 'geobuddy' ),
			'defaults'    => array(
				'data_type'          => 'TEXT',
				'title'              => __( 'BD-TikTok Profile', 'geobuddy' ),
				'admin_title'        => __( 'BD-TikTok Profile', 'geobuddy' ),
				'frontend_title'     => __( 'TikTok', 'geobuddy' ),
				'frontend_desc'      => __( 'Enter your TikTok profile URL', 'geobuddy' ),
				'desc'               => __( 'Enter your TikTok profile URL', 'geobuddy' ),
				'htmlvar_name'       => 'bd_tiktok',
				'placeholder'        => 'https://www.tiktok.com/@username',
				'is_required'        => false,
				'is_active'          => true,
				'validation_pattern' => '^https:\/\/(www\.)?tiktok\.com\/@[a-zA-Z0-9._-]+',
				'validation_msg'     => __( 'Please enter a valid TikTok profile URL', 'geobuddy' ),
				'default_value'      => '',
				'show_in'            => '[detail],[mapbubble]',
				'field_icon'         => 'fab fa-tiktok',
			),
		);
		// Whatsapp Number Field.
		$fields['whatsapp'] = array(
			'field_type'  => 'phone',
			'class'       => 'gd-phone',
			'icon'        => 'fab fa-whatsapp',
			'name'        => __( 'Whatsapp', 'geobuddy' ),
			'description' => __( 'Adds a Whatsapp number field', 'geobuddy' ),
			'defaults'    => array(
				'data_type'          => 'TEXT',
				'title'              => __( 'BD-Whatsapp', 'geobuddy' ),
				'admin_title'        => __( 'BD-Whatsapp', 'geobuddy' ),
				'frontend_title'     => __( 'Whatsapp', 'geobuddy' ),
				'frontend_desc'      => __( 'Enter your Whatsapp', 'geobuddy' ),
				'desc'               => __( 'Enter your Whatsapp', 'geobuddy' ),
				'htmlvar_name'       => 'bd_Whatsapp',
				'placeholder'        => '+918097876910',
				'is_required'        => false,
				'is_active'          => true,
				'validation_pattern' => '\+\d{3}[ ]?(\d+(-| )?)+',
				'validation_msg'     => __( 'Please enter a valid Whatsapp number', 'geobuddy' ),
				'default_value'      => '',
				'show_in'            => '[detail],[mapbubble]',
				'field_icon'         => 'fab fa-whatsapp',
			),
		);
		// Skype Field.
		$fields['skype'] = array(
			'field_type'  => 'text',
			'class'       => 'gd-text',
			'icon'        => 'fab fa-skype',
			'name'        => __( 'Skype', 'geobuddy' ),
			'description' => __( 'Adds a Skype number field', 'geobuddy' ),
			'defaults'    => array(
				'data_type'          => 'TEXT',
				'title'              => __( 'BD-Skype', 'geobuddy' ),
				'admin_title'        => __( 'BD-Skype', 'geobuddy' ),
				'frontend_title'     => __( 'Skype', 'geobuddy' ),
				'frontend_desc'      => __( 'Enter your Skype', 'geobuddy' ),
				'desc'               => __( 'Enter your Skype', 'geobuddy' ),
				'htmlvar_name'       => 'bd_skype',
				'placeholder'        => 'naveen.giri6',
				'is_required'        => false,
				'is_active'          => true,
				'validation_pattern' => '',
				'validation_msg'     => __( 'Please enter a valid Skype ID', 'geobuddy' ),
				'default_value'      => '',
				'show_in'            => '[detail],[mapbubble]',
				'field_icon'         => 'fab fa-skype',
			),
		);
		// 360° Virtual Tour Field.
		$fields['virtual_tour'] = array(
			'field_type'  => 'url',
			'class'       => 'gd-url',
			'icon'        => 'fas fa-vr-cardboard',
			'name'        => __( 'BD-360° Virtual Tour URL', 'geobuddy' ),
			'description' => __( 'Adds a link to a virtual tour of the business or property', 'geobuddy' ),
			'defaults'    => array(
				'data_type'          => 'TEXT',
				'title'              => __( 'BD-360° Virtual Tour URL', 'geobuddy' ),
				'admin_title'        => __( 'BD-360° Virtual Tour URL', 'geobuddy' ),
				'frontend_title'     => __( '360° Virtual Tour', 'geobuddy' ),
				'frontend_desc'      => __( 'Enter the URL for your 360° virtual tour', 'geobuddy' ),
				'desc'               => __( 'Enter the URL for your 360° virtual tour (Matterport, Google Virtual Tour, etc.)', 'geobuddy' ),
				'htmlvar_name'       => 'bd_virtual_tour',
				'placeholder'        => 'https://my.matterport.com/show/?m=example',
				'is_required'        => false,
				'is_active'          => true,
				'validation_pattern' => '^https:\/\/.*$',
				'validation_msg'     => __( 'Please enter a valid HTTPS URL for your virtual tour', 'geobuddy' ),
				'default_value'      => '',
				'show_in'            => '',
				'field_icon'         => 'fas fa-vr-cardboard',
			),
		);

		return $fields;
	}

	/**
	 *  Custom output for Virtual Tour field.
	 *
	 * @param  mixed $html HTML.
	 * @param  mixed $location  Location.
	 * @param  Array $cf Custom Fields.
	 */
	public function custom_output_virtual_tour( $html, $location, $cf ) {
		$value = esc_url( trim( $html ) );
		if ( ! empty( $value ) ) {
			$field_icon = ! empty( $cf['field_icon'] ) ? $cf['field_icon'] : 'fas fa-vr-cardboard';
			$output     = '<div class="geodir_post_meta gd-virtual-tour clear">';
			$output    .= '<span class="geodir_post_meta_icon"><i class="' . esc_attr( $field_icon ) . '" aria-hidden="true"></i></span>';
			$output    .= '<span class="geodir_post_meta_title">' . esc_html( $cf['frontend_title'] ) . ': </span>';
			$output    .= '<span class="geodir_post_meta_content"><a href="' . $value . '" target="_blank" rel="nofollow noopener">' . __( 'View Virtual Tour', 'geobuddy' ) . '</a></span>';
			$output    .= '</div>';
			return $output;
		}
		return '';
	}

	/**
	 * Custom output for WhatsApp Field.
	 *
	 * @param  mixed $html HTML.
	 * @param  mixed $location Location.
	 * @param  mixed $cf Custom Field.
	 * @param  mixed $output Field Output.
	 */
	public function custom_output_whatsapp( $html, $location, $cf, $output ) {
		global $gd_post;
		if ( $gd_post->{$cf['htmlvar_name']} ) :
			$design_style = geodir_design_style();
			$field_icon   = geodir_field_icon_proccess( $cf );
			$output       = geodir_field_output_process( $output );
			if ( strpos( $field_icon, 'http' ) !== false ) {
				$field_icon_af = '';
			} elseif ( $field_icon == '' ) {
				$field_icon_af = $design_style ? '<i class="fab fa-whatsapp fa-fw" aria-hidden="true"></i> ' : '<i class="fab fa-whatsapp" aria-hidden="true"></i>';
			} else {
				$field_icon_af = $field_icon;
				$field_icon    = '';
			}

			$raw_value = stripslashes( $gd_post->{$cf['htmlvar_name']} );
			$value     = '<a href="https://api.whatsapp.com/send?phone=' . preg_replace( '/[^0-9+]/', '', $gd_post->{$cf['htmlvar_name']} ) . '&text=Hey%2C%20How%20you%20doing%3F">' . $cf['frontend_title'] . '</a>';

			if ( ! empty( $output ) && isset( $output['raw'] ) ) {
				// Database value.
				return $raw_value;
			} elseif ( ! empty( $output ) && isset( $output['strip'] ) ) {
				// Stripped value.
				return $value;
			}

			$html = '<div class="geodir_post_meta ' . $cf['css_class'] . ' geodir-field-' . $cf['htmlvar_name'] . '">';

			$maybe_secondary_class = isset( $output['icon'] ) ? 'gv-secondary' : '';

			if ( $output == '' || isset( $output['icon'] ) ) {
				$html .= '<span class="geodir_post_meta_icon geodir-i-phone" style="' . $field_icon . '">' . $field_icon_af;
			}
			if ( $output == '' || isset( $output['value'] ) ) {
				$html .= $value;
			}
			if ( $output == '' || isset( $output['icon'] ) ) {
				$html .= '</span>';
			}

			$html .= '</div>';

		endif;

		return $html;
	}

	/**
	 * Custom output for Skype Field.
	 *
	 * @param  mixed $html HTML.
	 * @param  mixed $location Location.
	 * @param  mixed $cf Custom Field.
	 * @param  mixed $output Field Output.
	 */
	public function custom_output_skype( $html, $location, $cf, $output ) {
		global $gd_post;

		if ( isset( $gd_post->{$cf['htmlvar_name']} ) && $gd_post->{$cf['htmlvar_name']} != '' ) :

			$class = ( $cf['htmlvar_name'] == 'geodir_timing' ) ? 'geodir-i-time' : 'geodir-i-text';

			$field_icon = geodir_field_icon_proccess( $cf );
			if ( strpos( $field_icon, 'http' ) !== false ) {
				$field_icon_af = '';
			} elseif ( $field_icon == '' ) {
				$field_icon_af = $design_style ? '<i class="fab fa-skype" aria-hidden="true"></i> ' : '<i class="fab fa-skype" aria-hidden="true"></i>';
			} else {
				$field_icon_af = $field_icon;
				$field_icon    = '';
			}

			$raw_value = stripslashes( $gd_post->{$cf['htmlvar_name']} );
			$value     = '<a href="skype:' . $gd_post->{$cf['htmlvar_name']} . '?chat">' . $cf['frontend_title'] . '</a>';

			if ( ! empty( $output ) && isset( $output['raw'] ) ) {
				// Database value.
				return $raw_value;
			} elseif ( ! empty( $output ) && isset( $output['strip'] ) ) {
				// Stripped value.
				return $value;
			}

			$html = '<div class="geodir_post_meta ' . $cf['css_class'] . ' geodir-field-' . $cf['htmlvar_name'] . '">';

			$maybe_secondary_class = isset( $output['icon'] ) ? 'gv-secondary' : '';

			if ( $output == '' || isset( $output['icon'] ) ) {
				$html .= '<span class="geodir_post_meta_icon geodir-i-phone" style="' . $field_icon . '">' . $field_icon_af;
			}
			if ( $output == '' || isset( $output['value'] ) ) {
				$html .= $value;
			}
			if ( $output == '' || isset( $output['icon'] ) ) {
				$html .= '</span>';
			}

			$html .= '</div>';

		endif;

		return $html;
	}
}
