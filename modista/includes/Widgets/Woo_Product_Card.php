<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Woo_Product_Card extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-product-card';
    }

    public function get_title() {
        return __('Product Card', 'modista');
    }

    public function get_icon() {
        return 'eicon-single-product';
    }

    public function get_categories() {
        return ['modista'];
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];

        return ['mi-widget-woo-card'];
    }

    public function get_style_depends()
    {
        return [ 'mi-bundle-widget' ];

        return ['mi-widget-woo-card'];
    }

    protected function register_controls() {

        // Content Section
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

        $this->add_control(
            'content_enable_gallery',
            [
                'label' => __('Enable Card Gallery', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'content_enable_color',
            [
                'label' => __('Enable Card Color', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
            ]
        );

        $this->end_controls_section();

        // Query Section
        $this->start_controls_section(
            'query_section',
            [
                'label' => __('Query', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'product_count',
            [
                'label' => __('Number of Products', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 1,
                'max' => 20,
                'step' => 1,
            ]
        );

        $this->add_control(
            'product_categories',
            [
                'label' => __('Product Categories', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_product_categories(),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Style Controls
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Box Style', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'container_slide_margin',
            [
                'label' => __('Container Margin', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_space_between',
            [
                'label' => __( 'Card Space Between', 'modista' ),
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
                    '{{WRAPPER}} .mi-product-card-wrapper' => 'gap: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
            'card_height_equal',
            [
                'label' => esc_html__( 'Equal Height', 'modista' ),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Yes', 'modista' ),
                'label_off' => esc_html__( 'No', 'modista' ),
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'card_height',
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
                    '{{WRAPPER}} .mi-product-card__item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slide_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'slide_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slide_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selectors' => '{{WRAPPER}} .mi-product-card__item'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Image Style', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .mi-product-card__image' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'card_image_background',
                'types' => [ 'classic', 'gradient', 'image' ],
                'selector' => '{{WRAPPER}} .mi-product-card__image',
            ]
        );

        $this->add_control(
            'card_box_image_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_image_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_image_heading',
            [
                'label' => __( 'Image', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'card_image_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__image > img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mi-product-card__image > a img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .mi-product-card__image > img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-product-card__image > a img' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
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
                    '{{WRAPPER}} .mi-product-card__image > img' => 'object-fit: {{VALUE}};',
                    '{{WRAPPER}} .mi-product-card__image > a img' => 'object-fit: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_image_object_position',
            [
                'label' => __( 'Object Position', 'modista' ),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'center center',
                'description' => __( 'جایگاه عکس را تنظیم کنید', 'modista' ),
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__image > img' => 'object-position: {{VALUE}};',
                    '{{WRAPPER}} .mi-product-card__image > a img' => 'object-position: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'card_item_image_gallery',
            [
                'label' => esc_html__( 'Gallery', 'elementor' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'card_item_gallery_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__gallery-thumbnails' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'card_item_gallery_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__gallery-thumbnails' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'card_item_gallery_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__gallery-thumbnails' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_content_section',
            [
                'label' => __('Content Style', 'modista'),
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

        $this->add_control(
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

        $this->add_control(
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
                    '{{WRAPPER}} .mi-product-loop__regular-price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce-Price-amount  .woocommerce-Price-currencySymbol' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'card_item_price_sale_typography',
                'selector' => '{{WRAPPER}} .mi-product-loop__regular-price',
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->end_controls_section();

        $this->start_controls_section(
            'style_thumbnail_slide_section',
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
                'label' => esc_html__( 'Option', 'digiplus' ),
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

    private function echo_product_galley() {
        $product = wc_get_product(get_the_ID());
        $gallery_image_ids = $product->get_gallery_image_ids();

        if ( ! empty($gallery_image_ids) ) :

            echo '<div class="mi-product-card__gallery-thumbnails d-flex justify-content-between">';

            echo '<div class="thumbnail" data-index="' .  0 . '">';
                woocommerce_template_loop_product_thumbnail();
            echo '</div>';

            foreach ($gallery_image_ids as $key => $image_id) {

                // Maximum gallery count
                if ( $key === 4 ) break;
                
                $image_src = wp_get_attachment_image_url($image_id, 'thumbnail');
                ?>
                <div class="thumbnail" data-index="<?php echo $key + 1 ?>">
                    <img decoding="async" src="<?php echo esc_url($image_src); ?>" alt="Gallery Thumbnail">
                </div>
                <?php
            }
            ?>
            </div>
        <?php
        endif;
    }

    private function echo_product_color() {

        $product = wc_get_product(get_the_ID());

        if ($product->is_type('variable')) {
            $available_variations = $product->get_available_variations();
            $attribute_name = 'pa_color'; // نام ویژگی رنگ
            ?>
            <div class="mi-product-card__color-options d-flex">
                <?php foreach ($available_variations as $variation) :
                    if (isset($variation['attributes']["attribute_$attribute_name"])) {
                        $color = $variation['attributes']["attribute_$attribute_name"];
                        $image_id = $variation['image_id']; // دریافت ID تصویر متغیر
                        $image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : ''; // URL تصویر
                        ?>
                        <span
                            class="color-circle"
                            style="background-color: <?php echo esc_attr($color); ?>"
                            data-variation-id="<?php echo esc_attr($variation['variation_id']); ?>"
                            data-image-src="<?php echo esc_attr($image_url); ?>"
                            title="<?php echo esc_attr($color); ?>">
                        </span>
                        <?php
                    }
                endforeach; ?>
            </div>
            <?php
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $args = [
            'post_type' => 'product',
            'posts_per_page' => $settings['product_count'],
        ];

        if (!empty($settings['product_categories'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $settings['product_categories'],
                ],
            ];
        }

        // Slide Class attributes
        $this->add_render_attribute('card_classes', 'class', 'mi-product-card__item');
        if ($settings['card_height_equal'] === 'yes') {
            $this->add_render_attribute('card_classes', 'class', 'h-auto');
        }

        $products = new \WP_Query($args);
        if ($products->have_posts()) :
            ?>
            <div class="mi-product-card">
                <div class="mi-product-card-wrapper d-flex flex-row">
                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <div <?php echo $this->get_render_attribute_string('card_classes') ?>>
                            <div class="mi-product-card__item-link d-flex flex-column">
                                <div class="mi-product-card__image">
                                    <a href="<?php the_permalink(); ?>">
                                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                                    </a>
                                    <?php
                                    // Render gallery
                                    if ( 'yes' === $settings['content_enable_gallery'] ) $this->echo_product_galley();

                                    // Render Navigation
                                    if ( 'yes' === $settings['content_enable_gallery'] || 'yes' === $settings['content_enable_color'] ) :
                                        ?>
                                    <!-- Navigation for thumbnails -->
                                    <button class="nav-button prev-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L4.84873 12.93L4.84883 12.9299L4.85458 9.76505L9.48809 9.77345L9.07583 5.71905L11.438 3.35684L13.6759 5.59472L9.49716 9.77347L17.7358 9.78841L17.7301 12.9532L9.33251 12.938L13.5516 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
                                        </svg>
                                    </button>
                                    <button class="nav-button next-button">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L17.7787 12.93L17.7786 12.9299L17.7728 9.76505L13.1393 9.77345L13.5516 5.71905L11.1894 3.35684L8.95152 5.59472L13.1303 9.77347L4.89162 9.78841L4.89736 12.9532L13.2949 12.938L9.07584 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
                                        </svg>
                                    </button>
                                    <?php
                                    endif;
                                    ?>
                                </div>
                                <?php if ( $settings['content_show_title'] === 'yes') : ?>
                                    <a href="<?php the_permalink(); ?>">
                                        <h2 class="mi-product-card__item-title"><?php the_title(); ?></h2>
                                    </a>
                                <?php
                                endif;

                                // Show select color
                                if ( 'yes' === $settings['content_enable_color'] ) $this->echo_product_color();
                                ?>
                            </div>
                            <div class="d-flex justify-content-between align-items-center">
                                <?php woocommerce_template_loop_add_to_cart(['class' => 'ajax_add_to_cart mi-product-card__item-add-to-cart d-flex']); ?>
                                <div class="mi-product-card__item-price">
                                    <?php woocommerce_template_loop_price(); ?>
                                </div>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php
            wp_reset_postdata();
        endif;
    }
}
