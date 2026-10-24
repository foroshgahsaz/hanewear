<?php

namespace Hanewear\Core\Elementor;

use Hanewear\Core\Product_Query_Helper;

defined( 'ABSPATH' ) || exit;

class Control_Injection {

	/**
	 * Product card extends parent render only — query controls are injected here.
	 * Carousel widgets register the same controls inside their own register_controls().
	 */
	private static array $widgets = [
		'mi-product-card',
	];

	public static function init() {
		add_action( 'elementor/element/before_section_end', [ __CLASS__, 'maybe_inject_query_controls' ], 10, 3 );
	}

	public static function maybe_inject_query_controls( $element, $section_id, $args ) {
		if ( 'query_section' !== $section_id || ! in_array( $element->get_name(), self::$widgets, true ) ) {
			return;
		}

		Product_Query_Helper::register_product_query_controls( $element );
	}
}
