<?php
/**
 * The header for our theme
 *
 * Displays all the head element and everything up till the "content" div.
 *
 * @package Custom Elementor Theme
 */

defined('ABSPATH') || exit; // Exit if accessed directly.

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>    
</head>
<body <?php body_class(); ?>><?php wp_body_open(); ?>
<?php
    if ( did_action( 'elementor/loaded' ) && function_exists( 'elementor_theme_do_location' ) &&
     elementor_theme_do_location( 'header' ) ) {
        elementor_theme_do_location( 'header' );
    } else {
        get_template_part( 'template-parts/header' );
    } 
?>