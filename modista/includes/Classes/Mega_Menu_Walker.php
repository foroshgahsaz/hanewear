<?php

namespace Modista\Classes;

class Mega_Menu_Walker extends \Walker_Nav_Menu {

    // Current item level
    private $item_lvl = 0;

    private $menu_gallery_images = null;
    private $menu_gallery_links = null;
    
    private $menu_carousel_images = null;
    private $menu_carousel_links = null;

    private $is_mega_menu = false;

    // Add filter on started each item. eg: <li>, <a>
    function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        if ( $depth === 0 ) {

            $mega_menu_status = get_post_meta( $item->ID, '_menu_item_mega_menu_status', true );
            $mega_menu_type = get_post_meta( $item->ID, '_menu_item_mega_menu_type', true );
            $this->is_mega_menu = ($mega_menu_status && $mega_menu_type);

            if ( $this->is_mega_menu ) {

                $item->classes[] = 'mi-menu__mega-menu';
                if ($mega_menu_type == 'default') $item->classes[] = 'mi-mega-menu--default';

                // Add gallery fields
                $this->menu_gallery_images  = get_post_meta($item->ID, '_menu_item_gallery', true); // Retrieve gallery images for current lvl
                $this->menu_gallery_links   = get_post_meta($item->ID, '_menu_item_gallery_links', true); // Retrieve gallery images Link for current lvl
                
                // Add carousel fields
                $this->menu_carousel_images  = get_post_meta($item->ID, '_menu_item_gallery_carouel', true); // Retrieve carouel images for current lvl
                $this->menu_carousel_links   = get_post_meta($item->ID, '_menu_item_gallery_carouel_links', true); // Retrieve carouel images Link for current lvl
            }
        }

        // Get item for items
        $icon_url = get_post_meta($item->ID, '_menu_item_icon', true);

        // Set menu depth level for style
        $item->classes[] = "menu-item--lvl-$depth";

