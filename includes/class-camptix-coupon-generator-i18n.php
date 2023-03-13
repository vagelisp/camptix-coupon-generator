<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://vagelis.dev
 * @since      1.0.0
 *
 * @package    CampTix_Coupon_Generator
 * @subpackage CampTix_Coupon_Generator/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    CampTix_Coupon_Generator
 * @subpackage CampTix_Coupon_Generator/includes
 * @author     Vagelis Papaioannou <hello@vagelis.dev>
 */
class Camptix_Coupon_Generator_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'camptix-coupon-generator',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
