<?php

namespace WP_Defender\Controller;

use Calotes\Component\Request;
use Calotes\Component\Response;
use Calotes\Helper\Array_Cache;
use Calotes\Helper\HTTP;
use WP_Defender\Component\Blacklist_Lockout;
use WP_Defender\Component\Config\Config_Hub_Helper;
use WP_Defender\Component\Trusted_Proxy_Preset\Trusted_Proxy_Preset;
use WP_Defender\Component\User_Agent as User_Agent_Component;
use WP_Defender\Event;
use WP_Defender\Controller\Dashboard;
use WP_Defender\Model\Lockout_Ip;
use WP_Defender\Model\Lockout_Log;
use WP_Defender\Model\Notification\Firewall_Report;
use WP_Defender\Model\Notification\Firewall_Notification;
use WP_Defender\Model\Setting\Login_Lockout as Login_Lockout_Model;
use WP_Defender\Model\Setting\Notfound_Lockout;
use WP_Defender\Model\Setting\User_Agent_Lockout;
use WP_Defender\Model\Setting\Blacklist_Lockout as Blacklist_Model;
use WP_Defender\Model\Setting\Global_Ip_Lockout;
use WP_Defender\Model\Unlockout;
use WP_Defender\Behavior\WPMUDEV;
use WP_Defender\Component\Unlock_Me;
use WP_Defender\Component\Firewall as Firewall_Component;

class Firewall extends Event {
	use \WP_Defender\Traits\IP;
	use \WP_Defender\Traits\Formats;

	public const FIREWALL_LOG = 'firewall.log';

	protected $slug = 'wdf-ip-lockout';

	/**
	 * @var \WP_Defender\Model\Setting\Firewall
	 */
	protected $model;

	/**
	 * @var Firewall_Component
	 */
	public $service;

	public function __construct() {
		$title = esc_html__( 'Firewall', 'wpdef' );
		$this->register_page(
			$title,
			$this->slug,
			[ &$this, 'main_view' ],
			$this->parent_slug,
			null,
			$this->menu_title( $title )
		);
		$this->model = wd_di()->get( \WP_Defender\Model\Setting\Firewall::class );
		$this->service = wd_di()->get( Firewall_Component::class );
		$this->register_routes();
		$this->maybe_show_demo_lockout();
		$this->maybe_lockout_gathered_ips();
		// Todo: pass $ip as argument to Login_Lockout/Nf_Lockout.
		wd_di()->get( Login_Lockout::class );
		wd_di()->get( Nf_Lockout::class );
		wd_di()->get( Blacklist::class );
		wd_di()->get( Firewall_Logs::class );
		wd_di()->get( UA_Lockout::class );
		wd_di()->get( Global_Ip::class );

		// We will schedule the time to clean up old firewall logs.
		if ( ! wp_next_scheduled( 'firewall_clean_up_logs' ) ) {
			wp_schedule_event( time() + 10, 'hourly', 'firewall_clean_up_logs' );
		}

		// Schedule cleanup blocklist ips event.
		$this->schedule_cleanup_blocklist_ips_event();

		add_action( 'firewall_clean_up_logs', [ &$this, 'clean_up_firewall_logs' ] );
		add_action( 'firewall_cleanup_temp_blocklist_ips', [ &$this, 'clean_up_temporary_ip_blocklist' ] );

		// Clean unwanted records from lockout table.
		if ( ! wp_next_scheduled( 'wpdef_firewall_clean_up_lockout' ) ) {
			wp_schedule_event( time() + 10, 'weekly', 'wpdef_firewall_clean_up_lockout' );
		}
		add_action( 'wpdef_firewall_clean_up_lockout', [ &$this, 'clean_up_firewall_lockout' ] );
		// Clean old Unlockouts.
		if ( ! wp_next_scheduled( 'wpdef_firewall_clean_up_unlockout' ) ) {
			wp_schedule_event( time() + 20, 'weekly', 'wpdef_firewall_clean_up_unlockout' );
		}
		add_action( 'wpdef_firewall_clean_up_unlockout', [ &$this, 'clean_up_unlockout' ] );

		// Additional hooks.
		add_action( 'defender_enqueue_assets', [ &$this, 'enqueue_assets' ], 11 );
		add_action( 'admin_print_scripts', [ &$this, 'print_emoji_script' ] );

		$this->maybe_extend_mime_types();

		if ( ! wp_next_scheduled( 'wpdef_firewall_fetch_trusted_proxy_preset_ips' ) ) {
			wp_schedule_event( time(), 'daily', 'wpdef_firewall_fetch_trusted_proxy_preset_ips' );
		}
		add_action( 'wpdef_firewall_fetch_trusted_proxy_preset_ips', [ &$this, 'update_trusted_proxy_preset_ips' ] );
	}

