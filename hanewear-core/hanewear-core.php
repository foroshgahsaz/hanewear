<?php
/**
 * Plugin Name: Hanewear Core
 * Description: سفارشی‌سازی‌های hanewear — Query ویجت‌های محصول Elementor
 * Version: 1.0.0
 * Author: Hanewear
 * Text Domain: hanewear-core
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

define( 'HANEWEAR_CORE_VERSION', '1.0.0' );
define( 'HANEWEAR_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'HANEWEAR_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once HANEWEAR_CORE_PATH . 'includes/Product_Query_Helper.php';

add_action( 'plugins_loaded', 'hanewear_core_bootstrap', 20 );

function hanewear_core_bootstrap() {
	if ( ! defined( 'ELEMENTOR_VERSION' ) ) {
		return;
	}

	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets/Woo_Product_Card.php';
	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets/Woo_Product_Carousel.php';
	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets/Woo_Product_Carousel_Slide.php';
	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets_Registry.php';

	Hanewear\Core\Elementor\Widgets_Registry::init();
}
