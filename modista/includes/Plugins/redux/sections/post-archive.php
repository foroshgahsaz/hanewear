<?php
/**
 * ReduxFramework Section
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

Redux::set_section(
    $opt_name,
    array(
        'title'  => esc_html__( 'آرشیو مقاله(وبلاگ)', 'modista' ),
        'id'     => 'archive_posts',
        'desc'   => esc_html__( 'تنظیمات مربوط به صفحه آرشیو نوشته‌ها', 'modista' ),
        'icon'   => 'el el-folder-open',
        'fields' => array(
            array(
                'id'       => 'mi_archive_sidebar_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش سایدبار', 'modista' ),
                'desc'     => esc_html__( 'فعال یا غیرفعال کردن سایدبار در صفحه آرشیو.', 'modista' ),
                'on'       => esc_html__( 'فعال', 'modista' ),
                'off'      => esc_html__( 'غیرفعال', 'modista' ),
                'default'  => true,
            ),
            array(
                'id'       => 'mi_archive_posts_per_page',
                'type'     => 'slider',
                'title'    => esc_html__( 'تعداد مقالات در هر صفحه', 'modista' ),
                'desc'     => esc_html__( 'تعداد مقالاتی که در هر صفحه آرشیو نمایش داده شود.', 'modista' ),
                'min'      => 1,
                'max'      => 50,
                'step'     => 1,
                'default'  => 10,
            ),
            array(
                'id'       => 'mi_archive_sort_filter',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش فیلتر مرتب‌سازی', 'modista' ),
                'desc'     => esc_html__( 'فعال یا غیرفعال کردن نمایش فیلتر مرتب‌سازی در آرشیو.', 'modista' ),
                'on'       => esc_html__( 'فعال', 'modista' ),
                'off'      => esc_html__( 'غیرفعال', 'modista' ),
                'default'  => true,
            ),
            array(
                'id'       => 'mi_archive_sidebar_help_text',
                'type'     => 'info',
                'style'    => 'info',
                'title'    => esc_html__( 'راهنما', 'modista' ),
                'desc'     => esc_html__( 'مدیریت ویجت‌های سایدبار از طریق بخش  پیشخوان وردپرس > نمایش >ابزارک‌ها انجام می‌شود.', 'modista' ),
            ),
        ),
    )
);