	/**
	 * Get menu title.
	 *
	 * @param string $title
	 *
	 * @since 3.11.0
	 * @return string
	 */
	protected function menu_title( string $title ): string {
		$info = defender_white_label_status();
		if ( ! $info['hide_doc_link'] ) {
			$suffix = '<span style="padding: 2px 6px;border-radius: 9px;background-color: #17A8E3;color: #FFF;font-size: 8px;letter-spacing: -0.25px;text-transform: uppercase;vertical-align: middle;">' . __( 'NEW', 'wpdef' ) . '</span>';
			$title .= ' ' . $suffix;
		}

		return $title;
	}

	/**
	 * Clean up all the old logs from the local storage, this will happen per hourly basis.
	 *
	 * @return void
	 */
	public function clean_up_firewall_logs(): void {
		$this->service->firewall_clean_up_logs();
	}

	/**
	 * Clean up temporary IP block list.
	 *
	 * @return void
	 */
	public function clean_up_temporary_ip_blocklist(): void {
		$this->service->firewall_clean_up_temporary_ip_blocklist();
	}

	/**
	 * This is for handling request from dashboard.
	 *
	 * @defender_route
	 * @return Response
	 */
	public function dashboard_activation() {
		$il = wd_di()->get( Login_Lockout_Model::class );
		$nf = wd_di()->get( Notfound_Lockout::class );
		$ua = wd_di()->get( User_Agent_Lockout::class );

		$il->enabled = true;
		$il->save();
		$nf->enabled = true;
		$nf->save();
		$ua->enabled = true;
		$ua->save();

		return new Response( true, $this->to_array() );
	}

	/**
	 * Render the view page.
	 *
	 * @return void
	 */
	public function main_view(): void {
		$this->render( 'main' );
	}

	/**
	 * Save the main settings.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * @defender_route
	 */
	public function save_settings( Request $request ): Response {
		$data = $request->get_data_by_model( $this->model );
		// Before updating Trusted Proxy Preset (TPP) IP's, check the current option is a custom header, no blank TPP value and there's TPP change.
		$is_preset_update = false;
		if (
			in_array(
				$data['http_ip_header'],
				Firewall_Component::custom_http_headers(),
				true
			)
			&& ! empty( $data['trusted_proxy_preset'] )
			&& $data['trusted_proxy_preset'] !== $this->model->trusted_proxy_preset
		) {
			$is_preset_update = true;
		}

		$this->model->import( $data );
		if ( $this->model->validate() ) {
			$this->service->update_cron_schedule_interval( $data['ip_blocklist_cleanup_interval'] );
			$this->model->save();
			Config_Hub_Helper::set_clear_active_flag();
			// Fetch trusted proxy ips.
			if ( $is_preset_update ) {
				$this->service->update_trusted_proxy_preset_ips();
			}

			return new Response(
				true,
				[
					'message' => __( 'Your settings have been updated.', 'wpdef' ),
					'auto_close' => true,
				]
			);
		}

		return new Response(
			false,
			[
				'message' => $this->model->get_formatted_errors(),
			]
		);
	}

	/**
	 * @return array
	 */
	public function to_array(): array {
		$il = wd_di()->get( Login_Lockout_Model::class );
		$nf = wd_di()->get( Notfound_Lockout::class );
		$ua = wd_di()->get( User_Agent_Lockout::class );

		return array_merge(
			[
				'summary' => [
					'ip' => [
						'week' => Lockout_Log::count_login_lockout_last_7_days(),
					],
					'nf' => [
						'week' => Lockout_Log::count_404_lockout_last_7_days(),
					],
					'ua' => [
						'week' => Lockout_Log::count_ua_lockout_last_7_days(),
					],
					'lastLockout' => Lockout_Log::get_last_lockout_date(),
				],
				'notification' => true,
				'enabled' => $nf->enabled || $il->enabled || $ua->enabled,
				'enable_login' => $il->enabled,
				'enable_404' => $nf->enabled,
				'enable_ua' => $ua->enabled,
			],
			$this->dump_routes_and_nonces()
		);
	}

