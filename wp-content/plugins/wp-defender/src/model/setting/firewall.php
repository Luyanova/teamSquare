<?php

namespace WP_Defender\Model\Setting;

use Calotes\Model\Setting;

class Firewall extends Setting {
	use \WP_Defender\Traits\IP;

	/**
	 * Option name
	 * @var string
	 */
	protected $table = 'wd_lockdown_settings';

	/**
	 * @var string
	 * @defender_property
	 */
	public $ip_blocklist_cleanup_interval = 'never';

	/**
	 * @var int
	 * @defender_property
	 */
	public $storage_days = 30;

	/**
	 * HTTP IP header.
	 *
	 * @var string
	 * @defender_property
	 */
	public $http_ip_header = '';

	/**
	 * Trusted proxies IP.
	 *
	 * @var string
	 * @defender_property
	 */
	public $trusted_proxies_ip = '';

	/**
	 * Trusted proxy preset.
	 *
	 * @var string
	 * @defender_property
	 */
	public $trusted_proxy_preset = '';

	/**
	 * Define settings labels.
	 *
	 * @return array
	 */
	public function labels(): array {
		return [
			'storage_days' => __( 'Days to keep logs', 'wpdef' ),
			'ip_blocklist_cleanup_interval' => __( 'Clear Temporary IP Block List', 'wpdef' ),
			'http_ip_header' => __( 'Detect IP Addresses', 'wpdef' ),
			'trusted_proxies_ip' => __( 'Edit Trusted Proxies', 'wpdef' ),
		];
	}

	/**
	 * Get the trusted proxies as an array of IPs.
	 *
	 * @return array Array of IPs.
	 */
	public function get_trusted_proxies_ip(): array {
		$ip = $this->trusted_proxies_ip;

		$ip_array = [];

		if ( is_string( $ip ) ) {
			$ip_array = preg_split( '#\r\n|[\r\n]#', $ip );

			if ( is_array( $ip_array ) ) {
				$ip_array = array_filter( $ip_array );
				$ip_array = array_map( 'trim', $ip_array );
				$ip_array = array_map( 'strtolower', $ip_array );
			}
		}

		return (array) $ip_array;
	}

	/**
	 * Get the trusted proxy preset.
	 *
	 * @return string
	 */
	public function get_trusted_proxy_preset(): string {
		return $this->trusted_proxy_preset;
	}

	/**
	 * Validation method.
	 *
	 * @return void
	 */
	protected function after_validate(): void {
		$validation_object = $this->validate_trusted_proxies();

		if (
			isset( $validation_object['error'] )
			&& $validation_object['error'] === true
			&& ! empty( $validation_object['message'] )
		) {
			$this->errors[] = $validation_object['message'];
		}
	}

	/**
	 * Validation method for trusted proxies.
	 *
	 * @return array Return an array with mandatory boolean index error and optional index message which describes the error.
	 */
	private function validate_trusted_proxies(): array {
		if (
			in_array(
				$this->http_ip_header,
				\WP_Defender\Component\Firewall::custom_http_headers(),
				true
			)
		) {
			$trusted_proxies_ip = $this->get_trusted_proxies_ip();

			if ( empty( $trusted_proxies_ip ) ) {
				// Nothing to check.
				return [ 'error' => false ];
			}

			foreach ( $trusted_proxies_ip as $ip ) {
				if ( ! $this->validate_ip( $ip ) ) {
					return [
						'error' => true,
						'message' => sprintf(
						/* translators: %s: IP value. */
							__( '%s is not a valid IP address', 'wpdef' ),
							$ip
						),
					];
				}
			}
		}

		return [ 'error' => false ];
	}
}