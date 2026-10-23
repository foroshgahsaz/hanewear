<?php

namespace Modista\Classes;

defined('ABSPATH') || exit; // Exit if accessed directly.

abstract class PostType
{
    /**
     * Property
     * Args register new post type
     */
    protected $labels = [],
        $description,
        $public,
        $publicly_queryable,
        $show_ui,
        $show_in_menu = true,
        $query_var,
        $rewrite = [],
        $capability_type,
        $has_archive,
        $hierarchical,
        $menu_position,
        $menu_icon,
        $supports,
        $post_type_key,
        $single_page_name = null;

    protected function __construct()
    {
        $this->public = true;
        $this->publicly_queryable = true;
        $this->show_ui = true;
        $this->query_var = true;
        $this->capability_type = 'post';
        $this->has_archive = true;
        $this->hierarchical = true;
        $this->supports = ['title', 'editor', 'author', 'thumbnail'];
        
        add_action('init', [$this, 'register_custom_post_type']);
    }

    /**
     * Register
     */
    public function register_custom_post_type()
    {
        $args = [
            'labels' => $this->labels,
            'description' => $this->description,
            'public' => $this->public,
            'publicly_queryable' => $this->publicly_queryable,
            'show_ui' => $this->show_ui,
            'show_in_menu' => $this->show_in_menu,
            'query_var' => $this->query_var,
            'rewrite' => $this->rewrite,
            'capability_type' => $this->capability_type,
            'has_archive' => $this->has_archive,
            'hierarchical' => $this->hierarchical,
            'menu_position' => $this->menu_position,
            'menu_icon' => $this->menu_icon,
            'supports' => $this->supports
        ];
        
        register_post_type( $this->post_type_key, $args );
    }

    /**
     * Register Custom post type template
     * eg: add_filter( 'single_template', [$this, 'register_custom_template_post_type'] );
     *
     * @param $single_template
     * @return mixed|string
     */
    protected function register_custom_template_post_type( $single_template )
    {
        $file = MI_PATH . '/templates/' . $this->single_page_name . '-singular.php';

        if( ! is_null($this->single_page_name) && file_exists( $file ) ) $single_template = $file;

        return $single_template;
    }
}