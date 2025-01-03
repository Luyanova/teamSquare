<?php

namespace WP_Defender\Traits;
trait IP {
	/**
	 * @param $ip
	 *
	 * @return mixed
	 */
	private function is_v4( $ip ) {
		return filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV4 );
	}

	/**
	 * @param $ip
	 *
	 * @return mixed
	 */
	private function is_v6( $ip ) {
		return filter_var( $ip, FILTER_VALIDATE_IP, FILTER_FLAG_IPV6 );
	}

	/**
	 * @return bool
	 */
	private function is_v6_support(): bool {
		return defined( 'AF_INET6' );
	}

	/**
	 * @param string $ip
	 *
	 * @return bool|string
	 */
	private function expand_ip_v6( $ip ) {
		$hex = unpack( 'H*hex', inet_pton( $ip ) );

		return substr( preg_replace( '/([A-f0-9]{4})/', '$1:', $hex['hex'] ), 0, - 1 );
	}

	/**
	 * @param $inet
	 *
	 * @src https://stackoverflow.com/a/7951507
	 * @return string
	 */
	private function ine_to_bits( $inet ): string {
		$unpacked = unpack( 'a16', $inet );
		$unpacked = str_split( $unpacked[1] );
		$binaryip = '';
		foreach ( $unpacked as $char ) {
			$binaryip .= str_pad( decbin( ord( $char ) ), 8, '0', STR_PAD_LEFT );
		}

		return $binaryip;
	}

	/**
	 * @param string $ip
	 * @param string $first_in_range
	 * @param string $last_in_range
	 *
	 * @return bool
	 */
	private function compare_v4_in_range( $ip, $first_in_range, $last_in_range ): bool {
		$low = sprintf( '%u', ip2long( $first_in_range ) );
		$high = sprintf( '%u', ip2long( $last_in_range ) );

		$cip = sprintf( '%u', ip2long( $ip ) );
		if ( $high >= $cip && $cip >= $low ) {
			return true;
		}

		return false;
	}

	/**
	 * @param string $ip
	 * @param string $first_in_range
	 * @param string $last_in_range
	 *
	 * @return bool
	 */
	private function compare_v6_in_range( $ip, $first_in_range, $last_in_range ): bool {
		$first_in_range = inet_pton( $this->expand_ip_v6( $first_in_range ) );
		$last_in_range = inet_pton( $this->expand_ip_v6( $last_in_range ) );
		$ip = inet_pton( $this->expand_ip_v6( $ip ) );

		if ( ( strlen( $ip ) === strlen( $first_in_range ) )
			&& ( $ip >= $first_in_range && $ip <= $last_in_range ) ) {
			return true;
		} else {
			return false;
		}
	}

	/**
	 * @param $ip
	 * @param $block
	 *
	 * @src http://stackoverflow.com/a/594134
	 * @return bool
	 */
	private function compare_cidrv4( $ip, $block ): bool {
		[$subnet, $bits] = explode( '/', $block );
		if ( is_null( $bits ) ) {
			$bits = 32;
		}
		$ip = ip2long( $ip );
		$subnet = ip2long( $subnet );
		$mask = - 1 << ( 32 - $bits );
		$subnet &= $mask;// nb: in case the supplied subnet wasn't correctly aligned

		return ( $ip & $mask ) == $subnet;// phpcs:ignore
	}

	/**
	 * @param $ip
	 * @param $block
	 *
	 * @return bool
	 */
	private function compare_cidrv6( $ip, $block ): bool {
		$ip = $this->expand_ip_v6( $ip );
		$ip = inet_pton( $ip );
		$b_ip = $this->ine_to_bits( $ip );
		[$subnet, $bits] = explode( '/', $block );
		$subnet = $this->expand_ip_v6( $subnet );
		$subnet = inet_pton( $subnet );
		$b_subnet = $this->ine_to_bits( $subnet );

		$ip_net_bits = substr( $b_ip, 0, $bits );
		$subnet_bits = substr( $b_subnet, 0, $bits );

		return $ip_net_bits === $subnet_bits;
	}

	/**
	 * Compare ip2 to ip1, true if ip2>ip1, false if not.
	 *
	 * @param $ip1
	 * @param $ip2
	 *
	 * @return bool
	 */
	public function compare_ip( $ip1, $ip2 ): bool {
		if ( $this->is_v4( $ip1 ) && $this->is_v4( $ip2 ) ) {
			if ( sprintf( '%u', ip2long( $ip2 ) ) - sprintf( '%u', ip2long( $ip1 ) ) > 0 ) {
				return true;
			}
		} elseif ( $this->is_v6( $ip1 ) && $this->is_v6( $ip2 ) && $this->is_v6_support() ) {
			$ip1 = inet_pton( $this->expand_ip_v6( $ip1 ) );
			$ip2 = inet_pton( $this->expand_ip_v6( $ip2 ) );

			return $ip2 > $ip1;
		}

		return false;
	}

	/**
	 * @param $ip
	 * @param $first_in_range
	 * @param $last_in_range
	 *
	 * @return bool
	 */
	public function compare_in_range( $ip, $first_in_range, $last_in_range ): bool {
		if ( $this->is_v4( $first_in_range ) && $this->is_v4( $last_in_range ) ) {
			return $this->compare_v4_in_range( $ip, $first_in_range, $last_in_range );
		} elseif ( $this->is_v6( $first_in_range ) && $this->is_v6( $last_in_range ) && $this->is_v6_support() ) {
			return $this->compare_v6_in_range( $ip, $first_in_range, $last_in_range );
		}

		return false;
	}

	/**
	 * @param $ip
	 * @param $block
	 *
	 * @return bool
	 */
	public function compare_cidr( $ip, $block ): bool {
		[$subnet, $bits] = explode( '/', $block );
		if ( $this->is_v4( $ip ) && $this->is_v4( $subnet ) ) {
			return $this->compare_cidrv4( $ip, $block );
		} elseif ( $this->is_v6( $ip ) && $this->is_v6( $subnet ) && $this->is_v6_support() ) {
			return $this->compare_cidrv6( $ip, $block );
		}

		return false;
	}

	/**
	 * $ip an be single ip, or a range like xxx.xxx.xxx.xxx - xxx.xxx.xxx.xxx or CIDR.
	 * @param string $ip
	 *
	 * @return bool
	 */
	public function validate_ip( $ip ): bool {
		if (
			! stristr( $ip, '-' )
			&& ! stristr( $ip, '/' )
			&& filter_var( $ip, FILTER_VALIDATE_IP ) ) {
			// Only ip, no '-', '/' symbols.
			return true;
		} elseif ( stristr( $ip, '-' ) ) {
			$ips = explode( '-', $ip );
			foreach ( $ips as $ip_key ) {
				if ( ! filter_var( $ip_key, FILTER_VALIDATE_IP ) ) {
					return false;
				}
			}
			if ( $this->compare_ip( $ips[0], $ips[1] ) ) {
				return true;
			}
		} elseif ( stristr( $ip, '/' ) ) {
			[$ip, $bits] = explode( '/', $ip );
			if ( filter_var( $ip, FILTER_VALIDATE_IP ) && filter_var( $bits, FILTER_VALIDATE_INT ) ) {
				if ( $this->is_v4( $ip ) && 0 <= $bits && $bits <= 32 ) {
					return true;
				} elseif ( $this->is_v6( $ip ) && 0 <= $bits && $bits <= 128 && $this->is_v6_support() ) {
					return true;
				}
			}
		}

		return false;
	}

	/**
	 * Display a message if IP is non-valid. The cases:
	 * 1) single IP (no '-', '/' symbols),
	 * 2) IP range,
	 * 3) CIDR.
	 * Ignore cases with private, reserved ranges.
	 * @src https://en.wikipedia.org/wiki/IPv4#Special-use_addresses
	 * @src https://en.wikipedia.org/wiki/IPv6#Special-use_addresses
	 * @param $ip
	 *
	 * @return array
	*/
	public function display_validation_message( $ip ): array {
		$errors = [];
		// Case1: single IP.
		if (
			! stristr( $ip, '-' )
			&& ! stristr( $ip, '/' )
			&& ! filter_var( $ip, FILTER_VALIDATE_IP ) ) {
			$errors[] = sprintf(
			/* translators: %s: IP value. */
				__( '%s – invalid format', 'wpdef' ),
				'<b>' . $ip . '</b>'
			);
			// Case2: IP range.
		} elseif ( stristr( $ip, '-' ) ) {
			$ips = explode( '-', $ip );
			foreach ( $ips as $ip_key ) {
				if ( ! filter_var( $ip_key, FILTER_VALIDATE_IP ) ) {
					$errors[] = sprintf(
					/* translators: %s: IP value. */
						__( '%s – invalid format', 'wpdef' ),
						'<b>' . $ip_key . '</b>'
					);
				}
			}
			if ( ! $this->compare_ip( $ips[0], $ips[1] ) ) {
				$errors[] = sprintf(
				/* translators: 1. IP value. 2. IP value. */
					__( 'Can\'t compare %1$s with %2$s.', 'wpdef' ),
					'<b>' . $ips[1] . '</b>',
					'<b>' . $ips[0] . '</b>'
				);
			}
			// Case3: CIDR.
		} elseif ( stristr( $ip, '/' ) ) {
			[$ip, $bits] = explode( '/', $ip );
			if ( filter_var( $ip, FILTER_VALIDATE_IP ) && filter_var( $bits, FILTER_VALIDATE_INT ) ) {
				if ( $this->is_v4( $ip ) && 0 <= $bits && $bits <= 32 ) {
					// IPv4 is correct.
				} elseif ( $this->is_v6( $ip ) && 0 <= $bits && $bits <= 128 && $this->is_v6_support() ) {
					// IPv6 is correct.
				} else {
					$errors[] = sprintf(
					/* translators: %s: IP value. */
						__( '%s – address out of range', 'wpdef' ),
						'<b>' . $ip . '</b>'
					);
				}
			} else {
				$errors[] = sprintf(
				/* translators: %s: IP value. */
					__( '%s – invalid format', 'wpdef' ),
					'<b>' . $ip . '</b>'
				);
			}
		}
		// @since 2.6.3
		return (array) apply_filters( 'wd_display_ip_validations', $errors );
	}

	/**
	 * Validate IP.
	 * @param $ip
	 *
	 * @return bool
	 */
	public function check_validate_ip( $ip ): bool {
		// Validate the localhost IP address.
		if ( in_array( $ip, [ '127.0.0.1', '::1' ], true ) ) {
			return true;
		}

		$filter_flags = FILTER_FLAG_IPV4 | FILTER_FLAG_IPV6;
		// @since 2.4.7
		if ( apply_filters( 'wp_defender_filtered_internal_ip', false ) ) {
			// Todo: improve display of IP log when filtering reserved or private IPv4/IPv6 ranges.
			$filter_flags = $filter_flags | FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE;
		}

		if ( false === filter_var( $ip, FILTER_VALIDATE_IP, $filter_flags ) ) {
			return false;
		}

		return true;
	}

	/**
	 * Get user IP.
	 *
	 * @return array
	 */
	public function get_user_ip(): array {
		/**
		 * @var \WP_Defender\Component\Http\Remote_Address
		 */
		$remote_addr = wd_di()->get( \WP_Defender\Component\Http\Remote_Address::class );
		$ips = (array) $remote_addr->get_ip_address();

		return $this->filter_user_ips( $ips );
	}

	/**
	 * @param string $ip
	 * @param array  $arr_ips
	 *
	 * @return bool
	 */
	public function is_ip_in_format( $ip, $arr_ips ): bool {
		foreach ( $arr_ips as $wip ) {
			if ( false === strpos( $wip, '-' ) && false === strpos( $wip, '/' ) && trim( $wip ) === $ip ) {
				return true;
			} elseif ( false !== strpos( $wip, '-' ) ) {
				$ips = explode( '-', $wip );
				if ( $this->compare_in_range( $ip, $ips[0], $ips[1] ) ) {
					return true;
				}
			} elseif ( false !== strpos( $wip, '/' ) && $this->compare_cidr( $ip, $wip ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Filter user IPs.
	 *
	 * This function takes an array of user IPs, applies the 'defender_user_ip'
	 * filter to each IP, and returns a unique array of filtered values.
	 *
	 * @param array $ips An array of user IPs.
	 *
	 * @since 4.4.2
	 * @return array An array of unique, filtered user IPs.
	 */
	public function filter_user_ips( array $ips ): array {
		$ips_filtered = [];
		foreach ( $ips as $ip ) {
			/**
			 * Filters the user IP.
			 *
			 * @param string $ip The user IP.
			 */
			$ips_filtered[] = apply_filters( 'defender_user_ip', $ip );
		}

		return array_unique( $ips_filtered );
	}

	/**
	 * Use $_SERVER['REMOTE_ADDR'] as the first protection layer to avoid spoofed headers.
	 *
	 * @param string $blocked_ip
	 *
	 * @return string
	 */
	public function check_ip_by_remote_addr( $blocked_ip ): string {
		return isset( $_SERVER['REMOTE_ADDR'] ) && ! empty( $_SERVER['REMOTE_ADDR'] )
			? $_SERVER['REMOTE_ADDR']
			: $blocked_ip;
	}
}