<?php
namespace JLTMAWPF\Addon;

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Control_Media;
use Elementor\Group_Control_Image_Size;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Color;
use Elementor\Scheme_Typography;
use Elementor\Utils;


/**
 * Author Name: Liton Arefin
 * Author URL: https://jeweltheme.com
 * Date: 27/06/2020
 */

if ( ! defined( 'ABSPATH' ) ) exit; // If this file is called directly, abort.


class JLTMA_WPF_Addon extends Widget_Base {

	public function get_name() {
		return 'jltma-wpf';
	}

	public function get_title() {
		return esc_html__( 'PrettyPhoto', JLTMA_WPF_TD );
	}

	public function get_icon() {
		return 'ma-el-icon eicon-image-rollover';
	}

	public function get_categories() {
		return [ 'general', 'master-addons' ];
	}

   
    public function get_keywords() {
        return [ 'compare', 'image', 'popup', 'image popup', 'lightbox', 'fancybox', 'prettyphoto' ];
	}

    public function get_custom_help_url() {
		return 'https://master-addons.com/';
	}


	protected function _register_controls() {

		$this->start_controls_section(
			'jltma_wpf_section_start',
			[
				'label' => esc_html__( 'Image', JLTMA_WPF_TD )
			]
		);

		$this->add_control(
			'jltma_wpf_image',
			array(
				'label'      => esc_html__('Upload Image',JLTMA_WPF_TD ),
				'type'       => Controls_Manager::MEDIA,
				'show_label' => false
			)
		);

        $this->add_control(
            'jltma_wpf_enable_prettyphoto',
            [
				'label' 		    => esc_html__( 'Enable PrettyPhoto', JLTMA_WPF_TD ),
				'type'              => Controls_Manager::SWITCHER,
                'default'           => 'yes',
                'label_on'          => esc_html__( 'Enable', JLTMA_WPF_TD ),
                'label_off'         => esc_html__( 'Disable', JLTMA_WPF_TD ),
                'return_value'      => 'yes',
                'description' 	    => esc_html__( 'Enable/Disable prettyPhoto for this Image', JLTMA_WPF_TD ),
                'style_transfer'    => true,
            ]
		);

		$this->end_controls_section();

	}

	protected function render() {
		$settings     = $this->get_settings_for_display();

		if($settings['jltma_wpf_enable_prettyphoto'] == "yes"){

            if ( $settings['jltma_wpf_image']['url'] || $settings['jltma_wpf_image']['id'] ) {
                $this->add_render_attribute( 'jltma_wpf_image', 'src', $settings['jltma_wpf_image']['url'] );
                $this->add_render_attribute( 'jltma_wpf_image', 'alt', Control_Media::get_image_alt( $settings['jltma_wpf_image'] ) );
                $this->add_render_attribute( 'jltma_wpf_image', 'title', Control_Media::get_image_title( $settings['jltma_wpf_image'] ) );
                echo '<a rel="prettyPhoto" href="' . $settings['jltma_wpf_image']['url'] . '" title="' . Control_Media::get_image_title( $settings['jltma_wpf_image'] ) .'">'; 
                echo Group_Control_Image_Size::get_attachment_image_html( $settings, 'thumbnail', 'jltma_wpf_image' );
                echo '</a>';
            }
		}

	}

}