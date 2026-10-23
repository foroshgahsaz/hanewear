<?php

defined( 'ABSPATH' ) || exit;

require_once get_stylesheet_directory() . '/inc/hanewear-woocommerce.php';

add_action( 'wp_enqueue_scripts', 'mi_child_enqueue_styles' );

if ( ! function_exists( 'mi_child_enqueue_styles' ) ) {

	function mi_child_enqueue_styles() {
		wp_enqueue_style(
			'mi-style',
			get_stylesheet_uri(),
			[],
			'1.0.1'
		);
	}
}

add_filter(
	'upload_mimes',
	function ( $mimes ) {
		$mimes['woff']  = 'font/woff';
		$mimes['woff2'] = 'font/woff2';
		return $mimes;
	}
);