	/**
	 * @return void
	 */
	public function enqueue_assets() {
		if ( ! $this->is_page_active() ) {
			return;
		}

		wp_enqueue_media();

		wp_localize_script( 'def-iplockout', 'iplockout', $this->data_frontend() );
		wp_enqueue_script( 'def-iplockout' );
		$this->enqueue_main_assets();

		do_action( 'defender_ip_lockout_action_assets' );
	}

	/**
	 * Renders the preview of lockout screen.
	 *
	 * @return void
	 */
	private function maybe_show_demo_lockout(): void {
		$is_test = HTTP::get( 'def-lockout-demo', 0 );
		if ( 1 === (int) $is_test ) {
			$type = HTTP::get( 'type' );

			$remaining_time = 0;

			switch ( $type ) {
				case 'login':
					$settings = wd_di()->get( Login_Lockout_Model::class );
					$message = $settings->lockout_message;
					$remaining_time = 3600;
					break;
				case '404':
					$settings = wd_di()->get( Notfound_Lockout::class );
					$message = $settings->lockout_message;
					$remaining_time = 3600;
					break;
				case 'blocklist':
					$settings = wd_di()->get( Blacklist_Model::class );
					$message = $settings->ip_lockout_message;
					break;
				case 'ua-lockout':
					$settings = wd_di()->get( User_Agent_Lockout::class );
					$message = $settings->message;
					$remaining_time = 3600;
					break;
				default:
					$message = __( 'Demo', 'wpdef' );
					break;
			}

			$this->actions_for_blocked( $message, $remaining_time, 'demo', $this->get_user_ip() );
			exit;
		}
	}

	/**
	 * @param string $blocked_ip
	 *
	 * @return bool
	 */
	private function check_attempt_counter_by( $blocked_ip ): bool {
		$blocked_ip = $this->check_ip_by_remote_addr( $blocked_ip );
		$request_count = get_transient( $blocked_ip );
		$disabled = false;
		if ( false === $request_count ) {
			set_transient( $blocked_ip, 1, Unlock_Me::EXPIRED_COUNTER_TIME );
		} elseif ( (int) $request_count >= Unlock_Me::get_attempt_limit() ) {
			$disabled = true;
		} else {
			$request_count++;
			set_transient( $blocked_ip, $request_count, Unlock_Me::EXPIRED_COUNTER_TIME );
		}

		return $disabled;
	}

	/**
	 * @param Request $request
	 *
	 * @return Response
	 * @defender_route
	 * @is_public
	 */
	public function verify_blocked_user( Request $request ): Response {
		$data = $request->get_data(
			[
				'user_data' => [
					'type' => 'string',
					'sanitize' => 'sanitize_text_field',
				],
			]
		);
		$maybe_email = $data['user_data'];
		if ( empty( $maybe_email ) ) {
			return new Response( false, [] );
		}
		$ips = $this->get_user_ip();
		//Check if at least one IP is blocked.
		$blocked_ip = $this->service->get_blocked_ip( $ips );
		// If nothing, just return.
		if ( '' === $blocked_ip ) {
			return new Response( false, [] );
		}
		// Maybe is it an user email?
		$user = get_user_by( 'email', $maybe_email );
		if ( ! is_object( $user ) ) {
			// Maybe is it an user name?
			$user = get_user_by( 'login', $maybe_email );
			if ( ! is_object( $user ) ) {
				$this->check_attempt_counter_by( $blocked_ip );

				return new Response( false, [] );
			}
		}
		// Send email only for admins.
		if ( ! $this->is_admin( $user ) ) {
			// No need to count attempts for existed user but non-admin.
			return new Response( false, [] );
		}
		//Create Unlockout records.
		$arr_uids = [];
		foreach ( $ips as $ip ) {
			// Collect blocked IP's.
			$created_id = wd_di()->get( Unlockout::class )->create( $ip, $user->user_email );
			if ( $created_id ) {
				$arr_uids[] = $created_id;
			}
		}

		$this->send_unlock_email( $user->user_email, $user->user_login, $arr_uids );

		return new Response( true, [] );
	}

	/**
	 * Send again if the attempt limit has not expired.
	 *
	 * @return Response
	 * @defender_route
	 * @is_public
	 */
	public function send_again(): Response {
		//Check if at least one IP is blocked.
		$blocked_ip = $this->service->get_blocked_ip( $this->get_user_ip() );
		if ( '' === $blocked_ip ) {
			return new Response( false, [] );
		}
		$request_count = get_transient( $this->check_ip_by_remote_addr( $blocked_ip ) );
		$is_expired = false !== $request_count && $request_count >= Unlock_Me::get_attempt_limit();

		return new Response(
			! $is_expired,
			[]
		);
	}

