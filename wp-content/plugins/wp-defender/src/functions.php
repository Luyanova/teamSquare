<?php
if ( ! defined( 'ABSPATH' ) ) {
	die;
}

/**
 * @param string $path
 *
 * @return string
 */
function defender_asset_url( string $path ): string {
	$base_url = plugin_dir_url( __DIR__ );

	return untrailingslashit( $base_url ) . $path;
}

/**
 * @param string $path
 *
 * @return string
 */
function defender_path( string $path ): string {
	$base_path = plugin_dir_path( __DIR__ );

	return $base_path . $path;
}

/**
 * Sanitize submitted data.
 *
 * @param array $data
 *
 * @return array
 */
function defender_sanitize_data( $data ) {
	foreach ( $data as $key => &$value ) {// phpcs:ignore
		if ( is_array( $value ) ) {
			$value = defender_sanitize_data( $value );
		} else {
			$value = sanitize_textarea_field( $value );
		}
	}

	return $data;
}

/**
 * Retrieve wp-config.php file path.
 *
 * @return string
 */
function defender_wp_config_path(): string {
	if ( file_exists( ABSPATH . 'wp-config.php' ) ) {
		return ABSPATH . 'wp-config.php';
	}

	if (
		@file_exists( dirname( ABSPATH ) . '/wp-config.php' )
		&& ! @file_exists( dirname( ABSPATH ) . '/wp-settings.php' )
	) {
		return dirname( ABSPATH ) . '/wp-config.php';
	}

	return ( defined( 'WD_TEST' ) && WD_TEST ) ? '/tmp/wordpress-tests-lib/wp-tests-config.php' : '';
}

/**
 * Check whether we're on Windows platform or not.
 *
 * @return bool
 */
function defender_is_windows(): bool {
	return '\\' === DIRECTORY_SEPARATOR;
}

/**
 * @return \DI\Container
 */
function wd_di() {
	global $wp_defender_di;

	return $wp_defender_di;
}

/**
 * @return \WP_Defender\Central
 */
function wd_central() {
	global $wp_defender_central;

	return $wp_defender_central;
}

/**
 * @since 2.8.0
 * @return string
 */
function defender_base_action(): string {
	return 'wp_defender/v1/hub/';
}

/**
 * Get backward compatibility. Forminator uses this method.
 *
 * @return array
 */
function defender_backward_compatibility() {
	$wpmu_dev = new \WP_Defender\Behavior\WPMUDEV();
	$two_fa_settings = new \WP_Defender\Model\Setting\Two_Fa();
	$controller = wd_di()->get( \WP_Defender\Controller\Two_Factor::class );
	$list = $controller->dump_routes_and_nonces();
	$lost_url = add_query_arg(
		[
			'action' => defender_base_action(),
			'_def_nonce' => $list['nonces']['send_backup_code'],
			// Add a dummy values to avoid displaying errors, e.g. for the case with null.
			'route' => $controller->check_route( $list['routes']['send_backup_code'] ?? 'test' ),
		],
		admin_url( 'admin-ajax.php' )
	);

	return [
		'is_free' => ! $wpmu_dev->is_pro(),
		'plugin_url' => defender_asset_url( '' ),
		'two_fa_settings' => $two_fa_settings,
		'two_fa_component' => \WP_Defender\Component\Two_Fa::class,
		'lost_url' => $lost_url,
	];
}

/**
 * Polyfill functions for supporting WordPress 5.3.
 *
 * @since 2.4.2
 */
if ( ! function_exists( 'wp_timezone_string' ) ) {
	/**
	 * Retrieves the timezone from site settings as a string.
	 * Uses the `timezone_string` option to get a proper timezone if available, otherwise falls back to an offset.
	 *
	 * @since 5.3.0
	 *
	 * @return string PHP timezone string or a ±HH:MM offset.
	 */
	function wp_timezone_string() {
		$timezone_string = get_option( 'timezone_string' );

		if ( $timezone_string ) {
			return $timezone_string;
		}

		$offset = (float) get_option( 'gmt_offset' );
		$hours = (int) $offset;
		$minutes = ( $offset - $hours );

		$sign = ( $offset < 0 ) ? '-' : '+';
		$abs_hour = abs( $hours );
		$abs_mins = abs( $minutes * 60 );
		$tz_offset = sprintf( '%s%02d:%02d', $sign, $abs_hour, $abs_mins );

		return $tz_offset;
	}
}

