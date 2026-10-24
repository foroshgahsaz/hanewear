<?php
/**
 * Plugin Name: Hanewear Core
 * Description: سفارشی‌سازی‌های hanewear — Query ویجت‌های محصول Elementor
 * Version: 1.0.1
 * Author: Hanewear
 * Text Domain: hanewear-core
 * Requires at least: 6.0
 * Requires PHP: 7.4
 */

defined( 'ABSPATH' ) || exit;

define( 'HANEWEAR_CORE_VERSION', '1.0.1' );
define( 'HANEWEAR_CORE_PATH', plugin_dir_path( __FILE__ ) );
define( 'HANEWEAR_CORE_URL', plugin_dir_url( __FILE__ ) );

require_once HANEWEAR_CORE_PATH . 'includes/Product_Query_Helper.php';

/**
 * Elementor loads Widget_Base only after elementor/loaded — not on plugins_loaded.
 */
add_action( 'elementor/loaded', 'hanewear_core_bootstrap' );

function hanewear_core_bootstrap() {
	if ( ! class_exists( 'WooCommerce' ) ) {
		return;
	}

	if ( ! class_exists( '\Elementor\Widget_Base' ) ) {
		return;
	}

	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets/Woo_Product_Card.php';
	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets/Woo_Product_Carousel.php';
	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets/Woo_Product_Carousel_Slide.php';
	require_once HANEWEAR_CORE_PATH . 'includes/Elementor/Widgets_Registry.php';

	Hanewear\Core\Elementor\Widgets_Registry::init();
}

add_action(
	'admin_notices',
	function () {
		if ( ! current_user_can( 'activate_plugins' ) ) {
			return;
		}

		if ( defined( 'ELEMENTOR_VERSION' ) ) {
			return;
		}

		echo '<div class="notice notice-error"><p>';
		echo esc_html__( 'Hanewear Core نیاز به افزونه Elementor دارد. لطفاً Elementor را نصب و فعال کنید.', 'hanewear-core' );
		echo '</p></div>';
	}
);
