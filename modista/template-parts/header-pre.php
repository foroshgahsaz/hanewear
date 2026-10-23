<?php

defined('ABSPATH') || exit; // Exit if accessed directly.

if ( did_action( 'elementor/loaded' ) ) {

    global $redux_mi_theme;
    $pre_header_status = $redux_mi_theme['pre_header_status'] ?? false;
    $selected_section_id = $redux_mi_theme['pre_header_select'] ?? false;

    if ( $pre_header_status && $selected_section_id ) {
        \Modista\Classes\PostType_Modista_Library::load($selected_section_id);
    }
}