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
        'title'  => esc_html__( 'صفحه نوشته', 'modista' ),
        'id'     => 'single_posts',
        'desc'   => esc_html__( 'فیلد های نوشته', 'modista' ),
        'icon'   => 'el el-edit',
        'fields' => array(
	        array(
		        'id'       => 'mi_single_section_after_base_template',
		        'type'     => 'select',
		        'title'    => esc_html__( 'بخش پس از تک قالب', 'modista' ),
		        'desc'     => esc_html__( 'بخش را از Section builder انتخاب کنید.', 'modista' ),
		        'options'  => $section_options,
	        ),
        )
    )
);