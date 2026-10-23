<?php

namespace Modista\Classes;

defined('ABSPATH') || exit; // Exit if accessed directly.

final class MI_Core
{
    /**
     * @since 1.0
     */
    public function __construct()
    {
        $this->init();
    }

    /**
     * @since 1.0
     */
    public function init()
    {
        $this->registerFiles();
        $this->registerHook();

        // Register translate.
        add_action('init', [$this, 'theme_translate']);
    }

    /**
     * @since 1.0
     */
    public function theme_translate()
    {
        // Localization
        load_theme_textdomain( 'modista', MI_PATH . '/languages/' );
        load_textdomain( 'elementor-pro', MI_PATH . '/languages/elementor-pro-fa_IR.mo' );
        load_textdomain( 'tgmpa', MI_PATH . '/languages/tgmpa-fa_IR.mo' );
    }

    /**
     * Any plugin or external source is called.
     *
     * @since 1.0
     */
    public function registerFiles()
    {
        // Require helper functions.
        require_once MI_PATH . '/includes/helper.php';
        // Require theme setting functions.
        require_once MI_PATH . '/includes/theme-settings.php';
	    // All process used in posts.
	    require_once MI_PATH . '/includes/post-functions.php';
	    require_once MI_PATH . '/includes/post-hook.php';
		// require WordPress custom widgets.
	    require_once MI_PATH . '/includes/register-wordpress-widgets.php';
        // Register shortcodes
	    require_once MI_PATH . '/includes/shortcodes-function.php';
	    require_once MI_PATH . '/includes/shortcodes-action.php';
        // Thert party plugins
        require_once MI_PATH . '/includes/Plugins/redux/redux-panel.php';
        require_once MI_PATH . '/includes/Plugins/jdf.php';
        require_once MI_PATH . '/includes/Plugins/tgm-plugin-activation.php';

        // woocommerce functions.
        if ( class_exists( 'WooCommerce' ) ) {
            require_once MI_PATH . '/includes/woocommerce-actions-function.php';
            require_once MI_PATH . '/includes/woocommerce-actions.php';
            require_once MI_PATH . '/includes/woocommerce-custom-fields.php';
        }
    }

    /**
     * Regsiter theme hooks
     *
     * @since 1.0
     */
    public function registerHook()
    {
        add_action( 'after_setup_theme', 'custom_theme_support' );
        // activate TGMPA plugin.
        add_action( 'tgmpa_register', 'dp_register_required_plugins' );
        // Register Menus
        add_action( 'init', 'dp_register_menus' );
        add_action('widgets_init', 'dp_widgets_init' );
		// Ordering handle in blog and archive of posts.
	    add_action('pre_get_posts', 'mi_pre_get_posts_orderby');
		// Handle view of posts.
	    add_action('wp', 'mi_increase_post_views');

		// /** Enable plugin updates with license check **/
		update_option( 'efa_2710_license_status', 'valid' );
		remove_action( 'admin_menu', 'efa_2710_license_menu' );
		add_action('admin_menu', function() {
			remove_submenu_page('elementor', 'elementor-license');
		}, 999);
    }
}