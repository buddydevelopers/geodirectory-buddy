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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		
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
		// Add main menu item
		add_menu_page(
			__('GeoBuddy Settings', 'geobuddy'), // Page title
			__('GeoBuddy', 'geobuddy'),         // Menu title
			'manage_options',                    // Capability required
			'geobuddy',                         // Menu slug
			array($this, 'display_plugin_admin_page'), // Callback function
			'dashicons-admin-site',             // Icon
			25                                  // Position in menu
		);

		// Add only one submenu item that matches the parent
		add_submenu_page(
			'geobuddy',                         // Parent slug
			__('Settings', 'geobuddy'),         // Page title
			__('Settings', 'geobuddy'),         // Menu title
			'manage_options',                    // Capability required
			'geobuddy',                         // Menu slug (same as parent)
			array($this, 'display_plugin_admin_page') // Callback function
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

}
