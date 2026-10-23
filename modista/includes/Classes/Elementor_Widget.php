<?php

namespace Modista\Classes;

defined('ABSPATH') || exit; // Exit if accessed directly.

final class Elementor_Widget
{
    function __construct()
    {
        if ( ! $this->is_compatible() ) {
            return;
        }

        add_action( 'elementor/init', [ $this, 'init' ] );
        add_action('wp_enqueue_scripts', [$this, 'enqueue_assets_frontend']);
        add_action( 'elementor/preview/enqueue_scripts', [$this, 'enqueue_editor_scripts'] );

        $this->register_custom_fonts();
    }

    function init()
    {
        add_action('elementor/elements/categories_registered', [$this, 'register_widget_category']);
        add_action('elementor/widgets/register', [$this, 'register_widgets']);        
    }

    function register_widgets($widgets_manager)
    {
        // Base Widgets
        $base_widgets = [
            \Modista\Widgets\Base_Logo::class,
            \Modista\Widgets\Base_Search::class,
            \Modista\Widgets\Base_Nav_Menu::class,
            \Modista\Widgets\Base_Button_Login::class,
            \Modista\Widgets\Base_Toggle_Section::class,
            \Modista\Widgets\Base_Advance_Title::class,
            \Modista\Widgets\Base_Count_Down::class,
            \Modista\Widgets\Base_Button_Auto_Scroll::class,
            \Modista\Widgets\Base_Image_Box_Carousel::class,
            \Modista\Widgets\Base_Icon_Box_Grid::class,
            \Modista\Widgets\Base_Form_Submission::class,
        ];

        // Post Widgets
        $post_widgets = [
            \Modista\Widgets\Post_Category_Carousel::class, // Also for products
            \Modista\Widgets\Post_Card::class,
            \Modista\Widgets\Post_Card_Carousel::class,
        ];

        // Register all base widgets
        foreach (array_merge($base_widgets, $post_widgets) as $widget_class) {
            $widgets_manager->register(new $widget_class());
        }

        // WooCommerce Widgets
        if (class_exists('WooCommerce')) {
            $woo_widgets = [
                \Modista\Widgets\Woo_Mini_Cart::class,
                \Modista\Widgets\Woo_Product_Carousel::class,
                \Modista\Widgets\Woo_Product_Card::class,
                \Modista\Widgets\Woo_Product_Carousel_Slide::class,
                \Modista\Widgets\Woo_Product_Carousel_Tab::class,
                \Modista\Widgets\Woo_Product_Carousel_List::class,
            ];

            foreach ($woo_widgets as $widget_class) {
                $widgets_manager->register(new $widget_class());
            }
        }
    }

    function register_widget_category($elements_manager)
    {
        $elements_manager->add_category(
            'modista',
            [
                'title' => esc_html__( 'modista', 'modista' ),
                'icon' => 'fa fa-plug',
            ]
        );
    }

