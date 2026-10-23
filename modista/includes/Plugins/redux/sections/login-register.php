<?php
/**
 * ReduxFramework Section
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

$result = get_posts( [
	'numberposts'      => -1,
	'post_type'        => 'page',
] );

$pages_options = [];

foreach ($result as $item) {
	$pages_options[$item->ID] = $item->post_title;
}

Redux::set_section(
	'modista',
	array(
		'title'  => esc_html__( 'ورود عضویت', 'modista' ),
		'id'     => 'mi_login_register',
		'desc'   => esc_html__( 'تنظیمات ورود عضویت', 'modista' ),
		'icon'   => 'el el-lock',
		'fields' => array(
			array(
				'id'       => 'mi_login_register_id',
				'type'     => 'select',
				'title'    => esc_html__( 'صفحه ورود و عضویت', 'modista' ),
				'desc'     => esc_html__( 'لطفاً صفحه موردنظر برای ورود و عضویت کاربران را انتخاب نمایید.', 'modista' ),
				'options'  => $pages_options
			),
			array(
				'id'       => 'mi_after_login_redirect',
				'type'     => 'text',
				'title'    => esc_html__( 'آدرس تغییر مسیر پس از ورود', 'modista' ),
				'desc'     => esc_html__( 'پس از ورود موفق، کاربر به این آدرس هدایت خواهد شد.', 'modista' ),
			),
			array(
				'id'       => 'mi_auth_with_google',
				'type'     => 'switch',
				'title'    => esc_html__( 'فعال‌سازی ورود با گوگل', 'modista' ),
				'desc'     => esc_html__( 'با فعال‌سازی این گزینه، کاربران می‌توانند با حساب گوگل خود وارد شوند.', 'modista' ),
				'on'       => 'فعال',
				'off'      => 'غیرفعال',
				'default'  => false,
			),
			array(
				'id'       => 'auth_with_google_method',
				'type'     => 'radio',
				'title'    => esc_html__( 'روش ورود با گوگل', 'modista' ),
				'desc'     => esc_html__( 'روش اول طراحی زیباتری دارد اما منسوخ شده است؛ روش دوم توسط گوگل توصیه می‌شود.', 'modista' ),
				'data'     => array(
					'gapi' => 'روش Google API (قدیمی - منسوخ شده)',
					'gis'  => 'روش Google Identity Service (توصیه‌شده)',
				),
				'default'  => 'gis',
				'required' => array( 'mi_auth_with_google', '=', 'true' ),
			),
			array(
				'id'          => 'mi_auth_with_google_client_id',
				'type'        => 'text',
				'placeholder' => 'example.apps.googleusercontent.com',
				'title'       => esc_html__( 'Client ID', 'modista' ),
				'desc'        => esc_html__( 'Client ID دریافتی از کنسول گوگل را وارد نمایید.', 'modista' ),
				'required'    => array( 'mi_auth_with_google', '=', 'true' ),
			),
			array(
				'id'       => 'mi_auth_with_google_secret_id',
				'type'     => 'password',
				'title'    => esc_html__( 'Secret ID', 'modista' ),
				'desc'     => esc_html__( 'Secret ID محرمانه مربوط به پروژه گوگل را وارد نمایید.', 'modista' ),
				'required' => array( 'mi_auth_with_google', '=', 'true' ),
			),
			array(
				'id'          => 'mi_auth_with_google_redirect_url',
				'type'        => 'text',
				'placeholder' => 'https://example.com/login',
				'title'       => esc_html__( 'آدرس بازگشتی (Redirect URL)', 'modista' ),
				'desc'        => esc_html__( 'پس از احراز هویت موفق از طریق گوگل، کاربر به این آدرس بازگردانده می‌شود.', 'modista' ),
				'required'    => array( 'auth_with_google_method', '=', 'gis' ),
				'validate'    => array( 'url' )
			),
		)
	)
);