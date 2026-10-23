<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Base_Form_Submission extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi_form_submission';
    }

    public function get_title() {
        return __( 'Form Submissions', 'modista' );
    }

    public function get_icon() {
        return 'eicon-form-horizontal';
    }

    public function get_script_depends() {
        return [ 'mi-bundle-widget' ];
        return ['mi-widget-form-submission'];
    }

    function get_keywords()
    {
        return ['form', 'submissions', __('form submissions', 'modista'), 'modista', __('modista', 'modista') ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    protected function register_controls() {

        // Controls for the content.
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Form Submission', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'form_banner',
            [
                'label' => __( 'Banner', 'modista' ),
                'type' => \Elementor\Controls_Manager::MEDIA,
            ]
        );

        $this->add_control(
            'form_placeholder',
            [
                'label'     => __( 'Place Holder', 'modista' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => __( 'شمارتو بزن کد تخفیف بگیر', 'modista' ),
            ]
        );

        $this->add_control(
            'form__button_text',
            [
                'label'     => __( 'Button Text', 'modista' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => __( 'ارسال', 'modista' ),
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'form__button_icon',
            [
                'label'     => __( 'Icon', 'modista' ),
                'type'      => \Elementor\Controls_Manager::ICONS,
                'default'   => [
                    'value'     => ['url' => MI_URL . '/assets/image/svg/arrow-up-left.svg'],
                    'library'   => 'svg'
                ]
            ]
        );

        $this->add_control(
            'form__after_message',
            [
                'label'     => __( 'پیام بعد از ثبت شماره', 'modista' ),
                'type'      => \Elementor\Controls_Manager::TEXT,
                'default'   => __( 'با موفقیت شماره شما ثبت شد', 'modista' ),
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        // Controls for style.
        $this->start_controls_section(
            'container_section',
            [
                'label' => __( 'Form', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'form_width',
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
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'selectors' => [
                    "{{WRAPPER}} .mi-form-submission" => 'width: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        \Modista\Classes\Elementor_Controls_Helper::get_box_style_controls($this, 'form_submission', '.mi-form-submission');

        $this->end_controls_section();
        // End controls for style.

        // Controls for style.
        $this->start_controls_section(
            'image_section',
            [
                'label' => __( 'Banner', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        \Modista\Classes\Elementor_Controls_Helper::get_image_style_controls($this, 'form_submission__image', '.mi-form-submission__image-wrapper');

        $this->end_controls_section();
        // End controls for style.

        $this->start_controls_section(
            'Input',
            [
                'label' => __( 'Input', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'input_typography',
                'selector' => '{{WRAPPER}} .mi-form-submission__form-input',
            ]
        );

        $this->add_control(
            'input_color',
            [
                'label' => __( 'Color', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-input' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_background',
            [
                'label' => __( 'Background', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-input' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'input_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-input' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'input_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-input' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'input_border',
                'selector' => '{{WRAPPER}} .mi-form-submission__form-input',
            ]
        );

        $this->end_controls_section();

        
        $this->start_controls_section(
            'button',
            [
                'label' => __( 'Button', 'modista' ),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .mi-form-submission__form-button',
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
                    '{{WRAPPER}} .mi-form-submission__form-button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_background',
            [
                'label' => __( 'Background', 'modista' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-button' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_gap',
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
                    '{{WRAPPER}} .mi-form-submission__form-button' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-button' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_radius',
            [
                'label' => __( 'Border Radius', 'modista' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-form-submission__form-button' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .mi-form-submission__form-button',
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $form_banner = $settings['form_banner']['url'];
        ?>
        <div class="mi-form-submission d-flex">
            <div class="mi-form-submission__image-wrapper">
                <img src="<?php echo esc_url( $form_banner ); ?>" alt="" class="mi-form-submission__image">
            </div>
            <form action="" method="POST" class="mi-form-submission__form d-flex flex-column align-items-center gap-4" data-message="<?php echo esc_attr($settings['form__after_message'] ); ?>">
                <input type="text" required name="field" placeholder="<?php echo $settings['form_placeholder'] ?>" id="field" class="w-100 mi-form-submission__form-input">
                <input type="hidden" name="nonce" id="nonce" value="<?php echo wp_create_nonce( 'mi_form_submission' ); ?>">
                <button class="mi-form-submission__form-button d-flex gap-2 align-items-center">
                    <span><?php echo esc_html($settings['form__button_text'] ); ?></span>
                    <div class="mi-form-button__icon d-flex">
                        <?php if ( $settings['form__button_icon']['library'] == 'svg' ) : ?>
                            <img src="<?php echo esc_url( $settings['form__button_icon']['value']['url'] ) ?>" alt="">
                        <?php
                        else :
                            \Elementor\Icons_Manager::render_icon( $settings['form__button_icon'], [ 'aria-hidden' => 'true' ] );
                        endif;
                        ?>
                    </div>
                </button>
            </form>
            <div class="mi-form-submission__result fs-4 color-text-400 fw-600 bg-text-100 w-100 text-center rounded-2 py-1 d-none"></div>
            <span class="mi-form-submission__close position-absolute bg-white d-flex p-1 rounded-2 cursor-pointer">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                    <g clip-path="url(#clip0_531_13244)">
                        <path d="M10.875 7.12502L7.125 10.875M7.12498 7.125L10.875 10.875" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/>
                        <path d="M16.5 9C16.5 12.5355 16.5 14.3033 15.4017 15.4017C14.3033 16.5 12.5355 16.5 9 16.5C5.46447 16.5 3.6967 16.5 2.59835 15.4017C1.5 14.3033 1.5 12.5355 1.5 9C1.5 5.46447 1.5 3.6967 2.59835 2.59835C3.6967 1.5 5.46447 1.5 9 1.5C12.5355 1.5 14.3033 1.5 15.4017 2.59835C16.132 3.32865 16.3767 4.35491 16.4587 6" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/>
                    </g>
                    <defs>
                        <clipPath id="clip0_531_13244">
                        <rect width="18" height="18" fill="white"/>
                        </clipPath>
                    </defs>
                </svg>
            </span>
        </div>
        <?php
    }

    private static function create_table_if_not_exists() {
        global $wpdb;
    
        $table_name = $wpdb->prefix . 'mi_form_submission';
    
        if ($wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name) {

            $charset_collate = $wpdb->get_charset_collate();
            $sql = "CREATE TABLE $table_name (
                id INT NOT NULL AUTO_INCREMENT,
                field VARCHAR(255) NOT NULL,
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
            ) $charset_collate;";
    
            require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
            dbDelta($sql);
        }
    }
    
    public static function create_field($value) {

        global $wpdb;
    
        self::create_table_if_not_exists();
    
        $table_name = $wpdb->prefix . 'mi_form_submission';
    
        return $wpdb->insert(
            $table_name,
            array(
                'field' => sanitize_text_field($value),
            )
        );
    }
    
}