<?php
/**
 * Single Product Share
 *
 * Sharing plugins can hook into here or you can add your own code directly.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/share.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$post_id = get_the_ID();
$user_id = get_current_user_id();
$wishlist = get_user_meta($user_id, '_mi_wishlist', true);

$is_favorited = is_array($wishlist) && in_array($post_id, $wishlist);

do_action( 'woocommerce_share' ); // Sharing plugins can hook into here. ?>

<div class="action-button d-flex gap-2 align-items-start">
	<div class="action-button__share position-relative d-flex p-3 cursor-pointer" data-link="<?php echo get_the_permalink(); ?>">
		<div class="tooltip position-absolute">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path d="M22 11.1V6.9C22 3.4 20.6 2 17.1 2H12.9C9.4 2 8 3.4 8 6.9V8H11.1C14.6 8 16 9.4 16 12.9V16H17.1C20.6 16 22 14.6 22 11.1Z" stroke="#221F1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M16 17.1V12.9C16 9.4 14.6 8 11.1 8H6.9C3.4 8 2 9.4 2 12.9V17.1C2 20.6 3.4 22 6.9 22H11.1C14.6 22 16 20.6 16 17.1Z" stroke="#221F1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M6.08008 14.9998L8.03008 16.9498L11.9201 13.0498" stroke="#221F1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<span>کپی شد</span>
		</div>
		<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
			<path d="M12.72 4.6275C14.22 5.67 15.255 7.3275 15.465 9.24" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M2.61743 9.27749C2.81243 7.37249 3.83243 5.71499 5.31743 4.66499" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M6.14258 15.705C7.01258 16.1475 8.00258 16.395 9.04508 16.395C10.0501 16.395 10.9951 16.17 11.8426 15.7575" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M9.04496 5.775C10.1965 5.775 11.13 4.84151 11.13 3.69C11.13 2.53848 10.1965 1.605 9.04496 1.605C7.89345 1.605 6.95996 2.53848 6.95996 3.69C6.95996 4.84151 7.89345 5.775 9.04496 5.775Z" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M3.6226 14.94C4.77411 14.94 5.7076 14.0065 5.7076 12.855C5.7076 11.7035 4.77411 10.77 3.6226 10.77C2.47108 10.77 1.5376 11.7035 1.5376 12.855C1.5376 14.0065 2.47108 14.94 3.6226 14.94Z" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			<path d="M14.3775 14.94C15.529 14.94 16.4625 14.0065 16.4625 12.855C16.4625 11.7035 15.529 10.77 14.3775 10.77C13.226 10.77 12.2925 11.7035 12.2925 12.855C12.2925 14.0065 13.226 14.94 14.3775 14.94Z" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</div>
	<div class="action-button__wishlist position-relative d-flex p-3 cursor-pointer" data-id="<?php echo esc_attr($post_id); ?>" data-action="<?php echo $is_favorited ? 'remove' : 'add'; ?>">
		<div class="tooltip position-absolute">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
				<path d="M16.8198 2H7.17982C5.04982 2 3.31982 3.74 3.31982 5.86V19.95C3.31982 21.75 4.60982 22.51 6.18982 21.64L11.0698 18.93C11.5898 18.64 12.4298 18.64 12.9398 18.93L17.8198 21.64C19.3998 22.52 20.6898 21.76 20.6898 19.95V5.86C20.6798 3.74 18.9498 2 16.8198 2Z" stroke="#221F1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9.58984 11L11.0898 12.5L15.0898 8.5" stroke="#221F1F" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<?php if ($user_id) : ?>
				<span><?php echo $is_favorited ? __('از علاقه مندی حذف شد.') : __('به علاقه مندی افزوده شد.'); ?></span>
			<?php else : ?>
				<span><?php echo __('ابتدا وارد شوید.'); ?></span>
			<?php endif; ?>
		</div>
		<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
			<path d="M9.465 15.6075C9.21 15.6975 8.79 15.6975 8.535 15.6075C6.36 14.865 1.5 11.7675 1.5 6.5175C1.5 4.2 3.3675 2.325 5.67 2.325C7.035 2.325 8.2425 2.985 9 4.005C9.7575 2.985 10.9725 2.325 12.33 2.325C14.6325 2.325 16.5 4.2 16.5 6.5175C16.5 11.7675 11.64 14.865 9.465 15.6075Z" stroke="#AFAFAF" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
		</svg>
	</div>
</div>

<?php
/* Omit closing PHP tag at the end of PHP files to avoid "headers already sent" issues. */