<?php

namespace Hanewear\Core\Elementor\Widgets;

use Modista\Classes\Elementor_Controls_Helper;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Woo_Product_Carousel_Slide extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-product-carousel_slide';
    }

    public function get_title() {
        return __('Product Carousel Slide', 'modista');
    }

    public function get_icon() {
        return 'eicon-carousel';
    }

    public function get_categories() {
        return ['modista'];
    }

    public function get_script_depends()
    {
        return [ 'mi-bundle-widget' ];

        return ['mi-widget-woo-product-slide'];
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
                'default' => 12,
                'min' => 5,
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

        $this->add_responsive_control(
            'carousel_per_view',
            [
                'label' => __('Slides Per View', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 5,
                'min' => 5,
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
                'default' => 'yes',
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
        $this->start_controls_section(
            'style_section',
            [
                'label' => __('Slide', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'container_margin',
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
            'container_padding',
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
            'slide_space_between',
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
                    '{{WRAPPER}} .mi-swiper__slide' => 'padding: 0 {{SIZE}}{{UNIT}};',
                ],
                'separator' => 'after'
            ]
        );

        $this->add_control(
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
                    'size' => 200,
                    'unit' => 'px'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-swiper__link' => 'height: {{SIZE}}{{UNIT}};',
                ],
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

        $this->add_control(
            'slide_background',
            [
                'label' => __('Background Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-swiper__link' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-swiper__link' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-swiper__link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'slide_border',
                'selectors' => '{{WRAPPER}} .mi-swiper__link'
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_image_section',
            [
                'label' => __('Image', 'modista'),
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
                'name' => 'slides_image_background',
                'types' => [ 'classic', 'gradient', 'image' ],
                'selector' => '{{WRAPPER}} .mi-product-card__image',
            ]
        );

        $this->add_control(
            'slides_image_heading',
            [
                'label' => __( 'Image', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'slides_image_width',
            [
                'label' => __( 'Width', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'default' => [
                    'size' => '100',
                    'unit' => '%'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__image img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides_image_height',
            [
                'label' => __( 'Height', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%'],
                'range' => [
                    'px' => [
                        'min' => 0
                    ],
                ],
                'default' => [
                    'size' => '100',
                    'unit' => '%'
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-product-card__image img' => 'height: {{SIZE}}{{UNIT}};',
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
                    '{{WRAPPER}} .mi-product-card__image img' => 'object-fit: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-product-card__image img' => 'object-position: {{VALUE}};',
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
            ]
        );

        $this->add_control(
            'slides_item_title_alignment',
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
                    '{{WRAPPER}} .mi-swiper__title' => 'text-align: {{VALUE}};',
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
                    '{{WRAPPER}} .mi-swiper__title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides_item_color',
            [
                'label' => esc_html__( 'Color', 'elementor' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-swiper__title' => 'color: {{VALUE}};',
                ]
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'slides_item_typography',
                'selector' => '{{WRAPPER}} .mi-swiper__title',
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Typography::TYPOGRAPHY_PRIMARY,
                ],
            ]
        );

        $this->add_control(
            'overflow_title',
            [
                'label' => __('Overflow Hidden', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
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

        $this->add_control(
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

        $this->add_control(
            'navigation_vertical_offset',
            [
                'label' => __( 'Vertical Offset', 'modista' ),
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
                    '{{WRAPPER}} .swiper-rtl .swiper-button-next' => 'top: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .swiper-rtl .swiper-button-prev' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

        $this->add_control(
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

    private function echo_product_galley() {
        $product = wc_get_product( get_the_ID() );
        $gallery_image_ids = $product->get_gallery_image_ids();

        if ( ! empty($gallery_image_ids) ) :

            echo '<div class="mi-swiper__gallery mi-product-card__gallery-thumbnails single-product d-flex flex-row gap-2 justify-content-between">';

                echo '<div class="thumbnail active" data-index="' .  0 . '">';
                    echo get_the_post_thumbnail( get_the_ID(), 'full' );
                echo '</div>';

                foreach ($gallery_image_ids as $key => $image_id) {

                    // Maximum gallery count
                    if ( $key === 3 ) break;

                    $image_src = wp_get_attachment_image_url($image_id, 'full');
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
        $this->add_render_attribute('slide_classes', 'class', 'swiper-slide mi-swiper__slide');
        if ($settings['slides_height_equal'] === 'yes') {
            $this->add_render_attribute('slide_classes', 'class', 'h-auto');
        }

        $this->add_render_attribute('title_classes', 'class', 'mi-swiper__title');
        if ($settings['overflow_title'] === 'yes') {
            $this->add_render_attribute('title_classes', 'class', 'line-overflow-ellipsis');
        }

        echo '<div class="mi-carousel--slide">';
        ?>
            <div <?php echo $this->get_render_attribute_string('swiper') ?> data-slides-per-view="<?php echo esc_attr($carousel_per_view); ?>" data-slides-per-view-tablet="<?php echo esc_attr($carousel_per_view_tablet); ?>" data-slides-per-view-mobile="<?php echo esc_attr($carousel_per_view_mobile); ?>" data-speed="<?php echo esc_attr($settings['carousel_speed']); ?>">
                <div class="swiper-wrapper">
                    <?php while ($products->have_posts()) : $products->the_post(); ?>
                        <div <?php echo $this->get_render_attribute_string('slide_classes') ?>>
                            <a href="<?php the_permalink(); ?>" class="mi-swiper__link mi-product-card__item d-flex flex-column justify-content-end position-relative overflow-hidden">
                                <div class="mi-product-card__image mi-product-card__image--slide">
                                    <?php echo get_the_post_thumbnail( get_the_ID(), 'full' ); ?>
                                </div>
                                <div class="mi-swiper__content">
                                    <?php if ( $settings['content_show_title'] === 'yes') : ?>
                                    <h3 class="mi-swiper__title"><?php the_title(); ?></h3>
                                    <?php endif; ?>
                                    <?php
                                    // Render gallery
                                    if ( 'yes' === $settings['content_enable_gallery'] ) $this->echo_product_galley();
                                    ?>
                                </div>
                            </a>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>

            <style>
                .mi-carousel--slide .mi-product-card__image {
                    position: unset;
                }
                
                .mi-carousel--slide .mi-product-card__image img {
                    right: 0;
                    top: 0;
                    position: absolute;
                }

                .mi-carousel--slide .mi-swiper__slide {
                    transition: all 0.3s ease;
                }

                .mi-carousel--slide .mi-swiper__link:after {
                    content: "";
                    right: 0;
                    bottom: 0;
                    position: absolute;
                    background: transparent;
                    width: 100%;
                    height: 48%;
                    transition: all 0.3s ease;
                }

                .mi-carousel--slide .swiper-slide-active .mi-swiper__link:after {
                    background: linear-gradient(180deg, rgba(0, 0, 0, 0.00) 8.47%, rgba(0, 0, 0, 0.35) 40.9%, rgba(0, 0, 0, 0.69) 74.48%);
                }

                .mi-carousel--slide .mi-swiper__gallery img {
                    width: 76px;
                    height: 76px;
                    object-fit: cover;
                    border-radius: 12px;
                    opacity: 0.7;
                }

                .mi-carousel--slide .mi-swiper__gallery .active img {
                    opacity: 1;
                }

                .mi-carousel--slide .mi-swiper__content {
                    z-index: 1;
                    opacity: 0;
                }

                .mi-carousel--slide .swiper-slide-active .mi-swiper__content {
                    opacity: 1;
                }

            </style>

            <?php
            // Render Navigation
            Elementor_Controls_Helper::get_carousel_navigation_render($this, $settings);

        echo '</div>';

        wp_reset_postdata();
    }
}