        if ( $icon_url ) {

            $output .= "<li class='menu-item-has-icon" . implode(" ", $item->classes) . "'>";

            if ( strpos($icon_url, '.svg' ) !== false ) {
                
                $output .= '<a href="' . esc_url($item->url) . '" class="menu-item__link" >';
                $output .= '<div class="d-flex gap-2"><div class="menu-item__icon d-flex align-items-center">' . $this->print_item_url_to_svg($icon_url) . '</div>';
                $output .= $item->title . '</div>';
            }
            else {
                $output .= '<a href="' . esc_url($item->url) . '">';
                $output .= $item->title;
            }

            // Set arrow for has_children items.
            if ($depth === 0 && ( $args->walker->has_children || $this->is_mega_menu ) ) {
                $output .= '<div class="menu-item__arrow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="12" viewBox="0 0 16 22" fill="none">
                        <path d="M15.0211 9.34571L8.68778 15.4945C8.49612 15.718 8.24612 15.8125 8.00028 15.8125C7.75445 15.8125 7.50528 15.7185 7.31278 15.5305L0.97945 9.34571C0.5782 8.9504 0.561533 8.29727 0.940283 7.88477C1.3207 7.46797 1.95612 7.45508 2.35445 7.8461L8.00028 13.359L13.6461 7.8418C14.0445 7.45104 14.6774 7.46583 15.0603 7.88209C15.4378 8.29727 15.4211 8.9504 15.0211 9.34571Z" fill="#666666"></path>
                    </svg>
                </div>';
            }

            $output .= '</a>';
        }
        else {
            parent::start_el($output, $item, $depth, $args, $id);
        }
    }

    // Add filter on end each item. eg: </li>, </a>
    function end_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {

        if ($depth === 0) {

            $mega_menu_status       = get_post_meta( $item->ID, '_menu_item_mega_menu_status', true );
            $mega_menu_template_id  = get_post_meta( $item->ID, '_menu_item_mega_menu_selected', true );
            $mega_menu_type         = get_post_meta( $item->ID, '_menu_item_mega_menu_type', true );

            // Elementor mega menu
            if ( $mega_menu_status && $mega_menu_template_id && $mega_menu_type == 'elementor' ) {
                $output .= '<div class="mi-mega-menu__container">';
                $output .= do_shortcode('[elementor-template id="' . esc_attr($mega_menu_template_id) . '"]');
                $output .= '</div>';
            }
        }

        // Check if it is the last item at depth 1
        if ($depth === 1 ) {
            // if mega menu type is 'default'
            $mega_menu_type = get_post_meta( $item->menu_item_parent, '_menu_item_mega_menu_type', true );
            // Get banner data
            $menu_banner_src = get_post_meta( $item->menu_item_parent, '_menu_item_banner', true );

            // Render banner
            if ( $menu_banner_src && $mega_menu_type === 'default' ) {
                // Get banner url
                $menu_banner_url = get_post_meta( $item->menu_item_parent, '_menu_item_banner_url', true );

                $nav_menu_items = new \WP_Query([
                    'post_type'     => 'nav_menu_item',
                    'meta_key'      => '_menu_item_menu_item_parent',
                    'meta_value'    => $item->menu_item_parent,
                    'posts_per_page' => -1,
                ]);

                $this->item_lvl++;
            
                // Check is last item
                if ( count( $nav_menu_items->posts ) == $this->item_lvl ) {
                    // Close current item tag
                    $output .= '</li>';
                    // Set link for banner if exists
                    $output .= ($menu_banner_url) ? '<a href="' . esc_url($menu_banner_url) . '" class="mi-menu-item-1__banner-link">' : '';
                    // Set banner if exists
                    $output .= '<img src="' . esc_url($menu_banner_src) . '" alt="" class="mi-menu-item-1__banner-img">';

                    $output .= ($menu_banner_url) ? '</a>' : '';

                    $this->item_lvl = 0;

                    return;
                }
            }            
        }

        parent::end_el($output, $item, $depth, $args);
    }

    public function start_lvl(&$output, $depth = 0, $args = null)
    {
        // 
        if ( $this->is_mega_menu && $depth === 0 ) {        
            $output .= '<div class="sub-menu"><ul class="main-sub-menu flex-1">';
        } else {
            parent::start_lvl($output, $depth, $args);
        }
    }

    // Add filter on end each item. eg: </ul>
    public function end_lvl(&$output, $depth = 0, $args = null)
    {
        // Set side banner and category
        if ( $this->is_mega_menu && $depth === 0 ) {

            $output .= '</ul>';

            $output .= '<div class="menu-aside d-none d-lg-flex gap-3">';

            if ( !empty($this->menu_carousel_images) ) {
                $output .= $this->get_swiper_html();
            }
            if ( !empty($this->menu_gallery_images) ) {
                $output .= $this->get_gallery_html();
            }

            // Set null for next lvl
            $this->menu_gallery_images = null;

            $output .= '</div></div>';

        } else {
            parent::end_lvl($output, $depth, $args);
        }
    }

    private function get_swiper_html()
    {
        return '<div class="swiper slide-vertical--category loop-enabled" data-direction="vertical">
            <div class="swiper-wrapper">
                ' . $this->get_swiper_slides_html() . '
            </div>
        </div>';
    }

    private function get_swiper_slides_html()
    {       
        $slides_html = '';
        foreach ($this->menu_carousel_images as $index => $image_src) {
            $slides_html .= '
            <div class="swiper-slide"><a href="' . esc_url($this->menu_carousel_links[$index]) . '">
                <img src="' . esc_url($image_src) . '" alt="">
            </a></div>';
        }

        return $slides_html;
    }

    private function get_gallery_html()
    {
        $gallery_html = '<div class="mega-default__side-banner">';

        foreach ($this->menu_gallery_images as $index => $image_src) {
            $gallery_html .= '<a href="' . esc_url($this->menu_gallery_links[$index]) . '">';
            $gallery_html .= '<img width="220" src="' . esc_url($image_src) . '" alt="">';            
            $gallery_html .= '</a>';
        }

        $gallery_html .= '</div>';

        return $gallery_html;
    }

    // Used for render before icon in each menu item.
    private function print_item_url_to_svg($url)
    {
        $response = wp_remote_get($url);

        if ( !is_wp_error($response) ) {
            return wp_remote_retrieve_body( $response );
        }
    }
}