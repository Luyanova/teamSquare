<?php
/**
 * @package   The_Grid
 * @author    Themeone <themeone.master@gmail.com>
 * @copyright 2015 Themeone
 */

// Exit if accessed directly
if (!defined('ABSPATH')) { 
	exit;
}

class The_Grid_Instagram {
	
	/**
	* Instagram API Key
	*
	* @since 1.0.0
	* @access private
	*
	* @var integer
	*/
	private $api_key;
	
	/**
	* Instagram transient
	*
	* @since 1.0.0
	* @access private
	*
	* @var string
	*/
	private $transient_sec;
	
	/**
	* Grid data
	*
	* @since 1.0.0
	* @access private
	*
	* @var array
	*/
	private $grid_data;
	
	
	/**
	* Instagram count
	*
	* @since 1.0.0
	* @access private
	*
	* @var integer
	*/
	private $count;
	
	/**
	* Instagram media items
	*
	* @since 1.0.0
	* @access private
	*
	* @var array
	*/
	private $media = array();
	
	
	/**
	* Initialize the class and set its properties.
	* @since 1.0.0
	*/
	public function __construct($grid_data = '') {
		
		$this->get_transient_expiration();
		$this->grid_data = $grid_data;
		
	}
	
	/**
	* Get Instagram transient expiration
	* @since: 1.0.0
	*/
	public function get_transient_expiration(){
		
		$this->transient_sec = apply_filters('tg_transient_instagram', 3600);
		
	}
	
	/**
	* Return array of data
	* @since 1.0.0
	*/
	public function get_grid_items() {

		global $tg_is_ajax;
		
		if ( empty( $this->grid_data['instagram_access_token'] ) ) {
			$error_msg  = __( 'Please enter your Access Token.', 'tg-text-domain' );
			throw new Exception($error_msg);
		}

		$this->count  = $this->grid_data['item_number'];
		$this->offset = $this->grid_data['offset'];
		$this->get_media();

		if ( empty( $this->media ) && ! $tg_is_ajax ) {
				
			$error_msg = __( 'No content was found.', 'tg-text-domain' );
			throw new Exception($error_msg);

		}

		return $this->media;

	}
	
	/**
	* Return array of grid data
	* @since: 1.0.0
	*/
	public function get_grid_data(){

		return $this->grid_data;
		
	}
	
	
	/**
	* Retrieve media data
	* @since 1.0.0
	*/
	public function get_media() {

		$request = add_query_arg(
			urlencode_deep(
				array(
					'access_token' => $this->grid_data['instagram_access_token'],
					'fields'       => 'caption,id,media_type,media_url,permalink,thumbnail_url,timestamp,username,children{id,media_type,media_url,permalink,thumbnail_url,timestamp,username}',
					'limit'        => 100,
				)
			),
			'https://graph.instagram.com/me/media/'
		);
		
		$response = $this->get_response( $request, [] );

		if ( empty( $response->data ) ) {
				return;
		}
		
		$this->build_media_array( $response->data );
		
		$this->media = array_slice( $this->media, $this->offset, $this->count );
		
	}
	

	
	/**
	* Get url response (transient)
	* @since 1.0.0
	*/
	public function get_response( $url, $variables = '' ) {

		global $tg_is_ajax;
		
		$transient_name = 'tg_grid_insta_' . md5( $url );
		
		if ($this->transient_sec > 0 && ($transient = get_transient($transient_name)) !== false) {
			$response = $transient;
		} else {

			$response = wp_remote_get( $url );

			if ( is_wp_error( $response ) || empty( $response['body'] ) ) {
				$error_msg  = __( 'Sorry, an error occured from Instagram API.' . $url, 'tg-text-domain' );
				throw new Exception($error_msg);
			}
			
			$response = json_decode( $response['body'] );

			if ( ! is_object( $response ) ) {
				$error_msg  = __( 'Sorry, an error occured from Instagram API.' . $url, 'tg-text-domain' );
				throw new Exception($error_msg);
			}
			
			set_transient($transient_name, $response, $this->transient_sec);

		}

		return $response;
		
	}


	/**
	* Build data array for the grid
	* @since 1.0.0
	*/
	public function build_media_array($response) {

		foreach( $response as $node ) {

			$this->media[ $node->timestamp ] = array(
				'ID'              => $node->id,
				'date'            => strtotime( $node->timestamp ),
				'post_type'       => null,
				'format'          => 'VIDEO' === $node->media_type ? 'video' : null,
				'url'             => $node->permalink,
				'url_target'      => '_blank',
				'title'           => ! empty( $node->caption ) ? $node->caption : '',
				'terms'           => null,
				'author'          => array(
					'ID'     => '',
					'name'   => $node->username,
					'url'    => 'https://www.instagram.com/' . $node->username . '/',
					'avatar' => '',
				),
				'views_number'    => null,
				'image'           => array(
					'alt'    => null,
					'url'    => 'VIDEO' !== $node->media_type ? $node->media_url : $node->thumbnail_url,
					'lb_url' => 'VIDEO' !== $node->media_type ? $node->media_url : $node->thumbnail_url,
					'width'  => 800,
					'height' => 600,
				),
				'gallery'         => null,
				'video'           => array(
					'type'   => 'video',
					'source' => 'VIDEO' === $node->media_type ? array( 'mp4' =>$node->media_url ) : '',
				),
				'audio'           => null,
				'quote'           => null,
				'link'            => null,
				'meta_data'       => null
			);
			
		}
	}
}
