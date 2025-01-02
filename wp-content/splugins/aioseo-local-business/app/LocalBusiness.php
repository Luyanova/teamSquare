<?php
namespace AIOSEO\Plugin\Addon\LocalBusiness {
	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * Main class.
	 *
	 * @since 1.0.0
	 */
	final class LocalBusiness {
		/**
		 * Holds the instance of the plugin currently in use.
		 *
		 * @since 1.0.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\LocalBusiness
		 */
		private static $instance;

		/**
		 * Plugin version for enqueueing, etc.
		 * The value is retrieved from the version constant.
		 *
		 * @since 1.0.0
		 *
		 * @var string
		 */
		public $version = '';

		/**
		 * Instance of the Admin class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Admin\Admin
		 */
		public $admin;

		/**
		 * Instance of the Locations class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Locations\Locations
		 */
		public $locations;

		/**
		 * Instance of the Shortcodes class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Shortcodes\Shortcodes
		 */
		public $shortcodes;

		/**
		 * Instance of the Location postType class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\PostTypes\Location
		 */
		public $postType;

		/**
		 * Instance of the Location taxonomy class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Taxonomies\Location
		 */
		public $taxonomy;

		/**
		 * Instance of the Blocks class containing all blocks.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Blocks\Blocks
		 */
		public $blocks;

		/**
		 * Instance of the Widgets class registering all widgets.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Widgets\Widgets
		 */
		public $widgets;

		/**
		 * Instance of the Schema class.
		 *
		 * @since 1.1.0
		 *
		 * @var string
		 */
		public $schema;

		/**
		 * Instance of the Tags class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Utils\Tags
		 */
		public $tags;

		/**
		 * Instance of the Helpers class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Utils\Helpers
		 */
		public $helpers;

		/**
		 * Instance of the Search class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Main\Search
		 */
		public $search;

		/**
		 * Instance of the Templates class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Utils\Templates
		 */
		public $templates;

		/**
		 * Instance of the Access class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Utils\Access
		 */
		public $access;

		/**
		 * Instance of the Activate class.
		 *
		 * @since 1.1.0
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Main\Activate
		 */
		public $activate;

		/**
		 * Instance of the Map class.
		 *
		 * @since 1.1.3
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Locations\Maps
		 */
		public $maps;

		/**
		 * Instance of the API class.
		 *
		 * @since 1.1.3
		 *
		 * @var AIOSEO\Plugin\Addon\LocalBusiness\Locations\Api
		 */
		public $api;

		/**
		 * Main LocalBusiness Instance.
		 *
		 * Insures that only one instance of the addon exists in memory at any one
		 * time. Also prevents needing to define globals all over the place.
		 *
		 * @since 1.0.0
		 *
		 * @return LocalBusiness
		 */
		public static function instance() {
			if ( null === self::$instance || ! self::$instance instanceof self ) {
				self::$instance = new self();
				self::$instance->constants();
				self::$instance->includes();
				self::$instance->load();
				add_action( 'init', [ self::$instance, 'registerStyles' ] );
			}

			return self::$instance;
		}

		/**
		 * Setup plugin constants.
		 * All the path/URL related constants are defined in main plugin file.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		private function constants() {
			$defaultHeaders = [
				'name'    => 'Plugin Name',
				'version' => 'Version',
			];

			$pluginData = get_file_data( AIOSEO_LOCAL_BUSINESS_FILE, $defaultHeaders );

			$constants = [
				'AIOSEO_LOCAL_BUSINESS_VERSION' => $pluginData['version']
			];

			foreach ( $constants as $constant => $value ) {
				if ( ! defined( $constant ) ) {
					define( $constant, $value );
				}
			}

			$this->version = AIOSEO_LOCAL_BUSINESS_VERSION;
		}

		/**
		 * Including the new files with PHP 5.3 style.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		private function includes() {
			$dependencies = [
				'/vendor/autoload.php'
			];

			foreach ( $dependencies as $path ) {
				if ( ! file_exists( AIOSEO_LOCAL_BUSINESS_DIR . $path ) ) {
					// Something is not right.
					status_header( 500 );
					wp_die( esc_html__( 'Plugin is missing required dependencies. Please contact support for more information.', 'aioseo-local-business' ) );
				}
				require AIOSEO_LOCAL_BUSINESS_DIR . $path;
			}
		}

		/**
		 * Register styles.
		 *
		 * @since 1.1.0
		 *
		 * @return void
		 */
		public function registerStyles() {
			wp_register_style(
				'aioseo-local-business-info',
				trailingslashit( AIOSEO_LOCAL_BUSINESS_URL ) . 'dist/assets/css/business-info.css',
				[],
				AIOSEO_LOCAL_BUSINESS_VERSION
			);

			wp_register_style(
				'aioseo-local-business-opening-hours',
				trailingslashit( AIOSEO_LOCAL_BUSINESS_URL ) . 'dist/assets/css/opening-hours.css',
				[],
				AIOSEO_LOCAL_BUSINESS_VERSION
			);
		}

