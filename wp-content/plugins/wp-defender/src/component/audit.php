<?php

namespace WP_Defender\Component;

use Calotes\Helper\Array_Cache;
use WP_Defender\Behavior\WPMUDEV;
use WP_Defender\Component;
use WP_Defender\Model\Audit_Log;
use WP_Defender\Traits\IO;
use WP_Defender\Traits\Formats;

class Audit extends Component {
	use IO, Formats;

	public const CACHE_LAST_CHECKPOINT = 'wd_audit_fetch_checkpoint';

	/**
	 *
	 * All the logs should be fetched through this function, it will automate query the API and fetch local log if the date range not exists.
	 *
	 * @param int    $date_from
	 * @param int    $date_to
	 * @param array  $events
	 * @param string $user_id
	 * @param string $ip
	 * @param int    $paged
	 *
	 * return \WP_Error|Audit_Log[]
	 */
	public function fetch( $date_from, $date_to, $events = [], $user_id = '', $ip = '', $paged = 1 ) {
		$internal = Audit_Log::query( $date_from, $date_to, $events, $user_id, $ip, $paged );
		$this->log( sprintf( 'Found %s from local', count( $internal ) ), 'audit.log' );
		$checkpoint = get_site_option( self::CACHE_LAST_CHECKPOINT );
		if ( false === $checkpoint ) {
			// This case where user install the plugin, have some local data but never reach to Logs page, then check point will be today.
			$checkpoint = time();
		}
		$checkpoint = (int) $checkpoint;
		$date_from = (int) $date_from;
		if ( 0 === count( $internal ) && $checkpoint > $date_from ) {
			// Have to fetch from API.
			$this->log( 'fetch from cloud', 'audit.log' );
			//Todo:need $paged as 'nopaging'-arg?
			$cloud = $this->query_from_api( $date_from, $date_to );
			if ( is_wp_error( $cloud ) ) {
				$this->log( sprintf( 'Fetch error %s', $cloud->get_error_message() ), 'audit.log' );

				return $cloud;
			}
			if ( count( $cloud ) ) {
				// No data from cloud too.
				Audit_Log::mass_insert( $cloud );
				// Because this is roughly fetch, so we have to filter out again using the local data.
				$internal = Audit_Log::query( $date_from, $date_to, $events, $user_id, $ip, $paged );
			}
			// Cache the last time fetch, this will be useful in case of mixed data.
			update_site_option( self::CACHE_LAST_CHECKPOINT, $date_from );
		} else {
			// This case we have the data, however, maybe it can be out of the cached range, so we have to check.
			// Note that, the out of range only happen with date_from, as the local always have the newest data.
			if ( $checkpoint > $date_from ) {
				// We have some data out of range, fetch and cache.
				$this->log(
					sprintf(
						'checkpoint %s - date from %s',
						gmdate( 'Y-m-d H:i:s', $checkpoint ),
						gmdate( 'Y-m-d H:i:s', $date_from )
					),
					'audit.log'
				);
				//Todo:need $paged as 'nopaging'-arg?
				$cloud = $this->query_from_api( $date_from, $checkpoint );
				if ( is_wp_error( $cloud ) ) {
					$this->log( sprintf( 'Fetch error %s', $cloud->get_error_message() ), 'audit.log' );

					return $cloud;
				}
				if ( is_array( $cloud ) ) {
					// Silence the error here, as we actually have data.
					Audit_Log::mass_insert( $cloud );
					$internal = Audit_Log::query( $date_from, $date_to, $events, $user_id, $ip, $paged );
					// Cache the last time fetch, this will be useful in case of mixed data.
					update_site_option( self::CACHE_LAST_CHECKPOINT, $date_from );
				}
			}
		}

		return $internal;
	}

	/**
	 * @param int $date_from
	 * @param int $date_to
	 *
	 * @return array|\WP_Error
	 * @throws \Exception
	 */
	public function query_from_api( $date_from, $date_to ) {
		$date_format = 'Y-m-d H:i:s';
		$date_to = gmdate( $date_format, $date_to );
		$date_from = gmdate( $date_format, $date_from );
		$args = [
			'site_url' => network_site_url(),
			'order_by' => 'timestamp',
			'order' => 'desc',
			'nopaging' => true,
			'timezone' => get_option( 'gmt_offset' ),
			'date_from' => $date_from,
			'date_to' => $date_to,
		];

		$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );
		$data = $this->make_wpmu_request(
			WPMUDEV::API_AUDIT,
			$args,
			[ 'method' => 'GET' ],
			true
		);

