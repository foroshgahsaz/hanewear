<?php

namespace Hanewear\Core\Elementor;

defined( 'ABSPATH' ) || exit;

class Widgets_Registry {

	public static function init() {
		add_action( 'elementor/widgets/register', [ __CLASS__, 'register_widgets' ], 20 );
	}

	public static function register_widgets( $widgets_manager ) {
		if ( ! class_exists( 'WooCommerce' ) ) {
			return;
		}

		$overrides = [
			'mi-product-card'           => Widgets\Woo_Product_Card::class,
			'mi-product-carousel'       => Widgets\Woo_Product_Carousel::class,
			'mi-product-carousel_slide' => Widgets\Woo_Product_Carousel_Slide::class,
		];

		foreach ( $overrides as $widget_name => $class ) {
			if ( ! class_exists( $class ) ) {
				continue;
			}
			$widgets_manager->unregister( $widget_name );
			$widgets_manager->register( new $class() );
		}
	}
}
