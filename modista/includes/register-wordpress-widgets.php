<?php
/**
 * WordPress Widget Functions
 *
 * Widget related functions and widget registration.
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register Widgets.
 *
 * @since 1.0.0
 */
function mi_register_widgets() {

	// Woocommerce extended widgets.
	if ( class_exists('WC_Widget')) {
		unregister_widget('\WC_Widget_Layered_Nav');
		register_widget( '\Modista\Widgets\Wordpress\MI_Widget_Layered_Nav' );
	}
}

add_action( 'widgets_init', 'mi_register_widgets' );