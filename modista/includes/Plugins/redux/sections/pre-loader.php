<?php
/**
 * ReduxFramework Section
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

Redux::setSection(
  $opt_name,
  array(
    'title'  => __('پیش بارگذار', 'modista'),
    'id'     => 'preloader_section',
    'desc'   => __('پیش بارگذاری صفحه را سفارشی کنید.', 'modista'),
    'icon'   => 'el el-refresh',
    'fields' => array(
        array(
            'id'       => 'enable_preloader',
            'type'     => 'switch',
            'title'    => __('فعالسازی پیش بارگذار', 'modista'),
            'default'  => true,
            'off'      => __('خاموش', 'modista')
        ),
        array(
            'id'       => 'preloader_logo',
            'type'     => 'media',
            'url'      => false,
            'title'    => __('آپلود لوگو برای پیش بارگذار', 'modista'),
            'default'  => '',
        ),
        array(
            'id'       => 'preloader_bg_color',
            'type'     => 'color',
            'title'    => __('پس زمینه', 'modista'),
            'default'  => '#ffffff',
        ),
    )
));