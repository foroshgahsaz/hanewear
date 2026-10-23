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
        'title'  => esc_html__( 'آرشیو فروشگاه', 'modista' ),
        'id'     => 'archive_shop',
        'desc'   => esc_html__( 'تنظیمات مربوط به صفحه آرشیو محصولات (فروشگاه)', 'modista' ),
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
            array(
                'id'       => 'mi_shop_sidebar_display',
                'type'     => 'switch',
                'title'    => esc_html__( 'نمایش سایدبار', 'modista' ),
                'desc'     => esc_html__( 'فعال یا غیرفعال کردن سایدبار در صفحه فروشگاه.', 'modista' ),
                'on'       => esc_html__( 'فعال', 'modista' ),
                'off'      => esc_html__( 'غیرفعال', 'modista' ),
                'default'  => true,
            ),
            array(
                'id'       => 'mi_shop_products_per_page',
                'type'     => 'slider',
                'title'    => esc_html__( 'تعداد محصولات در هر صفحه', 'modista' ),
                'desc'     => esc_html__( 'تعداد محصولاتی که در هر صفحه فروشگاه نمایش داده شود.', 'modista' ),
                'min'      => 1,
                'max'      => 100,
                'step'     => 1,
                'default'  => 12,
            ),
            array(
                'id'       => 'mi_shop_sidebar_help_text',
                'type'     => 'info',
                'style'    => 'info',
                'title'    => esc_html__( 'راهنما', 'modista' ),
                'desc'     => esc_html__( 'مدیریت ویجت‌های سایدبار فروشگاه از طریق پیشخوان وردپرس > نمایش >ابزارک‌ها انجام می‌شود.', 'modista' ),
            ),
        ),
    )
);