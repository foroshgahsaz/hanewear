<?php

namespace Modista\Classes;

use \Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;

class Elementor_Controls_Helper
{
    /**
     * @param $widget
     * @param $id
     * @param $selector
     */
    public static function get_base_box_style_controls($widget, $id, $selector)
    {
        $widget->add_responsive_control(
            "padding_$id",
            [
                'label' => __('Padding', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "margin_$id",
            [
                'label' => __('Margin', 'elementor'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "border_radius_$id",
            [
                'label' => __('Border Radius', 'elementor'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => "border_$id",
                'selector' => "{{WRAPPER}} $selector"
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => "box_shadow_$id",
                'selector' => "{{WRAPPER}} $selector",
            ]
        );

        $widget->add_control(
            "background_$id",
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'background-color: {{VALUE}};',
                ],
            ]
        );

    }

    /**
     * Return control widgets for design of the box.
     *
     * @param $widget
     * @param $id
     * @param $selector
     * @return void
     */
    public static function get_box_style_controls($widget, $id, $selector) {

        self::get_flex_style_controls($widget, $id, $selector);

        self::get_base_box_style_controls($widget, $id, $selector);

    }

    /**
     * Return control widgets for flex box.
     *
     * @param $widget
     * @param $id
     * @param $selector
     * @return void
     */
    public static function get_flex_style_controls($widget, $id, $selector) {

        $widget->add_responsive_control(
            "direction_$id",
            [
                'label' => esc_html__( 'Direction', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => esc_html__( 'row', 'modista' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'column' => [
                        'title' => esc_html__( 'column', 'modista' ),
                        'icon' => 'eicon-v-align-bottom',
                    ],
                    'row-reverse' => [
                        'title' => esc_html__( 'row-reverse', 'modista' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'column-reverse' => [
                        'title' => esc_html__( 'column-reverse', 'modista' ),
                        'icon' => 'eicon-v-align-top',
                    ]
                ],
                'default' => 'column',
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "justify_content_$id",
            [
                'label' => esc_html__( 'Justify Content', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'center' => [
                        'title' => esc_html__( 'center', 'modista' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-start' => [
                        'title' => esc_html__( 'flex-start', 'modista' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'flex-end', 'modista' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'space-between', 'modista' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ]
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "align_items_$id",
            [
                'label' => esc_html__( 'Align Items', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'center' => [
                        'title' => esc_html__( 'center', 'modista' ),
                        'icon' => 'eicon-align-center-h',
                    ],
                    'flex-start' => [
                        'title' => esc_html__( 'flex-start', 'modista' ),
                        'icon' => 'eicon-align-end-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'flex-end', 'modista' ),
                        'icon' => 'eicon-align-start-h',
                    ]
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "gap_$id",
            [
                'label' => __( 'Gap', 'modista' ),
                'type' => Controls_Manager::SLIDER,
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
                    "{{WRAPPER}} $selector" => 'gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

    }

    /**
     * Return control widgets for design of the image.
     *
     * @param $widget
     * @param $id
     * @param $selector_wrapper
     * @return void
     */
    public static function get_image_style_controls($widget, $id, $selector_wrapper) {

        $widget->add_responsive_control(
            "align_$id",
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector_wrapper" => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "width_$id",
            [
                'label' => esc_html__( 'Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector_wrapper img" => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "space_$id",
            [
                'label' => esc_html__( 'Max Width', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ 'px', '%', 'em', 'rem', 'vw', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                    'vw' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector_wrapper img" => 'max-width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "height_$id",
            [
                'label' => esc_html__( 'Height', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem', 'vh', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                    'vh' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector_wrapper img" => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "object_fit_$id",
            [
                'label' => esc_html__( 'Object Fit', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'condition' => [
                    'height_' . $id . '[size]!' => '',
                ],
                'options' => [
                    '' => esc_html__( 'Default', 'elementor' ),
                    'fill' => esc_html__( 'Fill', 'elementor' ),
                    'cover' => esc_html__( 'Cover', 'elementor' ),
                    'contain' => esc_html__( 'Contain', 'elementor' ),
                    'scale-down' => esc_html__( 'Scale Down', 'elementor' ),
                ],
                'default' => '',
                'selectors' => [
                    "{{WRAPPER}} $selector_wrapper img" => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "object_position_$id",
            [
                'label' => esc_html__( 'Object Position', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'center center' => esc_html__( 'Center Center', 'elementor' ),
                    'center left' => esc_html__( 'Center Left', 'elementor' ),
                    'center right' => esc_html__( 'Center Right', 'elementor' ),
                    'top center' => esc_html__( 'Top Center', 'elementor' ),
                    'top left' => esc_html__( 'Top Left', 'elementor' ),
                    'top right' => esc_html__( 'Top Right', 'elementor' ),
                    'bottom center' => esc_html__( 'Bottom Center', 'elementor' ),
                    'bottom left' => esc_html__( 'Bottom Left', 'elementor' ),
                    'bottom right' => esc_html__( 'Bottom Right', 'elementor' ),
                ],
                'default' => 'center center',
                'selectors' => [
                    "{{WRAPPER}} $selector_wrapper img" => 'object-position: {{VALUE}};',
                ],
                'condition' => [
                    'height_' . $id . '[size]!' => '',
                    "object_fit_$id" => [ 'cover', 'contain', 'scale-down' ],
                ],
            ]
        );

        self::get_base_box_style_controls($widget, $id, $selector_wrapper . ' img');

    }

    /**
     * Return control widgets for design of the text or title.
     *
     * @param $widget
     * @param $id
     * @param $selector_wrapper
     * @return void
     */
    public static function get_text_style_controls($widget, $id, $selector) {

        $widget->add_responsive_control(
            "align_$id",
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => esc_html__( 'Left', 'elementor' ),
                        'icon' => 'eicon-text-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-text-align-center',
                    ],
                    'right' => [
                        'title' => esc_html__( 'Right', 'elementor' ),
                        'icon' => 'eicon-text-align-right',
                    ],
                ],
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            "color_$id",
            [
                'label' => __('Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            "background_color_$id",
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    "{{WRAPPER}} $selector" => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => "typography_$id",
                'selector' => "{{WRAPPER}} $selector",
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Text_Stroke::get_type(),
            [
                'name' => "text_stroke_$id",
                'selector' => "{{WRAPPER}} $selector",
            ]
        );

        $widget->add_group_control(
            \Elementor\Group_Control_Text_Shadow::get_type(),
            [
                'name' => "text_shadow_$id",
                'selector' => "{{WRAPPER}} $selector",
            ]
        );

    }

    /**
     * Return control select tag
     *
     * @param $widget
     * @param $id
     * @return void
     */
    public static function get_tag_control($widget, $id) {

        $widget->add_control(
            "content_tag_type_$id",
            [
                'label' => esc_html__( 'HTML Tag', 'elementor' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'h1' => 'H1',
                    'h2' => 'H2',
                    'h3' => 'H3',
                    'h4' => 'H4',
                    'h5' => 'H5',
                    'h6' => 'H6',
                    'div' => 'div',
                    'span' => 'span',
                    'p' => 'p',
                ],
                'default' => 'h2',
            ]
        );

    }

    /**
     * Return control select tag
     *
     * @param $widget
     * @return void
     */
    public static function get_carousel_config_controls($widget) {

        $widget->add_responsive_control(
            'carousel_per_view',
            [
                'label' => __('Slides Per View', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 10,
            ]
        );

        $widget->add_control(
            'carousel_autoplay',
            [
                'label' => __('Autoplay', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
            ]
        );

        $widget->add_control(
            'carousel_loop',
            [
                'label' => __('Loop', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
            ]
        );

        $widget->add_responsive_control(
            'carousel_centered',
            [
                'label' => __('Centered', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
            ]
        );

        $widget->add_control(
            'carousel_speed',
            [
                'label' => __('Speed (ms)', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1500,
            ]
        );

        $widget->add_control(
            'carousel_navigation',
            [
                'label' => __('Navigation Arrows', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $widget->add_responsive_control(
            'carousel_navigation_display',
            [
                'label' => __('Display Navigation', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'default_tablet' => 'yes',
                'default_mobile' => 'yes',
                'condition' => ['carousel_navigation' => 'yes']
            ]
        );

        $widget->add_control(
            'carousel_custom_icons',
            [
                'label' => __( 'Custom Icons', 'modista' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'modista' ),
                'label_off' => __( 'No', 'modista' ),
                'default' => 'no',
                'condition' => ['carousel_navigation' => 'yes']
            ]
        );

        $widget->add_control(
            'carousel_prev_button_icon',
            [
                'label' => __('Previous Button Icon', 'modista'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'eicon-chevron-left',
                    'library' => 'solid',
                ],
                'condition' => [ 'carousel_custom_icons' => 'yes' ],
            ]
        );

        $widget->add_control(
            'carousel_next_button_icon',
            [
                'label' => __('Next Button Icon', 'modista'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'default' => [
                    'value' => 'eicon-chevron-right',
                    'library' => 'solid',
                ],
                'condition' => [ 'carousel_custom_icons' => 'yes' ],
            ]
        );

        $widget->add_control(
            'carousel_pagination',
            [
                'label' => __('Pagination', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $widget->add_responsive_control(
            'carousel_pagination_display',
            [
                'label' => __('Display Pagination', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'default_tablet' => 'yes',
                'default_mobile' => 'yes',
                'condition' => ['carousel_pagination' => 'yes']
            ]
        );

    }

    /**
     * Return carousel navigation for render.
     *
     * @param $widget
     * @param $settings
     * @return void
     */
    public static function get_carousel_navigation_render($widget, $settings) {

        // Navigation Class attributes
        $widget->add_render_attribute('navigation', 'class', 'mi-product-carousel__navigation--out swiper-rtl');
        if ( ! isset($settings['carousel_navigation_display']) || $settings['carousel_navigation_display'] !== 'yes') {
            $widget->add_render_attribute('navigation', 'class', 'd-lg-none');
        } else {
            $widget->add_render_attribute('navigation', 'class', 'd-lg-block');
        }
        if ( ! isset($settings['carousel_navigation_display_tablet']) || $settings['carousel_navigation_display_tablet'] !== 'yes') {
            $widget->add_render_attribute('navigation', 'class', 'd-md-none');
        } else {
            $widget->add_render_attribute('navigation', 'class', 'd-md-block');
        }
        if ( ! isset($settings['carousel_navigation_display_mobile']) || $settings['carousel_navigation_display_mobile'] !== 'yes') {
            $widget->add_render_attribute('navigation', 'class', 'd-none');
        } else {
            $widget->add_render_attribute('navigation', 'class', 'd-block');
        }

        if ('yes' === $settings['carousel_navigation']) {

            $prev_button_class = 'swiper-button swiper-button-prev';
            $next_button_class = 'swiper-button swiper-button-next';

            if ('yes' === $settings['carousel_custom_icons']) {
                $prev_button_class .=  ' swiper-button--svg';
                $next_button_class .= ' swiper-button--svg';
            }
            // Render navigation
            ?>
            <div <?php echo $widget->get_render_attribute_string('navigation') ?>>
                <div class="<?php echo esc_attr( $prev_button_class ); ?>">
                    <?php if ( 'yes' === $settings['carousel_custom_icons'] && isset($settings['carousel_prev_button_icon']) ) : ?>
                        <span class="swiper-button-prev-icon">
                                 <?php if ($settings['carousel_prev_button_icon']['library'] == 'svg'): ?>
                                     <img src="<?php echo esc_url($settings['carousel_prev_button_icon']['value']['url']) ?>" alt="">
                                 <?php
                                 else:
                                     \Elementor\Icons_Manager::render_icon( $settings['carousel_prev_button_icon'], [ 'aria-hidden' => 'true' ] );
                                 endif; ?>
                             </span>
                    <?php endif; ?>
                </div>
                <div class="<?php echo esc_attr( $next_button_class ); ?>">
                    <?php if ( 'yes' === $settings['carousel_custom_icons'] && isset($settings['carousel_next_button_icon']) ) : ?>
                        <span class="swiper-button-next-icon">
                             <?php if ($settings['carousel_next_button_icon']['library'] == 'svg'): ?>
                                 <img src="<?php echo esc_url($settings['carousel_next_button_icon']['value']['url']) ?>" alt="">
                             <?php
                             else:
                                 \Elementor\Icons_Manager::render_icon( $settings['carousel_next_button_icon'], [ 'aria-hidden' => 'true' ] );
                             endif; ?>
                         </span>
                    <?php endif; ?>
                </div>
            </div>
        <?php }
    }

    public static function get_carousel_navigation_style_controls($widget, $id) {

        $widget->add_responsive_control(
            "prev_top_offset_$id",
            [
                'label' => __( 'Top Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "prev_right_offset_$id",
            [
                'label' => __( 'Right Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_control(
            "next_heading_$id",
            [
                'label' => esc_html__( 'Next Arrow', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_responsive_control(
            "next_top_offset_$id",
            [
                'label' => __( 'Top Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "next_left_offset_$id",
            [
                'label' => __( 'Left Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button-next' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $widget->add_responsive_control(
            "width_$id",
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
                    '{{WRAPPER}} .swiper-button' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "height_$id",
            [
                'label' => __( 'Height', 'modista' ),
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
                    '{{WRAPPER}} .swiper-button' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_control(
            "background_$id",
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "padding_$id",
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "border_radius_$id",
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
    }

    /**
     * Return .
     *
     * @param $widget
     * @param $settings
     * @return void
     */
    public static function get_carousel_pagination_render($widget, $settings) {

        if ('yes' !== $settings['carousel_pagination'])
            return;

        // Pagination Class attributes
        $widget->add_render_attribute('pagination', 'class', 'swiper-pagination');

        if ( ! isset($settings['carousel_pagination_display']) || $settings['carousel_pagination_display'] !== 'yes') {
            $widget->add_render_attribute('pagination', 'class', 'd-lg-none');
        } else {
            $widget->add_render_attribute('pagination', 'class', 'd-lg-block');
        }
        if ( ! isset($settings['carousel_pagination_display_tablet']) || $settings['carousel_pagination_display_tablet'] !== 'yes') {
            $widget->add_render_attribute('pagination', 'class', 'd-md-none');
        } else {
            $widget->add_render_attribute('pagination', 'class', 'd-md-block');
        }
        if ( ! isset($settings['carousel_pagination_display_mobile']) || $settings['carousel_pagination_display_mobile'] !== 'yes') {
            $widget->add_render_attribute('pagination', 'class', 'd-none');
        } else {
            $widget->add_render_attribute('pagination', 'class', 'd-block');
        }

        // Render pagination
        ?>
        <div <?php echo $widget->get_render_attribute_string('pagination') ?>></div>
        <?php
    }

    public static function get_carousel_pagination_style_controls($widget, $id) {

        $widget->add_responsive_control(
            "top_offset_$id",
            [
                'label' => __( 'Top Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "bottom_offset_$id",
            [
                'label' => __( 'Bottom Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => -100,
                        'max' => 100,
                        'step' => 1,
                    ],
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_control(
            "dots_$id",
            [
                'label' => esc_html__( 'Dots', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_responsive_control(
            "width_$id",
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
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "height_$id",
            [
                'label' => __( 'Height', 'modista' ),
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
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "padding_$id",
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "border_radius_$id",
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $widget->add_responsive_control(
            "opacity_$id",
            [
                'label' => __('Opacity', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'size_units' => ['px'],
                'min' => '0',
                'max' => '1',
                'step' => '0.1',
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'opacity: {{SIZE}};',
                ],
            ]
        );

        $widget->add_control(
            "background_$id",
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $widget->add_control(
            "dots_active_$id",
            [
                'label' => esc_html__( 'Active Dot', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $widget->add_control(
            "background_active_$id",
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-pagination .swiper-pagination-bullet-active' => 'background-color: {{VALUE}};',
                ],
            ]
        );
    }

}