		/**
		 * Load our classes.
		 *
		 * @since 1.0.0
		 *
		 * @return void
		 */
		public function load() {
			require_once( AIOSEO_LOCAL_BUSINESS_DIR . '/extend/updates.php' );
			new \AIOSEOUpdates( 'aioseo-local-business', $this->version, plugin_basename( AIOSEO_LOCAL_BUSINESS_FILE ) );

			aioseo()->helpers->loadTextDomain( 'aioseo-local-business' );

			$this->internalOptions = new Utils\InternalOptions();
			$this->updates         = new Main\Updates();
			$this->admin           = new Admin\Admin();
			$this->postType        = new Admin\Location();
			$this->taxonomy        = new Admin\LocationCategory();
			$this->locations       = new Locations\Locations();
			$this->maps            = new Locations\Maps();
			$this->shortcodes      = new Shortcodes\Shortcodes();
			$this->blocks          = new Blocks\Blocks();
			$this->widgets         = new Widgets\Widgets();
			$this->tags            = new Utils\Tags();
			$this->helpers         = new Utils\Helpers();
			$this->search          = new Main\Search();
			$this->templates       = new Utils\Templates();
			$this->access          = new Utils\Access();
			$this->schema          = new Schema\Schema();
			$this->activate        = new Main\Activate();
			$this->api             = new Api\Api();

			// Load into main aioseo instance.
			aioseo()->addons->loadAddon( 'localBusiness', $this );
		}
	}
}

namespace {
	// Exit if accessed directly.
	if ( ! defined( 'ABSPATH' ) ) {
		exit;
	}

	/**
	 * The function which returns the one LocalBusiness instance.
	 *
	 * @since 1.0.0
	 *
	 * @return AIOSEO\Plugin\Addon\LocalBusiness\LocalBusiness
	 */
	function aioseoLocalBusiness() {
		return AIOSEO\Plugin\Addon\LocalBusiness\LocalBusiness::instance();
	}

	if ( ! function_exists( 'aioseo_local_business_info' ) ) {
		/**
		 * Global function for business info output.
		 *
		 * @param  array $args
		 * @return void
		 */
		function aioseo_local_business_info( $args = [] ) {
			$shortcodeArgs = [];
			foreach ( $args as $key => $value ) {
				$shortcodeArgs[ aioseo()->helpers->toSnakeCase( $key ) ] = $value;
			}

			echo aioseoLocalBusiness()->shortcodes->businessInfo( $shortcodeArgs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! function_exists( 'aioseo_local_opening_hours' ) ) {
		/**
		 * Global function for opening hours output.
		 *
		 * @param  array $args Opening hours arguments.
		 * @return void
		 */
		function aioseo_local_opening_hours( $args = [] ) {
			$shortcodeArgs = [];
			foreach ( $args as $key => $value ) {
				$shortcodeArgs[ aioseo()->helpers->toSnakeCase( $key ) ] = $value;
			}

			echo aioseoLocalBusiness()->shortcodes->openingHours( $shortcodeArgs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! function_exists( 'aioseo_local_locations' ) ) {
		/**
		 * Global function for locations output.
		 *
		 * @param  array $args Locations arguments.
		 * @return void
		 */
		function aioseo_local_locations( $args = [] ) {
			$shortcodeArgs = [];
			foreach ( $args as $key => $value ) {
				$shortcodeArgs[ aioseo()->helpers->toSnakeCase( $key ) ] = $value;
			}

			echo aioseoLocalBusiness()->shortcodes->locations( $shortcodeArgs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}

	if ( ! function_exists( 'aioseo_local_map' ) ) {
		/**
		 * Global function for locations output.
		 *
		 * @param  array $args Locations arguments.
		 * @return void
		 */
		function aioseo_local_map( $args = [] ) {
			$shortcodeArgs = [];
			foreach ( $args as $key => $value ) {
				$shortcodeArgs[ aioseo()->helpers->toSnakeCase( $key ) ] = $value;
			}

			echo aioseoLocalBusiness()->shortcodes->map( $shortcodeArgs ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}