    /**
     * Register frontend widget-specific scripts and styles.
     *
     * @return void
     */
    public function enqueue_assets_frontend()
    {
        // Styles: Common widgets
        $widget_styles = [
            'mi-widget-nav-menu'                => '/assets/css/widgets/base-nav-menu.css',
            'mi-widget-button-login'            => '/assets/css/widgets/base-button-login.css',
            'mi-widget-toggle-section'              => '/assets/css/widgets/base-toggle-section.css',
            'mi-widget-post-category-carousel'  => '/assets/css/widgets/post-category-carousel.css',
        ];

        // Styles: Minified widgets
        $widget_styles = [
            'mi-bundle-widget'         => '/assets/css/widgets/widget.bundle.min.css',
        ];

        foreach ($widget_styles as $handle => $path) {
            wp_register_style($handle, MI_URL . $path);
        }

        // WooCommerce styles (if WC active)
        if (class_exists('WooCommerce')) {
            $woo_styles = [
                'mi-widget-woo-product-list' => '/assets/css/widgets/woo-product-list.css',
                'mi-widget-woo-card'         => '/assets/css/widgets/woo-card.css',
                'mi-widget-woo-mini-cart'    => '/assets/css/widgets/woo-mini-cart.css',
            ];

            // Styles: Minified widgets
            $woo_styles = [
                'mi-bundle-widget'         => '/assets/css/widgets/widget.bundle.min.css',
            ];

            foreach ($woo_styles as $handle => $path) {
                wp_register_style($handle, MI_URL . $path);
            }
        }

        // Scripts: Common widgets (register only)
        $widget_scripts = [
            'mi-base-carousel'              => '/assets/js/widgets/base-carousel.js',
            'mi-widget-nav-menu'            => '/assets/js/widgets/base-nav-menu.js',
            'mi-widget-toggle-section'      => '/assets/js/widgets/base-toggle-section.js',
            'mi-widget-countdown'           => '/assets/js/widgets/base-countdown.js',
            'mi-widget-button-auto-scroll'  => '/assets/js/widgets/base-button-auto-scroll.js',
            'mi-widget-form-submission'     => '/assets/js/widgets/base-form-submission.js',
            // Editor mode
            'mi-editor-base-carousel'       => '/assets/js/widgets/editor-base-carousel.js'
        ];

        // Styles: Minified widgets
        $widget_scripts = [
            'mi-bundle-widget'         => '/assets/js/widgets/widgets.bundle.min.js',
            // Editor mode
            'mi-editor-base-carousel'       => '/assets/js/widgets/editor-base-carousel.js'
        ];

        foreach ($widget_scripts as $handle => $path) {
            wp_register_script($handle, MI_URL . $path, [], null, true);
        }

        // WooCommerce widget scripts
        if (class_exists('WooCommerce')) {
            $woo_scripts = [
                'mi-widget-woo-mini-cart'     => '/assets/js/widgets/woo-mini-cart.js',
                'mi-widget-woo-product-slide' => '/assets/js/widgets/woo-product-slide.js',
                'mi-widget-woo-product-tab'   => '/assets/js/widgets/woo-product-tab.js',
                'mi-widget-woo-product-list'  => '/assets/js/widgets/woo-product-list.js',
            ];

            // Styles: Minified widgets
            $woo_scripts = [
                'mi-bundle-widgets' => '/assets/js/widgets/widgets.bundle.min.js',
            ];

            foreach ($woo_scripts as $handle => $path) {
                wp_register_script($handle, MI_URL . $path, [], null, true);
            }
        }
    }

    /**
     * Enqueue editor widget-specific scripts and styles.
     *
     * @return void
     */
    function enqueue_editor_scripts()
    {
        // Scripts: Common widgets (Editor mode)
        $widget_scripts = [
            'mi-editor-base-carousel'
        ];

        foreach ($widget_scripts as $handle) {
            wp_enqueue_script($handle);
        }
    }

    private function register_custom_fonts() {
        
        /**
         * Add fonts to the new font group
         */
        add_filter( 'elementor/fonts/additional_fonts', function( $additional_fonts ) {
            //Font name/font group
            $additional_fonts['Iransans'] = 'custom';
            return $additional_fonts;
        } );    
    }
    
    /**
     * Compatibility Checks
     *
     * Checks whether the site meets the addon requirement.
     *
     * @since 1.0.0
     * @access public
     */
    public function is_compatible() {

        // Check if Elementor is installed and activated
        if ( ! did_action( 'elementor/loaded' ) ) {
            add_action( 'admin_notices', [ $this, 'admin_notice_missing_main_plugin' ] );
            return false;
        }

        return true;
    }

    /**
     * Admin notice
     *
     * Warning when the site doesn't have Elementor installed or activated.
     *
     * @since 1.0.0
     * @access public
     */
    public function admin_notice_missing_main_plugin() {

        if ( isset( $_GET['activate'] ) ) unset( $_GET['activate'] );

        $message = sprintf(
        /* translators: 1: Plugin name 2: Elementor */
            esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'modista' ),
            '<strong>' . esc_html__( 'modista', 'modista' ) . '</strong>',
            '<strong>' . esc_html__( 'Elementor', 'modista' ) . '</strong>'
        );

        printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
    }
}