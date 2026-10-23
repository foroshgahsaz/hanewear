<?php

defined('ABSPATH') || exit;

add_filter('wp_list_categories', 'mi_wp_list_categories');

add_filter('get_the_date', 		'mi_date_to_jalali', 10, 3);
add_filter('the_date', 			'mi_date_to_jalali', 10, 3);
add_filter('get_the_time', 		'mi_date_to_jalali', 10, 3);
add_filter('the_time', 			'mi_date_to_jalali', 10, 3);
add_filter('get_comment_date', 	'mi_date_to_jalali', 10, 3);
add_filter('get_comment_time', 	'mi_date_to_jalali', 10, 3);

// Set post per page for post archive
add_action( 'pre_get_posts', 'mi_custom_posts_per_page' );