<?php
namespace AIOSEO\Plugin\Addon\LocalBusiness\Main;

// Exit if accessed directly.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use AIOSEO\Plugin\Common\Models;

/**
 * The Search class..
 *
 * @since 1.1.0
 */
class Search {
	/**
	 * The JSON searchable fields.
	 *
	 * @since 1.1.0
	 *
	 * @var string An array of searchable fields.
	 */
	private $searchFields = [
		'streetLine1',
		'city',
		'zipCode'
	];

	/**
	 * Whether to force an enhanced query.
	 *
	 * @since 1.1.0
	 *
	 * @var boolean
	 */
	private $forceEnhance = false;

	/**
	 * Holds the errors if there are any.
	 *
	 * @since 1.1.0
	 *
	 * @var bool|string
	 */
	private $errorDetected = false;

	/**
	 * Class constructor.
	 *
	 * @since 1.1.0
	 */
	public function __construct() {
		$this->hooks();
	}

	/**
	 * Hook where we need to enhance the search query.
	 *
	 * @since 1.1.0
	 *
	 * @return void
	 */
	public function hooks() {
		add_action( 'pre_get_posts', [ $this, 'maybeEnhanceSearch' ], 50 );
		add_filter( 'the_excerpt', [ $this, 'maybeEnhanceSearchResults' ], 50 );
	}

	/**
	 * Filter the query join and search to include location results.
	 *
	 * @since 1.1.0
	 *
	 * @param  WP_Query $query The main query.
	 * @return void
	 */
	public function maybeEnhanceSearch( $query ) { // phpcs:ignore VariableAnalysis.CodeAnalysis.VariableAnalysis.UnusedVariable
		$enhance = (
			is_search() &&
			! is_admin() &&
			aioseo()->options->localBusiness->locations->general->multiple &&
			aioseo()->options->localBusiness->locations->general->enhancedSearch &&
			(
				! isset( $_GET['post_type'] ) ||
				aioseoLocalBusiness()->postType->getName() === wp_unslash( $_GET['post_type'] ) // phpcs:ignore HM.Security.ValidatedSanitizedInput.InputNotSanitized
			)
		);

		if ( $this->forceEnhance || $enhance ) {
			remove_action( 'pre_get_posts', [ $this, 'maybeEnhanceSearch' ], 50 );

			add_filter( 'posts_join', [ $this, 'join' ], 50 );
			add_filter( 'posts_search', [ $this, 'search' ], 50, 2 );
			add_filter( 'posts_groupby', [ $this, 'groupBy' ] );
			add_filter( 'posts_results', [ $this, 'maybeDisableEnhancedSearch' ] );
		}
	}

	/**
	 * Left join the aioseo_posts table.
	 *
	 * @since 1.1.0
	 *
	 * @param  string $join The current $join string.
	 * @return string       Adds a left join for location info on table aioseo_posts.
	 */
	public function join( $join ) {
		remove_filter( 'posts_join', [ $this, 'join' ], 50 );

		$join .= ' LEFT JOIN ' . aioseo()->db->db->prefix . 'aioseo_posts aioseo_posts ON ( ' . aioseo()->db->db->posts . '.ID = aioseo_posts.post_id AND aioseo_posts.local_seo IS NOT NULL ) ';

		return $join;
	}

	/**
	 * Adds our search parameters.
	 *
	 * @since 1.1.0
	 *
	 * @param  string    $searchWhere The current search where string.
	 * @param  \WP_Query $query       The current WP_Query.
	 * @return string                 Adds to the search where string to account for locations.
	 */
	public function search( $searchWhere, $query ) {
		remove_filter( 'posts_search', [ $this, 'search' ], 50 );

		$localWhere    = ' ( ';
		$localWhereAnd = '';
		foreach ( $query->get( 'search_terms' ) as $item ) {
			$localWhere    .= $localWhereAnd . $this->getLocalWhere( $item );
			$localWhereAnd = ' AND ';
		}
		$localWhere .= ' ) ';

		$searchWhere = preg_replace( '/^\s*AND\s*\(/', " AND ( {$localWhere} OR ( ", $searchWhere );
		$searchWhere .= ' ) ';

		return $searchWhere;
	}

	/**
	 * Group by ID.
	 *
	 * @since 1.1.0
	 *
	 * @param  string $groupBy The current groupBy string.
	 * @return string          Adds a group_by string for query consistency.
	 */
	public function groupBy( $groupBy ) {
		if ( empty( $groupBy ) ) {
			$groupBy = aioseo()->db->db->posts . '.ID ';
		}

		return $groupBy;
	}

