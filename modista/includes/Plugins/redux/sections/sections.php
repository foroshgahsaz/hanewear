<?php
/**
 * ReduxFramework Section
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

/**
 * Get Modista posts
 * Create array for render.
 */
$result = get_posts( [
	'numberposts'      => -1,
	'post_type'        => 'modista_library',
] );

$section_options = [];

foreach ($result as $item) {
	$section_options[$item->ID] = $item->post_title;
}

Redux::set_section(
    $opt_name,
    array(
        'title'  => esc_html__( 'بخش های قالب', 'modista' ),
        'id'     => 'sections',
        'desc'   => esc_html__( 'مدیریت بخش های متحرک.', 'modista' ),
        'icon'   => 'el el-th-large',
        'fields' => array(
			array(
                'id'       => 'pre_header_status',
                'type'     => 'radio',
                'title'    => esc_html__( 'پیش هدر وضعیت (نوار بالا)', 'modista' ),
                'desc'     => esc_html__( 'پیش هدر وضعیت (نوار بالا)', 'modista' ),
                'data'  => [
                    '1' => esc_html__( 'فعال', 'modista' ),
                    '0' => esc_html__( 'غیرفعال', 'modista' ),
                ],
            ),
            array(
                'id'       => 'pre_header_select',
                'type'     => 'select',
                'title'    => esc_html__( 'پیش هدر وضعیت (نوار بالا)', 'modista' ),
                'desc'     => esc_html__( 'سبک هدر ثانویه را انتخاب کنید.', 'modista' ),
                'options'  => $section_options,
                'required' => array( 'pre_header_status', '=', '1' ),
            ),
            array(
                'id'       => 'main_header_select',
                'type'     => 'select',
                'title'    => esc_html__( 'هدر اصلی', 'modista' ),
                'desc'     => esc_html__( 'سبک هدر اصلی را انتخاب کنید.', 'modista' ),
                'options'  => $section_options,
            ),
			array(
                'id'       => 'main_footer_select',
                'type'     => 'select',
                'title'    => esc_html__( 'فوتر اصلی', 'modista' ),
                'desc'     => esc_html__( 'پاورقی اصلی را از Section builder انتخاب کنید.', 'modista' ),
                'options'  => $section_options,
            ),
			array(
		        'id'       => 'mi_404_section_id',
		        'type'     => 'select',
		        'title'    => esc_html__( '404', 'modista' ),
		        'desc'     => esc_html__( 'محتوای اصلی صفحه 404 را انتخاب کنید', 'modista' ),
		        'options'  => $section_options,
	        ),
        )
    )
);