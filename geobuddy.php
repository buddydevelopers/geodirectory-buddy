<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://https://buddydevelopers.com
 * @since             1.0.0
 * @package           Geobuddy
 *
 * @wordpress-plugin
 * Plugin Name:       GeoBuddy
 * Plugin URI:        https://buddydevelopers.com
 * Description:       GeoBuddy is the ultimate companion for the GeoDirectory plugin, designed to extend its core functionality and unlock new possibilities for directory-based WordPress websites.
 * Version:           1.0.0
 * Author:            BuddyDevelopers
 * Author URI:        https://buddydevelopers.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       geobuddy
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'GEOBUDDY_VERSION', '1.0.0' );

if ( ! defined( 'GEOBUDDY_PLUGINS_URL' ) ) {
	define( 'GEOBUDDY_PLUGINS_URL', plugin_dir_url( __FILE__ ) );
}

if ( ! defined( 'GEOBUDDY_PLUGINS_PATH' ) ) {
	define( 'GEOBUDDY_PLUGINS_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-geobuddy-activator.php
 */
function activate_geobuddy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-geobuddy-activator.php';
	Geobuddy_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-geobuddy-deactivator.php
 */
function deactivate_geobuddy() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-geobuddy-deactivator.php';
	Geobuddy_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_geobuddy' );
register_deactivation_hook( __FILE__, 'deactivate_geobuddy' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-geobuddy.php';

/**
 * Check if the GD_STEPWISE_FORM class exists.
 *
 * @since 1.0.0
 *
 * @return bool True if the class exists, false otherwise.
 */
function geobuddy_check_gd_stepwise_form_exists() {
	// Check if the GD_STEPWISE_FORM class exists.
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'geobuddy-multistep-form/geobuddy-multistep-form.php' )) {
		return true;
	}

	return false;
}

/**
 * Check if the GD Announcement Bar class exists.
 *
 * @since 1.0.0
 *
 * @return bool True if the class exists, false otherwise.
 */
function geobuddy_check_gd_announcement_bar_exists() {
	// Check if the GD_STEPWISE_FORM class exists.
    include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( 'geobuddy-announcement-bar/class-announcement-bar.php' )) {
		return true;
	}

	return false;
}

/**
 * Generate a greeting message for the current logged-in user.
 *
 * @return string Greeting message with the username or "Hi, Guest" if not logged in.
 */
function geobuddy_get_user_greeting() {
    $current_user = wp_get_current_user(); // Fetch current user data.

    if ( $current_user->exists() ) {
        $username = $current_user->display_name; // Get the display name of the user.
        return sprintf( esc_html__( 'Hi, %s', 'geobuddy' ), esc_html( $username ) );
    }

    return esc_html__( 'Hi, Guest', 'geobuddy' );
}



/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_geobuddy() {

	$plugin = new Geobuddy();
	$plugin->run();
}
run_geobuddy();

// Freemius integration code.
if ( ! function_exists( 'geobuddy_fs' ) ) {
    // Create a helper function for easy SDK access.
    function geobuddy_fs() {
        global $geobuddy_fs;

        if ( ! isset( $geobuddy_fs ) ) {
            // Include Freemius SDK.
            require_once dirname(__FILE__) . '/freemius/start.php';

            $geobuddy_fs = fs_dynamic_init( array(
                'id'                  => '17588',
                'slug'                => 'geobuddy',
                'type'                => 'plugin',
                'public_key'          => 'pk_ef77760e0a4dc010bf37a5f8a507e',
                'is_premium'          => false,
                'has_addons'          => true,
                'has_paid_plans'      => false,
                'is_org_compliant'    => false,
                'menu'                => array(
                    'slug'           => 'geobuddy',
                    'support'        => false,
                ),
            ) );
        }

        return $geobuddy_fs;
    }

    // Init Freemius.
    geobuddy_fs();
    // Signal that SDK was initiated.
    do_action( 'geobuddy_fs_loaded' );
}
