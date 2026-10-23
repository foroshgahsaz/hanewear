<?php

namespace Modista\Classes;

defined('ABSPATH') || exit; // Exit if accessed directly.

class PostType_Modista_Library extends PostType
{
    public function __construct()
    {
        // Set post type slug/id
        $this->post_type_key = 'modista_library';

        // Set labels
        $this->labels = array(
            'name'                  =>  __('سازنده قالب(مدیستا)', 'modista'),
            'singular_name'         =>  __('سازنده قالب(مدیستا)', 'modista'),
            'menu_name'             =>  __('سازنده قالب(مدیستا)', 'modista'),
            'add_new_item'               => __( 'افزودن جدید', 'modista' ),
        );

         $this->show_in_menu  = 'edit.php?post_type=elementor_library';

         parent::__construct();
    }

    /**
     * Load tempaltes section
     * first load with elmentor if not loaded, load with default process
     */
	public static function load( $postID ) {
		if ( did_action( 'elementor/loaded' ) && $postID ) {

			if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($postID)) {
				echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($postID);
			} else {
				$post = get_post($postID);
                if ($post) {
                    echo apply_filters('the_content', $post->post_content);
                }
			}

			wp_reset_postdata();
		}
	}
}