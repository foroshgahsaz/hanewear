<?php

namespace Modista\Widgets;


defined('ABSPATH') || exit; // Exit if accessed directly.

class Base_Count_Down extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-countdown';
    }

    public function get_title() {
        return __('CountDown', 'modista');
    }

    public function get_icon() {
        return 'eicon-countdown';
    }

    public function get_categories() {
        return ['modista'];
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];
        return ['mi-widget-countdown'];
    }

    protected function _register_controls() {

        // Content Section
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Countdown', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'due_date',
            [
                'label' => esc_html__( 'Due Date', 'modista' ),
                'type' => \Elementor\Controls_Manager::DATE_TIME,
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Countdown', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_direction',
            [
                'label' => esc_html__( 'Container Direction', 'modista' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'row',
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Row', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'modista' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'elementor' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'modista' ),
                        'icon' => 'eicon-v-align-top',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_gap',
            [
                'label' => __( 'Gap', 'modista' ),
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
                    'size' => 8,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'container_border_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'container_typography',
                'selector' => '{{WRAPPER}} .mi-countdown span',
            ]
        );

        $this->add_control(
            'container_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown' => 'color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'container_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown' => 'background-color: {{VALUE}};',
                ],
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'container_border',
                'selector' => '{{WRAPPER}} .mi-countdown',
            ]
        );

        $this->add_control(
            'heading_item',
            [
                'label' => esc_html__( 'Item', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'item_direction',
            [
                'label' => esc_html__( 'Item Direction', 'modista' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'column',
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'Row', 'modista' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'modista' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => esc_html__( 'Column', 'elementor' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'Column Reverse', 'modista' ),
                        'icon' => 'eicon-v-align-top',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown > div' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_width',
            [
                'label' => __( 'Width', 'modista' ),
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
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown > div' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_text_alignment',
            [
                'label' => esc_html__( 'Alignment', 'modista' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'modista' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'modista' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'modista' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown > div' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'item_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown > div' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_border_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown > div' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .mi-countdown > div',
            ]
        );

        $this->add_control(
            'item_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown > div' => 'background-color: {{VALUE}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_responsive_control(
            'item_divider',
            [
                'label' => __( 'Divider Width', 'modista' ),
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
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown .digits' => 'border-bottom: {{SIZE}}{{UNIT}} solid; padding-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item_divider_background_color',
            [
                'label' => esc_html__( 'Divider Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown .digits' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'heading_digits',
            [
                'label' => esc_html__( 'Digits', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'digits_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown .digits' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'digits_typography',
                'selector' => '{{WRAPPER}} .mi-countdown .digits',
            ]
        );

        $this->add_control(
            'heading_label',
            [
                'label' => esc_html__( 'Label', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'label_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-countdown .label' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'label_typography',
                'selector' => '{{WRAPPER}} .mi-countdown .label',
            ]
        );

        $this->end_controls_section();

    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $due_date = $settings['due_date'];
        ?>

        <div class="mi-countdown d-flex" data-due-date="<?php echo esc_html($due_date); ?>">                                
            <div class="d-flex mi-countdown__second">
                <span class="digits">00</span>
                <span class="label"><?php echo __('ثانیه', 'modista'); ?></span>
            </div>
            <div class="d-flex mi-countdown__minute">
                <span class="digits">00</span>
                <span class="label"><?php echo __('دقیقه', 'modista'); ?></span>
            </div>
            <div class="d-flex mi-countdown__hour">
                <span class="digits">00</span>
                <span class="label"><?php echo __('ساعت', 'modista'); ?></span>
            </div>
            <div class="d-flex mi-countdown__day">
                <span class="digits">00</span>
                <span class="label"><?php echo __('روز', 'modista'); ?></span>
            </div>
        </div>
    <?php
    }
}
