<?php
namespace Modista\Classes;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class Asset_Loader
{
    public function __construct()
    {
        add_action('wp_enqueue_scripts', [$this, 'enqueue_frontend_assets'], 30);
        add_action('admin_enqueue_scripts', [$this, 'enqueue_admin_assets']);
        add_action('wp_enqueue_scripts', [$this, 'deregister_default_scripts'], 10001);
        add_action('elementor/editor/before_enqueue_scripts', [$this, 'enqueue_editor_assets']);
        // Inline scripts 
        add_action('wp_head', [$this, 'output_inline_styles']);
        add_action('wp_footer', [$this, 'output_inline_script']);
        add_action('wp_body_open', [$this, 'output_inline_html']);
    }

    /**
     * Enqueue frontend styles and scripts.
     */
    public function enqueue_frontend_assets()
    {
        // ==== Styles ====
        wp_enqueue_style('mi-style', get_stylesheet_uri());

        $frontend_styles = [
            'mi-frontend'       => '/assets/css/frontend.min.css',
            'mi-swiper'       => '/assets/plugin/Swiper/swiper-bundle.min.css',
        ];

        foreach ($frontend_styles as $handle => $path) {
            wp_enqueue_style($handle, MI_URL . $path);
        }

        wp_enqueue_style('mi-custom', MI_URL . '/assets/css/custom.css', ['mi-frontend'], wp_get_theme()->get('Version'));

        // Optional font style
        if ( get_redux('basic_font_enable') == 1 ) {
            wp_enqueue_style('mi-font', MI_URL . '/assets/font/font-register.min.css');
        }

        // Login/Register CSS (only registered for specific pages)
        wp_register_style('mi-login-register', MI_URL . '/assets/css/login-register.min.css');

        // ==== Scripts ====
        $frontend_scripts = [
            'mi-swiper'   => '/assets/plugin/Swiper/swiper-bundle.min.js',
            'mi-frontend' => '/assets/js/frontend.min.js',
        ];

        foreach ($frontend_scripts as $handle => $path) {
            wp_enqueue_script($handle, MI_URL . $path, [], false, true);
        }

        // Login/Register Scripts (only registered)
        wp_register_script('mi-login-register', MI_URL . '/assets/js/login-register.min.js', [], false, true);
        if ( get_redux('mi_auth_with_google') == 1 ) {
            wp_register_script('mi-gsi', MI_URL . '/assets/plugin/google-services-identity.js', [], false, true);
            wp_register_script('mi-gapi','https://apis.google.com/js/api:client.js', [], false, false);
        }

        // Localize frontend script
        wp_localize_script('mi-frontend', 'mi_ajax_object', [
            'ajax_url'  => admin_url('admin-ajax.php'),
            'security'  => wp_create_nonce('update_action_nonce'),
        ]);

        // ==== WooCommerce Conditional Assets ====
        if (class_exists('WooCommerce')) {
            if (is_product()) {
                wp_enqueue_script('mi-single-product', MI_URL . '/assets/js/single-product.min.js', [], false, true);
                wp_enqueue_script('mi-micromodal', MI_URL . '/assets/plugin/micromodal.min.js', [], false, true);
            }
            if (is_account_page()) {
                wp_enqueue_style('mi-woocommerce-account', MI_URL . '/assets/css/woocommerce-account.min.css');
                wp_enqueue_script('mi-woocommerce-account', MI_URL . '/assets/js/woocommerce-account.min.js', [], false, true);
            }
            if (is_cart() || is_checkout()) {
                wp_enqueue_style('mi-shopping-route', MI_URL . '/assets/css/shopping-route.min.css');
            }
        }
    }