	/**
	 * @param string $user_email
	 * @param string $user_login
	 * @param array $arr_uids
	 *
	 * @return bool
	 */
	protected function send_unlock_email( $user_email, $user_login, $arr_uids ): bool {
		$headers = wd_di()->get( \WP_Defender\Component\Mail::class )->get_headers(
			defender_noreply_email( 'wd_unlock_noreply_email' ),
			Unlock_Me::SLUG_UNLOCK
		);
		$subject = __( 'Request to Unblock IP Address', 'wpdef' );

		$content_body = $this->render_partial(
			'email/unlockout',
			[
				'subject' => $subject,
				'name' => $user_login,
				'unlocked_link' => Unlock_Me::create_url( $user_email, $user_login, $arr_uids ),
				'generated_time' => $this->get_local_human_date( time() ),
			],
			false
		);
		$content = $this->render_partial(
			'email/index',
			[
				'title' => __( 'Firewall', 'wpdef' ),
				'content_body' => $content_body,
				'unsubscribe_link' => '',
			],
			false
		);
		// Send email.
		return wp_mail( $user_email, $subject, $content, $headers );
	}

	/**
	 * Run actions for locked entities.
	 *
	 * @param string $message        The message to show.
	 * @param int    $remaining_time Remaining countdown time in seconds.
	 * @param string $reason         Block's reason.
	 * @param array  $ips            Array of blocked IP's.
	 *
	 * @return void
	 */
	private function actions_for_blocked(
		string $message,
		int $remaining_time = 0,
		string $reason = '',
		array $ips = []
	): void {
		$action = HTTP::get('action', false);

		if ( defender_base_action() === $action ) {
			$nonce = HTTP::get( '_def_nonce', false );
			$route = HTTP::get( 'route', '' );
			$route = wp_unslash( $route );
			if ( wp_verify_nonce( $nonce, $route ) ) {
				return;
			}
		}
		// Maybe unblock the request?
		if ( Unlock_Me::SLUG_UNLOCK === $action && wd_di()->get( Unlock_Me::class )->maybe_unlock() ) {
			return;
		}

		ob_start();

		if ( ! headers_sent() ) {
			if ( ! defined( 'DONOTCACHEPAGE' ) ) {
				define( 'DONOTCACHEPAGE', true );
			}

			header( 'HTTP/1.0 403 Forbidden' );
			header( 'Cache-Control: no-cache, no-store, must-revalidate, max-age=0' ); // HTTP 1.1.
			header( 'Pragma: no-cache' ); // HTTP 1.0.
			header( 'Expires: ' . gmdate('D, d M Y H:i:s', time()-3600) . ' GMT' ); // Proxies.
			header( 'Clear-Site-Data: "cache"' ); // Clear cache of the current request.

			$is_displayed = Unlock_Me::is_displayed( $reason, $ips );
			$params = [
				'message' => $message,
				'remaining_time' => $remaining_time,
				'is_unlock_me' => $is_displayed,
			];
			// Only for "Unlock me".
			if ( $is_displayed ) {
				$list = $this->dump_routes_and_nonces();
				$routes = $list['routes'];
				$nonces = $list['nonces'];
				// Prepare data.
				$args = [
					'action' => defender_base_action(),
					'_def_nonce' => $nonces['verify_blocked_user'],
					'route' => $this->check_route( $routes['verify_blocked_user'] ),
				];
				$params['action_verify_blocked_user'] = add_query_arg( $args, admin_url( 'admin-ajax.php' ) );
				// Rewrite args for another action.
				$args['_def_nonce'] = $nonces['send_again'];
				$args['route'] = $this->check_route( $routes['send_again'] );
				$params['action_send_again'] = add_query_arg( $args, admin_url( 'admin-ajax.php' ) );

				$params['button_title'] = Unlock_Me::get_feature_title();
				$button_disabled = false;
				if ( ! empty( $ips ) ) {
					// Get IP's.
					$request_count = get_transient( $this->check_ip_by_remote_addr( $ips[0] ) );
					$button_disabled = false !== $request_count && $request_count >= Unlock_Me::get_attempt_limit();
				}

				$params['button_disabled'] = $button_disabled;
			}

			$this->render_partial(
				'ip-lockout/locked',
				$params
			);
		}

		echo ob_get_clean();
		exit();
	}

