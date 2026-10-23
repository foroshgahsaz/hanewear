<?php
/**
 * My Account Dashboard
 *
 * Shows the first intro screen on the account dashboard.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/dashboard.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$current_user = wp_get_current_user();

$allowed_html = array(
	'a' => array(
		'href' => array(),
	),
);

$statuses = [
	'completed'   => __('سفارش تکمیل شده', 'modista'),
	'on-hold'     => __('سفارش درانتظار پرداخت', 'modista'),
	'processing'  => __('سفارش درحال انجام', 'modista'),
	'pending'     => __('سفارش درانتظار بررسی', 'modista'),
	'cancelled'   => __('سفارش لغو شده', 'modista'),
];

$order_counts = [];

foreach ($statuses as $status_key => $status_label) {
	$orders = wc_get_orders([
		'customer_id' => $current_user->ID,
		'status'      => $status_key,
		'return'      => 'ids',
	]);
	
	$order_counts[$status_key] = count($orders);
}

$address = wc_get_account_formatted_address();

?>
<div class="overflow-hidden">
	<div class="head-order d-flex d-md-grid overflow-scroll overflow-md-auto gap-4 d-grid-5 mb-6 mb-md-8">
		<?php foreach ($statuses as $status_key => $status_label): ?>
		<div class="head-order__item d-flex flex-column align-items-center justify-content-start justify-content-md-center">
			<svg width="24px" height="24px" style="fill: var(--mi-color-secondary);">
				<use xlink:href="#shopping-<?php echo $status_key; ?>"></use>
			</svg>
			<span><?php echo $order_counts[$status_key] ?? 0; ?></span>
			<p class="text-center px-2 px-md-4"><?php echo $status_label; ?></p>
		</div>
		<?php endforeach; ?>
	</div>
</div>
<div class="card bg-white rounded-4 p-3 pb-5 mb-6">
	<div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
		<h4 class="fw-700 lh-200 color-text-500"><?php _e( 'اطلاعات شخصی', 'modista' ) ?></h4>
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'edit-account' ) ); ?>"
			class="d-flex gap-2 align-items-center color-text-300 fs-3--1">
			<svg width="16" height="16" style="fill: #989898;">
				<use xlink:href="#edit"></use>
			</svg>
			<?php _e('ویرایش اطلاعات', 'modista'); ?>
		</a>
	</div>
	<div class="card__content">
		<div class="form-read d-grid d-grid-1 d-grid-md-2 gap-3 mb-3">
			<div class="d-flex align-items-start bg-text-100 py-2 px-3 rounded-3 gap-2">
				<span class="flex-none fs-3--1 color-text-300 end-divider"><?php _e('نام و نام خانوادگی', 'modista'); ?></span>
				<p class="color-text-500 lh-200">
					<?php echo $current_user->first_name . " " . $current_user->last_name ?>				
				</p>
			</div>
			<div class="d-flex align-items-start bg-text-100 py-2 px-3 rounded-3 gap-2">
				<span class="flex-none fs-3--1 color-text-300 end-divider"><?php _e('شماره موبایل', 'modista'); ?></span>
				<p class="color-text-500 lh-200">
					<?php echo get_user_meta( $current_user->ID, '_mi_phone', true ); ?>				
				</p>
			</div>
			<div class="d-flex align-items-start bg-text-100 py-2 px-3 rounded-3 gap-2">
				<span class="flex-none fs-3--1 color-text-300 end-divider"><?php _e('ایمیل', 'modista'); ?></span>
				<p class="color-text-500 lh-200">
					<?php echo $current_user->user_email; ?>
				</p>
			</div>
			<div class="d-flex align-items-start bg-text-100 py-2 px-3 rounded-3 gap-2">
				<span class="flex-none fs-3--1 color-text-300 end-divider"><?php _e('عضویت', 'modista'); ?></span>
				<p class="color-text-500 lh-200">
					<?php
					$user_registered = strtok($current_user->user_registered, ' ');
					echo mi_date_to_jalali($user_registered);
					?>
				</p>
			</div>
		</div>
		<div class="form-read d-grid d-grid-1 gap-3">
			<div class="d-flex align-items-start bg-text-100 py-2 px-3 rounded-3 gap-2">
				<span class="flex-none fs-3--1 color-text-300 end-divider"><?php _e('آدرس', 'modista'); ?></span>
				<p class="color-text-500 lh-200" style="min-height: 100px;">
					<?php echo str_replace("<br/>", "، ", $address); ?>
				</p>
			</div>
		</div>
	</div>
</div>
<div class="card bg-white rounded-4 p-3 pb-5">
	<div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
		<h4 class="fw-700 lh-200 color-text-500"><?php _e( 'آخرین علاقه مندی ها', 'modista' ) ?></h4>
		<a href="<?php echo esc_url( wc_get_account_endpoint_url( 'wishlist' ) ); ?>"
			class="d-flex gap-2 align-items-center color-text-300 fs-3--1">
			<svg width="16" height="16" style="fill: #989898;">
				<use xlink:href="#edit"></use>
			</svg>
			<?php _e('ویرایش علاقمندی ها', 'modista'); ?>
		</a>
	</div>
	<div class="card__content">
		<?php 
		$user_id = get_current_user_id();
		$wishlist = get_user_meta($user_id, '_mi_wishlist', true);
		?>
		<?php if ( is_array($wishlist) && count($wishlist) > 0 ) : ?>
			<?php $wishlist = array_slice( array_reverse($wishlist), 0, 3); ?>
			<div class="d-grid d-grid-1 d-grid-md-3 gap-3">
				<?php foreach ( $wishlist as $post_ID ) : ?>
					<div class="item d-flex p-3 rounded-3 gap-3 bg-text-100 align-items-center">
						<?php
						// Render thumbnail
						$src = get_the_post_thumbnail_url( $post_ID );
						if ($src) { 
							echo '<img width="37px" height="48px" src="' . $src . '" style="object-fit:contain;" />';
						} 
						?>
						<div class="flex-1 fs-3--1 lh-200 ps-md-12"><?php echo get_the_title( $post_ID ); ?></div>
						<div class="d-flex flex-column justify-content-center gap-3">
							<a href="<?php echo get_permalink( $post_ID ); ?>" target="_blank" class="d-flex bg-white rounded-2 p-2">                    
								<svg width="18" height="18" fill="#989898">
									<use xlink:href="#eye"></use>
								</svg>
							</a>
							<span class="action-button__wishlist d-flex bg-white rounded-2 p-2 cursor-pointer" data-id="<?php esc_attr_e( $post_ID ); ?>" data-action="remove" data-action-hide="true">
								<svg width="18" height="18" fill="#989898">
									<use xlink:href="#trash-bin"></use>
								</svg>
							</span>
						</div>
					</div>
				<?php endforeach; ?>
			</div>
			
		<?php else : ?>

			<div class="text-center py-16">
				<svg width="56px" height="56px" style="fill: #989898;">
					<use xlink:href="#heart"></use>
				</svg>
				<p class="lh-200 color-text-300">
					<?php _e('لیست علاقه مندی شما خالی است.', 'modista'); ?>
				</p>
			</div>	

		<?php endif; ?>
	</div>
</div>
<?php
	/**
	 * My Account dashboard.
	 *
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_dashboard' );

	/**
	 * Deprecated woocommerce_before_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_before_my_account' );

	/**
	 * Deprecated woocommerce_after_my_account action.
	 *
	 * @deprecated 2.6.0
	 */
	do_action( 'woocommerce_after_my_account' );

/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */