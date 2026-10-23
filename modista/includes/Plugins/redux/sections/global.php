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
        'title'  => esc_html__( 'سراسری', 'modista' ),
        'id'     => 'basic',
        'icon'   => 'el el-dashboard',
    )
);

Redux::set_field( $opt_name, 'basic',
    array(
        'id'       => 'basic_font_enable',
        'type'     => 'switch',
        'on'       => 'فعال',
        'off'       => 'غیرفعال',
        'title'    => esc_html__('فونت قالب', 'modista'), 
        'subtitle' => esc_html__('فعالسازی فونت پیشفرض قالب', 'modista'),
        'desc'     => esc_html__('با فعالسازی این گزینه فونت پیشفرض روی تمام بخش ها اعمال میشود', 'modista'),
        'default'  => 'true'
    )
);