	/**
	 * We will check and prevent the access if the current IP is blacklist, or get temporary banned.
	 *
	 * @param string $ip
	 *
	 * @return void|string
	 */
	public function maybe_lockout( $ip ) {
		do_action( 'wd_before_lockout', $ip );

		if ( $this->service->skip_priority_lockout_checks( $ip ) ) {
			return;
		}

		$is_blocklisted = $this->service->is_blocklisted_ip( $ip );
		if ( $is_blocklisted['result'] ) {
			// Get Blacklist_Lockout instance.
			$blacklist_model = wd_di()->get( Blacklist_Model::class );
			// This one is get blacklisted.
			$this->actions_for_blocked( $blacklist_model->ip_lockout_message, 0, $is_blocklisted['reason'], [ $ip ] );
		}
		// Get an instance of UA component.
		$service_ua = wd_di()->get( User_Agent_Component::class );

		if ( $service_ua->is_active_component() ) {
			$user_agent = $service_ua->sanitize_user_agent();
			if ( $service_ua->is_bad_post( $user_agent ) ) {
				$service_ua->block_user_agent_or_ip( $user_agent, $ip, User_Agent_Component::REASON_BAD_POST );

				return $service_ua->get_message();
			}
			if ( ! empty( $user_agent )
				/**
				 * Additional conditions for User Agent.
				 *
				 * @param bool
				 * @param string $user_agent
				 * @param string $ip
				 *
				 * @since 3.1.0
				 */
				&& apply_filters(
					'wd_user_agent_additional_check',
					$service_ua->is_bad_user_agent( $user_agent ),
					$user_agent,
					$ip
				)
			) {
				// Todo: if we use a hook then we should extend cases with a custom reason and send it for log.
				$service_ua->block_user_agent_or_ip( $user_agent, $ip, User_Agent_Component::REASON_BAD_USER_AGENT );

				return $service_ua->get_message();
			}
		}

		$notfound_lockout = wd_di()->get( Notfound_Lockout::class );
		if ( $notfound_lockout->enabled && false === $notfound_lockout->detect_logged && is_user_logged_in() ) {
			/**
			 * We don't need to check the IP if:
			 * the current user can logged-in and isn't from blacklisted,
			 * the option detect_404_logged is disabled.
			 */
			return;
		}
		// Check blacklist.
		$model = Lockout_Ip::get( $ip );
		if ( is_object( $model ) && $model->is_locked() ) {
			$remaining_time = $model->remaining_release_time();
			$this->actions_for_blocked( $model->lockout_message, $remaining_time, 'blacklist', [ $ip ] );
		}
	}

	/**
	 * Remove all IP logs.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * @defender_route
	 */
	public function empty_logs( Request $request ): Response {
		if ( Lockout_Log::truncate() ) {
			$this->log( 'Logs have been successfully deleted.', self::FIREWALL_LOG );

			return new Response(
				true,
				[
					'message' => __( 'Your logs have been successfully deleted.', 'wpdef' ),
					'interval' => 1,
				]
			);
		}

		return new Response(
			false,
			[
				'message' => __( 'Failed remove!', 'wpdef' ),
			]
		);
	}

	/**
	 * Return summary data.
	 *
	 * @return array
	 */
	public function get_summary(): array {
		$summary = Lockout_Log::get_summary();

		return [
			'lockout_last' => isset( $summary['lockout_last'] ) ?
				$this->format_date_time( $summary['lockout_last'] ) :
				__( 'Never', 'wpdef' ),
			'lockout_today' => $summary['lockout_today'] ?? 0,
			'lockout_this_month' => $summary['lockout_this_month'] ?? 0,
			'lockout_login_today' => $summary['lockout_login_today'] ?? 0,
			'lockout_login_this_week' => $summary['lockout_login_this_week'] ?? 0,
			'lockout_404_today' => $summary['lockout_404_today'] ?? 0,
			'lockout_404_this_week' => $summary['lockout_404_this_week'] ?? 0,
			'lockout_ua_today' => $summary['lockout_ua_today'] ?? 0,
			'lockout_ua_this_week' => $summary['lockout_ua_this_week'] ?? 0,
		];
	}

	/**
	 * Delete the settings of all submodules. Use separate submodule classes for individual options.
	 *
	 * @return void
	 */
	public function remove_settings(): void {
		( new Login_Lockout_Model )->delete();
		( new Blacklist_Model )->delete();
		( new Notfound_Lockout )->delete();
		( new \WP_Defender\Model\Setting\Firewall() )->delete();
		( new User_Agent_Lockout )->delete();
		( new Global_Ip_Lockout() )->delete();
	}

