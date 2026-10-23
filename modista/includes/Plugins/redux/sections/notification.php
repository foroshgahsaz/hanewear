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
    'modista', 
    array(
    'title'  => __('اطلاع‌رسانی‌ها', 'modista'),
    'id'     => 'notifications_section',
    'desc'   => __('لیست اطلاع‌رسانی‌ها را مدیریت کنید.', 'modista'),
    'icon'   => 'el el-info-circle',
    'fields' => array(
        array(
            'id'       => 'notifications_repeater_field',
            'type'    => 'repeater',
            'title'    => esc_html__( 'اطلاعیه های فعال', 'modista' ),
            'fields'  => array(    
                array(
                    'id'       => 'notification_title',
                    'type'     => 'text',
                    'title'    => __('عنوان اطلاع‌رسانی جدید', 'modista'),
                    'desc'     => __('عنوان موردنظر را برای اطلاع‌رسانی وارد کنید.', 'modista'),
                ),        
                array(
                    'id'       => 'notification_text',
                    'type'     => 'textarea',
                    'title'    => __('متن اطلاع‌رسانی جدید', 'modista'),
                    'desc'     => __('متن موردنظر را برای اطلاع‌رسانی وارد کنید.', 'modista'),
                ),
                array(
                    'id'       => 'notification_type',
                    'type'     => 'radio',
                    'title'    => __('نوع اطلاع‌رسانی', 'modista'),
                    'desc'     => '',
                    'data'  => [
                        '0' => esc_html__( 'اطلاعیه', 'modista' ),
                        '1' => esc_html__( 'مهم', 'modista' ),
                        '2' => esc_html__( 'خیلی مهم', 'modista' ),
                    ],
                    'default'   => '0',
                ),
                array(
                    'id'       => 'notification_id',
                    'type'     => 'text',
                    'title'    => __('شناسه اطلاعیه', 'modista'),
                    'desc'     => __('این مقدار به‌صورت خودکار تنظیم می‌شود.', 'modista'),
                    'readonly' => true,
                ),
            ),
        ) 
    ),    
));