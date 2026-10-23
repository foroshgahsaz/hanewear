<?php
/**
 * ReduxFramework Config File
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

if ( ! class_exists( 'Redux' ) ) {
	return;
}

// This is your option name where all the Redux data is stored.
$opt_name = 'modista';

$theme = wp_get_theme(); // For use with some settings. Not necessary.

/**
 * GLOBAL ARGUMENTS
 * All the possible arguments for Redux.
 * For full documentation on arguments, please refer to: @link https://github.com/ReduxFramework/ReduxFramework/wiki/Arguments
 */
$args = array(
    'display_name'         => $theme->get( 'Name' ),
    'display_version'      => $theme->get( 'Version' ),
    'menu_title'           => __( 'مدیستا', 'modista' ),
    // Enable basic customizer support.
    'customizer'           => false,
    // Show the panel pages on the admin bar.
    'admin_bar'            => false,
    // Specify a custom URL to an icon.
    'menu_icon'            => MI_URL . '/assets/admin/image/logo.svg',
    // Order where the menu appears in the admin area. If there is any conflict, something will not show. Warning.
    'page_priority'         => 90,
    'global_variable'       => 'redux_mi_theme',
    'dev_mode'              => false,
    'show_import_export'       => false,
);

// Boot with setting args
Redux::set_args( $opt_name, $args );

$sections_path = __DIR__ . DIRECTORY_SEPARATOR . 'sections' . DIRECTORY_SEPARATOR;

$default_pathes = [
    'global',
    'sections',
	'typography',
	'colors',
	'single-post',
    'post-archive',
    'single-product',
    'product-archive',
	'pre-loader'
];

foreach ($default_pathes as $path) {
    require_once $sections_path . $path . '.php';
}