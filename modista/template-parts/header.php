<?php

defined('ABSPATH') || exit; // Exit if accessed directly.

// Get pre header.
get_template_part('template-parts/header', 'pre');

// Get Header section.
if ( did_action( 'elementor/loaded' ) ) {
    
    global $redux_mi_theme;
    $selected_section_id = $redux_mi_theme['main_header_select'] ?? false;

    if ( $selected_section_id ) {        
        \Modista\Classes\PostType_Modista_Library::load($selected_section_id);
    }
}