	/**
	 * Delete data of all submodules. Use separate submodule classes for individual options.
	 *
	 * @return void
	 */
	public function remove_data(): void {
		Lockout_Log::truncate();
		// Remove cached data.
		Array_Cache::remove( 'countries', 'ip_lockout' );
		// Remove Global IP data.
		( new \WP_Defender\Controller\Global_Ip() )->remove_data();
		// Clear Trusted Proxy data.
		$trusted_proxy_preset = wd_di()->get( Trusted_Proxy_Preset::class );
		foreach ( array_keys( Firewall_Component::trusted_proxy_presets() ) as $preset ) {
			$trusted_proxy_preset->set_proxy_preset( $preset );
			$trusted_proxy_preset->delete_ips();
		}
		// Remove Unlockouts.
		Unlockout::truncate();
	}

	/**
	 * All the variables that we will show on frontend, both in the main page, or dashboard widget.
	 *
	 * @return array
	 */
	public function data_frontend(): array {
		$summary_data = $this->get_summary();

		$user_ip = $this->get_user_ip();

		/**
		 * @var \WP_Defender\Component\Http\Remote_Address
		 */
		$remote_addr = wd_di()->get( \WP_Defender\Component\Http\Remote_Address::class );
		$http_ip_header_value = $remote_addr->get_http_ip_header_value( esc_html( $this->model->http_ip_header ) );

		$data = [
			'login' => [
				'week' => $summary_data['lockout_login_this_week'],
				'day' => $summary_data['lockout_login_today'],
			],
			'nf' => [
				'week' => $summary_data['lockout_404_this_week'],
				'day' => $summary_data['lockout_404_today'],
			],
			'ua' => [
				'week' => $summary_data['lockout_ua_this_week'],
				'day' => $summary_data['lockout_ua_today'],
			],
			'month' => $summary_data['lockout_this_month'],
			'day' => $summary_data['lockout_today'],
			'last_lockout' => $summary_data['lockout_last'],
			'settings' => $this->model->export(),
			'login_lockout' => wd_di()->get( Login_Lockout_Model::class )->enabled,
			'nf_lockout' => wd_di()->get( Notfound_Lockout::class )->enabled,
			'report' => wd_di()->get( Firewall_Report::class )->to_string(),
			'notification_lockout' => 'enabled' === wd_di()->get( Firewall_Notification::class )->status,
			'ua_lockout' => wd_di()->get( User_Agent_Lockout::class )->enabled,
			'user_ip' => implode( ', ', $user_ip ),
			'user_ip_header' => $http_ip_header_value,
			'trusted_proxy_presets' => Firewall_Component::trusted_proxy_presets(),
		];

		return array_merge( $data, $this->dump_routes_and_nonces() );
	}

	/**
	 * @return array
	 */
	public function dashboard_widget(): array {
		return [
			'countries' => wd_di()->get( Blacklist_Lockout::class )->get_top_countries_blocked(),
		];
	}

	/**
	 * @param array $data
	 *
	 * @return void
	 */
	public function import_data( $data ): void {
		$model = $this->model;

		$model->import( $data );
		if ( $model->validate() ) {
			$model->save();
		}
	}

	/**
	 * @return array
	 */
	public function export_strings(): array {
		$strings = [];
		$is_pro = ( new WPMUDEV() )->is_pro();
		$firewall_report = new Firewall_Report();
		// Login lockout.
		$strings[] = Login_Lockout_Model::get_module_name() . ' '
			. Login_Lockout_Model::get_module_state( (bool) ( new Login_Lockout_Model() )->enabled );
		// Notfound lockout.
		$strings[] = Notfound_Lockout::get_module_name() . ' '
			. Notfound_Lockout::get_module_state( (bool) ( new Notfound_Lockout() )->enabled );
		// Global IP lockout.
		$strings[] = Global_Ip_Lockout::get_module_name() .' '
			. Global_Ip_Lockout::get_module_state( (bool) ( new Global_Ip_Lockout() )->enabled );
		// UA lockout.
		$strings[] = User_Agent_Lockout::get_module_name() . ' '
			. User_Agent_Lockout::get_module_state( (bool) ( new User_Agent_Lockout() )->enabled );
		// Notifications and reports.
		if ( 'enabled' === ( new Firewall_Notification() )->status ) {
			$strings[] = __( 'Email notifications active', 'wpdef' );
		}
		if ( $is_pro && 'enabled' === $firewall_report->status ) {
			$strings[] = sprintf(
			/* translators: %s: Frequency value. */
				__( 'Email reports sending %s', 'wpdef' ),
				$firewall_report->frequency
			);
		} elseif ( ! $is_pro ) {
			$strings[] = sprintf(
			/* translators: %s: Html for Pro-tag. */
				__( 'Email report inactive %s', 'wpdef' ),
				'<span class="sui-tag sui-tag-pro">Pro</span>'
			);
		}

		return $strings;
	}

