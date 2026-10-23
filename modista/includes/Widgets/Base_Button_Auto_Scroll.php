<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Colors;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Text_Shadow;
use Elementor\Group_Control_Text_Stroke;
use Elementor\Group_Control_Typography;
use Modista\Classes\Elementor_Controls_Helper;

class Base_Button_Auto_Scroll extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-button-auto-scroll';
    }

    public function get_title() {
        return __( 'Scroll Button', 'modista' );
    }

    public function get_icon() {
        return 'eicon-scroll';
    }

    function get_keywords()
    {
        return ['Scroll', __('Scroll Button', 'modista'), 'modista', __('modista', 'modista') ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    public function get_script_depends(): array {
        return [ 'mi-bundle-widget' ];
        return [ 'mi-widget-button-auto-scroll' ];
    }

    protected function register_controls() {

        // Controls for the content.
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'icon',
            [
                'label'     => __( 'Icon', 'modista' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'     => ['url' => MI_URL . '/assets/image/svg/arrow-up.svg'],
                    'library'   => 'svg'
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'بریم بالا', 'modista' ),
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        // Controls for Scroll.
        $this->start_controls_section(
            'scroll_section',
            [
                'label' => __( 'Scroll', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'scroll_direction',
            [
                'label' => esc_html__( 'Direction', 'modista' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'up',
                'options' => [
                    'up' => esc_html__( 'Up', 'modista' ),
                    'down'  => esc_html__( 'Down', 'modista' ),
                ]
            ]
        );

        $this->add_control(
            'scroll_offset',
            [
                'label' => esc_html__( 'Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 0,
                'default' => 0,
                'description' => __('If set 0 value, it returns complete.', 'modista'),
            ]
        );

        $this->end_controls_section();
        // End controls for Scroll.

        $this->start_controls_section(
            'style_button',
            [
                'label' => __( 'Button', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'button_heading',
            [
                'label'     => __('Button', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        Elementor_Controls_Helper::get_box_style_controls($this, 'button', '.mi-auto-scroll');

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .mi-auto-scroll',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-auto-scroll' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'icon_heading',
            [
                'label'     => __('Icon', 'modista'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'icon_width',
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
                    '{{WRAPPER}} .mi-auto-scroll__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-auto-scroll__icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'icon_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-auto-scroll__icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mi-auto-scroll__icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        $scroll_direction = $settings['scroll_direction'];
        $scroll_offset = $settings['scroll_offset'];
        ?>
        <button class="mi-auto-scroll" data-direction="<?php echo esc_html($scroll_direction); ?>" data-offset="<?php echo esc_html($scroll_offset); ?>">
            <div class="mi-auto-scroll__icon d-flex">
                <?php
                if ( $settings['icon']['library'] == 'svg' ) :
                    ?>
                    <img src="<?php echo esc_url( $settings['icon']['value']['url'] ) ?>" alt="">
                <?php
                else :
                    \Elementor\Icons_Manager::render_icon( $settings['icon'], [ 'aria-hidden' => 'true' ] );
                endif;
                ?>
            </div>
            <?php
            if ($settings['title'] !== '') {
                echo '<span>' . esc_html($settings['title'] ) . '</span>';
            }
            ?>
        </button>
        <?php
    }
}
