<?php

namespace Modista\Widgets;

use Modista\Classes\Elementor_Controls_Helper;defined('ABSPATH') || exit; // Exit if accessed directly.

class Woo_Product_Carousel_List extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-product-carousel-list';
    }

    public function get_title() {
        return __('Product List Carousel', 'modista');
    }

    public function get_icon() {
        return 'eicon-products';
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];

        return [
            'mi-widget-woo-product-list',
            'mi-base-carousel'
        ];
    }
    
    public function get_style_depends()
    {
        return [ 'mi-bundle-widget' ];

        return [
            'mi-widget-woo-product-list',
        ];
    }

    public function get_categories() {
        return ['modista'];
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
            'tab_title',
            [
                'name' => 'tab_title',
                'label' => __('Tab Title', 'modista'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('New Tab', 'modista'),
            ],
        );

        $repeater->add_control(
			'product_category',
			[
                'label' => __('Product Category', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'multiple' => true,
            ],
		);

        $repeater->add_control(
			'order_by',
			[
                'label' => __('Order By', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'date' => __('Date', 'modista'),
                    'title' => __('Title', 'modista'),
                    'price' => __('Price', 'modista'),
                    'rand' => __('Random', 'modista'),
                    'meta_value_num' => __('Sales Count', 'modista'),
                ],
                'default' => 'date',
            ],
		);

        $repeater->add_control(
			'order',
			[
                'label' => __('Order', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'ASC' => __('Ascending', 'modista'),
                    'DESC' => __('Descending', 'modista'),
                ],
                'default' => 'DESC',
            ],
		);

        $repeater->add_control(
			'posts_per_page',
			[
                'label' => __('Posts Per Page', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 8,
                'separator' => 'after'
            ],
		);

        $repeater->add_control(
			'more_button',
			 [
                'label' => __('More Button', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'modista' ),
                'label_off' => esc_html__( 'No', 'modista' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ],
		);

        $repeater->add_control(
			'button_title',
			 [
                'label' => __('Button Title', 'modista'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => __('Show more', 'modista'),
                'condition' => [ 'more_button' => 'yes' ]
            ],
		);

        $repeater->add_control(
            'button_link',
             [
                'label' => __('Button Link', 'modista'),
                'type' => \Elementor\Controls_Manager::URL,
                'condition' => [ 'more_button' => 'yes' ]
            ],
        );

        $repeater->add_control(
            'button_icon',
             [
                'label' => __('Button Icon', 'modista'),
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'condition' => [ 'more_button' => 'yes' ]
            ],
        );

        $this->add_control(
            'tabs',
            [
                'label' => __('Tabs', 'modista'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

        // Content Settings
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'content_show_title',
            [
                'label' => __('Show Title', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
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

        Elementor_Controls_Helper::get_carousel_config_controls($this);

        $this->end_controls_section();

        // Style Controls

        // Tab Toggle
        $this->start_controls_section(
            'style_tab_section',
            [
                'label' => __('Carousel Header', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tab_head_alignment',
            [
                'label' => esc_html__( 'Alignment', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'default' => 'space-between',
                'options' => [
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'elementor' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => esc_html__( 'Center', 'elementor' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'elementor' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'elementor' ),
                        'icon' => 'eicon-h-align-right',
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_head_align_items',
            [
                'label' => esc_html__( 'Align Items', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
                'options' => [
                    'center' => [
                        'title' => esc_html__( 'center', 'elementor' ),
                        'icon' => 'eicon-align-center-v',
                    ],
                    'flex-start' => [
                        'title' => esc_html__( 'flex-start', 'elementor' ),
                        'icon' => 'eicon-align-end-v',
                    ],
                    'flex-end' => [
                        'title' => esc_html__( 'flex-end', 'elementor' ),
                        'icon' => 'eicon-align-start-v',
                    ]
                ],
                'default' => 'center',
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_head_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'tab_title_item',
            [
                'label' => esc_html__( 'Title', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tab_title_item_typography',
                'selector' => '{{WRAPPER}} .mi-tab-title',
            ]
        );

        $this->add_responsive_control(
            'tab_title_item_border_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-title' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_item_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_title_item_border',
                'selector' => '{{WRAPPER}} .mi-tab-title',
            ]
        );

        $this->add_control(
            'tab_title_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_title_item_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-title' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_more_item',
            [
                'label' => esc_html__( 'More Button', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'list_button_more_gap',
            [
                'label' => __( 'Gap', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => ['px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-more-button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tab_more_item_typography',
                'selector' => '{{WRAPPER}} .mi-more-button',
            ]
        );

        $this->add_responsive_control(
            'tab_more_item_border_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-more-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_more_item_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-more-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_more_item_border',
                'selector' => '{{WRAPPER}} .mi-more-button',
            ]
        );

        $this->add_control(
            'tab_more_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-more-button' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_more_item_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-more-button' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'list_button_more_icon',
            [
                'label' => esc_html__( 'Icon', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'list_button_more_icon_width',
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
                    '{{WRAPPER}} .mi-more-button svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-more-button img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

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
                    '{{WRAPPER}} .mi-product__slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product__slide .slide-wrapper' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slide_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product__slide .slide-wrapper' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-product__slide .slide-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product__slide .slide-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selector' => '{{WRAPPER}} .mi-product__slide .slide-wrapper'
            ]
        );

        $this->end_controls_section();
        // End Carousel Body

        // Product Body
        $this->start_controls_section(
            'style_product_body_section',
            [
                'label' => __('Product Body', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'product_body_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_body_margin',
            [
                'label' => __('Container Margin', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_body_padding',
            [
                'label' => __('Container Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_body_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_body_border',
                'selector' => '{{WRAPPER}} .mi-product__item'
            ]
        );

        $this->add_control(
            'product_body_first_child',
            [
                'label' => __('First Item', 'modista'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'product_body_margin_first_child',
            [
                'label' => __('Container Margin', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item:first-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_body_padding_first_child',
            [
                'label' => __('Container Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item:first-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_body_border_first_child',
                'selector' => '{{WRAPPER}} .mi-product__item:first-child'
            ]
        );

        $this->add_control(
            'product_body_last_child',
            [
                'label' => __('Last Item', 'modista'),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'product_body_margin_last_child',
            [
                'label' => __('Container Margin', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item:last-child' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'product_body_padding_last_child',
            [
                'label' => __('Container Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__item:last-child' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'product_body_border_last_child',
                'selector' => '{{WRAPPER}} .mi-product__item:last-child'
            ]
        );

        $this->end_controls_section();

        // Style Product Image
        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Product Image', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'card_box_image_heading',
            [
                'label' => __( 'Box', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'text_alignment',
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
                    '{{WRAPPER}} .mi-product__image' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'card_image_background',
                'types' => [ 'classic', 'gradient', 'image' ],
                'selector' => '{{WRAPPER}} .mi-product__image',
            ]
        );

        $this->add_responsive_control(
            'card_box_image_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_image_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product__image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .mi-product__image img' => 'width: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product__image img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product__image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product__image img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-product__image img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style Product Content
        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Product Content', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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
                    '{{WRAPPER}} .mi-product-card__item-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_typography',
                'selector' => '{{WRAPPER}} .mi-product-card__item-title',
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
                    '{{WRAPPER}} .mi-product-card__item-title' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_item_title_margin_bottom',
            [
                'label' => __( 'Margin Bottom', 'modista' ),
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
                    '{{WRAPPER}} .mi-product-card__item-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_item_price',
            [
                'label' => esc_html__( 'Price', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'card_item_price_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-Price-amount bdi' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_price_typography',
                'selector' => '{{WRAPPER}} .woocommerce-Price-amount bdi',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_symbol_typography',
                'selector' => '{{WRAPPER}} bdi .woocommerce-Price-currencySymbol',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_control(
            'card_item_price_sale',
            [
                'label' => esc_html__( 'Sale Price', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'card_item_price_sale_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} del .woocommerce-Price-amount bdi' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce-Price-amount  .woocommerce-Price-currencySymbol' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_price_sale_typography',
                'selector' => '{{WRAPPER}} del .woocommerce-Price-amount bdi',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'card_item_price_sale_badge',
            [
                'label' => esc_html__( 'Sale Badge', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'card_item_price_sale_badge_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-product-loop__discount' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'card_item_price_sale_badge_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-product-loop__discount' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_price_sale_badge_typography',
                'selector' => '{{WRAPPER}} .mi-product-loop__discount',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'card_item_price_sale_badge_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-loop__discount' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'card_item_price_sale_badge_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-loop__discount' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_item_add_to_cart',
            [
                'label' => esc_html__( 'Add To Cart', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'card_item_add_to_cart_width',
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
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart svg' => 'width: {{SIZE}}{{UNIT}}; height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_add_to_cart_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'item_add_to_cart_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        // Normal and Hover tab
        $this->start_controls_tabs( 'tabs_image_background' );

        $this->start_controls_tab(
            'tab_image_background_normal',
            [
                'label' => __( 'Normal', 'modista' ),
            ]
        );

        $this->add_control(
            'item_add_to_cart_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart svg path' => 'stroke: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'item_add_to_cart_background',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_image_background_hover',
            [
                'label' => __( 'Hover', 'modista' ),
            ]
        );

        $this->add_control(
            'item_add_to_cart_color_hover',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart:hover svg path' => 'stroke: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'item_add_to_cart_background_hover',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item-add-to-cart:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        // End

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
                'label' => __( 'Padding', 'modista' ),
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
                'label' => __( 'Border Radius', 'modista' ),
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

    /**
     * Custom method
     * @return array
     */
    private function get_product_categories() {
        $categories = get_terms('product_cat');
        $options = [];
        if (!is_wp_error($categories)) {
            foreach ($categories as $category) {
                $options[$category->slug] = $category->name;
            }
        }
        return $options;
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
        $this->add_render_attribute('slide_classes', 'class', 'swiper-slide mi-product__slide');
        if ($settings['slides_height_equal'] === 'yes') {
            $this->add_render_attribute('slide_classes', 'class', 'h-auto');
        }

        if ( ! empty($tabs) ) {
            ?>
            <div class="mi-carousel">
                <div <?php echo $this->get_render_attribute_string('swiper') ?> data-slides-per-view="<?php echo esc_attr($carousel_per_view); ?>" data-slides-per-view-tablet="<?php echo esc_attr($carousel_per_view_tablet); ?>" data-slides-per-view-mobile="<?php echo esc_attr($carousel_per_view_mobile); ?>" data-speed="<?php echo esc_attr($settings['carousel_speed']); ?>">
                    <div class="swiper-wrapper">
                        <?php
                        foreach ($tabs as $index => $tab) {

                            echo sprintf("<div id=\"tab-%s\" %s >",esc_attr($index),$this->get_render_attribute_string('slide_classes'));

                                echo '<div class="slide-wrapper">';

                                    echo '<div class="mi-tab-titles d-flex">';
                                        // Render tab title
                                        echo '<p class="mi-tab-title">';
                                            echo esc_html($tab['tab_title']);
                                        echo '</p>';

                                        // Render more button
                                        if ($tab['more_button'] == 'yes') {
                                        // If the button have link
                                        if ( ! empty( $tab['button_link']['url'] ) ) $this->add_link_attributes( 'button_link_' . $index, $tab['button_link'] );
                                        ?>
                                        <a <?php $this->print_render_attribute_string( 'button_link_' . $index ); ?> class="mi-more-button d-flex">
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

                                    $query_args = [
                                        'post_type' => 'product',
                                        'posts_per_page' => $tab['posts_per_page'],
                                        'order' => $tab['order'],
                                    ];
                                    if ($tab['order_by'] === 'meta_value_num') {
                                        $query_args['orderby'] = 'meta_value_num';
                                        $query_args['meta_key'] = 'total_sales';
                                    } else {
                                        $query_args['orderby'] = $tab['order_by'];
                                    }
                                    if (!empty($tab['product_category'])) {
                                        $query_args['tax_query'] = [
                                            [
                                                'taxonomy' => 'product_cat',
                                                'field' => 'slug',
                                                'terms' => $tab['product_category'],
                                            ],
                                        ];
                                    }
                                    $query = new \WP_Query($query_args);

                                    echo '<div>';
                                        // Render products
                                        if ($query->have_posts()) {
                                            while ( $query->have_posts() ) : $query->the_post(); ?>
                                                <div class="mi-product__item d-flex">
                                                    <div class="mi-product__image">
                                                        <a href="<?php the_permalink(); ?>">
                                                            <?php woocommerce_template_loop_product_thumbnail(); ?>
                                                        </a>
                                                    </div>
                                                    <div class="mi-product-card__item-link d-flex flex-1 flex-column">
                                                        <?php
                                                        if ( $settings['content_show_title'] === 'yes') {
                                                            echo '<h2 class="mi-product-card__item-title">';
                                                            the_title();
                                                            echo '</h2>';
                                                        }
                                                        ?>

                                                        <div class="d-flex justify-content-between align-items-center">
                                                            <?php woocommerce_template_loop_add_to_cart(['class' => 'ajax_add_to_cart mi-product-card__item-add-to-cart d-flex']); ?>
                                                            <div class="mi-product-card__item-price position-relative">
                                                                <?php global $product; ?>
                                                                <div class="price text-left">
                                                                    <?php echo mi_woocommerce_get_price_html($product->get_price_html(), $product ,'inline'); ?>
                                                                </div>
                                                            </div>
                                                        </div>

                                                    </div>
                                                </div>
                                            <?php
                                            endwhile;
                                            wp_reset_postdata();
                                        }
                                        else {
                                            echo '<p>' . __('No products found', 'modista') . '</p>';
                                        }
                                    echo '</div>';

                                echo '</div>';
                            echo '</div>';
                        }
                        // If show navigation true
                        Elementor_Controls_Helper::get_carousel_navigation_render($this, $settings);
                    echo '</div>';
                    Elementor_Controls_Helper::get_carousel_pagination_render($this, $settings);
                echo '</div>
            </div>';
        }
        else {
            error_log('No tabs found in settings.');
        }
    }
}
