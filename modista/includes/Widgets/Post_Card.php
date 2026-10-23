<?php

namespace Modista\Widgets;

use Modista\Classes\Elementor_Controls_Helper;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Post_Card extends \Elementor\Widget_Base {

    public function get_name() {
        return 'mi-post-card';
    }

    public function get_title() {
        return __('Post Card', 'modista');
    }

    public function get_icon() {
        return 'eicon-posts-grid';
    }

    public function get_categories() {
        return ['modista'];
    }

    protected function register_controls() {

        // Layout section
        $this->start_controls_section(
            'layout_section',
            [
                'label' => __('Layout', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_responsive_control(
            'layout_columns',
            [
                'label' => __('Columns', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'devices' => [ 'desktop', 'tablet', 'mobile' ],
                'default' => 4,
                'tablet_default' => 3,
                'mobile_default' => 1,
                'options' => [
                    '1' => 1,
                    '2' => 2,
                    '3' => 3,
                    '4' => 4,
                    '5' => 5,
                    '6' => 6,
                ],
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
                'label' => __('Title', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
            ]
        );

        Elementor_Controls_Helper::get_tag_control($this, 'title');

        $this->add_control(
            'content_show_excerpt',
            [
                'label' => __('Excerpt', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'content_length_excerpt',
            [
                'label' => __('Length Excerpt', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 20,
                'condition' => [ 'content_show_excerpt' => 'yes' ]
            ]
        );

        $this->add_control(
            'content_ellipsis_excerpt',
            [
                'label' => __('Ellipsis Excerpt', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'condition' => [ 'content_show_excerpt' => 'yes' ]
            ]
        );

        $this->add_control(
            'content_meta_data',
            [
                'label' => __('Meta Data', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => [
                    'author'  => esc_html__( 'Author', 'modista' ),
                    'read_time' => esc_html__( 'Read Time', 'modista' ),
                    'date' => esc_html__( 'Date', 'modista' ),
                    'time' => esc_html__( 'Time', 'modista' ),
                    'comments' => esc_html__( 'Comments', 'modista' ),
                    'date_modified' => esc_html__( 'Date Modified', 'modista' ),
                ],
                'multiple' => true,
                'label_block' => true,
                'separator' => 'before'
            ]
        );

        $this->add_control(
            'content_meta_data_is_icons',
            [
                'label' => __('Custom Icons', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'no',
                'condition' => [ 'content_meta_data!' => '' ]
            ]
        );

        $icon_repeater = new \Elementor\Repeater();

        $icon_repeater->add_control(
        'icon_type',
            [
                'label' => esc_html__( 'Meta Data', 'textdomain' ),
                'type' => \Elementor\Controls_Manager::SELECT,
                'options' => [
                    'author'  => esc_html__( 'Author', 'modista' ),
                    'read_time' => esc_html__( 'Read Time', 'modista' ),
                    'date' => esc_html__( 'Date', 'modista' ),
                    'time' => esc_html__( 'Time', 'modista' ),
                    'comments' => esc_html__( 'Comments', 'modista' ),
                    'date_modified' => esc_html__( 'Date Modified', 'modista' ),
                ],
                'default' => esc_html__( 'author' , 'modista' ),
                'label_block' => true,
            ]
        );

        $icon_repeater->add_control(
        'icon',
            [
                'label' => esc_html__( 'Icon', 'modista' ),
                'type' => \Elementor\Controls_Manager::ICONS,
                'skin' => 'inline',
                'label_block' => true,
            ]
        );

        $this->add_control(
            'content_meta_data_icons',
            [
                'label' => esc_html__( 'Icon', 'modista' ),
                'type' => \Elementor\Controls_Manager::REPEATER,
                'fields' => $icon_repeater->get_controls(),
                'default' => [
                    [
                        'icon_type' => esc_html__( 'author', 'modista' ),
                        'icon' => [
                            'value' => 'fas fa-circle',
                            'library' => 'fa-solid',
                        ],
                    ],
                ],
                'prevent_empty' => false,
                'title_field' => '{{{ icon_type }}}',
                'condition' => [ 'content_meta_data_is_icons' => 'yes' ]
            ]
        );

        $this->add_control(
            'content_show_badge',
            [
                'label' => __('Badge', 'modista'),
                'type' => \Elementor\Controls_Manager::SWITCHER,
                'label_on' => __('Yes', 'modista'),
                'label_off' => __('No', 'modista'),
                'default' => 'yes',
                'separator' => 'before'
            ]
        );

        $this->end_controls_section();

        // Query section
        $this->start_controls_section(
            'query_section',
            [
                'label' => __('Query', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'query_post_per_page',
            [
                'label' => __('Post Per Page', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 6,
                'min' => 1,
                'max' => 20,
                'step' => 1,
            ]
        );

        $this->add_control(
            'query_offset',
            [
                'label' => __('Offset', 'modista'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
            ]
        );

        $this->add_control(
            'query_tax_category',
            [
                'label' => __('Categories', 'modista'),
                'type' => \Elementor\Controls_Manager::SELECT2,
                'options' => $this->get_query_terms(),
                'multiple' => true,
                'label_block' => true,
            ]
        );

        $this->end_controls_section();

        // Style layout
        $this->start_controls_section(
            'style_section_layout',
            [
                'label' => __('Layout', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'layout_grid_column_gap',
            [
                'label' => esc_html__( 'Column Gap', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__wrapper' => 'grid-column-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'layout_grid_row_gap',
            [
                'label' => esc_html__( 'Row Gap', 'modista' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 16,
                ],
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__wrapper' => 'grid-row-gap: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style card body
        $this->start_controls_section(
            'style_section_card_body',
            [
                'label' => __('Card Body', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        Elementor_Controls_Helper::get_box_style_controls($this, 'card', '.mi-card');

        $this->end_controls_section();

        // Style Thumbnail
        $this->start_controls_section(
            'style_section_image',
            [
                'label' => __('Thumbnail', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        Elementor_Controls_Helper::get_image_style_controls($this, 'card_image', '.mi-card__image');

        $this->end_controls_section();

        // Style card content
        $this->start_controls_section(
            'style_section_content',
            [
                'label' => __('Content', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        Elementor_Controls_Helper::get_box_style_controls($this, 'card_content', '.mi-card__content');

        $this->add_control(
            'style_content_title',
            [
                'label' => __( 'Title', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        Elementor_Controls_Helper::get_text_style_controls($this, 'card_title', '.mi-card__title');

        $this->add_control(
            'style_content_paragraph',
            [
                'label' => __( 'Excerpt', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        Elementor_Controls_Helper::get_text_style_controls($this, 'card_excerpt', '.mi-card__excerpt');

        $this->end_controls_section();

        // Style card Meta data
        $this->start_controls_section(
            'style_section_meta_data',
            [
                'label' => __('Meta Data', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );

        Elementor_Controls_Helper::get_flex_style_controls($this, 'meta_data', '.mi-card__meta-data');

        $this->add_control(
            'style_content_meta_data',
            [
                'label' => __( 'Item', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'gap_meta_data_item',
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
                'selectors' => [
                    '{{WRAPPER}} .mi-card__meta-data li' => 'gap: {{SIZE}}{{UNIT}};'
                ],
            ]
        );

        $this->add_control(
            'color_meta_data',
            [
                'label' => __('Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-card__meta-data' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'typography_meta_data',
                'selector' => '{{WRAPPER}} .mi-card__meta-data',
            ]
        );

        $this->add_control(
            'style_content_meta_data_icon',
            [
                'label' => __( 'Icon', 'modista' ),
                'type' => \Elementor\Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'width_meta_data_icon',
            [
                'label' => esc_html__( 'Width', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 1,
                        'max' => 1000,
                    ]
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__meta-data img' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .mi-card__meta-data svg' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'color_meta_data_icon',
            [
                'label' => __('Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-card__meta-data svg path' => 'stroke: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Style
        $this->start_controls_section(
            'style_section_badge',
            [
                'label' => __('Badge', 'modista'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
                'condition' => ['content_show_badge' => 'yes']
            ]
        );

        $this->add_responsive_control(
            "top_card_badge",
            [
                'label' => esc_html__( 'Top', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__badge' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            "bottom_card_badge",
            [
                'label' => esc_html__( 'Bottom', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__badge' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            "right_card_badge",
            [
                'label' => esc_html__( 'Right', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__badge' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            "left_card_badge",
            [
                'label' => esc_html__( 'Left', 'elementor' ),
                'type' => \Elementor\Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'custom' ],
                'range' => [
                    'px' => [
                        'min' => -500,
                        'max' => 500,
                        'step' => 1,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .mi-card__badge' => 'left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        Elementor_Controls_Helper::get_base_box_style_controls($this, 'card_badge', '.mi-card__badge');

        $this->add_control(
            "color_card_badge",
            [
                'label' => __('Color', 'modista'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .mi-card__badge' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => "typography_card_badge",
                'selector' => "{{WRAPPER}} .mi-card__badge",
            ]
        );

        $this->end_controls_section();
    }

    private function get_query_terms($taxonomy = 'category') {

        $taxonomies = get_terms($taxonomy);

        $options = [];
        if (!is_wp_error($taxonomies)) {
            foreach ($taxonomies as $category) {
                $options[$category->slug] = $category->name;
            }
        }
        return $options;
    }

    /**
     * Get first term for `$this->the_term_badge` method.
     *
     * @return string|void
     */
    private function get_first_term() {

        $taxonomies = get_the_terms(get_the_ID(), 'category');

        if ( !is_wp_error($taxonomies) ) foreach ($taxonomies as $category) {
            return $category->name;
        }

        return null;
    }

    /**
     * Render term badge.
     *
     * @return void
     */
    private function the_term_badge() {

        $term_badge = $this->get_first_term();

        if ( is_null($term_badge) ) return;

        echo '<div class="mi-card__badge position-absolute">';
        echo $term_badge;
        echo '</div>';
    }

    /**
     * Get excerpt with set length.
     *
     * @param int $count
     * @param string $ellipsis
     * @return void
     */
    private function the_excerpt( $count = 0, $ellipsis = 'yes' )
    {
        $excerpt = get_the_excerpt();
        $excerpt = trim($excerpt);

        $excerpt_array = explode(' ', $excerpt);
        $excerpt_array = array_slice($excerpt_array, 0, $count);

        $excerpt = implode(' ', $excerpt_array);

        if ( strlen($excerpt) > 0 && $ellipsis === 'yes' )  $excerpt = $excerpt . '...';

        echo $excerpt;
    }

    /**
     * Calculate Content Read time.
     *
     * @return false|float
     */
    private function calculate_reading_time() {

        $content = get_the_content();

        $clean_content = wp_strip_all_tags($content);
        $clean_content = trim($clean_content);

        // if content is empty.
        if ( empty($clean_content) ) {
            return 0;
        }

        // counter of the content characters.
        $word_count = preg_match_all('/\p{L}+/u', $clean_content);
        $reading_speed = 200;

        return ceil($word_count / $reading_speed);
    }

    /**
     * @return void
     */
    private function get_meta_data($settings) {

        $meta_data = $settings['content_meta_data'];

        if ( empty($meta_data) ) return;

        // Set Icon type to array key for easy fetch in switch.
        if ( $settings['content_meta_data_is_icons'] == 'yes' ) {
            $settings['content_meta_data_icons'] = array_reduce($settings['content_meta_data_icons'], function ($carry, $item) {
                $carry[ $item['icon_type'] ] = $item['icon'];
                return $carry;
            }, []);
        }

        echo '<ul class="d-flex mi-card__meta-data">';
            foreach ($meta_data as $meta) {
                // If set icon.
                $meta_icon = null;
                if ($settings['content_meta_data_is_icons'] == 'yes' && array_key_exists($meta, $settings['content_meta_data_icons']) ) {
                    $meta_icon = $settings['content_meta_data_icons'][$meta];
                }

                echo '<li class="d-flex">';

                // Render Icon
                if ($meta_icon) :
                    echo '<div class="d-flex">';
                        if ($meta_icon['library'] == 'svg'):
                            echo '<img src="' . $meta_icon['value']['url'] . '" alt="Search Icon" class="search-svg-icon">';
                        else:
                            \Elementor\Icons_Manager::render_icon($meta_icon, ['aria-hidden' => 'true']);
                        endif;
                    echo '</div>';
                endif;

                // Render data text
                echo '<span class="d-flex">';
                    switch ($meta) {
                        case 'author':
                            echo get_the_author();
                            break;
                        case 'read_time':
                            echo sprintf( __('%d دقیقه', 'modista'), $this->calculate_reading_time() );
                            break;
                        case 'date':
                            echo get_the_date('Y/m/d');
                            break;
                        case 'time':
                            echo get_the_time();
                            break;
                        case 'comments':
                            $comments_count = get_comments_number();
                            echo sprintf(_n('%s Comment', '%s Comments', $comments_count, 'modista'), $comments_count);
                            break;
                        case 'date_modified':
                            $modified_date = get_the_modified_date();
                            $modified_time = get_the_modified_time();
                            echo sprintf(__('Last updated on %s at %s', 'modista'), $modified_date, $modified_time);
                            break;
                    }
                echo '</span>';

                echo '</li>';
            }
        echo '</ul>';
    }

    protected function render() {
        $settings = $this->get_settings_for_display();
        $title_tag = $settings['content_tag_type_title'];

        // Post Query
        $args = [
            'post_type' => 'post',
            'posts_per_page' => $settings['query_post_per_page'],
            'offset' => $settings['query_offset'],
        ];

        if (!empty($settings['query_taxonomy'])) {
            $args['tax_query'] = [
                [
                    'taxonomy' => 'product_cat',
                    'field' => 'slug',
                    'terms' => $settings['query_tax_category'],
                ],
            ];
        }

        $query = new \WP_Query($args);

        // Layout grid column number.
        $this->add_render_attribute('wrapper_class', 'class', 'd-grid mi-card__wrapper h-100');
        if (isset($settings['layout_columns'])) {
            $this->add_render_attribute('wrapper_class', 'class', sprintf('d-grid-lg-%d', $settings['layout_columns']));
        }
        if (isset($settings['layout_columns_tablet'])) {
            $this->add_render_attribute('wrapper_class', 'class', sprintf('d-grid-md-%d', $settings['layout_columns_tablet']));
        }
        if (isset($settings['layout_columns_mobile'])) {
            $this->add_render_attribute('wrapper_class', 'class', sprintf('d-grid-%d', $settings['layout_columns_mobile']));
        }

        if ( $query->have_posts() ) :
            echo  '<div ' . $this->get_render_attribute_string('wrapper_class') . '>';
                // Render card
                while ($query->have_posts()) : $query->the_post(); ?>
                    <div class="d-flex position-relative mi-card">
                        <?php if ($settings['content_show_badge']) $this->the_term_badge(); ?>
                        <div class="mi-card__image">
                            <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
                                <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
                            </a>
                        </div>
                        <div class="d-flex flex-1 mi-card__content">
                            <?php
                            echo '<div>';
                            // Render the title
                            if ( $settings['content_show_title'] ) {
                                // Render title tag
                                echo '<' . esc_html($title_tag) . ' class="mi-card__title">';
                                echo '<a href="' . esc_url(get_permalink()) . '" title="' . esc_attr(get_the_title()) . '">';
                                the_title();
                                echo '</a>';
                                echo '</' . esc_html($title_tag) . '>';
                            }
                            // Render the excerpt
                            if ( $settings['content_show_excerpt'] ) {
                                echo '<p class="mi-card__excerpt">';
                                $this->the_excerpt( $settings['content_length_excerpt'], $settings['content_ellipsis_excerpt'] );
                                echo '</p>';
                            }
                            echo '</div>';
                            // Render meta data
                            $this->get_meta_data($settings);
                            ?>
                        </div>
                    </div>
                <?php endwhile;
            echo '</div>';
        wp_reset_postdata();
        endif;
    }
}
