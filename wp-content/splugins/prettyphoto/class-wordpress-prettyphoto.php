<?php
namespace JLTMAWPF;

if (!defined('ABSPATH')) { exit; } // No, Direct access Sir !!!

if( !class_exists('JLTMA_WordPress_PrettyPhoto') ){

    class JLTMA_WordPress_PrettyPhoto {
		
		private static $instance = null;

		const MINIMUM_PHP_VERSION = '5.4';

		const MINIMUM_ELEMENTOR_VERSION = '2.0.0';

		public function __construct() {

			// Initialize Plugin
			// add_action('plugins_loaded', [$this, 'jltma_wpf_plugins_loaded']);

			add_filter( 'plugin_row_meta', [ $this, 'jltma_wpf_plugin_actions_links' ] );

			// Enqueue Styles and Scripts
			add_action( 'wp_enqueue_scripts', [ $this, 'jltma_wpf_enqueue_scripts' ] );
			add_filter( 'wp_footer', [ $this, 'jltma_wpf_print_footer_script' ] );

			// Add Elementor Widgets
			add_action( 'elementor/widgets/widgets_registered', [ $this, 'jltma_wpf_init_widgets' ] );

			// Image Edit/Save
			add_filter("attachment_fields_to_edit", [$this, 'jltma_wpf_enable_disable_wpf_edit'], null, 2);
			add_filter("attachment_fields_to_save", [$this, 'jltma_wpf_enable_disable_wpf_save'], null, 2);

			// Send Editor Image Tags
			add_filter( 'image_send_to_editor', [$this,'jltma_wpf_replace_image_attribute'], 10, 8 );

			add_action('admin_head', [$this, 'jltma_wpf_editor_text_alignment']);
		}

		

		/**   
		 * Add the data-ext-link-title and data-ext-link-url attributes to inserted images. 
		 */
	    function jltma_wpf_replace_image_attribute( $html, $id, $caption, $title, $align, $url, $size, $alt ) {    

	        if( $id > 0 ){
	        	
	            $enable_prettyphoto = get_post_meta( $id, '_jltma_enable_prettyphoto', true );
	            $jltma_wpf_image_title = get_post_meta($id, '_wp_attachment_image_alt', true);
	            if($enable_prettyphoto){
		            $image_thumb = wp_get_attachment_image_src( $id, 'full');
		            $data  = sprintf( ' href="%1$s" title="%2$s"', esc_url( $image_thumb[0]), $jltma_wpf_image_title );
		            $html = str_replace( "<img src", " <a rel='prettyPhoto' {$data}><img src", $html );	
	            }
	            
	        }
	        return $html;
	    }
	

		// Resources
		// https://sevenspark.com/code/how-to-add-links-to-wordpress-image-captions

		/* For adding custom field to gallery popup */
		function jltma_wpf_enable_disable_wpf_edit($form_fields, $post){
			
			$jltma_enable_prettyphoto = (bool) get_post_meta($post->ID, 'jltma_enable_prettyphoto', true);

		    $form_fields["jltma_enable_prettyphoto"] = array(
		        "label" => sprintf("<strong>PrettyPhoto?<strong>", JLTMA_WPF ),
		        "input" => "html",
				'html' => '<label for="attachments-'.$post->ID.'-wpf"> '.
				    '<input type="checkbox" id="attachments-'.$post->ID.'-jltma_enable_prettyphoto" name="attachments['.$post->ID.'][jltma_enable_prettyphoto]" value="1"'.($jltma_enable_prettyphoto ? ' checked="checked"' : '').' style="margin:0px;"/> <strong style="float:none; display:inline-block; margin-top: 1px;">Enable</strong></label>  ',
				'value' => $jltma_enable_prettyphoto,		        
		        // "helps" => esc_html__("Enable/Disable prettyPhoto for this Image", JLTMA_WPF ),
		    );
		    unset($form_fields['post_content']);
		    return $form_fields;
		}


		//Save Attachment Image Meta Box
		public function jltma_wpf_enable_disable_wpf_save($post, $attachment){

		    if (isset($attachment['jltma_enable_prettyphoto'])) {
		        update_post_meta($post['ID'], '_jltma_enable_prettyphoto', $attachment['jltma_enable_prettyphoto']);
		    }
		    return $post;
		}


		public function jltma_wpf_editor_text_alignment(){
				echo '<style> .compat-field-jltma_enable_prettyphoto th.label {
					    margin-right:3% !important;
					    margin-top: -4px !important;
					  } 
				</style>';
		}

		public function jltma_wpf_plugin_actions_links( $links ) {
			if ( is_admin() ) {					
				$links[] = '<a href="' . esc_url_raw('https://master-addons.com/contact-us') .'" target="_blank">' . esc_html__( 'Support', JLTMA_WPF_TD ) . '</a>';
				$links[] = '<a href="'. esc_url_raw('https://master-addons.com/docs/').'" target="_blank">' . esc_html__( 'Documentation',
						JLTMA_WPF_TD ) . '</a>';
			}
			return $links;
		}

		public function jltma_wpf_init() {
			load_plugin_textdomain( 'mtel' );
		}

		public function jltma_wpf_enqueue_scripts() {
		    wp_enqueue_style( 'jltma-wpf', JLTMA_WPF_URL . '/css/prettyPhoto.css');
		    wp_enqueue_script( 'jltma-wpf', JLTMA_WPF_URL . '/js/jquery.prettyPhoto.js', array('jquery'), JLTMA_WPF_VERSION, true );
		}




		public function jltma_wpf_print_footer_script() { ?>

			<script type="text/javascript" charset="utf-8">
			    jQuery(document).ready(function() {
				    jQuery("a[rel^='prettyPhoto']").prettyPhoto({
					    deeplinking: false,
				    });
			    });
			</script>

		<?php }


		public function jltma_wpf_init_widgets(){

			require_once JLTMA_WPF_ADDON . 'jltma-wpf-addon.php';

			\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Addon\JLTMA_WPF_Addon() );	
		}


		public function jltma_wpf_plugins_loaded(){

			// Check if Elementor installed and activated
			if ( ! did_action( 'elementor/loaded' ) ) {
				add_action( 'admin_notices', array( $this, 'jltma_wpf_admin_notice_missing_main_plugin' ) );
				return;
			}

			// Check for required Elementor version
			if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
				add_action( 'admin_notices', array( $this, 'jltma_wpf_admin_notice_minimum_elementor_version' ) );
				return;
			}

			// Check for required PHP version
			if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
				add_action( 'admin_notices', array( $this, 'jltma_wpf_admin_notice_minimum_php_version' ) );
				return;
			}

		}


		public function is_elementor_activated( $plugin_path = 'elementor/elementor.php' ) {
			$installed_plugins_list = get_plugins();

			return isset( $installed_plugins_list[ $plugin_path ] );
		}

		public function jltma_wpf_admin_notice_missing_main_plugin() {
			$plugin = 'elementor/elementor.php';

			if ( $this->is_elementor_activated() ) {
				if ( ! current_user_can( 'activate_plugins' ) ) {
					return;
				}
				$activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $plugin . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $plugin );
				$message = sprintf( 'WordPress prettyPhoto requires <b>Elementor</b> plugin to be active. Please activate Elementor to continue.', JLTMA_WPF_TD );
				$button_text = esc_html__( 'Activate Elementor', JLTMA_WPF_TD );

			} else {
				if ( ! current_user_can( 'install_plugins' ) ) {
					return;
				}

				$activation_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
				$message = sprintf( esc_html__( 'WordPress prettyPhoto requires %1$s"Elementor"%2$s plugin to be installed and activated. Please install Elementor to continue.', JLTMA_WPF_TD ), '<strong>', '</strong>' );
				$button_text = esc_html__( 'Install Elementor', JLTMA_WPF_TD );
			}

			$button = '<p><a href="' . esc_url_raw( $activation_url ) . '" class="button-primary">' . esc_html( $button_text ) . '</a></p>';

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p>%2$s</div>', $message , $button );

		}


		public function jltma_wpf_admin_notice_minimum_elementor_version() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: Elementor 3: Required Elementor version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', JLTMA_WPF_TD ),
				'<strong>' . esc_html__( 'Master Addons for Elementor', JLTMA_WPF_TD ) . '</strong>',
				'<strong>' . esc_html__( 'Elementor', JLTMA_WPF_TD ) . '</strong>',
				self::MINIMUM_ELEMENTOR_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}


		public function jltma_wpf_admin_notice_minimum_php_version() {
			if ( isset( $_GET['activate'] ) ) {
				unset( $_GET['activate'] );
			}

			$message = sprintf(
			/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
				esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', JLTMA_WPF_TD ),
				'<strong>' . esc_html__( 'Master Addons for Elementor', JLTMA_WPF_TD ) . '</strong>',
				'<strong>' . esc_html__( 'PHP', JLTMA_WPF_TD ) . '</strong>',
				self::MINIMUM_PHP_VERSION
			);

			printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
		}


		public static function get_instance() {
			if ( ! self::$instance ) {
				self::$instance = new self;

				self::$instance -> jltma_wpf_init();
			}
			return self::$instance;
		}

    }

    JLTMA_WordPress_PrettyPhoto::get_instance();
}