	/**
	 * @param array $config
	 * @param bool  $is_pro
	 *
	 * @return array
	 */
	public function config_strings( array $config, bool $is_pro ): array {
		$strings = [];
		// Login lockout.
		if ( isset( $config['login_protection'] ) ) {
			$strings[] = Login_Lockout_Model::get_module_name() . ' '
				. Login_Lockout_Model::get_module_state( (bool) $config['login_protection'] );
		}
		// NF lockout.
		if ( isset( $config['detect_404'] ) ) {
			$strings[] = Notfound_Lockout::get_module_name() . ' '
				. Notfound_Lockout::get_module_state( (bool) $config['detect_404'] );
		}
		// Global IP blocker.
		if ( isset( $config['global_ip_list'] ) ) {
			$strings[] = Global_Ip_Lockout::get_module_name() . ' '
			. Global_Ip_Lockout::get_module_state( (bool) $config['global_ip_list'] );
		}
		// UA lockout.
		if ( isset( $config['ua_banning_enabled'] ) ) {
			$strings[] = User_Agent_Lockout::get_module_name() . ' '
				. User_Agent_Lockout::get_module_state( (bool) $config['ua_banning_enabled'] );
		}
		// Notifications.
		if ( isset( $config['notification'] ) && 'enabled' === $config['notification'] ) {
			$strings[] = __( 'Email notifications active', 'wpdef' );
		}
		// Report.
		if ( $is_pro && 'enabled' === $config['report'] ) {
			$strings[] = sprintf(
			/* translators: %s: Frequency value. */
				__( 'Email reports sending %s', 'wpdef' ),
				$config['report_frequency']
			);
		} elseif ( ! $is_pro ) {
			$strings[] = sprintf(
			/* translators: %s: Html for Pro-tag. */
				__( 'Email report inactive %s', 'wpdef' ),
				'<span class="sui-tag sui-tag-pro">Pro</span>'
			);
		}

		return $strings;
	}

	/**
	 * Schedule cleanup blocklist ips event.
	 *
	 * @return void
	 */
	private function schedule_cleanup_blocklist_ips_event() {
		// Sometimes multiple requests come at the same time. So we will only count the web requests.
		if ( defined( 'DOING_AJAX' ) || defined( 'DOING_CRON' ) ) {
			return;
		}

		$clear = get_site_option( 'wpdef_clear_schedule_firewall_cleanup_temp_blocklist_ips', false );
		if ( $clear ) {
			wp_clear_scheduled_hook( 'firewall_cleanup_temp_blocklist_ips' );
		}

		if ( wp_next_scheduled( 'firewall_cleanup_temp_blocklist_ips' ) ) {
			return;
		}

		$interval = $this->model->ip_blocklist_cleanup_interval;
		if ( ! $interval || 'never' === $interval ) {
			return;
		}

		wp_schedule_event( time() + 15, $interval, 'firewall_cleanup_temp_blocklist_ips' );
	}