	/**
	 * We'll proactively disable enhanced search if a SQL error was found.
	 *
	 * @since 1.1.0
	 *
	 * @param  array $posts The found search posts.
	 * @return array        The found search posts ( $posts ) is not modified.
	 */
	public function maybeDisableEnhancedSearch( $posts ) {
		if ( '' !== aioseo()->db->lastError() ) {

			$this->errorDetected = aioseo()->db->lastError();

			// Disable enhanced search if an error was found.
			aioseo()->options->localBusiness->locations->general->enhancedSearch = false;

			$notification = Models\Notification::getNotificationByName( 'local-business-enhanced-search' );
			if ( $notification->exists() ) {
				Models\Notification::deleteNotificationByName( 'local-business-enhanced-search' );
			}

			// Let user know we've found an error.
			Models\Notification::addNotification( [
				'slug'              => uniqid(),
				'notification_name' => 'local-business-enhanced-search',
				'title'             => __( 'Local Business - Enhanced Search', 'aioseo-local-business' ),
				'content'           => sprintf(
					// Translators: 1 - Opening link tag, 2 - Closing link tag.
					__( 'Enhanced Search cannot be enabled on your website because there is a search query conflict. To learn more about this, %1$sclick here%2$s.', 'aioseo-local-business' ), // phpcs:ignore Generic.Files.LineLength.MaxExceeded
					'<a href="' . aioseo()->helpers->utmUrl( trailingslashit( AIOSEO_MARKETING_URL ) . 'docs/enhanced-search-query-conflict/', 'notifications-center', 'v3-migration-title-formats-blank' ) . '" target="_blank">', // phpcs:ignore Generic.Files.LineLength.MaxExceeded
					'</a>'
				),
				'type'              => 'error',
				'level'             => [ 'all' ],
				'button1_label'     => '',
				'button1_action'    => '',
				'start'             => gmdate( 'Y-m-d H:i:s' )
			] );
		}

		return $posts;
	}

	/**
	 * Return a full where string query.
	 *
	 * @since 1.1.0
	 *
	 * @param  string $term Search term separated on WP_Query.
	 * @return string       A where for a single search term for each searchField.
	 */
	private function getLocalWhere( $term ) {
		$exclusionPrefix = apply_filters( 'wp_query_search_exclusion_prefix', '-' );

		$exclude = $exclusionPrefix && ( substr( $term, 0, 1 ) === $exclusionPrefix );
		if ( $exclude ) {
			$likeOp  = 'NOT REGEXP';
			$andorOp = 'AND';
			$term    = substr( $term, 1 );
		} else {
			$likeOp  = 'REGEXP';
			$andorOp = 'OR';
		}

		$localWhere = ' ( ';
		foreach ( $this->searchFields as $key => $field ) {
			if ( 0 < $key ) {
				$localWhere .= " {$andorOp} ";
			}
			$likeTerm    = "\"$field\":\"[^\"]*{$term}";
			$localWhere .= aioseo()->db->db->prepare( " aioseo_posts.local_seo {$likeOp} %s", $likeTerm );
		}

		$localWhere .= ' ) ';

		return $localWhere;
	}

	/**
	 * Adds html output to the search results.
	 *
	 * @since 1.1.0
	 *
	 * @param  string $excerpt The current post excerpt.
	 * @return string          A excerpt enhanced with the location business info.
	 */
	public function maybeEnhanceSearchResults( $excerpt ) {
		if (
			is_search() &&
			! is_admin() &&
			aioseo()->options->localBusiness->locations->general->enhancedSearch &&
			aioseo()->options->localBusiness->locations->general->enhancedSearchExcerpt
		) {
			if ( get_post_type() === aioseoLocalBusiness()->postType->getName() ) {
				ob_start(); ?>
				<div class="aioseo-local-seo-details">
					<?php aioseoLocalBusiness()->locations->outputBusinessInfo( get_the_ID() ); ?>
				</div>
				<?php
				$excerpt = ob_get_clean();
			}
		}

		return $excerpt;
	}

	/**
	 * Test if our enhanced search does not throw any SQL errors.
	 *
	 * @since 1.1.0
	 *
	 * @return bool Search query succeeded.
	 */
	public function testSearch() {
		$this->forceEnhance = true;
		new \WP_Query( [ 's' => 'test' ] );
		$this->forceEnhance = false;

		return ! $this->errorDetected;
	}
}