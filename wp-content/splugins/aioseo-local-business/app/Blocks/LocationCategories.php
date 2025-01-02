<?php
namespace AIOSEO\Plugin\Addon\LocalBusiness\Blocks;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The Locations block class.
 *
 * @since 1.1.1
 */
class LocationCategories {
	/**
	 * Class constructor.
	 *
	 * @since 1.1.1
	 */
	public function __construct() {
		register_block_type( 'aioseo/locationcategories', [ 'render_callback' => [ $this, 'render' ] ] );
	}

	/**
	 * Renders the block.
	 *
	 * @since 1.1.1
	 *
	 * @param  array  $blockAttributes The block attributes.
	 * @return string                  The output from the output buffering.
	 */
	public function render( $blockAttributes ) {
		ob_start();

		echo esc_html( aioseoLocalBusiness()->locations->outputLocationCategories( $blockAttributes ) );

		return ob_get_clean();
	}
}