    /**
     * Enqueue admin dashboard assets.
     */
    public function enqueue_admin_assets()
    {
        wp_enqueue_style('mi-admin-main', MI_URL . '/assets/admin/css/main.css');

        wp_enqueue_media();
        wp_enqueue_script('mi-media-upload', MI_URL . '/assets/admin/js/media-upload.js', [], false, true);
        wp_enqueue_script('mi-admin-main', MI_URL . '/assets/admin/js/main.js', [], false, true);

        wp_localize_script('mi-admin-main', 'mi_ajax_object', [
            'ajax_url'  => admin_url('admin-ajax.php'),
            'security'  => wp_create_nonce('update_action_nonce'),
        ]);
    }

    /**
     * Deregister default styles (e.g., WooCommerce).
     */
    public function deregister_default_scripts()
    {
        if (class_exists('WooCommerce')) {
            $styles_to_deregister = ['woocommerce-layout', 'woocommerce-smallscreen'];

            if (!is_archive()) {
                $styles_to_deregister[] = 'woocommerce-general';
            }

            foreach ($styles_to_deregister as $style) {
                wp_deregister_style($style);
            }
        }
    }

    /**
     * Enqueue assets specifically for Elementor editor.
     */
    public function enqueue_editor_assets()
    {
        if (!empty($_GET['action']) && $_GET['action'] === 'elementor') {
            wp_enqueue_style('mi-admin-main', MI_URL . '/assets/admin/css/main.css');
        }
    }

