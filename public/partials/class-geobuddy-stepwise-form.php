<?php
/**
 * Provide a public-facing of Geodirectory Stepwise form.
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://https://buddydevelopers.com
 * @since      1.0.0
 *
 * @package    Geobuddy/Geodirectory Stepwise form
 * @subpackage Geobuddy/public/partials
 */

/**
 * Provide a public-facing of Geodirectory Stepwise form.
 *
 * This file is used to markup the public-facing aspects of the plugin.
 *
 * @link       https://https://buddydevelopers.com
 * @since      1.0.0
 *
 * @package    Geobuddy/Geodirectory Stepwise form
 * @subpackage Geobuddy/public/partials
 */

if ( ! class_exists( 'GEOBUDDY_STEPWISE_FORM' ) ) {

	/**
	 * The public-facing functionality of the plugin.
	 *
	 * Defines the plugin name, version, and two examples hooks for how to
	 * enqueue the admin-specific stylesheet and JavaScript.
	 *
	 * @package    GEOBUDDY_STEPWISE_FORM
	 * @subpackage GEOBUDDY_STEPWISE_FORM/public
	 * @author     buddydevelopers <buddydevelopers@gmail.com>
	 */
	class GEOBUDDY_STEPWISE_FORM {

		/**
		 * Single ton pattern instance reuse.
		 *
		 * @access  private
		 *
		 * @var object  $_instance class instance.
		 */
		private static $_instance;

		/**
		 * Stepwise form style
		 *
		 * @access public
		 *
		 * @var string $bd_stepwise_style stepwise form style
		 */
		public $bd_stepwise_style;

		/**
		 * GET Instance
		 *
		 * Function help to create class instance as per singleton pattern.
		 *
		 * @return object  $_instance
		 */
		public static function get_instance() {
			if ( ! isset( self::$_instance ) ) {
				self::$_instance = new self();
			}
			return self::$_instance;
		}

		/**
		 * Initialize the class and set its properties.
		 *
		 * @since    1.0.0
		 */
		public function __construct() {
			add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
			add_filter( 'geodir_custom_field_input_bdsteps', array( $this, 'geodir_cfi_bdsteps' ), 10, 2 );
			add_filter( 'geodir_custom_fields', array( $this, 'geodir_custom_field_bdsteps' ), 10, 2 );
			add_action( 'admin_menu', array( $this, 'buddy_register_stepwise_menu_page' ), 12 );

			// Add progress bar.
			add_action( 'geodir_before_add_listing_form', array( $this, 'geodir_before_add_listing_form_callback' ), 10, 3 );
			add_action( 'geodir_add_listing_form_end', array( $this, 'geodir_add_listing_form_end_custom_callback' ), 10, 3 );
			add_filter( 'aui_screen_ids', array( $this, 'buddy_stepwise_screen' ), 10, 1 );
		}

		/**
		 * Register a stepwise menu page.
		 */
		public function buddy_register_stepwise_menu_page() {
			add_menu_page(
				__( 'Geodirectory Stepwise Forms', 'textdomain' ),
				'Stepwise form',
				'manage_options',
				'stepwise-form',
				array( $this, 'gd_stepwise_form_menu_page' ),
				'dashicons-feedback',
				6
			);
		}

		/**
		 * Display a stepwise menu page
		 */
		public function gd_stepwise_form_menu_page() {
			if ( isset( $_GET['save_form'] ) && ! empty( $_GET['save_form'] ) ) {
				if ( ! empty( $_GET['stepwise-nonce'] ) && wp_verify_nonce( $_GET['stepwise-nonce'], 'buddy_stepwise_form_nonce_check' ) ) {
					if ( ! empty( $_GET['bd_stepwise_style'] ) ) {
						$bd_stepwise_settings['design'] = sanitize_text_field( $_GET['bd_stepwise_style'] );
					}
					if ( ! empty( $_GET['bd_active_step_color'] ) ) {
						$bd_stepwise_settings['active_step_color'] = sanitize_text_field( $_GET['bd_active_step_color'] );
					}
					if ( ! empty( $_GET['bd_completed_step_color'] ) ) {
						$bd_stepwise_settings['completed_step_color'] = sanitize_text_field( $_GET['bd_completed_step_color'] );
					}
					update_option( 'bd_stepwise_settings', json_encode( $bd_stepwise_settings ) );
				}
			}

			$bd_stepwise_settings = $this->get_settings(); // get setting object.
			$bd_current_design    = function_exists( 'geodir_design_style' ) ? geodir_design_style() : ''; // Geodirectory Current design.
			?>
			<div class="wrap gd-stepwiseform bsui">
				<h1><?php echo __( 'Geodirectory Stepwise Forms', 'gd-stepwise-form' ); ?></h1>
				<form class="containerx" action="?page=stepwise-form">
					<div class="accordion ">
						<div class="card p-0 mw-100 border-0 shadow-sm">
							<div class="card-header bg-white rounded-top">
								<h5 class="gd-settings-title h5 mb-0 "><?php echo __( 'Form Style Settings', 'gd-stepwise-form' ); ?></h5>
							</div>
							<div class="card-body">
								<div class="row mb-3">
									<div class="col-sm-3">
										<label for="bd_stepwise_slide_style" class="font-weight-bold fw-bold col-form-label  form-label"><?php echo __( 'Form Style', 'gd-stepwise-form' ); ?></label>
									</div>
									<div class="col-sm-9">
										<select name="bd_stepwise_style" class="custom-select form-select mw-100" id="bd_stepwise_slide_style">
											<option value="stepwise" <?php echo selected( $bd_stepwise_settings->design, 'stepwise', false ); ?>>Stepwise</option>
										</select>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion ">
						<div class="card p-0 mw-100 border-0 shadow-sm">
							<div class="card-header bg-white rounded-top">
								<h5 class="gd-settings-title h5 mb-0 "><?php echo __( 'Form Step Settings', 'gd-stepwise-form' ); ?></h5>
							</div>
							<div class="card-body">
								<div class="row mb-3">
									<div class="col-sm-3">
										<label for="bd-gsf-steps-color" class="font-weight-bold fw-bold col-form-label  form-label"><?php echo __( 'Active Step Color', 'gd-stepwise-form' ); ?></label>
									</div>
									<div class="col-sm-9">
										<input type='color' name="bd_active_step_color" id="bd-gsf-steps-color" value="<?php echo $bd_stepwise_settings->active_step_color; ?>"/>
									</div>
								</div>
								<div class="row mb-3">
									<div class="col-sm-3">
										<label for="bd-gsf-completed-steps-color" class="font-weight-bold fw-bold col-form-label  form-label"><?php echo __( 'Completed Step Color', 'gd-stepwise-form' ); ?></label>
									</div>
									<div class="col-sm-9">
										<input type='color' name="bd_completed_step_color" id="bd-gsf-completed-steps-color" value="<?php echo $bd_stepwise_settings->completed_step_color; ?>"/>
									</div>
								</div>
							</div>
						</div>
					</div>
					<p class="submit mt-2 text-right text-end">
						<?php echo wp_nonce_field( 'buddy_stepwise_form_nonce_check', 'stepwise-nonce' ); ?>
						<input type="hidden" name="page" value="stepwise-form"/>
						<input type="submit" name="save_form" class="button-primary buddy-save-button" value="<?php echo __( 'Save changes', 'gd-stepwise-form' ); ?>"/>
					</p>
				</form>
			</div>
			<?php
		}


		/**
		 * Register the JavaScript for the public-facing side of the site.
		 *
		 * @since    1.0.0
		 */
		public function enqueue_scripts() {
			wp_register_style( 'bd-steps-style', GEOBUDDY_PLUGINS_URL . 'public/css/gd-stepwise-form.css' );
			wp_register_script( 'bd-steps-script', GEOBUDDY_PLUGINS_URL . 'public/js/gd-stepwise-form.js', array( 'jquery' ) );
			if ( function_exists( 'geodir_is_page' ) && geodir_is_page( 'add-listing' ) ) {
				wp_enqueue_style( 'bd-steps-style' );
				wp_enqueue_script( 'bd-steps-script' );
				$bd_stepwise_settings = $this->get_settings(); // get setting object.

				$custom_css = "
					#buddy-gsf-progressbar .bd-completed {
						color: {$bd_stepwise_settings->completed_step_color};
					}

					#buddy-gsf-progressbar .active {
						color: {$bd_stepwise_settings->active_step_color};
					}
					#buddy-gsf-progressbar li.bd-completed:before,
					#buddy-gsf-progressbar li.bd-completed:after {
						background: {$bd_stepwise_settings->completed_step_color};
					}

					#buddy-gsf-progressbar li.active:before,
					#buddy-gsf-progressbar li.active:after {
						background: {$bd_stepwise_settings->active_step_color};
					}
					#buddy-gsf-progressbar li.bd-completed span {
						background: {$bd_stepwise_settings->completed_step_color};
					}
					#buddy-gsf-progressbar li.active span {
						background: {$bd_stepwise_settings->active_step_color};
					}";
				wp_add_inline_style( 'bd-steps-style', $custom_css );

				$this->bd_stepwise_style = ! empty( $bd_stepwise_settings->design ) ? $bd_stepwise_settings->design : 'stepwise';

				// Localize the script with new data
				$translation_array = array(
					'next_text'         => __( 'Next', 'gd-stepwise-form' ),
					'prev_text'         => __( 'Prev', 'gd-stepwise-form' ),
					'bd_stepwise_style' => $this->bd_stepwise_style,
				);
				$translation_array = apply_filters( 'geodirectory_stepwise_form_navigation_text', $translation_array );
				wp_localize_script( 'bd-steps-script', 'buddysf', $translation_array );
			}
		}

		/**
		 * Function return settings object.
		 */
		public function get_settings() {
			$bd_stepwise_settings_json = get_option( 'bd_stepwise_settings', false );
			if ( empty( $bd_stepwise_settings_json ) ) {

				$bd_stepwise_settings      = array(
					'design'               => 'stepwise',
					'active_step_color'    => '#ff9800',
					'completed_step_color' => '#07b51b',
				);
				$bd_stepwise_settings_json = json_encode( $bd_stepwise_settings );
			}
			$bd_stepwise_settings = json_decode( $bd_stepwise_settings_json );
			return $bd_stepwise_settings;
		}

		public function geodir_custom_field_bdsteps( $custom_fields, $post_type ) {

			$custom_fields['bdsteps'] = array( // The key value should be unique and not contain any spaces.
				'field_type'  => 'bdsteps',
				'class'       => 'gd-bdsteps',
				'icon'        => 'fa fa-step-forward',
				'name'        => __( 'Steps', 'geodirectory' ),
				'description' => __( '', 'geodirectory' ),
				'defaults'    => array(
					'data_type'          => 'VARCHAR',
					'admin_title'        => '',
					'site_title'         => '',
					'admin_desc'         => '',
					'htmlvar_name'       => '',
					'is_active'          => true,
					'for_admin_use'      => false,
					'default_value'      => '',
					'show_in'            => '',
					'is_required'        => false,
					'validation_pattern' => '',
					'validation_msg'     => '',
					'required_msg'       => '',
					'field_icon'         => 'fa fa-step-forward',
					'css_class'          => '',
					'cat_sort'           => false,
				),
			);

			return $custom_fields;
		}

		public function geodir_cfi_bdsteps( $html, $cf ) {
			$html_var = $cf['htmlvar_name'];
			// Check if there is a custom field specific filter.
			if ( has_filter( "geodir_custom_field_input_bdsteps_{$html_var}" ) ) {
				/**
				 * Filter the bdsteps html by individual custom field.
				 *
				 * @param string $html The html to filter.
				 * @param array $cf The custom field array.
				 * @since 1.6.6
				 */
				$html = apply_filters( "geodir_custom_field_input_bdsteps_{$html_var}", $html, $cf );
			}

			// If no html then we run the standard output.
			if ( empty( $html ) ) {

				ob_start(); // Start  buffering;
				if ( 2 > $cf['sort_order'] ) {
					echo '<div class="geodir-bdsteps-main-container-parent geodir-bdsteps-' . $this->bd_stepwise_style . '"><div class="geodir-bdsteps-main-container">';
				}
				if ( 2 < $cf['sort_order'] ) {
					echo '</div></div>';
				}
				?>
				<div class="geodir-bdsteps-container" id="geodir-bdsteps-container-<?php echo (int) $cf['id']; ?>" data-filterdiv="bdstep-filter-<?php echo (int) $cf['id']; ?>">
					<div class="geodir-bdsteps-container-inner">
						<div class="geodir-bdsteps-row">
							<h3 id="geodir_bdsteps_<?php echo (int) $cf['id']; ?>"
							gd-bdsteps="<?php echo (int) $cf['id']; ?>"><?php echo esc_attr__( $cf['frontend_title'], 'geodirectory' ); ?>
							</h3>
							<?php
							if ( $cf['desc'] != '' ) {
								echo '<small>( ' . esc_attr__( $cf['desc'], 'geodirectory' ) . ' )</small>';
							}
							?>
						</div>
				<?php
				$html = ob_get_clean();
			}
			return $html;
		}

		/**
		 * Function to add progressbar.
		 */
		function geodir_before_add_listing_form_callback( $listing_type, $post, $package ) {
			$steps_array = $this->gsf_get_all_steps( $listing_type );

			if ( ! empty( $steps_array ) ) {
				echo '<ul id="buddy-gsf-progressbar">';
				foreach ( $steps_array as $key => $value ) {
					$active = ( $key == 0 ) ? 'class="active"' : '';
					echo '<li ' . $active . ' data-filter="bdstep-filter-' . $value->id . '"><span><i class="' . $value->field_icon . '"></i></span><strong>' . $value->frontend_title . '</strong></li>';
				}
				echo '</ul>';
				// echo '<div class="progress"> <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar" aria-valuemin="0" aria-valuemax="100"></div> </div>';
			}
		}

		private function gsf_get_all_steps( $post_type ) {
			global $wpdb;
			$table = GEODIR_CUSTOM_FIELDS_TABLE;
			$query = $wpdb->prepare( 'select id, frontend_title, field_icon from ' . GEODIR_CUSTOM_FIELDS_TABLE . ' where field_type = %s AND post_type = %s order by sort_order', 'bdsteps', $post_type );
			return $wpdb->get_results( $query );
		}

		/**
		 * Stepwise form issue with Elementor.
		 */
		function geodir_add_listing_form_end_custom_callback( $listing_type, $post, $package ) {
			echo '</div></div></div></div>';
		}

		/**
		 * Enable Ayecode UI on plugin setting page.
		 */
		function buddy_stepwise_screen( $aui_screens ) {
			$aui_screens[] = 'toplevel_page_stepwise-form';
			return $aui_screens;
		}
	}
	$_instance = GEOBUDDY_STEPWISE_FORM::get_instance();
}