if ( ! function_exists( 'wp_timezone' ) ) {
	/**
	 * Retrieves the timezone from site settings as a `DateTimeZone` object.
	 * Timezone can be based on a PHP timezone string or a ±HH:MM offset.
	 *
	 * @since 5.3.0
	 *
	 * @return DateTimeZone Timezone object.
	 */
	function wp_timezone() {
		return new DateTimeZone( wp_timezone_string() );
	}
}

/**
 * Get hostname.
 *
 * @return string|null
 */
function defender_get_hostname() {
	$host = parse_url( get_site_url(), PHP_URL_HOST );
	$host = str_replace( 'www.', '', $host );
	$host = explode( '.', $host );
	if ( is_array( $host ) ) {
		$host = array_shift( $host );
	} else {
		$host = null;
	}

	return $host;
}

if ( ! function_exists( 'sanitize_mask_url' ) ) {
	/**
	 * Sanitizes the mask login URL allowing uppercase letters,
	 * Replacing whitespace and a few other characters with dashes and
	 * Limits the output to alphanumeric characters, underscore (_) and dash (-).
	 * Whitespace becomes a dash.
	 *
	 * @param string $title The title to be sanitized.
	 *
	 * @return string The sanitized title.
	 */
	function sanitize_mask_url( $title ) {
		$title = strip_tags( $title );
		// Preserve escaped octets.
		$title = preg_replace( '|%([a-fA-F0-9][a-fA-F0-9])|', '---$1---', $title );
		// Remove percent signs that are not part of an octet.
		$title = str_replace( '%', '', $title );
		// Restore octets.
		$title = preg_replace( '|---([a-fA-F0-9][a-fA-F0-9])---|', '%$1', $title );

		if ( seems_utf8( $title ) ) {
			$title = utf8_uri_encode( $title, 200 );
		}

		// Kill entities.
		$title = preg_replace( '/&.+?;/', '', $title );
		$title = str_replace( '.', '-', $title );
		$title = preg_replace( '/[^%a-zA-Z0-9 _-]/', '', $title );
		$title = preg_replace( '/\s+/', '-', $title );

		return preg_replace( '|-+|', '-', $title );
	}
}

/**
 * Return the noreply email.
 * A utility function which will return common noreply from address.
 *
 * @param string $filter_tag Tag name of the filter to override email address.
 *
 * @return string Noreply email.
 */
function defender_noreply_email( string $filter_tag = '' ) {
	$host = wp_parse_url( get_site_url(), PHP_URL_HOST );

	if ( 'www.' === substr( $host, 0, 4 ) ) {
		$host = substr( $host, 4 );
	}

	$no_reply_email = 'noreply@' . $host;

	if ( strlen( $filter_tag ) > 0 ) {
		$no_reply_email = apply_filters( $filter_tag, $no_reply_email );
	}

	return $no_reply_email;
}

/**
 * Get data of the whitelabel feature from WPMUDEV Dashboard:
 * hide_branding, hide_doc_link, footer_text, hero_image, change_footer.
 *
 * @since 2.5.5
 * @return array
 */
function defender_white_label_status() {
	/* translators: %s: heart icon */
	$footer_text = sprintf( __( 'Made with %s by WPMU DEV', 'wpdef' ), '<i class="sui-icon-heart"></i>' );
	$custom_image = apply_filters( 'wpmudev_branding_hero_image', '' );
	$whitelabled = apply_filters( 'wpmudev_branding_hide_branding', false );

	return [
		'hide_branding' => apply_filters( 'wpmudev_branding_hide_branding', false ),
		'hide_doc_link' => apply_filters( 'wpmudev_branding_hide_doc_link', false ),
		'footer_text' => apply_filters( 'wpmudev_branding_footer_text', $footer_text ),
		'hero_image' => $custom_image,
		'change_footer' => apply_filters( 'wpmudev_branding_change_footer', false ),
		'is_unbranded' => empty( $custom_image ) && $whitelabled,
		'is_rebranded' => ! empty( $custom_image ) && $whitelabled,
	];
}

/**
 * Indicate this is not fresh setup.
 *
 * @since 2.5.5
 */
function defender_no_fresh_install() {
	if ( empty( get_site_option( 'wd_nofresh_install' ) ) ) {
		update_site_option( 'wd_nofresh_install', true );
	}
}

