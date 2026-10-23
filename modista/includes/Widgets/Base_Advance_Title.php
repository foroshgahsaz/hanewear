<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Base_Advance_Title extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi_advance_title';
    }

    public function get_title() {
        return __( 'Advance Title', 'modista' );
    }

    public function get_icon() {
        return 'eicon-heading';
    }

    function get_keywords()
    {
        return ['advance title', __('advance title', 'modista'), 'modista', __('modista', 'modista') ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    protected function register_controls() {

        // Controls for the content.
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Advance Title', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Add Text control
        $this->add_control(
            'title_first',
            [
                'label' => __( 'Title First', 'modista' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'مدیستا', 'modista' ),
            ]
        );

        // Add Text control
        $this->add_control(
            'title_second',
            [
                'label' => __( 'Title Second', 'modista' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __( 'ساده و سریع', 'modista' ),
            ]
        );

        $this->add_control(
            'content_title_first_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER
            ]
        );

        // Add spacing control
        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Spacing', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%', 'em'],
                'range' => [
                    'px' => ['min' => 0, 'max' => 100],
                    '%' => ['min' => 0, 'max' => 100],
                    'em' => ['min' => 0, 'max' => 10],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-title-advance--second' => 'padding-inline-start: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        // Add tag control
        $this->add_control(
            'title_tag',
            [
                'label' => __( 'HTML Tag', 'modista' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'h2',
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'DIV',
                    'span' => 'SPAN',
                    'p' => 'P',
                ],
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        // Controls for style.
        $this->start_controls_section(
            'container_section',
            [
                'label' => __( 'Advance Title', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'alignment',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'right',
                'options' => [
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'justify' => [
                        'title' => esc_html__( 'Justify', 'elementor' ),
                        'icon' => 'eicon-text-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-title-advance' => 'text-align: {{VALUE}};',
                ],
            ]
        );


        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_first_typography',
                'selector' => '{{WRAPPER}} .mi-title-advance',
            ]
        );

        $this->add_control(
            'title_first_color',
            [
                'label' => esc_html__( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-title-advance' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_first_background_color',
            [
                'label' => esc_html__( 'Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-title-advance' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_first_hr',
            [
                'type' => \Elementor\Controls_Manager::DIVIDER
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'title_second_typography',
                'selector' => '{{WRAPPER}} .mi-title-advance--second',
            ]
        );

        $this->add_control(
            'title_second_color',
            [
                'label' => esc_html__( 'Second Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-title-advance--second' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'title_second_background_color',
            [
                'label' => esc_html__( 'Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-title-advance--second' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        // End controls for style.

    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $tag = isset($settings['title_tag']) ? $settings['title_tag'] : 'h2';

        $this->add_render_attribute('title_first', 'class', 'mi-title-advance');
        $this->add_render_attribute('title_second', 'class', 'mi-title-advance--second');

        echo '<' . esc_attr($tag) . ' ' . $this->get_render_attribute_string('title_first') . '>';
        echo  $settings['title_first'];
        echo '<span ' . $this->get_render_attribute_string('title_second') . '>' . $settings['title_second'] . '</span>';
        echo '</' . esc_attr($tag) . '>';
    }

}
