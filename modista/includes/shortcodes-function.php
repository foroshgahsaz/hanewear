<?php

defined('ABSPATH') || exit; // Exit if accessed directly.

if ( ! function_exists('mi_login_register_callback') ) {

	function mi_login_register_callback() {	

		if (!class_exists('WooCommerce')) {
			return __('این بخش به افزونه ووکامرس نیازمند است', 'modista');
		}

		global $redux_mi_theme;

		// Register custom style.
		wp_enqueue_style( 'mi-login-register' );
		wp_enqueue_script( 'mi-login-register' );

		if (get_redux('auth_with_google_method') == 'gapi') {
			wp_enqueue_script( 'mi-gapi' );
		} else {
			wp_enqueue_script( 'mi-gsi' );
		}
		
					
		ob_start();
		get_template_part( 'template-parts/login-register');
		return ob_get_clean();
	}
}