/**
 * Polyfill for PHP version < 7.3.
 */
if ( ! function_exists( 'array_key_first' ) ) {
	function array_key_first( array $arr ) {
		$arr_keys = array_keys( $arr );

		return $arr_keys[0] ?? null;
	}
}

/**
 * Fetch request url.
 *
 * @return string
 */
function defender_get_request_url(): string {
	return home_url( esc_url( filter_input( INPUT_SERVER, 'REQUEST_URI' ) ) );
}

/**
 * What is the current WP page?
 *
 * @return string
*/
function defender_get_current_page(): string {
	return empty( $_GET['page'] ) ? '' : sanitize_text_field( $_GET['page'] );
}

/**
 * Check that current page is from Defender.
 *
 * @return bool
*/
function is_defender_page(): bool {
	$pages = [
		'wp-defender',
		'wdf-hardener',
		'wdf-scan',
		'wdf-logging',
		'wdf-ip-lockout',
		'wdf-waf',
		'wdf-2fa',
		'wdf-advanced-tools',
		'wdf-notification',
		'wdf-setting',
		'wdf-tutorial',
	];

	return in_array( defender_get_current_page(), $pages, true );
}

/**
 * Return the high contrast css class if it is.
 *
 * @since 2.7.0
 * @return bool
 */
function defender_high_contrast() {
	$model = new \WP_Defender\Model\Setting\Main_Setting();

	return $model->high_contrast_mode;
}

/**
 * Add more cron schedules for plugin modules. E.g. schedules:
 * cleaning completed Scan logs,
 * cleaning temporary firewall IPs,
 * send reports,
 * update MaxMind DB.
 * @since 2.7.1
 *
 * @param array $schedules
 *
 * @return array
 */
function defender_cron_schedules( $schedules ) {
	if ( ! isset( $schedules['thirty_minutes'] ) ) {
		$schedules['thirty_minutes'] = [
			'interval' => 30 * MINUTE_IN_SECONDS,
			'display' => __( 'Every Half Hour', 'wpdef' ),
		];
	}
	if ( ! isset( $schedules['weekly'] ) ) {
		$schedules['weekly'] = [
			'interval' => WEEK_IN_SECONDS,
			'display' => __( 'Weekly', 'wpdef' ),
		];
	}
	if ( ! isset( $schedules['monthly'] ) ) {
		$schedules['monthly'] = [
			'interval' => MONTH_IN_SECONDS,
			'display' => __( 'Once Monthly', 'wpdef' ),
		];
	}
	// Todo: find the right solution because 'monthly' (from Firewall)='thirty_days' (from Security_Key tweak).
	// For regeneration of security keys/salts. Schedules: 30, 60, 90 days, 6 months and 1 year.
	if ( ! isset( $schedules['thirty_days'] ) ) {
		$schedules['thirty_days'] = [
			'interval' => 2592000,
			'display' => __( '30 days', 'wpdef' ),
		];
	}
	if ( ! isset( $schedules['sixty_days'] ) ) {
		$schedules['sixty_days'] = [
			'interval' => 5184000,
			'display' => __( '60 days', 'wpdef' ),
		];
	}
	if ( ! isset( $schedules['ninety_days'] ) ) {
		$schedules['ninety_days'] = [
			'interval' => 7776000,
			'display' => __( '90 days', 'wpdef' ),
		];
	}
	if ( ! isset( $schedules['six_months'] ) ) {
		$schedules['six_months'] = [
			'interval' => 15780000,
			'display' => __( '6 months', 'wpdef' ),
		];
	}
	if ( ! isset( $schedules['one_year'] ) ) {
		$schedules['one_year'] = [
			'interval' => 31536000,
			'display' => __( '1 year', 'wpdef' ),
		];
	}

	return $schedules;
}

/**
 * Generate random string.
 *
 * @param int $length     Length of random string.
 * @param string $strings Characters to include in a random string.
 *
 * @since 3.0.0
 * @return string
 */
function defender_generate_random_string( $length = 16, $strings = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ234567' ) {
	if ( defined( 'DEFENDER_2FA_SECRET' ) ) {
		// Only use in test.
		return constant( 'DEFENDER_2FA_SECRET' );
	}

	if ( ! is_string( $strings ) ) {
		return '';
	}

	$secret = [];
	for ( $i = 0; $i < $length; $i++ ) {
		$secret[] = $strings[ \WP_Defender\Component\Crypt::random_int( 0, strlen( $strings ) - 1 ) ];
	}

	return implode( '', $secret );
}

