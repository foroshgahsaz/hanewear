<?php

namespace Modista\Widgets;

defined('ABSPATH') || exit; // Exit if accessed directly.

use Elementor\Controls_Manager;

class Base_Button_Login extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-button-login';
    }

    public function get_title() {
        return __( 'Login Button', 'modista' );
    }

    public function get_icon() {
        return 'eicon-button';
    }

    function get_keywords()
    {
        return ['login', __('Login Button', 'modista'), 'modista', __('modista', 'modista') ];
    }

    public function get_categories() {
        return [ 'modista' ];
    }

    public function get_style_depends(): array {
        return [ 'mi-bundle-widget' ];
        return [ 'mi-widget-button-login' ];
    }

    protected function _register_controls() {

        // Controls for the content.
        $this->start_controls_section(
            'content_section',
            [
                'label' => __( 'Content', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'button_icon',
            [
                'label'     => __( 'Icon', 'modista' ),
                'type'      => Controls_Manager::ICONS,
                'default'   => [
                    'value'     => ['url' => MI_URL . '/assets/image/svg/btn-user.svg'],
                    'library'   => 'svg'
                ]
            ]
        );

        $this->add_control(
            'content_title_two',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('کابر وارد شده', 'modista'),
            ]
        );

        $this->add_control(
            'button_title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => __( 'ورود / ثبت نام', 'modista' ),
            ]
        );

        $this->add_control(
            'button_url',
            [
                'label' => __( 'Link', 'modista' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->add_control(
            'content_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __('کابر میهمان', 'modista')
            ]
        );

        $this->add_control(
            'button_ghost_url',
            [
                'label' => __( 'Link', 'modista' ),
                'type' => Controls_Manager::URL,
                'dynamic' => [ 'active' => true ],
            ]
        );

        $this->end_controls_section();
        // End controls for the content.

        // Controls for the sub menu content.
        $this->start_controls_section(
            'content_dropdown_section',
            [
                'label' => __( 'Dropdown', 'modista' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'dropdown_status',
            [
                'label' => __( 'Show Dropdown', 'modista' ),
                'type' => Controls_Manager::SWITCHER,
                'default' => 'yes',
                'return_value' => 'yes'
            ]
        );

        $repeater = new \Elementor\Repeater();

        $repeater->add_control(
            'item_title',
            [
                'label' => esc_html__('Title', 'modista'),
                'type' => Controls_Manager::TEXT,
                'dynamic' => [ 'active' => true ],
                'default' => __('Item', 'elementor')
            ]
        );

        $repeater->add_control(
            'item_icon',
            [
                'label' => esc_html__('Icon', 'modista'),
                'type' => Controls_Manager::ICONS,
                'skin' => 'inline',
            ]
        );

        $repeater->add_control(
            'item_link',
            [
                'label' => esc_html__('Link', 'modista'),
                'type' => Controls_Manager::URL,
                'dynamic' => ['active' => true],
                'placeholder' => 'https://modista.com',
                'separator' => 'after',
            ]
        );

        $repeater->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'item_typography',
                'selector' => '{{WRAPPER}} {{CURRENT_ITEM}} a',
            ]
        );

        $repeater->add_responsive_control(
            'item_padding',
            [
                'label' => __( 'Padding', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'item_margin',
            [
                'label' => __( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'item_align',
            [
                'label' => esc_html__( 'Icon Direction', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'row-reverse' => [
                        'title' => esc_html__( 'Row Reverse', 'elementor' ),
                        'icon' => 'eicon-order-start',
                    ],
                    'row' => [
                        'title' => esc_html__( 'Row', 'elementor' ),
                        'icon' => 'eicon-order-end',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'flex-direction: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_responsive_control(
            'item_justify',
            [
                'label' => esc_html__( 'Icon Alignment', 'elementor' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'flex-end' => [
                        'title' => esc_html__( 'End', 'elementor' ),
                        'icon' => 'eicon-justify-end-h',
                    ],
                    'space-between' => [
                        'title' => esc_html__( 'Space Between', 'elementor' ),
                        'icon' => 'eicon-justify-space-between-h',
                    ],
                    'flex-start' => [
                        'title' => esc_html__( 'Start', 'elementor' ),
                        'icon' => 'eicon-justify-start-h',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'justify-content: {{VALUE}};',
                ],
            ]
        );

        $repeater->add_control(
            'item_color',
            [
                'label' => esc_html__('Color', 'modista'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} {{CURRENT_ITEM}} a' => 'color: {{VALUE}}'
                ]
            ]
        );

        $this->add_control(
            'items',
            [
                'label' => esc_html__('Items', 'modista'),
                'type'  => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'default' => [
                    [
                        'item_title' => $this->get_dropdown_base_items()['profile']['title'],
                        'item_icon' => $this->get_dropdown_base_items()['profile']['icon'],
                        'item_link' => $this->get_dropdown_base_items()['profile']['url']
                    ],
                    [
                        'item_title' => $this->get_dropdown_base_items()['order']['title'],
                        'item_icon' => $this->get_dropdown_base_items()['order']['icon'],
                        'item_link' => $this->get_dropdown_base_items()['order']['url']
                    ],
                    [
                        'item_title' => $this->get_dropdown_base_items()['favorite']['title'],
                        'item_icon' => $this->get_dropdown_base_items()['favorite']['icon'],
                        'item_link' => $this->get_dropdown_base_items()['favorite']['url']
                    ],
                    [
                        'item_title' => $this->get_dropdown_base_items()['comment']['title'],
                        'item_icon' => $this->get_dropdown_base_items()['comment']['icon'],
                        'item_link' => $this->get_dropdown_base_items()['comment']['url']
                    ],
                    [
                        'item_title' => $this->get_dropdown_base_items()['logout']['title'],
                        'item_icon' => $this->get_dropdown_base_items()['logout']['icon'],
                        'item_link' => $this->get_dropdown_base_items()['logout']['url']
                    ],
                ],
                'title_field' => '{{{ item_title }}}',
            ]
        );

        $this->end_controls_section();
        // End controls for the sub menu content.

        $this->start_controls_section(
            'style_login_button',
            [
                'label' => __( 'Button Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'icon_heading',
            [
                'label'     => __('Icon', 'modista'),
                'type'      => Controls_Manager::HEADING,
            ]
        );

        $this->add_control(
            'button_icon_width',
            [
                'label' => __( 'Icon Width', 'plugin-name' ),
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
                    '{{WRAPPER}} .mi-login-account__icon svg' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-login-account__icon img' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_icon_radius',
            [
                'label' => __( 'Border Radius', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 100,
                    'right' => 100,
                    'bottom' => 100,
                    'left' => 100,
                    'unit' => '%',
                    'isLinked' => true,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__icon svg' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    '{{WRAPPER}} .mi-login-account__icon img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'button_heading',
            [
                'label'     => __('Button', 'modista'),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'login_button_typography',
                'selector' => '{{WRAPPER}} .button-login-account',
            ]
        );

        $this->add_control(
            'login_button_color',
            [
                'label' => __( 'Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .button-login-account' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'login_button_gap',
            [
                'label' => __( 'Gap', 'plugin-name' ),
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
                    '{{WRAPPER}} .button-login-account' => 'gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'login_button_padding',
            [
                'label' => __( 'Padding', 'plugin-name' ),
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
                    '{{WRAPPER}} .button-login-account' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'login_button_radius',
            [
                'label' => __( 'Border Radius', 'plugin-name' ),
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
                    '{{WRAPPER}} .button-login-account' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'login_button_border',
                'selector' => '{{WRAPPER}} .button-login-account',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_dropdown',
            [
                'label' => __( 'Dropdown Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dropdown_width',
            [
                'label' => __( 'Width', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ]
                ],
                'desktop_default' => [
                    'size' => 210,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__list' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_offset',
            [
                'label' => __( 'Offset Position', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'desktop_default' => [
                    'unit' => 'px',
                    'size' => 0
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__list' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_margin_top',
            [
                'label' => __( 'Margin Top', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%' ],
                'range' => [
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                        'step' => 1,
                    ],
                ],
                'default' => [
                    'unit' => 'px',
                    'size' => 24
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__list' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_bg_color',
            [
                'label' => __( 'Background Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#FFFFFF',
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__list' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_padding',
            [
                'label' => __( 'Padding', 'plugin-name' ),
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
                    '{{WRAPPER}} .mi-login-account__list' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'dropdown_radius',
            [
                'label' => __( 'Border Radius', 'plugin-name' ),
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
                    '{{WRAPPER}} .mi-login-account__list' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_border',
                'selector' => '{{WRAPPER}} .mi-login-account__list',
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'box_shadow',
                'selector' => '{{WRAPPER}} .mi-login-account__list',
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            'style_dropdown_item',
            [
                'label' => __( 'Dropdown Item Style', 'modista' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'dropdown_item_typography',
                'selector' => '{{WRAPPER}} .mi-login-account__item-link',
            ]
        );

        $this->add_control(
            'dropdown_item_color',
            [
                'label' => __( 'Color', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::COLOR,
                'global' => [
                    'default' => \Elementor\Core\Kits\Documents\Tabs\Global_Colors::COLOR_SECONDARY,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__item-link' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_item_padding',
            [
                'label' => __( 'Padding', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'default' => [
                    'top' => 8,
                    'right' => 0,
                    'bottom' => 8,
                    'left' => 0,
                    'unit' => 'px',
                    'isLinked' => false,
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__item-link' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dropdown_item_margin',
            [
                'label' => __( 'Margin', 'plugin-name' ),
                'type' => \Elementor\Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em', 'rem', 'custom' ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__item-link' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Border::get_type(),
            [
                'name' => 'dropdown_item_border',
                'selector' => '{{WRAPPER}} .mi-login-account__item-link',
            ]
        );

        $this->add_responsive_control(
            'dropdown_item_gap',
            [
                'label' => esc_html__( 'Icon Spacing', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'em', 'rem' ],
                'default' => [
                    'size' => 8,
                    'unit' => 'px',
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-login-account__item-link' => 'gap: {{SIZE}}{{UNIT}}',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        
        $current_user = wp_get_current_user();
        $wpLogoutUrl = wp_logout_url( home_url() );
        ?>
        <div class="mi-login-account position-relative">
            <?php
            if ( ! empty( $settings['button_url']['url'] ) ) {
                $this->add_link_attributes( 'button_url', $settings['button_url'] );
            }
            echo  '<a ' . $this->get_render_attribute_string('button_url') . 'class="button-login-account d-flex align-items-center">';
            ?>
                <div class="mi-login-account__icon d-flex">
                    <?php
                    if ( $current_user->ID ) :
                        echo get_avatar( $current_user->ID, '34', '', '' );
                    elseif ( $settings['button_icon']['library'] == 'svg' ) :
                        ?>
                        <img src="<?php echo esc_url( $settings['button_icon']['value']['url'] ) ?>" alt="">
                    <?php
                    else :
                        \Elementor\Icons_Manager::render_icon( $settings['button_icon'], [ 'aria-hidden' => 'true' ] );
                    endif;
                    ?>
                </div>
                <span>
                    <?php echo ( $current_user->ID ) ? esc_html( $current_user->display_name ) : esc_html($settings['button_title'] ) ; ?>
                </span>
            </a>

            <?php
            if ( is_user_logged_in() && $settings['dropdown_status'] && $settings['items'] ) :
                ?>
                <ul class="mi-login-account__list">
                    <?php
                    foreach ($settings['items'] as $item) :
                        // Set display name if user logged in
                        $item['item_title'] = ( $item['item_title'] == 'حساب کاربری' && $current_user->ID ) ? $current_user->display_name : $item['item_title'];
                        $item['item_link']['url'] = ( $item['item_title'] == 'خروج از حساب کاربری' && $item['item_link']['url'] == '' ) ? $wpLogoutUrl : $item['item_link']['url'];
                        ?>
                        <li class="elementor-repeater-item-<?php echo esc_attr( $item['_id'] ) ?>">
                            <a href="<?php echo $item['item_link']['url'] ?>" class="mi-login-account__item-link d-flex justify-content-between">
                                <?php echo $item['item_title'] ?>
                                <div class="d-flex">
                                    <?php
                                    if ( $item['item_icon']['library'] == 'svg' ) :
                                        ?>
                                        <img src="<?php echo esc_url( $item['item_icon']['value']['url'] ) ?>" alt="">
                                    <?php
                                    else :
                                        \Elementor\Icons_Manager::render_icon( $item['item_icon'], [ 'aria-hidden' => 'true' ] );
                                    endif;
                                    ?>
                                </div>
                            </a>
                        </li>
                    <?php
                    endforeach;
                    ?>
                </ul>
            <?php
            endif;
            ?>
        </div>
        <?php
    }

    /**
     * Get default dropdown items.
     *
     * @return string[][]
     */
    private function get_dropdown_base_items()
    {
        $svgUrl = MI_URL . '/assets/image/svg/iconsax-';

        return [
            'profile' => [
                'title' => 'حساب کاربری',
                'url' => '',
                'icon' => [
                    'value' => [ 'url' => $svgUrl . 'arrow.svg' ],
                    'library' => 'svg'
                ]
            ],
            'order' => [
                'title' => 'سفارش ها',
                'url' => '',
                'icon' => [
                    'value' => [ 'url' => $svgUrl . 'book.svg' ],
                    'library' => 'svg'
                ]
            ],
            'favorite' => [
                'title' => 'علاقمندی ها',
                'url' => '',
                'icon' => [
                    'value' => [ 'url' => $svgUrl . 'heart.svg' ],
                    'library' => 'svg'
                ]
            ],
            'comment' => [
                'title' => 'جزیئات حساب',
                'url' => '',
                'icon' => [
                    'value' => [ 'url' => $svgUrl . 'stickynote.svg' ],
                    'library' => 'svg'
                ]
            ],
            'logout' => [
                'title' => __('خروج از حساب کاربری', 'modista'),
                'url' => '',
                'icon' => [
                    'value' => [ 'url' => $svgUrl . 'logout.svg' ],
                    'library' => 'svg'
                ]
            ]
        ];
    }

}
