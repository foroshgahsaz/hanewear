<?php
/**
 * The helper functions to show data for the templates.
 *
 * @since 1.0.1
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Get key from redux options
if ( !function_exists('get_redux') ) {

    function get_redux($key_name)
    {
        global $redux_mi_theme;

        if ($redux_mi_theme && is_array($redux_mi_theme) && array_key_exists($key_name, $redux_mi_theme)) {
            return $redux_mi_theme[$key_name];
        }

        return false;
    }
}

// Log data
if ( !function_exists('cmb_log') ) {
    function cmb_log($data)
    {
        error_log(print_r($data, true));
    }
}