	/**
	 * Maybe add a filter to extend mime types.
	 *
	 * @since 2.6.3
	 * @return void
	 */
	public function maybe_extend_mime_types(): void {
		if ( is_admin() ) {
			$current_url = set_url_scheme( 'http://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'] );
			$current_query = wp_parse_url( $current_url, PHP_URL_QUERY );
			$current_query = $current_query ?? '';
			$referer_url = ! empty( $_SERVER['HTTP_REFERER'] ) ?
				filter_var( $_SERVER['HTTP_REFERER'], FILTER_SANITIZE_URL ) :
				'';
			$referer_query = wp_parse_url( $referer_url, PHP_URL_QUERY );
			$referer_query = $referer_query ?? '';

			parse_str( $current_query, $current_queries );
			parse_str( $referer_query, $referer_queries );

			if (
				( preg_match( '#^' . network_admin_url() . '#i', $current_url ) &&
				  ! empty( $current_queries['page'] ) && $this->slug === $current_queries['page']
				) ||
				( preg_match( '#^' . network_admin_url() . '#i', $referer_url ) &&
				  ! empty( $referer_queries['page'] ) && $this->slug === $referer_queries['page']
				)
			) {
				// Add action hook here.
				add_filter( 'upload_mimes', [ &$this, 'extend_mime_types' ] );
			}
		}
	}

	/**
	 * Filter list of allowed mime types and file extensions.
	 *
	 * @param array $types
	 *
	 * @return array
	 */
	public function extend_mime_types( array $types ): array {
		if ( empty( $types['csv'] ) ) {
			$types['csv'] = 'text/csv';
		}

		return $types;
	}

	/**
	 * Remove all lockouts.
	 *
	 * @since 3.3.0
	 * @return Response
	 * @defender_route
	 */
	public function empty_lockouts() {
		if ( Lockout_Ip::truncate() ) {
			$this->log( 'Deleted lockout records successfully.', self::FIREWALL_LOG );

			return new Response(
				true,
				[
					'message' => __( 'Deleted lockout records successfully.', 'wpdef' ),
					'interval' => 1,
				]
			);
		}

		return new Response(
			false,
			[
				'message' => __( 'Failed remove!', 'wpdef' ),
			]
		);
	}

	/**
	 * Sync IP and it's HTTP header.
	 *
	 * @param Request $request
	 *
	 * @return Response
	 * @defender_route
	 */
	public function sync_ip_header( Request $request ): Response {
		$data = $request->get_data();

		/**
		 * @var \WP_Defender\Component\Http\Remote_Address
		 */
		$remote_addr = wd_di()->get( \WP_Defender\Component\Http\Remote_Address::class );
		$remote_addr->set_http_ip_header( $data['selected_http_header'] );

		$user_ip = $remote_addr->get_ip_address();
		$user_ip_header = $remote_addr->get_http_ip_header_value( $data['selected_http_header'] );
		$data = [
			'user_ip' => is_array( $user_ip ) ? implode( ', ', $user_ip ) : $user_ip,
			'user_ip_header' => $user_ip_header,
		];

		return new Response(
			true,
			$data
		);
	}

	/**
	 * Prints inline Emoji detection script on specific admin pages only.
	 * The conflict happens when other plugins work with emoji flags.
	 *
	 * @since 3.7.0
	 * @return void
	 */
	public function print_emoji_script(): void {
		$allowed_pages = [
			$this->slug,
			wd_di()->get( Dashboard::class )->slug,
		];

		if ( in_array( HTTP::get( 'page' ), $allowed_pages, true ) ) {
			if ( ! function_exists( 'print_emoji_detection_script' ) ) {
				include_once ABSPATH . WPINC . '/formatting.php';
			}

			remove_filter( 'emoji_svg_url', '__return_false' );
			print_emoji_detection_script();
		}
	}

	/**
	 * Clean up unwanted records from lockout table.
	 *
	 * @since 3.8.0
	 * @return void
	 */
	public function clean_up_firewall_lockout(): void {
		$this->service->firewall_clean_up_lockout();
	}

	/**
	 * Gather IP(s) from various headers and check if any IP is blacklisted, or temporary banned.
	 *
	 * @since 4.4.2
	 *
	 * @return void
	 */
	public function maybe_lockout_gathered_ips(): void {
		$msg = '';
		$ips = $this->service->gather_ips();

		if ( ! empty( $ips ) && is_array( $ips ) ) {
			foreach( $ips as $ip ) {
				$result = $this->maybe_lockout( $ip );
				if ( empty( $msg ) && ! empty( $result ) ) {
					$msg = $result;
				}
			}
		}

		if ( ! empty( $msg ) ) {
			$this->actions_for_blocked( $msg, 0, 'blacklist', $ips );
		}
	}

	/**
	 * Clean up old records.
	 *
	 * @since 4.6.0
	 * @return void
	 */
	public function clean_up_unlockout(): void {
		$timestamp = $this->local_to_utc( Unlock_Me::get_expired_time() );
		Unlockout::remove_records( $timestamp, 100 );
	}

	/**
	 * Update trusted proxy preset IPs periodically.
	 *
	 * @return void
	 */
	public function update_trusted_proxy_preset_ips(): void {
		$this->service->update_trusted_proxy_preset_ips();
	}
}