<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

use Modista\Classes\Elementor_Controls_Helper;

class Base_Image_Box_Carousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-image-box-carousel';
    }

    public function get_title() {
        return __('Image Box Carousel', 'modista');
    }

    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_categories() {
        return ['modista'];
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];
        return ['mi-base-carousel'];
    }

    protected function register_controls() {

        // Tabs Settings
        $this->start_controls_section(
            'tabs_section',
            [
                'label' => __('Tabs', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'image',
             [
                'label' => __('Image', 'modista'),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ],
        );

        $repeater->add_control(
            'title',
            [
                'label' => __('Title', 'modista'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Title', 'modista'),
            ],
        );

        $repeater->add_control(
			'button',
			 [
                'label' => __('Button', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'modista' ),
                'label_off' => esc_html__( 'No', 'modista' ),
                'return_value' => 'yes',
                'default' => 'no',
            ],
		);

        $repeater->add_control(
			'button_title',
			 [
                'label' => __('Button Title', 'modista'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Show more', 'modista'),
                'condition' => [ 'button' => 'yes' ]
            ],
		);

        $repeater->add_control(
            'button_link',
             [
                'label' => __('Button Link', 'modista'),
                'type' => \Elementor\Controls_Manager::URL,
                'condition' => [ 'button' => 'yes' ]
            ],
        );

        $repeater->add_control(
            'button_icon',
             [
                'label' => __('Button Icon', 'modista'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'condition' => [ 'button' => 'yes' ]
            ],
        );

        $this->add_control(
            'tabs',
            [
                'label' => __('Tabs', 'modista'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
            ]
        );

        $this->end_controls_section();

        // Carousel Settings
        $this->start_controls_section(
            'settings_section',
            [
                'label' => __('Carousel Settings', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        // Elementor_Controls_Helper::get_carousel_config_controls($this);

        $this->add_responsive_control(
            'carousel_per_view',
            [
                'label' => __('Slides Per View', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3,
                'min' => 1,
                'max' => 10,
            ]
        );

        $this->add_control(
            'carousel_autoplay',
            [
                'label' => __('Autoplay', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'carousel_loop',
            [
                'label' => __('Loop', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'carousel_centered',
            [
                'label' => __('Centered', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
            ]
        );

        $this->add_control(
            'carousel_speed',
            [
                'label' => __('Speed (ms)', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 1500,
            ]
        );

        $this->add_control(
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

        $this->add_responsive_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_responsive_control(
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

        $this->end_controls_section();

        // Style Controls

        // Carousel Body
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Carousel Body', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_slide_margin',
            [
                'label' => __('Container Margin', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'container_slide_padding',
            [
                'label' => __('Container Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_space_between',
            [
                'label' => __( 'Slide Space Between', 'modista' ),
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
                    '{{WRAPPER}} .swiper-slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'slides_heading',
            [
                'label' => __( 'Slide', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'slides_height_equal',
            [
                'label' => esc_html__( 'Equal Height', 'modista' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'modista' ),
                'label_off' => esc_html__( 'No', 'modista' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_responsive_control(
            'slides_height',
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
                'default' => [
                    'unit' => '%',
                    'size' => 100
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .swiper-slide__wrapper' => 'min-height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        Elementor_Controls_Helper::get_flex_style_controls($this, 'slide', '.swiper-slide__wrapper');

        $this->add_control(
            'slide_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .swiper-slide__wrapper' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .swiper-slide__wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide .swiper-slide__wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selector' => '{{WRAPPER}} .swiper-slide .swiper-slide__wrapper'
            ]
        );

        $this->end_controls_section();
        // End Carousel Body

        // Style Content
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_image_heading',
            [
                'label' => __( 'Image', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

         $this->add_responsive_control(
            'card_image_width',
            [
                'label' => __( 'Width', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_image_height',
            [
                'label' => __( 'Height', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_image_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_image_object_fit',
            [
                'label' => __('Image Object Fit', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'contain',
                'options' => [
                    'cover' => __('Cover', 'modista'),
                    'contain' => __('Contain', 'modista'),
                    'fill' => __('Fill', 'modista'),
                    'none' => __('None', 'modista'),
                    'scale-down' => __('Scale Down', 'modista'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_image_object_position',
            [
                'label' => __( 'Object Position', 'modista' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'center center',
                'description' => __( 'جایگاه عکس را تنظیم کنید', 'modista' ),
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_item_title',
            [
                'label' => esc_html__( 'Title', 'elementor' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'card_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper span' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_typography',
                'selector' => '{{WRAPPER}} .swiper-slide__wrapper span',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'card_item_title_text_alignment',
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
                'default' => 'right',
                'selectors' => [
                    '{{WRAPPER}} .swiper-slide__wrapper span' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_navigation_section',
            [
                'label' => __('Navigation', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'carousel_navigation' => 'yes'
                ]
            ]
        );

        Elementor_Controls_Helper::get_carousel_navigation_style_controls($this, 'navigation');

        $this->end_controls_section();

        $this->start_controls_section(
            'style_pagination_section',
            [
                'label' => __('Pagination', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'carousel_pagination' => 'yes'
                ]
            ]
        );

        Elementor_Controls_Helper::get_carousel_pagination_style_controls($this, 'pagination');

        $this->end_controls_section();

        $this->start_controls_section(
            'style_variation_section',
            [
                'label' => __('Variation Color', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => [
                    'content_enable_color' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'color_options_alignment',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'row',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__color-options' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'color_options_gap',
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
                    '{{WRAPPER}} .mi-product-card__color-options' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_options_padding',
            [
                'label' => __( 'Padding', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__color-options' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_options_item',
            [
                'label' => esc_html__( 'Option', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'color_options_width',
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
                    'size' => 16,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__color-options > span' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_options_border_radius',
            [
                'label' => __( 'Border Radius', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__color-options > span' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'color_options_border',
                'selector' => '{{WRAPPER}} .mi-product-card__color-options > span',
            ]
        );

        // Normal and Hover tab
        $this->start_controls_tabs( 'tabs_option_border' );

        $this->start_controls_tab(
            'tabs_option_border_hover',
            [
                'label' => __( 'Hover', 'modista' ),
            ]
        );

        $this->add_control(
            'tabs_option_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__color-options > span:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tabs_option_border_active',
            [
                'label' => __( 'Active', 'modista' ),
                'condition' => [
                    'content_enable_color' => 'yes'
                ]
            ]
        );

        $this->add_control(
            'tabs_option_border_color_active',
            [
                'label' => esc_html__( 'Border Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__color-options > span.active' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        // End

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $tabs = $settings['tabs'];

        // Slider Wrapper Class attributes
        $this->add_render_attribute('swiper', 'class', 'swiper');
        if ($settings['carousel_autoplay'] === 'yes') {
            $this->add_render_attribute('swiper', 'class', 'autoplay--enabled');
        }
        if ($settings['carousel_loop'] === 'yes') {
            $this->add_render_attribute('swiper', 'class', 'loop--enabled');
        }
        if ($settings['carousel_centered'] === 'yes') {
            $this->add_render_attribute('swiper', 'class', 'centered');
        }
        if (isset($settings['carousel_centered_tablet']) && $settings['carousel_centered_tablet'] === 'yes') {
            $this->add_render_attribute('swiper', 'class', 'centered--tablet');
        }
        if (isset($settings['carousel_centered_mobile']) && $settings['carousel_centered_mobile'] === 'yes') {
            $this->add_render_attribute('swiper', 'class', 'centered--mobile');
        }

        // Slide per view
        $carousel_per_view = $settings['carousel_per_view'];
        $carousel_per_view_tablet = $settings['carousel_per_view_tablet'] ?? $carousel_per_view;
        $carousel_per_view_mobile = $settings['carousel_per_view_mobile'] ?? $carousel_per_view_tablet;

        // Slide Class attributes
        $this->add_render_attribute('swiper_slide', 'class', 'swiper-slide');
        if ($settings['slides_height_equal'] === 'yes') {
            $this->add_render_attribute('swiper_slide', 'class', 'h-auto');
        }

        if ( ! empty($tabs) ) {
            ?>
            <div class="mi-carousel">
                <div <?php echo $this->get_render_attribute_string('swiper') ?> data-slides-per-view="<?php echo esc_attr($carousel_per_view); ?>" data-slides-per-view-tablet="<?php echo esc_attr($carousel_per_view_tablet); ?>" data-slides-per-view-mobile="<?php echo esc_attr($carousel_per_view_mobile); ?>" data-speed="<?php echo esc_attr($settings['carousel_speed']); ?>">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($tabs as $index => $tab) {
                            echo sprintf("<div %s>", $this->get_render_attribute_string('swiper_slide'));
                                echo '<div class="swiper-slide__wrapper d-flex">';
                                    // Render image
                                    if ( ! empty( $tab['image']['url'] ) ) {
                                        echo '<img src="' . $tab['image']['url'] . '">';
                                    }
                                    // Render title
                                    if ( $tab['title'] !== '' ) {
                                        echo '<span>' . esc_html($tab['title']) . '</span>';
                                    }
                                    // Render more button
                                    if ($tab['button'] == 'yes') {
                                        // If the button have the link
                                        if ( ! empty( $tab['button_link']['url'] ) ) $this->add_link_attributes( 'button_link_' . $index, $tab['button_link'] );
                                        ?>
                                        <a <?php $this->print_render_attribute_string( 'button_link_' . $index ); ?> class="swiper-slide__button d-flex">
                                            <?php echo esc_html($tab['button_title']);
                                            // Render Icon
                                            if ( $tab['button_icon']['library'] ) :
                                                if ($tab['button_icon']['library'] == 'svg') {
                                                    echo '<img src="' . esc_url($tab['button_icon']['value']['url']) . '" alt="">';
                                                } else {
                                                    \Elementor\Icons_Manager::render_icon($tab['button_icon'], ['aria-hidden' => 'true']);
                                                }
                                            endif;
                                            ?>
                                        </a>
                                    <?php
                                    }
                                echo '</div>';
                            echo '</div>';
                        }
                    echo '</div>
                </div>';
                // Render navigation & pagination
                Elementor_Controls_Helper::get_carousel_navigation_render($this, $settings);
                Elementor_Controls_Helper::get_carousel_pagination_render($this, $settings);
            echo '</div>';
        }
        else {
            error_log('No tabs found in settings.');
        }
    }
}