    /**
     * Output preloader CSS inline in <head>.
     */
    public function output_inline_styles()
    {
        if ( get_redux('enable_preloader') == 1 ) {
            ?>
            <style id="preloader-inline-style">
                #preloader {
                    position: fixed;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: <?php echo esc_attr( get_redux('preloader_bg_color') ?? '#ffffff' ); ?>;
                    z-index: 9999;
                    display: flex;
                    justify-content: center;
                    align-items: center;
                    transition: opacity 0.5s ease;
                }
                .preloader-inner {
                    animation: pulse 1.5s infinite ease-in-out;
                }
                @keyframes pulse {
                    0% { transform: scale(1); opacity: 1; }
                    50% { transform: scale(1.1); opacity: 0.8; }
                    100% { transform: scale(1); opacity: 1; }
                }
                #preloader.hidden {
                    opacity: 0;
                    visibility: hidden;
                    pointer-events: none;
                }
                .preloader-logo {
                    max-width: 150px;
                    height: auto;
                }
            </style>
            <?php
        };

        $body_typo      = get_redux('body_typography')      ?? [];
        $heading_typo   = get_redux('heading_typography')   ?? [];
        $link_typo      = get_redux('link_typography')      ?? [];
        $button_typo    = get_redux('button_typography')   ?? [];
        $input_typo     = get_redux('input_typography')     ?? [];

        $primary_color      = get_redux('primary_color') ?? '#0D0C0C';
        $secondary_color    = get_redux('secondary_color') ?? '#FD5504';
        $btn_bg_color       = get_redux('button_bg_color') ?? '#FD5504';
        $btn_hover          = get_redux('button_hover_color') ?? '#FD5504';

        echo '<style id="modista-typography">';
			?>
			body,
			.rtl #wpadminbar *:not(.ab-icon),
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			div,a {
				font-family: Iransans, Tahoma;
			}
			@supports (font-variation-settings: normal) {
			body,
			h1,
			h2,
			h3,
			h4,
			h5,
			h6,
			div,a {
					font-family: Iransans, Tahoma;
					-moz-font-feature-settings: "ss02";
					-webkit-font-feature-settings: "ss02";
					font-feature-settings: "ss02";
					-moz-font-feature-settings: "ss03";
					-webkit-font-feature-settings: "ss03";
					font-feature-settings: "ss03";
					-moz-font-feature-settings: "ss04";
					-webkit-font-feature-settings: "ss04";
					font-feature-settings: "ss04";
					font-variation-settings: "DOTS" 4;
				}
			}
			<?php
        // Body
        if (!empty($body_typo)) {
            echo "body {";
            //if (!empty($body_typo['font-family'])) echo "font-family: {$body_typo['font-family']};";
            if (!empty($body_typo['font-size'])) echo "font-size: {$body_typo['font-size']};";
            if (!empty($body_typo['color'])) echo "color: {$body_typo['color']};";
            if (!empty($body_typo['line-height'])) echo "line-height: {$body_typo['line-height']};";
            echo "}";
        }

        // Titles
        if (!empty($heading_typo)) {
            echo "h1, h2, h3, h4, h5, h6 {";
            //if (!empty($heading_typo['font-family'])) echo "font-family: {$heading_typo['font-family']};";
            if (!empty($heading_typo['font-weight'])) echo "font-weight: {$heading_typo['font-weight']};";
            if (!empty($heading_typo['color'])) echo "color: {$heading_typo['color']};";
            echo "}";
        }

        // Links
        if (!empty($link_typo)) {
            echo "a {";
            //if (!empty($link_typo['font-family'])) echo "font-family: {$link_typo['font-family']};";
            if (!empty($link_typo['color'])) echo "color: {$link_typo['color']};";
            if (!empty($link_typo['font-weight'])) echo "font-weight: {$link_typo['font-weight']};";
            echo "}";
        }

        // Buttons
        if (!empty($button_typo)) {
            echo "button, .btn {";
            //if (!empty($button_typo['font-family'])) echo "font-family: {$button_typo['font-family']};";
            if (!empty($button_typo['font-size'])) echo "font-size: {$button_typo['font-size']};";
            if (!empty($button_typo['color'])) echo "color: {$button_typo['color']};";
            if (!empty($button_typo['font-weight'])) echo "font-weight: {$button_typo['font-weight']};";
            if (!empty($btn_bg_color)) echo "background: {$btn_bg_color};";
            echo "}";
            if (!empty($btn_hover)) echo "button:hover, .btn:hover { background: {$btn_hover}; }";
        }

        // Inputs
        if (!empty($input_typo)) {
            echo "input, textarea, select {";
            //if (!empty($input_typo['font-family'])) echo "font-family: {$button_typo['font-family']};";
            if (!empty($input_typo['font-size'])) echo "font-size: {$button_typo['font-size']};";
            if (!empty($input_typo['color'])) echo "color: {$button_typo['color']};";
            if (!empty($input_typo['font-weight'])) echo "font-weight: {$button_typo['font-weight']};";
            echo "}";
        }

        // Main Color
        echo ".theme-modista { 
            --mi-color-primary: {$primary_color};
            --mi-color-secondary: {$secondary_color};
            --e-global-color-primary: {$primary_color} !important;
            --e-global-color-secondary: {$secondary_color} !important;
            --e-global-color-accent: {$secondary_color} !important;
        }";

        echo '</style>';
    }

    /**
     * Output preloader HTML right after <body>.
     */
    public function output_inline_html()
    {
        // Preloader html
        if (get_redux('enable_preloader') == 1) {

        $preloader_logo = (array) get_redux('preloader_logo');
        $logo_url = $preloader_logo['url'] ?? '';
        ?>
        <div id="preloader">
            <div class="preloader-inner">
                <?php if ($logo_url): ?>
                    <img src="<?= esc_url($logo_url); ?>" alt="Loading..." class="preloader-logo" />
                <?php else: ?>
                    <div class="preloader-default"><?php echo __('Loading', 'modista') . '...'; ?></div>
                <?php endif; ?>
            </div>
        </div>
        <?php
        }
    }

    /**
     * Output preloader JS inline in footer.
     */
    public function output_inline_script()
    {
        
        if (get_redux('enable_preloader') == 1) {
        ?>
            <script id="preloader-inline-script">
                document.addEventListener('DOMContentLoaded', function () {
                    window.addEventListener('load', function () {
                        const preloader = document.getElementById('preloader');
                        if (preloader) {
                            preloader.classList.add('hidden');
                            setTimeout(() => preloader.remove(), 600);
                        }
                    });
                });
            </script>
        <?php
        }
    }
}