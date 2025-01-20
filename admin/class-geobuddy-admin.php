<?php
/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://https://buddydevelopers.com
 * @since      1.0.0
 *
 * @package    Geobuddy
 * @subpackage Geobuddy/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Geobuddy
 * @subpackage Geobuddy/admin
 * @author     BuddyDevelopers <contact@buddydevelopers.com>
 */
class Geobuddy_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string $plugin_name       The name of this plugin.
	 * @param      string $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version     = $version;

		// Add hook for admin menu.
		add_action( 'admin_menu', array( $this, 'add_plugin_admin_menu' ) );
		add_action( 'admin_init', array( $this, 'register_settings' ) );
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Geobuddy_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Geobuddy_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/geobuddy-admin.css', array(), $this->version, 'all' );
	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Geobuddy_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Geobuddy_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/geobuddy-admin.js', array( 'jquery' ), $this->version, false );
	}

	/**
	 * Add options page to the admin menu
	 *
	 * @since    1.0.0
	 */
	public function add_plugin_admin_menu() {
		// Add main menu item.
		add_menu_page(
			__( 'GeoBuddy Settings', 'geobuddy' ), // Page title.
			__( 'GeoBuddy', 'geobuddy' ),         // Menu title.
			'manage_options',                    // Capability required.
			'geobuddy',                         // Menu slug.
			array( $this, 'display_plugin_admin_page' ), // Callback function.
			'dashicons-admin-site',             // Icon.
			25                                  // Position in menu.
		);

		// Add only one submenu item that matches the parent.
		add_submenu_page(
			'geobuddy',                         // Parent slug.
			__( 'Settings', 'geobuddy' ),         // Page title.
			__( 'Settings', 'geobuddy' ),         // Menu title.
			'manage_options',                    // Capability required.
			'geobuddy',                         // Menu slug (same as parent).
			array( $this, 'display_plugin_admin_page' ) // Callback function.
		);
	}

	/**
	 * Render the admin page with settings sections
	 *
	 * @since    1.0.0
	 */
	public function display_plugin_admin_page() {
		include_once 'partials/geobuddy-admin-display.php';
	}

	/**
	 * Register settings
	 */
	public function register_settings() {

		// Register a setting group.
		register_setting(
			'geobuddy_options',
			'geobuddy_custom_fields',
			array( 'sanitize_callback' => array( $this, 'sanitize_custom_fields' ) )
		);

		// Add settings section.
		add_settings_section(
			'geobuddy_custom_fields_section',
			__( 'Custom Fields Settings', 'geobuddy' ),
			array( $this, 'custom_fields_section_callback' ),
			'geobuddy'
		);

		// Add settings fields.
		$custom_fields = array(
			'linkedin'     => __( 'LinkedIn Profile', 'geobuddy' ),
			'whatsapp'     => __( 'WhatsApp', 'geobuddy' ),
			'tiktok'       => __( 'TikTok Profile', 'geobuddy' ),
			'youtube'      => __( 'YouTube Channel', 'geobuddy' ),
			'skype'        => __( 'Skype', 'geobuddy' ),
			'virtual_tour' => __( '360° Virtual Tour URL', 'geobuddy' ),
		);

		foreach ( $custom_fields as $field_id => $field_label ) {
			add_settings_field(
				'geobuddy_field_' . $field_id,
				$field_label,
				array( $this, 'custom_field_callback' ),
				'geobuddy',
				'geobuddy_custom_fields_section',
				array( 'field_id' => $field_id )
			);
		}


		// Register a single setting for all options.
		register_setting(
			'geobuddy_options',
			'bd_stepwise_settings',
			array(
				'sanitize_callback' => array( $this, 'sanitize_stepwise_settings' ),
			)
		);

		// Register a Stepwise form setting group.
		register_setting(
			'geobuddy_options',
			'bd_stepwise_style',
			array( 'sanitize_callback' => array( $this, 'sanitize_geobuddy_stepwise_form' ) )
		);

		// Add settings section.
		add_settings_section(
			'geobuddy_stepwise_form_fields_section',
			__( 'Geodirectory Stepwise Forms Setting', 'geobuddy' ),
			array( $this, 'stepwise_form_fields_section_callback' ),
			'geobuddy_stepwise_form'
		);

		add_settings_field(
			'geobuddy_field_',
			'Form Style',
			array( $this, 'geobuddy_stepwise_form_fields_callback' ),
			'geobuddy_stepwise_form',
			'geobuddy_stepwise_form_fields_section',
			array( 'field_id' => 'bd_stepwise_slide_style' )
		);

		$gd_color_array = array( 'active', 'completed' );

		foreach ( $gd_color_array as $gd_color ) {
			// Define an array of color settings.
			$gd_color_array = array(
				'active'    => __( 'Active Step Color', 'geobuddy' ),
				'completed' => __( 'Completed Step Color', 'geobuddy' ),
			);

			foreach ( $gd_color_array as $key => $label ) {
				// Register each color setting.
				register_setting(
					'geobuddy_options',
					"bd_{$key}_step_color",
					array(
						'sanitize_callback' => 'sanitize_hex_color',
					)
				);

				// Add a settings field for each color.
				add_settings_field(
					"geobuddy_field_{$key}_step_color",
					$label,
					array( $this, 'geobuddy_stepwise_form_color_fields_callback' ),
					'geobuddy_stepwise_form',
					'geobuddy_stepwise_form_fields_section',
					array(
						'field_id'  => "bd_{$key}_step_color",
						'label_for' => "bd-gsf-{$key}-steps-color",
					)
				);
			}
		}

		if ( geobuddy_check_gd_announcement_bar_exists() ) {
			// Register a Stepwise form setting group.
			register_setting(
				'geobuddy_options',
				'message_announcement_setting_text',
				array( 'sanitize_callback' => array( $this, 'sanitize_announcement_bar' ) )
			);

			// Add settings section.
			add_settings_section(
				'geobuddy_announcement_bar_fields_section',
				__( 'Announcement Settings', 'geobuddy' ),
				array( $this, 'announcement_bar_fields_section_callback' ),
				'message_announcement_setting_text'
			);

			add_settings_field(
				'geobuddy_field_',
				'Announcement Text',
				array( $this, 'geobuddy_announcement_bar_fields_callback' ),
				'message_announcement_setting_text',
				'geobuddy_announcement_bar_fields_section',
				array( 'field_id' => 'geobuddy_announcement_bar' )
			);
		}
	}

	/**
	 * Sanitize stepwise settings.
	 *
	 * @param array $input The unsanitized input.
	 * @return string The sanitized JSON string.
	 */
	public function sanitize_stepwise_settings( $input ) {
		// Fetch individual settings for colors.
		$bd_stepwise_style    = get_option( 'bd_stepwise_style', 'stepwise' ); // Default color.
		$active_step_color    = get_option( 'bd_active_step_color', '#ff9800' ); // Default color.
		$completed_step_color = get_option( 'bd_completed_step_color', '#07b51b' ); // Default color.
		$default_settings     = array(
			'design'               => $bd_stepwise_style,
			'active_step_color'    => $active_step_color,
			'completed_step_color' => $completed_step_color,
		);

		// Merge defaults with incoming settings.
		$sanitized_settings = wp_parse_args( $input, $default_settings );

		// Validate hex colors.
		$sanitized_settings['active_step_color']    = sanitize_hex_color( $sanitized_settings['active_step_color'] );
		$sanitized_settings['completed_step_color'] = sanitize_hex_color( $sanitized_settings['completed_step_color'] );

		// Return as a JSON-encoded string.
		return wp_json_encode( $sanitized_settings );
	}

	/**
	 * Section callback
	 */
	public function custom_fields_section_callback() {
		echo '<p>' . esc_html__( 'Enable or disable custom fields for your GeoDirectory listings.', 'geobuddy' ) . '</p>';
	}

	/**
	 * Section callback
	 */
	public function stepwise_form_fields_section_callback() {
		echo '<p>' . esc_html__( 'Geodirectory Stepwise Forms Fields', 'geobuddy' ) . '</p>';
	}

	/**
	 * Section callback
	 */
	public function announcement_bar_fields_section_callback() {
		echo '<p>' . esc_html__( 'Enter the announcement message you want to display.', 'geobuddy' ) . '</p>';
	}

	/**
	 *  Field callback.
	 *
	 * @param  Array $args Arguments.
	 */
	public function custom_field_callback( $args ) {
		$options  = get_option( 'geobuddy_custom_fields', array() );
		$field_id = $args['field_id'];
		$checked  = isset( $options[ $field_id ] ) ? $options[ $field_id ] : 1; // Default to enabled.
		?>
		<label>
			<input type="checkbox" 
					name="geobuddy_custom_fields[<?php echo esc_attr( $field_id ); ?>]" 
					value="1" 
					<?php checked( 1, $checked ); ?>>
			<?php esc_html_e( 'Enable this field', 'geobuddy' ); ?>
		</label>
		<?php
	}

	/**
	 * Field callback.
	 */
	public function geobuddy_stepwise_form_fields_callback() {

		?>
		<select name="bd_stepwise_style" class="custom-select form-select mw-100" id="bd_stepwise_slide_style">
			<?php
				// Default options for the dropdown.
				$default_options = array(
					'stepwise' => __( 'Stepwise', 'geobuddy' ),
				);

				// Apply a filter to allow other plugins to modify/add options.
				$dropdown_options = apply_filters( 'geobuddy_stepwise_style_options', $default_options );

				// Current selected option.
				$current_option = get_option( 'bd_stepwise_style', 'stepwise' );

				// Generate the dropdown options.
				foreach ( $dropdown_options as $value => $label ) {
					$selected = selected( $current_option, $value, false );
					echo '<option value="' . esc_attr( $value ) . '" ' . esc_attr( $selected ) . '>' . esc_html( $label ) . '</option>';
				}
				?>
		</select>
		<?php
	}


	/**
	 * Field callback.
	 */
	public function geobuddy_announcement_bar_fields_callback() {
		$get_text = get_option( 'message_announcement_setting_text', 'announcement message' );
		?>
		<input type="text" name="message_announcement_setting_text" value="<?php echo esc_attr( $get_text ); ?>">
		<?php
	}

	/**
	 * Callback function to render color input fields.
	 *
	 * @param array $args Arguments passed to the callback.
	 */
	public function geobuddy_stepwise_form_color_fields_callback( $args ) {
		$field_id = $args['field_id'];
		// Use a ternary operator to determine the default color.
		$default_color = ( 'bd_active_step_color' === $field_id ) ? '#ff9800' :
			( 'bd_completed_step_color' === $field_id ? '#07b51b' : '#000000' );
		$value         = get_option( $field_id, $default_color ); // Default to white color.
		?>
	<input
		type="color"
		name="<?php echo esc_attr( $field_id ); ?>"
		id="<?php echo esc_attr( $args['label_for'] ); ?>"
		value="<?php echo esc_attr( $value ); ?>"
	>
		<?php
	}

	/**
	 * Sanitize custom fields
	 *
	 * @param  Array $input Input.
	 */
	public function sanitize_custom_fields( $input ) {
		$new_input     = array();
		$custom_fields = array( 'linkedin', 'whatsapp', 'tiktok', 'youtube', 'skype', 'virtual_tour' );

		foreach ( $custom_fields as $field ) {
			$new_input[ $field ] = isset( $input[ $field ] ) ? 1 : 0;
		}

		return $new_input;
	}

	/**
	 * Sanitize the bd_stepwise_style field.
	 *
	 * @param  array $input The input data from the form.
	 * @return string Sanitized value.
	 */
	public function sanitize_geobuddy_stepwise_form( $input ) {
		// Ensure the input is sanitized.
		$sanitized_input = sanitize_text_field( $input );

		return $sanitized_input;
	}

	/**
	 * Sanitize the announcement bar input.
	 *
	 * @param array $input Input data.
	 *
	 * @return array Sanitized data.
	 */
	public function sanitize_announcement_bar( $input ) {

		echo '<pre>';
		print_r( $input );
		echo '</pre>';
		$sanitized = sanitize_text_field( $input );

		return $sanitized;
	}

	/**
	 * Updates the 'bd_stepwise_settings' option with the value of 'bd_stepwise_style'.
	 *
	 * Ensures the 'design' key in 'bd_stepwise_settings' reflects the value of 'bd_stepwise_style'.
	 *
	 * @return void
	 */
	public function gb_stepwise_form_style_setting_updation() {
		// Get the current value of the 'bd_stepwise_style' option.
		$bd_stepwise_style = get_option( 'bd_stepwise_style' );

		// Get the current value of the 'bd_stepwise_settings' option or initialize it as an array.
		$bd_stepwise_settings = get_option( 'bd_stepwise_settings', [] );

		// Ensure 'bd_stepwise_settings' is an array to avoid issues.
		if ( ! is_array( $bd_stepwise_settings ) ) {
			$bd_stepwise_settings = [];
		}

		// Update the 'design' key in 'bd_stepwise_settings' with the value of 'bd_stepwise_style'.
		$bd_stepwise_settings['design'] = $bd_stepwise_style;

		// Save the updated 'bd_stepwise_settings' option back to the database.
		update_option( 'bd_stepwise_settings', $bd_stepwise_settings );
	}

	/**
	 * Updates the 'bd_stepwise_settings' option with the value of 'bd_active_step_color'.
	 *
	 * Ensures the 'design' key in 'bd_stepwise_settings' reflects the value of 'bd_active_step_color'.
	 *
	 * @return void
	 */
	public function gb_stepwise_form_active_step_color_setting_updation() {
		// Get the current value of the 'bd_active_step_color' option.
		$bd_active_step_color = get_option( 'bd_active_step_color' );

		// Get the current value of the 'bd_stepwise_settings' option or initialize it as an array.
		$bd_stepwise_settings = get_option( 'bd_stepwise_settings', [] );

		// Ensure 'bd_stepwise_settings' is an array to avoid issues.
		if ( ! is_array( $bd_stepwise_settings ) ) {
			$bd_stepwise_settings = [];
		}

		// Update the 'active_step_color' key in 'bd_stepwise_settings' with the value of 'bd_active_step_color'.
		$bd_stepwise_settings['active_step_color'] = $bd_active_step_color;

		// Save the updated 'bd_stepwise_settings' option back to the database.
		update_option( 'bd_stepwise_settings', $bd_stepwise_settings );
	}

	/**
	 * Updates the 'bd_stepwise_settings' option with the value of 'bd_completed_step_color'.
	 *
	 * Ensures the 'design' key in 'bd_stepwise_settings' reflects the value of 'bd_completed_step_color'.
	 *
	 * @return void
	 */
	public function gb_stepwise_form_completed_step_color_setting_updation() {
		// Get the current value of the 'bd_completed_step_color' option.
		$bd_completed_step_color = get_option( 'bd_completed_step_color' );

		// Get the current value of the 'bd_stepwise_settings' option or initialize it as an array.
		$bd_stepwise_settings = get_option( 'bd_stepwise_settings', [] );

		// Ensure 'bd_stepwise_settings' is an array to avoid issues.
		if ( ! is_array( $bd_stepwise_settings ) ) {
			$bd_stepwise_settings = [];
		}

		// Update the 'completed_step_color' key in 'bd_stepwise_settings' with the value of 'bd_completed_step_color'.
		$bd_stepwise_settings['completed_step_color'] = $bd_completed_step_color;

		// Save the updated 'bd_stepwise_settings' option back to the database.
		update_option( 'bd_stepwise_settings', $bd_stepwise_settings );
	}

}
