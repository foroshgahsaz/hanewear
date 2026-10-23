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
        'title'  => esc_html__( 'صفحه محصول', 'modista' ),
        'id'     => 'single_product',
        'desc'   => esc_html__( 'فیلد های مصحول تکی.', 'modista' ),
        'icon'   => 'el el-shopping-cart',
        'fields' => array(
	        array(
		        'id'       => 'single_product_gallery',
		        'type'     => 'radio',
		        'title'    => esc_html__( 'نمایش گالری محصول', 'modista' ),
		        'desc'     => esc_html__( 'گالری را میتوانید مخفی یا نمایش دهید', 'modista' ),
		        'data'  => [
			        'on' => esc_html__( 'نمایش', 'modista' ),
			        'off' => esc_html__( 'مخفی', 'modista' ),
		        ],
	        ),
	        array(
		        'id'       => 'single_product_features',
		        'type'    => 'repeater',
		        'title'    => esc_html__( 'بخش جعبه امکانات', 'modista' ),
		        'desc'    => esc_html__( 'ویژگی های فروشگاه در صفحه تکی محصول', 'modista' ),
		        'fields'  => array(
			        array(
				        'id'    => 'single_product_feature_icon',
				        'type'  => 'media',
				        'title' => esc_html__( 'آیکن', 'modista' ),
				        'desc'  => esc_html__( 'یک آیکن برای ویژگی آپلود کنید.', 'modista' ),
			        ),
			        array(
				        'id'    => 'single_product_feature_title',
				        'type'  => 'text',
				        'title' => esc_html__( 'عنوان', 'modista' ),
				        'desc'  => esc_html__( 'عنوان این ویژگی را وارد کنید.', 'modista' ),
			        ),
		        ),
	        ),
	        array(
		        'id'       => 'single_product_after_summary_section',
		        'type'     => 'select',
		        'title'    => esc_html__( 'بخش پایینی', 'modista' ),
		        'desc'     => esc_html__( 'بخش را از Section builder انتخاب کنید.', 'modista' ),
		        'options'  => $section_options,
	        ),
        )
    )
);