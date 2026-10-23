<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Base_Logo extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-logo-widget';
    }

    public function get_title() {
        return __( 'Logo Widget', 'modista' );
    }

    public function get_icon() {
        return 'eicon-image';
    }
    
    public function get_categories() {
        return [ 'modista' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'logo_section',
            [
                'label' => __( 'Logo Settings', 'modista' ),
            ]
        );

        $this->add_control(
            'logo',
            [
                'label' => __( 'Choose Logo', 'modista' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
                'default' => [
                    'url' => $this->get_custom_logo(),
                ],
            ]
        );

        $this->add_control(
			'logo_dimension',
			[
				'label' => esc_html__( 'Image Dimension', 'modista' ),
				'type' => \Elementor\Controls_Manager::IMAGE_DIMENSIONS,
				'default' => [
					'width' => 160,
					'height' => 40,
				],
			]
		);

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $site_src = $this->get_custom_logo();
    
        // Custom logo
        $custom_src = $settings['logo']['url'];
    
        // تعیین ابعاد پیش‌فرض (در صورت نیاز می‌تونه داینامیک بشه)
        $default_width = $settings['logo_dimension']['width'];
        $default_height = $settings['logo_dimension']['height'];
    
        // اگه ابعاد از تنظیمات Elementor اومده باشه
        if ( ! empty( $settings['logo']['dimensions']['width'] ) && ! empty( $settings['logo']['dimensions']['height'] ) ) {
            $default_width = $settings['logo']['dimensions']['width'];
            $default_height = $settings['logo']['dimensions']['height'];
        }
    
        if ( ! empty( $custom_src ) ) {
            echo '<a href="' . esc_url(home_url()) . '" class="logo-widget d-flex">';
            echo '<img 
                src="' . esc_url($custom_src) . '" 
                alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" 
                width="' . esc_attr($default_width) . '" 
                height="' . esc_attr($default_height) . '" 
                loading="lazy"
                decoding="async"
            >';
            echo '</a>';
        } elseif ( $site_src ) {
            echo '<a href="' . esc_url(home_url()) . '" class="logo-widget d-flex">';
            echo '<img 
                src="' . esc_url($site_src) . '" 
                alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" 
                width="' . esc_attr($default_width) . '" 
                height="' . esc_attr($default_height) . '" 
                loading="lazy"
                decoding="async"
            >';
            echo '</a>';
        } else {
            echo '<p>' . esc_html__( 'No logo available', 'modista' ) . '</p>';
        }
    }
    

    protected function get_custom_logo () {
        $custom_logo_id = get_theme_mod( 'custom_logo' );
        $custom_logo_url = wp_get_attachment_image_url( $custom_logo_id, 'full' );

        if ( ! empty( $custom_logo_url ) ) {
            return $custom_logo_url;
        }

        return '';
    }
}
