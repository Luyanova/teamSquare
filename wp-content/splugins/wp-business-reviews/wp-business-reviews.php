<?php
/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and starts the plugin.
 *
 * @link              https://wpbusinessreviews.com
 * @package           WP_Business_Reviews
 * @since             0.1.0
 *
 * @wordpress-plugin
 * Plugin Name:       WP Business Reviews
 * Plugin URI:        https://wpbusinessreviews.com
 * Description:       A WordPress plugin for showcasing your best reviews in style.
 * Version:           1.5.0
 * Author:            Impress.org
 * Author URI:        https://impress.org
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-business-reviews
 * Domain Path:       /languages/
 */

namespace WP_Business_Reviews;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Define plugin version in SemVer format.
if ( ! defined( 'WPBR_VERSION' ) ) {
	define( 'WPBR_VERSION', '1.5.0' );
}

// Define plugin environment ('local' or 'production').
if ( ! defined( 'WPBR_ENV' ) ) {
	define( 'WPBR_ENV', 'production' );
}

// Define plugin root File.
if ( ! defined( 'WPBR_PLUGIN_FILE' ) ) {
	define( 'WPBR_PLUGIN_FILE', __FILE__ );
}

// Define plugin directory Path.
if ( ! defined( 'WPBR_PLUGIN_DIR' ) ) {
	define( 'WPBR_PLUGIN_DIR', plugin_dir_path( WPBR_PLUGIN_FILE ) );
}

// Define plugin directory URL.
if ( ! defined( 'WPBR_PLUGIN_URL' ) ) {
	define( 'WPBR_PLUGIN_URL', plugin_dir_url( WPBR_PLUGIN_FILE ) );
}

// Define assets directory URL.
if ( ! defined( 'WPBR_ASSETS_URL' ) ) {
	define( 'WPBR_ASSETS_URL', plugin_dir_url( WPBR_PLUGIN_FILE ) . 'assets/dist/' );
}

/**
 * Automatically loads files used throughout the plugin.
 */
require_once __DIR__ . '/autoloader.php';

// Initialize the plugin.
$plugin = new Includes\Plugin();
$plugin->register();
