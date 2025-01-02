<?php
/**
 * Defines the Review_Shortcode class
 *
 * @link https://wpbusinessreviews.com
 *
 * @package WP_Business_Reviews\Includes\Shortcode
 * @since 0.1.0
 */

namespace WP_Business_Reviews\Includes\Shortcode;

use WP_Business_Reviews\Includes\Deserializer\Review_Deserializer as Deserializer;
use WP_Business_Reviews\Includes\View;

/**
 * Outputs a review.
 *
 * @since 0.1.0
 */
class Review_Shortcode {
	/**
	 * Review deserializer.
	 *
	 * @since 0.1.0
	 * @var Deserializer $deserializer
	 */
	private $deserializer;

	/**
	 * Instantiates the Review_Shortcode object.
	 *
	 * @since 0.1.0
	 *
	 * @param Deserializer $deserializer Retriever of reviews.
	 */
	public function __construct( Deserializer $deserializer ) {
		$this->deserializer = $deserializer;
	}

	/**
	 * Registers functionality with WordPress hooks.
	 *
	 * @since 0.1.0
	 */
	public function register() {
		add_shortcode( 'wpbr_review', array( $this, 'init' ) );
	}

	/**
	 * Initializes the Review.
	 *
	 * @since 0.1.0
	 *
	 * @param array $atts {
	 *     Shortcode attributes.
	 *
	 *     @type int $id Review post ID.
	 * }
	 *
	 * @return string HTML output for JS.
	 */
	public function init( $atts ) {
		$atts = shortcode_atts( array(
			'id' => 0,
		), $atts, 'wpbr_review' );

		$review = $this->deserializer->get_review( $atts['id'] );

		if ( ! $review ) {
			return null;
		}

		// Ensure scripts are loaded to render shortcode.
		wp_enqueue_script( 'wpbr-public-main-script' );
		wp_enqueue_style( 'wpbr-public-main-styles' );

		// Send to JS.
		wp_localize_script(
			'wpbr-public-main-script',
			'wpbrReview' . $atts['id'],
			array(
				'review'   => $review,
				'settings' => array(
					'post_parent'       => 0,
					'style'             => 'light',
					'format'            => 'review_gallery',
					'max_columns'       => 1,
					'max_characters'    => 280,
					'line_breaks'       => 'disabled',
					'review_components' => array(
						'reviewer_image' => 'enabled',
						'reviewer_name'  => 'enabled',
						'rating'         => 'enabled',
						'recommendation' => 'enabled',
						'timestamp'      => 'enabled',
						'content'        => 'enabled',
						'platform_icon'  => 'enabled',
					),
				)
			)
		);

		$view_object = new View( WPBR_PLUGIN_DIR . 'views/review.php' );

		return $view_object->render(
			array(
				'unique_id' => $atts['id'],
			),
			false
		);

	}
}
