<?php
namespace AIOSEO\Plugin\Addon\LocalBusiness\Locations;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The Maps class.
 *
 * @since 1.1.3
 */
class Maps {
	/**
	 * Loader script handle.
	 *
	 * @since 1.1.3
	 *
	 * @var string
	 */
	public $loaderScriptHandle = 'aioseo-local-map-js-api-loader';

	/**
	 * Map script handle.
	 *
	 * @since 1.1.3
	 *
	 * @var string
	 */
	public $mapScriptHandle = 'aioseo-local-map';

	/**
	 * Map script localized.
	 *
	 * @since 1.1.3
	 *
	 * @var boolean
	 */
	public $mapScriptLocalized = false;

	/**
	 * Loader script handle.
	 *
	 * @since 1.1.3
	 *
	 * @var string
	 */
	public $cssHandle = 'aioseo-local-business-location-map';

	/**
	 * Map load event.
	 *
	 * @since 1.1.3
	 *
	 * @var string
	 */
	public $mapLoadEvent = 'aioseo-local-map-load';

	/**
	 * Class constructor.
	 *
	 * @since 1.1.3
	 */
	public function __construct() {
		add_action( 'wp_enqueue_scripts', [ $this, 'init' ] );
		add_action( 'admin_enqueue_scripts', [ $this, 'initAdmin' ] );
	}

	/**
	 * Init the class by registering our scripts.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function init() {
		// Here we just register scripts and styles which will be enqueued when the block is used.
		$this->registerScripts();
		$this->registerStyles();
	}

	/**
	 * Init the class by registering our scripts and enqueuing if we're on Gutenberg.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function initAdmin() {
		$this->init();

		// Enqueuing from the block rendering does not work in the admin.
		// So we enqueue our scripts here if we're in the block editor for a nice map preview.
		$screen = get_current_screen();
		if ( method_exists( $screen, 'is_block_editor' ) && $screen->is_block_editor() ) {
			$this->enqueues();
		}
	}

	/**
	 * Register scripts.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function registerScripts() {
		wp_register_script(
			$this->loaderScriptHandle,
			AIOSEO_LOCAL_BUSINESS_URL . 'dist/assets/js/js-api-loader.js',
			[],
			AIOSEO_LOCAL_BUSINESS_VERSION,
			true
		);

		wp_register_script(
			$this->mapScriptHandle,
			AIOSEO_LOCAL_BUSINESS_URL . 'dist/assets/js/map.js',
			[],
			AIOSEO_LOCAL_BUSINESS_VERSION,
			true
		);
	}

	/**
	 * Registers styles.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function registerStyles() {
		wp_register_style(
			$this->cssHandle,
			trailingslashit( AIOSEO_LOCAL_BUSINESS_URL ) . 'dist/assets/css/location-map.css',
			[],
			AIOSEO_LOCAL_BUSINESS_VERSION
		);
	}

	/**
	 * Enqueues needed scripts.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function enqueueScripts() {
		wp_enqueue_script( $this->loaderScriptHandle );

		if ( ! $this->mapScriptLocalized ) {
			$this->mapScriptLocalized = wp_localize_script( $this->mapScriptHandle, 'aioseoMapOptions',
				[
					'apiKey'       => aioseo()->options->localBusiness->maps->apiKey,
					'mapLoadEvent' => $this->mapLoadEvent
				]
			);
		}

		wp_enqueue_script( $this->mapScriptHandle );
	}

	/**
	 * Enqueues needed styles.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function enqueueStyles() {
		wp_enqueue_style( $this->cssHandle );
	}

	/**
	 * Enqueues needed scripts and styles.
	 *
	 * @since 1.1.3
	 *
	 * @return void
	 */
	public function enqueues() {
		$this->enqueueScripts();
		$this->enqueueStyles();
	}

	/**
	 * Adds inline script to start a map.
	 *
	 * @since 1.1.3
	 *
	 * @param  string $data Data to be encoded.
	 * @return void
	 */
	public function mapStartEvent( $data ) {
		$data = wp_json_encode( $data );

		wp_add_inline_script( $this->mapScriptHandle, "
			document.dispatchEvent(new CustomEvent('{$this->mapLoadEvent}', {
				detail : $data
			}))
			"
		);
	}

	/**
	 * Adds map information in the Rest API for a Location.
	 *
	 * @since 1.1.3
	 *
	 * @param  object      $object The rest object.
	 * @return object|null         Map information.
	 */
	public function restMapInfo( $object ) {
		$location = aioseoLocalBusiness()->locations->getLocation( $object['id'] );

		if ( empty( $location->maps ) ) {
			return null;
		}

		$location->maps->infoWindowContent = $this->getMarkerInfoWindow( $location );

		return $location->maps;
	}

	/**
	 * Returns the template for the marker's info window.
	 *
	 * @since 1.1.3
	 *
	 * @param  object $locationData The location data.
	 * @return string               Marker's info window template.
	 */
	public function getMarkerInfoWindow( $locationData ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		$template = aioseoLocalBusiness()->templates->locateTemplate( 'MapMarkerInfoWindow.php' );

		ob_start();

		require( $template );

		return ob_get_clean();
	}
}