/**
 * Either return array or echo json.
 *
 * @param mixed $data      A Data to be returned or echoed.
 * @param bool  $success   Is it a success or failure.
 * @param bool  $is_return True if data needs to be returned.
 *
 * @since 3.0.0
 * @return array|void
 */
function defender_maybe_echo_json( $data, $success, $is_return ) {
	if ( true === $is_return ) {
		return [
			'success' => $success,
			'data' => $data,
		];
	} else {
		$success ? wp_send_json_success( $data ) : wp_send_json_error( $data );
	}
}

/**
 * Find all the strings from .mo file.
 * `wpdef` is our text domain.
 *
 * @return array
 */
function defender_gettext_translations(): array {
	global $l10n;

	if ( ! isset( $l10n['wpdef'] ) ) {
		return [];
	}

	$items = [];

	foreach ( $l10n['wpdef']->entries as $key => $value ) {
		$items[ $key ] = count( $value->translations ) ? $value->translations[0] : $key;
	}

	return $items;
}

/**
 * Get string replacement regardless of the operating system.
 *
 * @param string $path
 *
 * @since 3.3.0
 * @return string
 */
function defender_replace_line( $path ): string {
	return str_replace( [ '/', '\\' ], DIRECTORY_SEPARATOR, $path );
}

/**
 * @return string
*/
function defender_support_ticket_text(): string {
	return sprintf(
	/* translators: %s: Support link. */
		__( 'Still, having trouble? <a target="_blank" href="%s">Open a support ticket</a>.', 'wpdef' ),
		WP_DEFENDER_SUPPORT_LINK
	);
}

/**
 * The message is shown on the inappropriate access of Safe Repair feature.
 *
 * @return string
 */
function defender_quarantine_pro_only(): string {
	return __( 'Safe Repair feature is only for Pro', 'wpdef' );
}

/**
 * @return string
 */
function defender_get_user_agent( $default_string = '' ) {
	return ! empty( $_SERVER['HTTP_USER_AGENT'] )
		? \WP_Defender\Component\User_Agent::fast_cleaning( $_SERVER['HTTP_USER_AGENT'] )
		: $default_string;
}

/**
 * @since 4.2.0
 * @return bool
 */
function defender_is_wp_cli() {
	return defined( 'WP_CLI' ) && WP_CLI;
}

/**
 * Check if the current request is a REST API request.
 *
 * This function checks if the current request URI contains the REST API prefix,
 * indicating that it's a request to the WordPress REST API.
 * @since 4.2.0
 *
 * @return bool Whether the current request is a REST API request.
 */
function defender_is_rest_api_request(): bool {
	if ( empty( $_SERVER['REQUEST_URI'] ) ) {
		return false;
	}

	$rest_prefix = trailingslashit( rest_get_url_prefix() );

	return false !== strpos( $_SERVER['REQUEST_URI'], $rest_prefix );
}

/**
 * Handle deprecated functions by logging or triggering actions.
 *
 * This function is a wrapper for WordPress's _deprecated_function() function.
 * It is used to handle deprecated functions by either logging a deprecation
 * message or triggering an action. It checks if the current request is an AJAX
 * request or a REST API request and acts accordingly.
 * @since 4.2.0
 *
 * @param string $function_name The function that was called.
 * @param string $version       The version number that deprecated the function.
 * @param string $replacement   (Optional) The function that should be used instead.
 *
 * @return void
 */
function defender_deprecated_function( string $function_name, string $version, string $replacement = '' ): void {
	/**
	 * Filters whether to trigger an error for deprecated functions.
	 *
	 * @since 4.2.1
	 *
	 * @param bool $trigger Whether to trigger the error for deprecated functions. Default false.
	 */
	if ( WP_DEBUG && apply_filters( 'defender_deprecated_function_trigger_error', false ) ) {
		if ( wp_doing_ajax() || defender_is_rest_api_request() ) {
			do_action( 'deprecated_function_run', $function_name, $replacement, $version );

			$log_string = "Function {$function_name} is deprecated since version {$version}!";
			$log_string .= $replacement ? " Use {$replacement} instead." : '';
			error_log( $log_string );
		} else {
			_deprecated_function( $function_name, $version, $replacement );
		}
	}
}