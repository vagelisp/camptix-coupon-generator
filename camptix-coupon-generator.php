<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://vagelis.dev
 * @since             1.0.0
 * @package           Camptix_Coupon_Generator
 *
 * @wordpress-plugin
 * Plugin Name:       Camptix Coupon Generator
 * Plugin URI:        https://github.com/vagelisp
 * Description:       This plugin generates CampTix coupons in bulk using a CSV file.
 * Version:           1.0.0
 * Author:            Vagelis Papaioannou
 * Author URI:        https://vagelis.dev
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       camptix-coupon-generator
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
define( 'CAMPTIX_COUPON_GENERATOR_VERSION', '1.0.0' );

/**
 * Log file path
 */
define('LOG_FILE_NAME', 'generated-coupons.txt');

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-camptix-coupon-generator-activator.php
 */
function activate_camptix_coupon_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-camptix-coupon-generator-activator.php';
	Camptix_Coupon_Generator_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-camptix-coupon-generator-deactivator.php
 */
function deactivate_camptix_coupon_generator() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-camptix-coupon-generator-deactivator.php';
	Camptix_Coupon_Generator_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_camptix_coupon_generator' );
register_deactivation_hook( __FILE__, 'deactivate_camptix_coupon_generator' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-camptix-coupon-generator.php';

/**
 * Initializes the Camptix Coupon Generator plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since 1.0.0
 */
function run_camptix_coupon_generator() {

	$plugin = new Camptix_Coupon_Generator();
	$plugin->run();

}

/**
 * Registers the 'run_camptix_coupon_generator' function to be executed
 * after CampTix has loaded.
 */
add_action( 'camptix_load_addons', 'run_camptix_coupon_generator' );
