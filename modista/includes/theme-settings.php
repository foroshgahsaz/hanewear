<?php 

defined('ABSPATH') || exit; // Exit if accessed directly.

/**
 * Register the required plugins for this theme.
 *
 * This function is hooked into `tgmpa_register` in modista->init, which is fired on the WP `init` action on priority 10.
 */
function dp_register_required_plugins() {

    // Array of plugin arrays. Required keys are name and slug.
    $plugins = array(
        // Require Redux Framework plugin.
        array(
            'name'      => __( 'پنل مدیریت ریداکس', 'modista' ),
            'slug'      => 'redux-framework',
            'required'  => true,
        ),
        // Require Elementor.
        array(
            'name'      => __( 'المنتور', 'modista' ),
            'slug'      => 'elementor',
            'required'  => true,
        ),
        // Suggest Elementor pro.
        array(
            'name'      => __( 'المنتور پرو', 'modista' ),
            'slug'      => 'elementor-pro',
            'source'    => ''
        )
    );

    // Array of configuration settings. Amend each line as needed.
    $config = array(
        'id'           => 'modista',                 // Unique ID for hashing notices for multiple instances of TGMPA.
        'default_path' => '',                      // Default absolute path to bundled plugins.
        'menu'         => 'modista-install-plugins', // Menu slug.
        'parent_slug'  => 'themes.php',            // Parent menu slug.
        'capability'   => 'edit_theme_options',    // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
        'has_notices'  => true,                    // Show admin notices or not.
        'dismissable'  => false,                    // If false, a user cannot dismiss the nag message.
        'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
        'is_automatic' => false,                   // Automatically activate plugins after installation or not.
        'message'      => '',                      // Message to output right before the plugins table.

        'strings'      => array(
            'page_title'                      => __( 'پلاگین های مورد نیاز را نصب کنید', 'modista' ),
            'menu_title'                      => __( 'نصب پلاگین ها', 'modista' )
        ),
    );

    tgmpa( $plugins, $config );
}

function dp_register_menus() {

    register_nav_menus([
        'primary_menu' => __('primary menu', 'modista'),
    ]);
}

// Add sidebars
function dp_widgets_init() {

    register_sidebar( array(
        'name'          => __( 'Sidebar', 'modista' ),
        'id'            => 'sidebar',
        'description'   => __( 'Widgets in this area will be shown on Blog page.', 'modista' ),
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget'  => '</div>',
        'before_title'  => '<h2 class="widgettitle">',
        'after_title'   => '</h2>',
    ) );

	register_sidebar( array(
		'name'          => __( 'Shop Sidebar', 'modista' ),
		'id'            => 'sidebar-shop',
		'description'   => __( 'Widgets in this area will be shown on shop page.', 'modista' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<h2 class="widgettitle">',
		'after_title'   => '</h2>',
	) );
}

function custom_theme_support() {

	// Base theme supports.
	add_theme_support(
		'custom-logo',
		[
			'height'      => 48,
			'width'       => 160,
			'flex-height' => true,
			'flex-width'  => true,
		]
	);
    
    add_theme_support( 'title-tag' );

	// Plugins theme supports.
    add_theme_support( 'elementor' );
	add_theme_support( 'woocommerce' );

    add_image_size('mi_100', 100, 100, false);
}