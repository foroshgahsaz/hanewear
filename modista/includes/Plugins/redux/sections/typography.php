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
    'title'  => 'تایپوگرافی',
    'id'     => 'typography_settings',
    'icon'   => 'el el-font',
    'fields' => array(
        array(
            'id'       => 'body_typography',
            'type'     => 'typography',
            'title'    => 'فونت بدنه سایت',
            'subtitle' => 'فونت، اندازه و رنگ متون بدنه سایت',
            'fonts'    => [
                'Iransans' => 'ایران‌سنس'
            ],
            'default'  => array(
                'font-family' => 'Iransans',
            ),
        ),
        array(
            'id'       => 'heading_typography',
            'type'     => 'typography',
            'title'    => 'فونت عناوین',
            'subtitle' => 'تنظیم فونت برای h1 تا h6',
            'fonts'    => [
                'Iransans' => 'ایران‌سنس'
            ],
            'default'  => array(
                'font-family' => 'Iransans',
            ),
        ),
        array(
            'id'       => 'link_typography',
            'type'     => 'typography',
            'title'    => 'فونت لینک‌ها',
            'subtitle' => 'تغییر رنگ و فونت لینک‌ها',
            'fonts'    => [
                'Iransans' => 'ایران‌سنس'
            ],
            'default'  => array(
                'font-family' => 'inherit',
            ),
        ),
        array(
            'id'       => 'button_typography',
            'type'     => 'typography',
            'title'    => 'فونت دکمه‌ها',
            'subtitle' => 'فونت و رنگ متون داخل دکمه',
            'fonts'    => [
                'Iransans' => 'ایران‌سنس'
            ],
            'default'  => array(
                'font-family' => 'inherit',
            ),
        ),
        array(
            'id'       => 'input_typography',
            'type'     => 'typography',
            'title'    => 'فونت فرم ها',
            'subtitle' => 'فونت و رنگ متون فرم و ورودی ها',
            'fonts'    => [
                'Iransans' => 'ایران‌سنس'
            ],
            'default'  => array(
                'font-family' => 'inherit',
            ),
        ),
    )
));
