<?php

namespace Hanewear\Core\Elementor\Widgets;

use Modista\Classes\Elementor_Controls_Helper;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Woo_Product_Carousel extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-product-carousel';
    }

    public function get_title() {
        return __('Product Carousel', 'modista');
    }

    public function get_icon() {
        return 'eicon-products';
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

        \Hanewear\Core\Product_Query_Helper::register_product_query_controls( $this );

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
                'label' => __('Box Style', 'modista'),
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
                    '{{WRAPPER}} .mi-product-carousel__slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
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
                    '{{WRAPPER}} .mi-product-carousel__item' => 'height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slide_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__item' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-product-carousel__item' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-carousel__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selectors' => '{{WRAPPER}} .mi-product-carousel__item'
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
                    '{{WRAPPER}} .mi-product-carousel__image' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'slides_image_background',
                'types' => [ 'classic', 'gradient', 'image' ],
                'selector' => '{{WRAPPER}} .mi-product-carousel__image',
            ]
        );

        $this->add_responsive_control(
            'slides_image_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__image' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_image_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__image' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides_image_heading',
            [
                'label' => __( 'Image', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'slides_image_height',
            [
                'label' => __( 'Height', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px'],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__image img' => 'height: {{SIZE}}{{UNIT}};',
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
            'slides_item_title',
            [
                'label' => esc_html__( 'Title', 'elementor' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'slides_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__item-title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slides_item_typography',
                'selector' => '{{WRAPPER}} .mi-product-carousel__item-title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'slides_item_price',
            [
                'label' => esc_html__( 'Price', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'slides_item_price_color',
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
                'name' => 'slides_item_price_typography',
                'selector' => '{{WRAPPER}} .woocommerce-Price-amount bdi',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slides_item_symbol_typography',
                'selector' => '{{WRAPPER}} bdi .woocommerce-Price-currencySymbol',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_TEXT,
                ],
            ]
        );

        $this->add_control(
            'slides_item_price_sale',
            [
                'label' => esc_html__( 'Sale Price', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'slides_item_price_sale_color',
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
                'name' => 'slides_item_price_sale_typography',
                'selector' => '{{WRAPPER}} del .woocommerce-Price-amount bdi',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'slides_item_price_sale_badge',
            [
                'label' => esc_html__( 'Sale Badge', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'slides_item_price_sale_badge_color',
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
            'slides_item_price_sale_badge_background_color',
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
                'name' => 'slides_item_price_sale_badge_typography',
                'selector' => '{{WRAPPER}} .mi-product-loop__discount',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_responsive_control(
            'slides_item_price_sale_badge_border_radius',
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
            'slides_item_price_sale_badge_padding',
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
            'slides_item_add_to_cart',
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
                    '{{WRAPPER}} .mi-product-carousel__item-add-to-cart svg path' => 'stroke: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-product-carousel__item-add-to-cart' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-product-carousel__item-add-to-cart:hover svg path' => 'stroke: {{VALUE}};',
                ]
            ]
        );

        $this->add_control(
            'item_add_to_cart_background_hover',
            [
                'label' => esc_html__( 'Background Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__item-add-to-cart:hover' => 'background-color: {{VALUE}};',
                ]
            ]
        );

        $this->end_controls_tab();

        $this->end_controls_tabs();

        $this->add_responsive_control(
            'item_add_to_cart_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-carousel__item-add-to-cart' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-carousel__item-add-to-cart' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_navigation_section',
            [
                'label' => __('Navigation', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE
            ]
        );

        $this->add_responsive_control(
            'navigation_horizontal_offset',
            [
                'label' => __( 'Horizontal Offset', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
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
                    '{{WRAPPER}} .swiper-rtl .swiper-button-next' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-rtl .swiper-button-prev' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_width',
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

        $this->add_responsive_control(
            'navigation_height',
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

        $this->add_control(
            'navigation_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .swiper-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_padding',
            [
                'label' => __('Padding', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'navigation_border_radius',
            [
                'label' => __('Border Radius', 'modista'),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .swiper-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $args     = \Hanewear\Core\Product_Query_Helper::build_product_query_args( $settings );
        $products = new \WP_Query( $args );

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
        $this->add_render_attribute('slide_classes', 'class', 'swiper-slide mi-product-carousel__slide');
        if ($settings['slides_height_equal'] === 'yes') {
            $this->add_render_attribute('slide_classes', 'class', 'h-auto');
        }

        if ($products->have_posts()) :
            echo '<div class="mi-carousel">';
            ?>
            <div <?php echo $this->get_render_attribute_string('swiper') ?> data-slides-per-view="<?php echo esc_attr($carousel_per_view); ?>" data-slides-per-view-tablet="<?php echo esc_attr($carousel_per_view_tablet); ?>" data-slides-per-view-mobile="<?php echo esc_attr($carousel_per_view_mobile); ?>" data-speed="<?php echo esc_attr($settings['carousel_speed']); ?>">
                <div class="swiper-wrapper">
                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <div <?php echo $this->get_render_attribute_string('slide_classes') ?>>
                            <div class="mi-product-carousel__item d-flex flex-column justify-content-between">
                                <a href="<?php the_permalink(); ?>" class="mi-product-carousel__item-link d-flex flex-column">
                                    <div class="mi-product-carousel__image">
                                        <?php woocommerce_template_loop_product_thumbnail(); ?>
                                    </div>
                                    <?php
                                    if ( $settings['content_show_title'] === 'yes') :
                                        ?>
                                    <h2 class="mi-product-carousel__item-title"><?php the_title(); ?></h2>
                                    <?php
                                    endif;
                                    ?>
                                </a>
                                <div class="d-flex justify-content-between align-items-end">
                                    <?php woocommerce_template_loop_add_to_cart(['class' => 'ajax_add_to_cart mi-product-carousel__item-add-to-cart d-flex']); ?>
                                    <div class="mi-product-carousel__item-price">
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
        endif;
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
}
