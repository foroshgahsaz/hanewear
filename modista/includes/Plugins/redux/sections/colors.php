<?php
/**
 * ReduxFramework Section
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

Redux::setSection($opt_name, array(
    'title'  => 'رنگ‌ها',
    'id'     => 'color_settings',
    'icon'   => 'el el-tint',
    'fields' => array(
        array(
            'id'       => 'primary_color',
            'type'     => 'color',
            'title'    => 'رنگ اصلی سایت',
            'default'  => '#0D0C0C',
        ),
        array(
            'id'       => 'secondary_color',
            'type'     => 'color',
            'title'    => 'رنگ ثانویه',
            'default'  => '#FD5504',
        ),
        array(
            'id'       => 'button_bg_color',
            'type'     => 'color',
            'title'    => 'رنگ پس‌زمینه دکمه‌ها',
        ),
        array(
            'id'       => 'button_hover_color',
            'type'     => 'color',
            'title'    => 'رنگ دکمه در حالت هاور',
        ),
    )
));