		if ( is_wp_error( $data ) ) {
			$this->log( sprintf( 'Fetch error %s', $data->get_error_message() ), 'audit.log' );

			return $data;
		}

		if ( 'success' !== $data['status'] ) {
			return new \WP_Error( Error_Code::API_ERROR, __( 'Something wrong happen, please try again!', 'wpdef' ) );
		}

		return $data['data'];
	}

	public function flush() {
		$logs = Audit_Log::get_logs_need_flush();
		// Build the data.
		$data = [];
		foreach ( $logs as $log ) {
			$item = $log->export();
			unset( $item['synced'] );
			unset( $item['safe'] );
			unset( $item['id'] );
			$item['msg'] = addslashes( $item['msg'] );
			$data[] = $item;
		}

		if ( count( $data ) ) {
			$ret = $this->curl_to_api( $data );
			if ( ! is_wp_error( $ret ) ) {
				foreach ( $logs as $log ) {
					$log->synced = 1;
					$log->save();
				}
			}
		}
	}

	/**
	 * We will clean up the old logs depending on the storage settings.
	 *
	 * @return void
	 */
	public function audit_clean_up_logs() {
		$audit_settings = wd_di()->get( \WP_Defender\Model\Setting\Audit_Logging::class );
		$interval = $this->calculate_date_interval( $audit_settings->storage_days );
		$date_from = ( new \DateTime() )->setTimezone( wp_timezone() )
			->sub( new \DateInterval( 'P1Y' ) )
			->setTime( 0, 0, 0 );
		$date_to = ( new \DateTime() )->setTimezone( wp_timezone() )
			->sub( new \DateInterval( $interval ) );

		if ( $date_from < $date_to ) {
			// Count the logs that should be deleted.
			$logs_count = Audit_Log::count( $date_from->getTimestamp(), $date_to->getTimestamp() );
			if ( $logs_count > 0 ) {
				Audit_Log::delete_old_logs( $date_from->getTimestamp(), $date_to->getTimestamp(), 50 );
			}
		}
	}

	/**
	 * @param $data
	 */
	public function curl_to_api( $data ) {
		$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );
		$ret = $this->make_wpmu_request(
			WPMUDEV::API_AUDIT_ADD,
			$data,
			[
				'method' => 'POST',
				'timeout' => 3,
				'headers' => [
					'apikey' => $this->get_apikey(),
				],
			]
		);

		return $ret;
	}

	/**
	 * @param $data
	 *
	 * @return bool
	 */
	public function socket_to_api( $data ) {
		$sockets = Array_Cache::get( 'sockets', 'audit', [] );
		// We will need to wait a bit.
		if ( 0 === ( is_array( $sockets ) || $sockets instanceof \Countable ? count( $sockets ) : 0 ) ) {
			// Fall back.
			return false;
		}
		$this->log( sprintf( 'Flush %s to cloud', is_array( $data ) || $data instanceof \Countable ? count( $data ) : 0 ), 'audit.log' );
		$start_time = microtime( true );
		$sks = $sockets;
		$r = null;
		$e = null;
		if ( ( false === @stream_select( $r, $sks, $e, 1 ) ) ) {
			// This case error happen.
			return false;
		}

		$fp = array_shift( $sockets );

		$uri = '/logs/add_multiple';
		$vars = http_build_query( $data );
		$this->attach_behavior( WPMUDEV::class, WPMUDEV::class );
		fwrite( $fp, 'POST ' . $uri . "  HTTP/1.1\r\n" );
		fwrite( $fp, 'Host: ' . $this->strip_protocol( $this->get_endpoint() ) . "\r\n" );
		fwrite( $fp, "Content-Type: application/x-www-form-urlencoded\r\n" );
		fwrite( $fp, 'Content-Length: ' . strlen( $vars ) . "\r\n" );
		fwrite( $fp, 'apikey:' . $this->get_apikey() . "\r\n" );
		fwrite( $fp, "Connection: close\r\n" );
		fwrite( $fp, "\r\n" );
		fwrite( $fp, $vars );
		stream_set_timeout( $fp, 5 );
		$res = '';
		while ( ! feof( $fp ) ) {
			$res .= fgets( $fp, 1024 );

			$end_time = microtime( true );
			if ( $end_time - $start_time > 3 ) {
				fclose( $fp );
				break;
			}
		}

		return true;
	}

	/**
	 * Open a socket to API for faster transmit.
	 */
	public function open_socket() {
		$sockets = Array_Cache::get( 'sockets', 'audit', [] );
		$endpoint = $this->strip_protocol( $this->get_endpoint() );
		if ( empty( $sockets ) ) {
			$fp = @stream_socket_client( //phpcs:ignore
				'ssl://' . $endpoint . ':443',
				$errno,
				$errstr,
				5
			);
			if ( is_resource( $fp ) ) {
				Array_Cache::set( 'sockets', [ $fp ], 'audit' );
			}
		}
	}

	/**
	 * @param string $url
	 *
	 * @return string
	 */
	private function strip_protocol( $url ) {
		$parts = parse_url( $url );
		$host = $parts['host'] . ( $parts['path'] ?? null );

		return rtrim( $host, '/' );
	}

	private function get_endpoint(): string {
		return defined( 'WPMUDEV_CUSTOM_AUDIT_SERVER' )
			? constant( 'WPMUDEV_CUSTOM_AUDIT_SERVER' )
			: 'https://audit.wpmudev.org/';
	}

	/**
	 * Queue all the events listeners, so we can listen and build log base on user behaviors.
	 * Never catch if it runs from WP CLI or CRON.
	 */
	public function enqueue_event_listener() {
		if ( ! wp_doing_cron() && ! defender_is_wp_cli() ) {
			$events_class = [
				new Component\Audit\Comment_Audit(),
				new Component\Audit\Core_Audit(),
				new Component\Audit\Media_Audit(),
				new Component\Audit\Post_Audit(),
				new Component\Audit\Users_Audit(),
				new Component\Audit\Options_Audit(),
				new Component\Audit\Menu_Audit(),
			];

			foreach ( $events_class as $class ) {
				// @since 2.4.7.
				$hooks = apply_filters( 'wp_defender_audit_hooks', $class->get_hooks() );
				foreach ( $hooks as $key => $hook ) {
					$func = function () use ( $key, $hook, $class ) {
						global $wp_filter;
						if ( isset( $wp_filter['gettext'] ) ) {
							$gettext_callbacks = $wp_filter['gettext']->callbacks;

							// Disable all gettext filters.
							$wp_filter['gettext']->callbacks = [];
						}

						// This is arguments of the hook.
						$args = func_get_args();
						// This is hook data, defined in each event class.
						$class->build_log_data( $key, $args, $hook );

						// Add all filters back for gettext.
						if ( isset( $wp_filter['gettext'], $gettext_callbacks ) ) {
							$wp_filter['gettext']->callbacks = $gettext_callbacks;
						}
					};
					add_action( $key, $func, 11, is_array( $hook['args'] ) || $hook['args'] instanceof \Countable ? count( $hook['args'] ) : 0 );
				}
			}
		}
	}

	/**
	 * @throws \ReflectionException
	 */
	public function log_audit_events() {
		$events = Array_Cache::get( 'logs', 'audit', [] );

		if ( ! ( is_array( $events ) || $events instanceof \Countable ? count( $events ) : 0 )
			|| ! class_exists( Audit_Log::class )
		) {
			return;
		}
		$model = new Audit_Log();

		if ( ( is_array( $events ) || $events instanceof \Countable ? count( $events ) : 0 ) > 1 ) {
			if ( $model->has_method( 'mass_insert' ) ) {
				$model->mass_insert( $events );

				return;
			}
		}

		foreach ( $events as $event ) {
			$model->import( $event );
			$model->synced = 0;
			$model->save();
		}
	}
}