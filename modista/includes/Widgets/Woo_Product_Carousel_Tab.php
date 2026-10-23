<?php

namespace Modista\Widgets;

use Modista\Classes\Elementor_Controls_Helper;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Woo_Product_Carousel_Tab extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-product-carousel-tab';
    }

    public function get_title() {
        return __('Product Tab Carousel', 'modista');
    }

    public function get_icon() {
        return 'eicon-product-tabs';
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];

        return [
            'mi-widget-woo-product-tab',
            'mi-base-carousel',
            'mi-widget-woo-card',
        ];

    }

    public function get_style_depends()
    {
        return [ 'mi-bundle-widget' ];

        return ['mi-widget-woo-card'];
    }

    public function get_categories() {
        return ['modista'];
    }

    protected function register_controls() {

        $this->start_controls_section(
                'tabs_section',
                [
                    'label' => __('Tabs', 'modista'),
                    'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
                ]
            );

        $this->add_control(
            'tabs',
            [
                'label' => __('Tabs', 'modista'),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => [
                    [
                        'name' => 'tab_title',
                        'label' => __('Tab Title', 'modista'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('New Tab', 'modista'),
                    ],
                    [
                        'name' => 'product_category',
                        'label' => __('Product Category', 'modista'),
                        'type' => \Elementor\Controls_Manager::SELECT2,
                        'options' => $this->get_product_categories(),
                        'multiple' => true,
                    ],
                    [
                        'name' => 'order_by',
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
                    [
                        'name' => 'order',
                        'label' => __('Order', 'modista'),
                        'type' => \Elementor\Controls_Manager::SELECT,
                        'options' => [
                            'ASC' => __('Ascending', 'modista'),
                            'DESC' => __('Descending', 'modista'),
                        ],
                        'default' => 'DESC',
                    ],
                    [
                        'name' => 'posts_per_page',
                        'label' => __('Posts Per Page', 'modista'),
                        'type' => \Elementor\Controls_Manager::NUMBER,
                        'default' => 8,
                        'separator' => 'after'
                    ],
                    [
                        'name' => 'more_button',
                        'label' => __('More Button', 'modista'),
                        'type' => \Elementor\Controls_Manager::SWITCHER,
                        'label_on' => esc_html__( 'Yes', 'modista' ),
                        'label_off' => esc_html__( 'No', 'modista' ),
                        'return_value' => 'yes',
                        'default' => 'yes',
                    ],
                    [
                        'name' => 'button_title',
                        'label' => __('Button Title', 'modista'),
                        'type' => \Elementor\Controls_Manager::TEXT,
                        'default' => __('Show more', 'modista'),
                        'condition' => [ 'more_button' => 'yes' ]
                    ],
                    [
                        'name' => 'button_link',
                        'label' => __('Button Link', 'modista'),
                        'type' => \Elementor\Controls_Manager::URL,
                        'condition' => [ 'more_button' => 'yes' ]
                    ]
                ],
                'default' => [],
                'title_field' => '{{{ tab_title }}}',
            ]
        );

        $this->end_controls_section();

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

        // Settings Section
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
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Box', 'modista'),
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
            'swiper_slide_padding',
            [
                'label' => __('فاصله داخلی گردونه', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-card__slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .mi-product-card__item' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-card__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-card__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );
        
        $this->start_controls_tabs( 'slide_card_item' );  // شروع تب‌ها

        // تب معمولی (normal) برای تنظیمات پیش‌فرض
        $this->start_controls_tab(
            'normal_tab',
            [
                'label' => __( 'Normal', 'modista' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slide_box_shadow',
                'selector' => '{{WRAPPER}} .mi-product-card__item',
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

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_border',
                'selector' => '{{WRAPPER}} .mi-product-card__item',
            ]
        );

        $this->add_control(
            'slide_transition',
            [
                'label' => __('مدت انتقال', 'modista'),
                'type' => \Elementor\Controls_Manager::TEXT,
                'default' => 'all 0.3s ease', // مقدار پیش‌فرض transition
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item' => 'transition: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();  // پایان تب معمولی

        // تب هاور (hover) برای تنظیمات حالت هاور
        $this->start_controls_tab(
            'hover_tab',
            [
                'label' => __( 'Hover', 'modista' ),
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'slide_box_shadow_hover',
                'selector' => '{{WRAPPER}} .mi-product-card__item:hover',
            ]
        );

        $this->add_control(
            'slide_background_hover',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__item:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item_border_hover',
                'selector' => '{{WRAPPER}} .mi-product-card__item:hover',
            ]
        );

        $this->end_controls_tab();  // پایان تب هاور

        $this->end_controls_tabs();  // پایان همه تب‌ها

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Image', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
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

        $this->add_responsive_control(
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

        $this->add_responsive_control(
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

        $this->add_responsive_control(
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
                    '{{WRAPPER}} .mi-product-card__image > img' => 'height: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-product-card__image > a img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-card__image > img' => 'object-fit: {{VALUE}};',
                    '{{WRAPPER}} .mi-product-card__image > a img' => 'object-fit: {{VALUE}};',
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

        $this->add_responsive_control(
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

        $this->add_responsive_control(
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
                'label' => __('Content', 'modista'),
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
                    '{{WRAPPER}} .woocommerce-Price-amount .woocommerce-Price-currencySymbol' => 'color: {{VALUE}};',
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

        // Tab Toggle
        $this->start_controls_section(
            'style_tab_section',
            [
                'label' => __('Tab Toggle', 'modista'),
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
            'tab_head_gap',
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
                    '{{WRAPPER}} .mi-tab-titles' => 'gap: {{SIZE}}{{UNIT}};',
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
                'label' => esc_html__( 'Tab', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tab_title_item_typography',
                'selector' => '{{WRAPPER}} .mi-tab-titles ul li',
            ]
        );

        $this->add_responsive_control(
            'tab_title_gap',
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
                    '{{WRAPPER}} .mi-tab-titles ul' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_title_item_border_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-tab-titles ul li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_title_item_border',
                'selector' => '{{WRAPPER}} .mi-tab-titles ul li',
            ]
        );

        $this->add_control(
            'tab_title_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul li' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_title_item_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul li' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        // Normal and Hover tab
        $this->start_controls_tabs( 'tab_title_item_status' );

        $this->start_controls_tab(
            'tab_title_item_hover',
            [
                'label' => __( 'Hover', 'modista' ),
            ]
        );

        $this->add_control(
            'tab_title_item_color_hover',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul li:hover' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_title_item_background_color_hover',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul li:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_title_item_border_color_hover',
            [
                'label' => esc_html__( 'Border Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul li:hover' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_title_item_active',
            [
                'label' => __( 'Active', 'modista' ),
            ]
        );

        $this->add_control(
            'tab_title_item_color_active',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul .active' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_title_item_background_color_active',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul .active' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_title_item_border_color_active',
            [
                'label' => esc_html__( 'Border Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab-titles ul .active' => 'border-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();
        // End

        $this->add_control(
            'tab_more_item',
            [
                'label' => esc_html__( 'More Button', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            "justify_content_tab_more",
            [
                'label' => esc_html__( 'Justify Content', 'elementor' ),
                'type' => \Elementor\Controls_Manager::CHOOSE,
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
                    '{{WRAPPER}} .mi-tab__more-button' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_more_position',
            [
                'label' => esc_html__( 'Position', 'modista' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => '',
                'options' => [
                    '' => esc_html__( 'Default', 'modista' ),
                    'relative' => esc_html__( 'Relative', 'modista' ),
                    'absolute'  => esc_html__( 'Absolute', 'modista' ),
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab__more-button' => 'position: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            "tab_more_top_offset",
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
                    '{{WRAPPER}} .mi-tab__more-button' => 'top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'tab_more_position!' => '' ]
            ]
        );

        $this->add_responsive_control(
            "tab_more_right_offset",
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
                    '{{WRAPPER}} .mi-tab__more-button' => 'right: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'tab_more_position!' => '' ]
            ]
        );

        $this->add_responsive_control(
            "tab_more_bottom_offset",
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
                    '{{WRAPPER}} .mi-tab__more-button' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [ 'tab_more_position!' => '' ]
            ]
        );

        $this->add_responsive_control(
            "tab_more_left_offset",
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
                    '{{WRAPPER}} .mi-tab__more-button' => 'left: {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after',
                'condition' => [ 'tab_more_position!' => '' ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'tab_more_item_typography',
                'selector' => '{{WRAPPER}} .mi-tab__more-button',
            ]
        );

        $this->add_responsive_control(
            'tab_more_item_border_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-tab__more-button > a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-tab__more-button > a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'tab_more_item_border',
                'selector' => '{{WRAPPER}} .mi-tab__more-button > a',
            ]
        );

        $this->add_control(
            'tab_more_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab__more-button > a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'tab_more_item_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-tab__more-button > a' => 'background-color: {{VALUE}};',
                ]
            ]
        );

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

    /**
     * Custom method
     * @return void
     */
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

    /**
     * Custom method
     * @return void
     */
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
        $this->add_render_attribute('slide_classes', 'class', 'swiper-slide mi-product-card__slide');
        if ($settings['slides_height_equal'] === 'yes') {
            $this->add_render_attribute('slide_classes', 'class', 'h-auto');
        }

        if ( ! empty($tabs) ) {
            echo '<div class="mi-product-tabs">';

                echo '<div class="mi-tab-titles d-flex flex-wrap">';

                    echo '<ul class="d-flex flex-wrap">';
                    foreach ($tabs as $index => $tab) {
                        $active = ($index == 0 ) ? ' active' : '';
                        echo '<li data-tab="tab-' . esc_attr($index) . '" class="tab-title cursor-pointer' . $active . '">' . esc_html($tab['tab_title']) . '</li>';
                    }
                    echo '</ul>';

                    // Print more buttons link
                    echo '<div class="mi-tab__more-button d-flex">';
                    foreach ($tabs as $index => $tab) {
                        // If button disabled
                        if ( $tab['more_button'] != 'yes' ) continue;

                        if ( ! empty( $tab['button_link']['url'] ) ) {
                            $this->add_link_attributes( 'button_link_' . $index, $tab['button_link'] );
                        }

                        // Hidden deactivate buttons
                        $this->add_render_attribute('more_button_class_' . $index, 'class', "more-tab-$index");
                        if ($index != 0 ) $this->add_render_attribute('more_button_class_' . $index, 'class', 'd-none');
                        ?>
                        <a <?php $this->print_render_attribute_string( 'button_link_' . $index ); ?> <?php echo $this->get_render_attribute_string('more_button_class_' . $index); ?>>
                            <?php echo esc_html($tab['button_title']); ?>
                        </a>
                        <?php
                    }
                    echo '</div>';

                echo '</div>';

                echo '<div class="mi-tab-contents">';
                foreach ($tabs as $index => $tab) {

                    $d_none = ($index != 0 ) ? ' d-none' : '';
                    echo '<div id="tab-' . esc_attr($index) . '" class="tab-content' . $d_none . '">';

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

                    if ($query->have_posts()) {
                        echo '<div class="mi-carousel">';
                        ?>
                            <div <?php echo $this->get_render_attribute_string('swiper') ?> data-slides-per-view="<?php echo esc_attr($carousel_per_view); ?>" data-slides-per-view-tablet="<?php echo esc_attr($carousel_per_view_tablet); ?>" data-slides-per-view-mobile="<?php echo esc_attr($carousel_per_view_mobile); ?>" data-speed="<?php echo esc_attr($settings['carousel_speed']); ?>">
                                <div class="swiper-wrapper">
                                    <?php while ($query->have_posts()) : $query->the_post(); ?>
                                        <div <?php echo $this->get_render_attribute_string('slide_classes') ?>>
                                            <div class="mi-product-card__item">
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
                                                    <?php
                                                    if ( $settings['content_show_title'] === 'yes') :
                                                        ?>
                                                        <h2 class="mi-product-card__item-title"><?php the_title(); ?></h2>
                                                    <?php
                                                    endif;

                                                    // Show select color
                                                    if ( 'yes' === $settings['content_enable_color'] ) $this->echo_product_color();
                                                    ?>
                                                </div>
                                                <div class="d-flex flex-wrap justify-content-between align-items-center">
                                                    <?php woocommerce_template_loop_add_to_cart(['class' => 'ajax_add_to_cart mi-product-card__item-add-to-cart d-flex flex-column']); ?>
                                                    <div class="mi-product-card__item-price">
                                                        <?php woocommerce_template_loop_price(); ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endwhile; ?>
                                </div>
                            </div>

                            <?php
                            // Render navigation
                            Elementor_Controls_Helper::get_carousel_navigation_render($this, $settings);

                        echo '</div>';
                    wp_reset_postdata();
                    }
                    else {
                        echo '<p>' . __('No products found', 'modista') . '</p>';
                    }
                    echo '</div>';
                }
                echo '</div>';

            echo '</div>';
        }
        else {
            error_log('No tabs found in settings.');
        }
    }
}
