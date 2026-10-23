<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

use Elementor\Controls_Manager;
use Elementor\Core\Kits\Documents\Tabs\Global_Typography;
use Elementor\Group_Control_Typography;

class Woo_Mini_Cart extends \Elementor\Widget_Base {

    public function get_name() {
        return 'dp-woo-mini-cart';
    }

    public function get_title() {
        return __( 'Mini Cart', 'modista' );
    }

    public function get_icon() {
        return 'eicon-cart';
    }

    function get_keywords()
    {
        return ['contact', __('Contact Box', 'modista'), 'modista', __('modista', 'modista') ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    public function get_style_depends(): array {
        return [ 'mi-bundle-widget' ];

        return [ 'mi-widget-woo-mini-cart' ];
    }
    
    public function get_script_depends(): array {
        return [ 'mi-bundle-widget' ];

        return [ 'mi-widget-woo-mini-cart' ];
    }

    protected function _register_controls() {

        // Controls for the content.
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Toggle', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label' => __( 'Icon', 'modista' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'button_title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('سبد خرید', 'modista')                			
            ]
        );

        $this->add_control(
            'button_divider',
            [
                'label' => __( 'Divider', 'modista' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => esc_html__( 'Show', 'modista' ),
				'label_off' => esc_html__( 'Hide', 'modista' ),
				'return_value' => 'yes',
				'default' => 'yes',
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        // Controls for the content.
        $this->start_controls_section(
            'content_section_checkout_button',
            [
                'label' => __( 'Button Checkout', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'checkout_button_icon',
            [
                'label' => __( 'Icon', 'modista' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'checkout_button_title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('تسویه حساب', 'modista')
            ]
        );

        $this->add_control(
            'cart_button_heading',
            [
                'label'     => __('Cart', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'cart_button_icon',
            [
                'label' => __( 'Icon', 'modista' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'cart_button_title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('سبد خرید', 'modista')
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        // Controls for the content.
        $this->start_controls_section(
            'content_section_empty_cart',
            [
                'label' => __( 'Empty Cart', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );    

        $this->add_control(
            'content_section_empty_cart_icon',
            [
                'label' => __( 'Icon', 'modista' ),
                'type' => Controls_Manager::ICONS,
            ]
        );

        $this->add_control(
            'content_section_empty_cart_title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'default' => __('سبد خرید شما خالیست!', 'modista')
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        $this->start_controls_section(
            'style_button',
            [
                'label' => __( 'Button Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_direction',
            [
                'label'   => __( 'Direction', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => __( 'Row', 'modista' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => __( 'Row Reverse', 'modista' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => __( 'Column', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                    'column-reverse' => [
                        'title' => __( 'Column Reverse', 'modista' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                ],
                'default' => 'vertical',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'button_align_items',
            [
                'label'   => __( 'Align Items', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Start', 'modista' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modista' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'End', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_heading',
            [
                'label'     => __('Button', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .mi-mini-cart__button',
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'login_button_gap',
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
                    'unit' => 'px',
                    'size' => 8
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'login_button_padding',
            [
                'label' => __( 'Padding', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'login_button_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'login_button_border',
                'selector' => '{{WRAPPER}} .mi-mini-cart__button',
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
            'button_icon_width',
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
                    'size' => 24,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-mini-cart__icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__icon' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .mi-mini-cart__icon svg path' => 'fill: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'divider_heading',
            [
                'label'     => __('Divider', 'modista'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'button_divider_height',
            [
                'label' => __( 'Height', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'size' => 16,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__divider' => 'height: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'button_divider_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__divider' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_dropdown',
            [
                'label' => esc_html__( 'Dropdown Style', 'modista' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dropdown__background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__result' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'dropdown_padding',
            [
                'label' => __( 'Padding', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__result' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_dropdown_item',
            [
                'label' => esc_html__( 'Dropdown Item Style', 'modista' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dropdown_box',
            [
                'label' => esc_html__( 'Box', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dropdown_box_gap',
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
                    'unit' => 'px',
                    'size' => 8
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart-list' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_box_padding',
            [
                'label' => __( 'Padding', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_box_border',
                'selector' => '{{WRAPPER}} .mi-mini-cart__item',
            ]
        );

        $this->add_control(
            'dropdown_title',
            [
                'label' => esc_html__( 'Title', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dropdown_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__item-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dd_item_typography',
                'selector' => '{{WRAPPER}} .mi-mini-cart__item-title',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_price',
            [
                'label' => esc_html__( 'Price', 'modista' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dropdown_item_price_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .woocommerce-Price-amount bdi' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dd_item_price_typography',
                'selector' => '{{WRAPPER}} .woocommerce-Price-amount bdi',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_price_sale',
            [
                'label' => esc_html__( 'Sale Price', 'modista' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dropdown_item_price_sale_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mini-cart__item-regular-price' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .woocommerce-Price-amount  .woocommerce-Price-currencySymbol' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dropdown_item_price_sale_typography',
                'selector' => '{{WRAPPER}} .mini-cart__item-regular-price',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_price_sale_badge',
            [
                'label' => esc_html__( 'Sale Badge', 'modista' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dropdown_item_sale_badge_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mini-cart__item-discount' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'dropdown_item_sale_badge_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mini-cart__item-discount' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'dropdown_item_price_sale_badge_typography',
                'selector' => '{{WRAPPER}} .mini-cart__item-discount',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_quantity',
            [
                'label' => esc_html__( 'Quantity', 'modista' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'item-quantity_typography',
                'selector' => '{{WRAPPER}} .mini-cart__item-quantity',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'dropdown_item_quantity_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mini-cart__item-quantity' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'dropdown_item_quantity_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mini-cart__item-quantity' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'item-quantity_padding',
            [
                'label' => __( 'Padding', 'modista' ),
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
                    '{{WRAPPER}} .mini-cart__item-quantity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item-quantity_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
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
                    '{{WRAPPER}} .mini-cart__item-quantity' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item-quantity_border',
                'selector' => '{{WRAPPER}} .mini-cart__item-quantity',
            ]
        );

        $this->add_control(
            'dropdown_item_quantity_toggle',
            [
                'label' => esc_html__( 'Quantity Toggle', 'modista' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dropdown_item_quantity_toggle_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.mini-cart__quantity svg' => 'stroke: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'dropdown_item_quantity_toggle_color_disable',
            [
                'label' => esc_html__( 'Color Disable', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.mini-cart__quantity--disable svg' => 'stroke: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'dropdown_item_quantity_toggle_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} button.mini-cart__quantity' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'item-quantity_toggle_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} button.mini-cart__quantity' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'item-quantity_toggle_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} button.mini-cart__quantity' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'item-quantity_toggle_border',
                'selector' => '{{WRAPPER}} button.mini-cart__quantity',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'section_style_content',
            [
                'label' => esc_html__( 'Empty Cart Style', 'modista' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'empty_box',
            [
                'label' => esc_html__( 'Box', 'elementor' ),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'empty_gap',
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
                    'unit' => 'px',
                    'size' => 8
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__empty-message' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__empty-message' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'selector' => '{{WRAPPER}} .mi-mini-cart__empty-message',
                'global' => [
                    'default' => Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'empty_icon',
            [
                'label' => esc_html__( 'Icon', 'elementor' ),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'empty_icon_width',
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
                    'size' => 64,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-empty-message__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-empty-message__icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'empty_button',
            [
                'label' => esc_html__( 'Empty Button', 'modista' ),
                'type' => Controls_Manager::HEADING,
            ]
        );
        
        $this->add_control(
            'empty_return_shop_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__empty-message a' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'empty_return_shop_background_color',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__empty-message a' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'empty_return_shop_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 4,
                    'right' => 4,
                    'bottom' => 4,
                    'left' => 4,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__empty-message a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'empty_return_shop_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 8,
                    'right' => 8,
                    'bottom' => 8,
                    'left' => 8,
                    'unit' => 'px',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__empty-message a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'empty_return_shop_border',
                'selector' => '{{WRAPPER}} .mi-mini-cart__empty-message a',
            ]
        );
        
        $this->end_controls_section();

        $this->start_controls_section(
            'style_checkout_button',
            [
                'label' => __( 'Button Checkout Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'dropdown_button_wrap_heading',
            [
                'label'     => __('Wrap', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dropdown_button_wrap_margin',
            [
                'label' => __( 'Margin', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_wrap_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_button_wrap_border',
                'selector' => '{{WRAPPER}} .mi-mini-cart__buttons',
            ]
        );

        $this->add_control(
            'dropdown_button_heading',
            [
                'label'     => __('Buttons', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'dropdown_button_direction',
            [
                'label'   => __( 'Direction', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'row' => [
                        'title' => __( 'Row', 'modista' ),
                        'icon'  => 'eicon-h-align-left',
                    ],
                    'row-reverse' => [
                        'title' => __( 'Row Reverse', 'modista' ),
                        'icon'  => 'eicon-h-align-right',
                    ],
                    'column' => [
                        'title' => __( 'Column', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                    'column-reverse' => [
                        'title' => __( 'Column Reverse', 'modista' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                ],
                'default' => 'vertical',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_button_align_items',
            [
                'label'   => __( 'Align Items', 'modista' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-start' => [
                        'title' => __( 'Start', 'modista' ),
                        'icon'  => 'eicon-v-align-top',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'modista' ),
                        'icon'  => 'eicon-v-align-middle',
                    ],
                    'flex-end' => [
                        'title' => __( 'End', 'modista' ),
                        'icon'  => 'eicon-v-align-bottom',
                    ],
                ],
                'default' => 'center',
                'toggle'  => true,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'align-items: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'dropdown_button_typography',
                'selector' => '{{WRAPPER}} .mi-mini-cart__buttons a',
            ]
        );

        $this->add_control(
            'dropdown_button_icon',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_bg_color',
            [
                'label' => __( 'Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_gap',
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
                    'unit' => 'px',
                    'size' => 8
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_padding',
            [
                'label' => __( 'Padding', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__buttons a' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_button_border',
                'selector' => '{{WRAPPER}} .mi-mini-cart__buttons a',
            ]
        );

        $this->add_control(
            'dropdown_button_cart_heading',
            [
                'label'     => __('Cart', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'dropdown_button_cart_padding',
            [
                'label' => __( 'Padding', 'modista' ),
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
                    '{{WRAPPER}} .mi-mini-cart__buttons .cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_cart_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_PRIMARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons .cart' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_cart_bg_color',
            [
                'label' => __( 'Background Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__buttons .cart' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_icon_heading',
            [
                'label'     => __('Icon', 'modista'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'dropdown_button_icon_width',
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
                    'size' => 24,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button-icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-mini-cart__button-icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_button_icon_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-mini-cart__button-icon' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        global $woocommerce;

        $settings = $this->get_settings_for_display();

        $mini_cart_args = [
            'empty_icon'            => $settings['content_section_empty_cart_icon'] ?? '',
            'empty_title'           => $settings['content_section_empty_cart_title'] ?? '',
            'checkout_button_icon'  => $settings['checkout_button_icon'] ?? '',
            'checkout_button_title' => $settings['checkout_button_title'] ?? '',
            'cart_button_icon'      => $settings['cart_button_icon'] ?? '',
            'cart_button_title'     => $settings['cart_button_title'] ?? ''
        ];

        // Get cart total
        $cart_total = null;
        if ( $woocommerce->cart && $woocommerce->cart->total ) {
            $cart_total = number_format($woocommerce->cart->total);
        }    
        ?>
        <div class="mi-mini-cart h-100 position-relative">
            <a href="<?php echo wc_get_cart_url(); ?>" class="mi-mini-cart__button h-100<?php echo !is_null($cart_total) ? ' mi-mini-cart__button--has-item' : ''; ?>">
                <div class="mi-mini-cart__icon">
                    <?php
                    if ( $settings['button_icon']['library'] ) :
                        if ($settings['button_icon']['library'] == 'svg') {
                            echo '<img src="' . esc_url($settings['button_icon']['value']['url']) . '" alt="">';
                        } else {
                            \Elementor\Icons_Manager::render_icon($settings['button_icon'], ['aria-hidden' => 'true']);
                        }
                    else :
                        ?>
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="22" viewBox="0 0 24 22" fill="none">
                            <g clip-path="url(#clip0_2097_14269)">
                                <path d="M9.33333 16.8438C9.33333 17.4153 8.8875 17.875 8.33333 17.875C7.77917 17.875 7.33333 17.4153 7.33333 16.8438V13.4063C7.33333 12.8348 7.77917 12.375 8.33333 12.375C8.8875 12.375 9.33333 12.8348 9.33333 13.4063V16.8438ZM12 12.375C12.5542 12.375 13 12.8348 13 13.4063V16.8438C13 17.4153 12.5542 17.875 12 17.875C11.4458 17.875 11 17.4153 11 16.8438V13.4063C11 12.8348 11.4458 12.375 12 12.375ZM16.6667 16.8438C16.6667 17.4153 16.2208 17.875 15.6667 17.875C15.1125 17.875 14.6667 17.4153 14.6667 16.8438V13.4063C14.6667 12.8348 15.1125 12.375 15.6667 12.375C16.2208 12.375 16.6667 12.8348 16.6667 13.4063V16.8438ZM10.1292 0.116392C10.6167 0.379146 10.8083 1.00163 10.5542 1.50695L7.15417 8.25003H16.8458L13.4458 1.50695C13.1917 1.00163 13.3833 0.379146 13.8708 0.116392C14.3625 -0.146361 14.9667 0.0502636 15.2208 0.555619L19.1 8.25003H23C23.5542 8.25003 24 8.7098 24 9.28128C24 9.85277 23.5542 10.3125 23 10.3125H22.1667L19.8375 19.916C19.5042 21.1407 18.475 22 17.25 22H6.7125C5.525 22 4.45833 21.1407 4.16167 19.916L1.83333 10.3125H1C0.447917 10.3125 0 9.85277 0 9.28128C0 8.7098 0.447917 8.25003 1 8.25003H4.9L8.77917 0.555619C9.03333 0.0502636 9.6375 -0.146361 10.1292 0.116392ZM6.1 19.4176C6.175 19.7227 6.44167 19.9375 6.7125 19.9375H17.25C17.5583 19.9375 17.825 19.7227 17.9 19.4176L20.1042 10.3125H3.895L6.1 19.4176Z" fill="#DC2F02" />
                            </g>
                            <defs>
                                <clipPath id="clip0_2097_14269">
                                    <rect width="24" height="22" fill="white" />
                                </clipPath>
                            </defs>
                        </svg>
                    <?php
                    endif;
                    ?>
                </div>

                <?php if ( (array_key_exists('button_divider', $settings) && $settings['button_divider'] === 'yes') && 
                ( !empty($settings['button_title']) || !is_null($cart_total) ) ) : ?>
                    <div class="mi-mini-cart__divider border"></div>
                <?php endif; ?>

                <?php if ( !empty($settings['button_title']) || !is_null($cart_total) ) : ?>
                    <div class="mi-mini-cart__price">
                        <?php
                        if ( !is_null($cart_total) ) :
                            echo $cart_total;
                        else:
                            echo $settings['button_title'];
                        endif;
                        ?>
                    </div>
                <?php endif; ?>

            </a>
            <div class="mi-mini-cart__result position-absolute">
                <?php woocommerce_mini_cart( $mini_cart_args ); ?>
            </div>
        </div>
        <?php
    }
}
