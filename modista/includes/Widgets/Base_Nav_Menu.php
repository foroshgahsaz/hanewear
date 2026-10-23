<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

use Elementor\Controls_Manager;

class Base_Nav_Menu extends \Elementor\Widget_Base {

    public function get_name() {
        return 'dp-nav-menu';
    }

    public function get_title() {
        return __( 'Nav Menu', 'modista' );
    }

    public function get_icon() {
        return 'eicon-nav-menu';
    }

    function get_keywords()
    {
        return ['nav', 'menu', __('menu', 'modista'), 'modista', __('modista', 'modista') ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    public function get_style_depends(): array {
        return [ 'mi-bundle-widget' ];

        return [ 'mi-widget-nav-menu' ];
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];

        return [ 'mi-widget-nav-menu' ];
    }

    protected function _register_controls() {

        // Controls for the content
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'nav_menu_name',
            [
                'label' => __( 'Menu Name', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Menu',
            ]
        );

        $this->add_control(
            'nav_menu_id',
            [
                'label' => __( 'Menu', 'modista' ),
                'description' => esc_html__( 'Go to the Menus screen to manage your menus.', 'modista' ),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_nav_menus(),
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER
            ]
        ); // DIVIDER

        $this->end_controls_section();
        // End controls for the content

        // Controls for style
        $this->start_controls_section(
            'container_section',
            [
                'label' => __( 'Container Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'mi_menu_orientation',
            [
                'label'   => __( 'Menu Orientation', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => __( 'Horizontal', 'modista' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'column' => [
                        'title' => __( 'Vertical', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'vertical',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list' => 'display: flex; flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_menu_align_items',
            [
                'label'   => __( 'Align Items', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Start', 'modista' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modista' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'End', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_menu_justify_content',
            [
                'label'   => __( 'Justify Content', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Start', 'modista' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modista' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'End', 'modista' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => __( 'Space Between', 'modista' ),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => __( 'Space Around', 'modista' ),
                        'icon'  => 'eicon-justify-space-around-h',
                    ],
                ],
                'default' => 'start',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_menu_gap',
            [
                'label' => __( 'Item Gap', 'modista' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_item_heading',
            [
                'label' => esc_html__( 'Items', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'mi_menu_item_orientation',
            [
                'label'   => __( 'Menu Orientation', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => __( 'Horizontal', 'modista' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'column' => [
                        'title' => __( 'Vertical', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'row',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list > .menu-item a' => 'display: flex; flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_menu_item_align_items',
            [
                'label'   => __( 'Align Items', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Start', 'modista' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modista' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'End', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list > .menu-item a' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_menu_item_justify_content',
            [
                'label'   => __( 'Justify Content', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Start', 'modista' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modista' ),
                        'icon'  => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => __( 'End', 'modista' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => __( 'Space Between', 'modista' ),
                        'icon'  => 'eicon-justify-space-between-h',
                    ],
                    'space-around' => [
                        'title' => __( 'Space Around', 'modista' ),
                        'icon'  => 'eicon-justify-space-around-h',
                    ],
                ],
                'default' => 'start',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list > .menu-item a' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'mi_menu_item_gap',
            [
                'label' => __( 'Item Gap', 'modista' ),
                'type'  => Controls_Manager::SLIDER,
                'size_units' => [ 'px', 'em', '%' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'em' => [
                        'min' => 0,
                        'max' => 5,
                        'step' => 0.1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 50,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 4,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list > .menu-item a' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mi_menu_item_typography',
                'selector' => '{{WRAPPER}} .mi-menu__list > .menu-item a',
            ]
        );

        $this->add_control(
            'mi_menu_item_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list > .menu-item a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'dropdown_style_section',
            [
                'label' => __( 'Dropdown Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'menu_dropdown_color',
            [
                'label' => __( 'Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-menu__list .menu-item-has-children .sub-menu' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();

        // For responseve
        $orientation_class[] = array_key_exists('mi_menu_orientation', $settings) ? 'mi-menu--' . $settings['mi_menu_orientation'] : '';
        $orientation_class[] = array_key_exists('mi_menu_orientation_tablet', $settings) ?
         'mi-menu-tablet--' . $settings['mi_menu_orientation_tablet'] : '';
        $orientation_class[] = array_key_exists('mi_menu_orientation_mobile', $settings) ?
         'mi-menu-mobile--' . $settings['mi_menu_orientation_mobile'] : '';

        $menu_class =  'menu mi-menu__list ' . trim(implode(' ', $orientation_class));
        
        wp_nav_menu( array(
            'menu'		    => $settings['nav_menu_id'], // Passed a menu ID.
            'walker'        => new \Modista\Classes\Mega_Menu_Walker(),
            'menu_class'    => $menu_class,
        ) );
    }

    /**
     * @return array
     */
    private function get_nav_menus() {

        // Returned
        $select = [];
        // Returns all navigation menu objects.
        $menus = wp_get_nav_menus();

        foreach ( $menus as $menu ) {
            $select[ $menu->term_id ] = $menu->name;
        }

        return $select;
    }
}
