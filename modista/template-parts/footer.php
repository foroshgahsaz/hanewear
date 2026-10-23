<?php

if ( did_action( 'elementor/loaded' ) ) {
        
    global $redux_mi_theme;
    
    $selected_section_id = $redux_mi_theme['main_footer_select'] ?? false;

    if ( $selected_section_id ) {

        if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($selected_section_id)) {
            echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($selected_section_id);
        } else {
            $post = get_post($selected_section_id);
            apply_filters('the_content', $post->post_content);
            the_content();
        }
    }
}