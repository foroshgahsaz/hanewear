<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

use Modista\Classes\Elementor_Controls_Helper;

class Base_Icon_Box_Grid extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-icon-box-grid';
    }

    public function get_title() {
        return __('Icon Box Grid', 'modista');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }


    public function get_categories() {
        return ['modista'];
    }

    protected function register_controls() {

        // Tabs Settings
        $this->start_controls_section(
            'list_section',
            [
                'label' => __('List', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
             [
                'label' => __('Media', 'modista'),
                'type' => \Elementor\Controls_Manager::MEDIA,
                 'media_types' => ['image', 'svg']
            ],
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'modista'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'modista'),
                'label_block' => true
            ],
        );

        $repeater->add_control(
            'link',
            [
                'label' => esc_html__( 'Box Link', 'modista' ),
                'type' => \Elementor\Controls_Manager::URL,
                'options' => [ 'url', 'is_external', 'nofollow' ],
                'label_block' => true,
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => __('Items', 'modista'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Style layout
        $this->start_controls_section(
            'style_section_layout',
            [
                'label' => __('Layout', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'direction_gap',
            [
                'label' => esc_html__( 'Gap', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-icon-box' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            "direction_wrap",
            [
                'label' => esc_html__( 'Flex Wrap', 'modista' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'nowrap' => [
                        'title' => esc_html__( 'No Wrap', 'modista' ),
                        'icon' => 'eicon-nowrap',
                    ],
                    'wrap' => [
                        'title' => esc_html__( 'Wrap', 'modista' ),
                        'icon' => 'eicon-wrap',
                    ],
                ],
                'default' => 'wrap',
                'selectors' => [
                    '{{WRAPPER}} .mi-icon-box' => 'flex-wrap: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            "direction_overflow",
            [
                'label' => esc_html__( 'OverFlow', 'modista' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'visible' => [
                        'title' => esc_html__( 'Visible', 'modista' ),
                        'icon' => 'eicon-container-grid',
                    ],
                    'scroll' => [
                        'title' => esc_html__( 'Scroll', 'modista' ),
                        'icon' => 'eicon-inner-container',
                    ],
                ],
                'default' => 'visible',
                'selectors' => [
                    '{{WRAPPER}} .mi-icon-box' => 'overflow-x: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Item body
        $this->start_controls_section(
            'style_section_card_body',
            [
                'label' => __('Item', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'width_item',
            [
                'label' => esc_html__( 'Width', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom'],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-icon-box__item' => 'min-width: {{SIZE}}{{UNIT}}; width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        Elementor_Controls_Helper::get_box_style_controls($this, 'item', '.mi-icon-box__item');

        $this->add_control(
            'title_heading',
            [
                'label' => esc_html__( 'Title', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'title_rotate',
            [
                'label' => esc_html__( 'Rotate', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 360,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-icon-box span' => 'rotate: {{SIZE}}deg;',
                ],
            ]
        );

        $this->add_responsive_control(
            'title_width',
            [
                'label' => esc_html__( 'Width', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-icon-box span' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        Elementor_Controls_Helper::get_text_style_controls($this, 'item_title', '.mi-icon-box__item span');

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $items = $settings['items'];

        if ( ! empty($items) ) {
            ?>
            <div class="mi-icon-box d-flex hide-scroll">
                <?php
                foreach ($items as $index => $item) {

                     // Render link
                    if ( ! empty($item['link']['url']) ) {
                        $this->add_link_attributes( $index . 'link', $item['link'] );
                        ?>
                        <a <?php $this->print_render_attribute_string( $index . 'link'); ?> class="mi-icon-box__item d-flex" >
                    <?php
                    } else {
                        echo '<div class="mi-icon-box__item d-flex">';
                    }

                    // Render image
                    if ( ! empty( $item['image']['url'] ) ) {
                        echo '<img src="' . $item['image']['url'] . '">';
                    }
                    // Render title
                    if ( $item['title'] !== '' ) {
                        echo '<span>' . esc_html($item['title']) . '</span>';
                    }

                    echo ( ! empty($item['link']['url']) ) ? '</a>' : '</div>' ;
                }
            echo '</div>';
        }
    }
}
