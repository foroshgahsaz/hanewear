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
 * Table data
 * Get data from `mi_form_submission` table
 */
function get_form_data() {

	global $wpdb;

	$table_name = $wpdb->prefix . 'mi_form_submission';

	if ( $wpdb->get_var("SHOW TABLES LIKE '$table_name'") != $table_name ) {
		return [];
	}

    $results = $wpdb->get_results("SELECT * FROM $table_name", ARRAY_A);
    
    if (empty($results)) {
        return '<p>هیچ داده‌ای یافت نشد.</p>';
    }

    $output = '<table border="1" width="100%" style="border-collapse: collapse; text-align: center;">';
    $output .= '<tr><th>آیدی</th><th>مقدار</th><th>تاریخ ایجاد</th></tr>';
    
    foreach ($results as $row) {

		$created_at = strtok($row['created_at'], ' ');
		if (function_exists('mi_date_to_jalali')) {
			$created_at = mi_date_to_jalali($created_at);
		}

        $output .= '<tr>';
        $output .= '<td>' . esc_html($row['id']) . '</td>';
        $output .= '<td>' . esc_html($row['field']) . '</td>';
        $output .= '<td>' . esc_html($created_at) . '</td>';
        $output .= '</tr>';
    }
    
    $output .= '</table>';

    return $output;
}

$get_form_data = get_form_data();

// Hide item in panel menu.
if (empty($get_form_data)) {
	return;
}

Redux::set_section(
	'modista', 
	array(
		'title'  => __('ورودی ویجت فرم تماس', 'modista'),
		'id'     => 'elementor_widget_form_submision_section',
		'icon'     => 'el el-th-list',
		'fields' => array(
			array(
				'id'       => 'elementor_widget_form_submision_data',
				'type'     => 'raw',
				'content'  => $get_form_data,
			),
		)
	)
);