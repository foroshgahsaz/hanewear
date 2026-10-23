<?php

namespace Modista\Widgets;

use Elementor\Controls_Manager;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Base_Toggle_Section extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-toggle-section';
    }

    public function get_title() {
        return __( 'Toggle Section', 'modista' );
    }

    public function get_icon() {
        return 'eicon-toggle';
    }

    public function get_keywords() {
        return [ 'toggle', __('Toggle Section', 'modista'), 'modista' ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    public function get_style_depends(): array {
        return [ 'mi-bundle-widget' ];

        return [ 'mi-widget-toggle-section' ];
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];

        return ['mi-widget-toggle-section'];
    }

    protected function _register_controls() {

        $this->start_controls_section(
            'section_toggle_content',
            [
                'label' => __( 'Toggle Section Content', 'modista' ),
            ]
        );

        $this->add_control(
            'selected_section',
            [
                'label' => __( 'Select Section', 'modista' ),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_modista_library_posts(),
                'multiple' => false,
                'label_block' => true,
            ]
        );

        $this->add_control(
            'content_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('دکمه باز کننده', 'modista'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'toggle_icon',
            [
                'label'     => __( 'Icon', 'modista' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'toggle_close_heading',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('دکمه بستن', 'modista'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'toggle_close_icon',
            [
                'label'     => __( 'Icon', 'modista' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_toggle_style',
            [
                'label' => __( 'Toggle Section Style', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'style_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('دکمه باز کننده', 'modista'),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'toggle_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 12,
                    'left' => 12,
                    'unit' => '%',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'toggle_color',
            [
                'label' => esc_html__('Color', 'modista'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__button' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mi-toggle-section__icon svg' => 'stroke: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'toggle_background_color',
            [
                'label' => esc_html__('Background Color', 'modista'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__button' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'toggle_border',
                'selector' => '{{WRAPPER}} .mi-toggle-section__button',
            ]
        );

        $this->add_control(
            'toggle_icon_width',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 24
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-toggle-section__icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'style_close_title',
            [
                'type' => \Elementor\Controls_Manager::HEADING,
                'label' => __('دکمه بستن', 'modista'),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'toggle_close_offset',
            [
                'label' => __( 'Offset Position', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'desktop_default' => [
                    'unit' => 'px',
                    'size' => 16
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'toggle_close_margin_top',
            [
                'label' => __( 'Margin Top', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 26
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'toggle_close_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 10,
                    'right' => 10,
                    'bottom' => 10,
                    'left' => 10,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_close_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 12,
                    'right' => 12,
                    'bottom' => 12,
                    'left' => 12,
                    'unit' => '%',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'toggle_close_color',
            [
                'label' => esc_html__('Color', 'modista'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .mi-toggle-section__close svg' => 'stroke: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'toggle_close_background_color',
            [
                'label' => esc_html__('Background Color', 'modista'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close' => 'background-color: {{VALUE}}'
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'toggle_close_border',
                'selector' => '{{WRAPPER}} .mi-toggle-section__close',
            ]
        );

        $this->add_control(
            'toggle_close_icon_width',
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
                'default' => [
                    'unit' => 'px',
                    'size' => 24
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__close svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-toggle-section__close img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style',
            [
                'label' => __( 'Section Style', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_control(
            'section_background_color',
            [
                'label' => esc_html__('Background Color', 'modista'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-toggle-section__content' => 'background-color: {{VALUE}}'
                ]
            ]
        );
        
        $this->add_control(
            'section_width',
            [
                'label' => esc_html__('Background Color', 'modista'),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 5,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
                'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .mi-toggle-section__content' => 'width: {{SIZE}}{{UNIT}};',
				],
            ]
        );

        $this->end_controls_section();
    }

    // Get sections modista_library
    private function get_modista_library_posts() {
        $posts = get_posts([
            'post_type' => 'modista_library',
            'posts_per_page' => -1,
        ]);

        $options = [];
        foreach ($posts as $post) {
            $options[$post->ID] = $post->post_title;
        }

        return $options;
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $selected_section_id = $settings['selected_section'];

        if (empty($selected_section_id)) {
            echo __('Please select a section.', 'modista');
            return;
        }

        ?>
        <div class="mi-toggle-section">
            <button class="mi-toggle-section__button">
                <div class="mi-toggle-section__icon d-flex">
                    <?php
                    if ( $settings['toggle_icon']['value'] ) {
                        if ( $settings['toggle_icon']['library'] == 'svg' ) :
                            ?>
                            <img src="<?php echo esc_url( $settings['toggle_icon']['value']['url'] ) ?>" alt="">
                        <?php
                        else :
                            \Elementor\Icons_Manager::render_icon( $settings['toggle_icon'], [ 'aria-hidden' => 'true' ] );
                        endif;
                    } else {
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" viewBox="0 0 24 24" fill="none">
                            <path d="M20 7L4 7" stroke-width="1.5" stroke-linecap="round"/>
                            <path opacity="0.5" d="M20 12L4 12" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M20 17L4 17" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    <?php } ?>
                </div>
            </button>
            <div class="mi-toggle-section__content">
                <div class="mi-toggle-section__close d-flex">
                    <?php
                    if ( $settings['toggle_close_icon']['value'] ) {
                        if ( $settings['toggle_close_icon']['library'] == 'svg' ) :
                            ?>
                            <img src="<?php echo esc_url( $settings['toggle_close_icon']['value']['url'] ) ?>" alt="">
                        <?php
                        else :
                            \Elementor\Icons_Manager::render_icon( $settings['toggle_close_icon'], [ 'aria-hidden' => 'true' ] );
                        endif;
                    } else {
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                            <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke-width="1.5" stroke-linecap="round"/>
                            <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke-width="1.5" stroke-linecap="round"/>
                        </svg>
                    <?php } ?>
                </div>

                <?php
                if ( $selected_section_id ) {        
                    \Modista\Classes\PostType_Modista_Library::load($selected_section_id);
                }
                ?>
            </div>
        </div>
        <?php
    }
}
