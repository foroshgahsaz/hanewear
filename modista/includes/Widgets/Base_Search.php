<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit;

class Base_Search extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-search-widget';
    }

    public function get_title() {
        return __('Search Widget', 'modista');
    }

    public function get_icon() {
        return 'eicon-search';
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    protected function register_controls() {
        $this->start_controls_section(
            'search_section',
            [
                'label' => __( 'Search Settings', 'modista' ),
            ]
        );

        $this->add_control(
            'placeholder_text',
            [
                'label' => __( 'Placeholder Text', 'modista' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Search...', 'modista' ),
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'modista' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'Search', 'modista' ),
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => esc_html__( 'Icon', 'modista' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'fas fa-circle',
                    'library' => 'fa-solid',
                ],
                'recommended' => [
                    'fa-solid' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                    'fa-regular' => [
                        'circle',
                        'dot-circle',
                        'square-full',
                    ],
                ],
            ]
        );

        $this->add_control(
            'button_icon_only',
            [
                'label' => __( 'Only Icon for Button', 'modista' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'modista' ),
                'label_off' => __( 'No', 'modista' ),
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_section',
            [
                'label' => __( 'Search Style', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'mi_search_form_heading',
            [
                'label' => esc_html__( 'Form Style', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'search_form_width',
            [
                'label' => __( 'Search Form Width', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0
                    ],
                ],
                'mobile_default' => [
                    'size' => 100,
                    'unit' => '%',
                ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'search_form_padding',
            [
                'label' => __( 'Search Form Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 8,
                    'right' => 10,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mi_search_form_gap',
            [
                'label' => __( 'Search Form Gap', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 8
                ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'search_form_color',
            [
                'label' => __( 'Search Form Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} form' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'search_input_border',
                'selector' => '{{WRAPPER}} form',
            ]
        );

        $this->add_control(
            'search_form_radius',
            [
                'label' => __( 'Search Form Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 16,
                    'right' => 16,
                    'bottom' => 16,
                    'left' => 16,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} form' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        // Input element
        $this->add_control(
            'mi_search_input_heading',
            [
                'label' => esc_html__( 'Input Style', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'search_input_typography',
                'selector' => '{{WRAPPER}} .search-input',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'search_input',
                'selector' => '{{WRAPPER}} .search-input',
            ]
        );

        $this->add_control(
            'mi_search_input_width',
            [
                'label' => __( 'Search Input Width', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0
                    ],
                ],
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-input' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mi_search_input_padding',
            [
                'label' => __( 'Search Input Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 8,
                    'right' => 10,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'search_input_radius',
            [
                'label' => __( 'Search Input Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 16,
                    'right' => 16,
                    'bottom' => 16,
                    'left' => 16,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'mi_search_input_color',
            [
                'label' => __( 'Search Input Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .search-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'mi_search_input_text_color',
            [
                'label' => __( 'Search Input Text Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        // Button element
        $this->add_control(
            'mi_search_button_options',
            [
                'label' => esc_html__( 'Button Style', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'mi_search_input_button_typography',
                'selector' => '{{WRAPPER}} .search-button',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'mi_search_input_button',
                'selector' => '{{WRAPPER}} .search-button',
            ]
        );

        $this->add_control(
            'button_icon_size',
            [
                'label' => __( 'Button Icon Size', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => 0
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-button img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .search-button svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => __( 'Button Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => 6,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}} !important;',
                ],
            ]
        );

        $this->add_control(
            'mi_button_input_radius',
            [
                'label' => __( 'Search Button Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 12,
                    'left' => 12,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .search-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Button Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_text_color',
            [
                'label' => __( 'Button Text Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .search-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $placeholder_text = !empty( $settings['placeholder_text'] ) ? $settings['placeholder_text'] : __( 'Search...', 'modista' );
        $button_text = !empty( $settings['button_text'] ) ? $settings['button_text'] : __( 'Search', 'modista' );
        $button_icon_only = 'yes' === $settings['button_icon_only'];

        echo '<div class="search-widget">';
        echo '<form action="' . esc_url( home_url( '/' ) ) . '" method="get" class="search-form d-flex align-items-center flex-row">';
        echo '<input type="text" name="s" placeholder="' . esc_attr( $placeholder_text ) . '" class="search-input" />';
        
        if(class_exists('WooCommerce')) { echo '<input type="hidden" name="post_type" value="product" />'; }

        echo '<button type="submit" class="search-button d-flex align-items-center flex-row">';

        if ($settings['button_icon']['library'] == 'svg'):
            echo '<img src="' . $settings['button_icon']['value']['url'] . '" alt="Search Icon" class="search-svg-icon">';
        else:
            \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
        endif;

        if ( ! $button_icon_only)  {
            echo '<span>' . esc_html( $button_text ) . '</span>';
        }

        echo '</button>';
        echo '</form>';
        echo '</div>';
    }
}
