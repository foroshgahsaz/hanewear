<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );

$current_user = wp_get_current_user();

?>
<div id="mi_modal_side" class="mi-modal-side bg-text-100 w-75 d-flex flex-column flex-1 p-5 rounded-6 gap-8">
	<div class="avatar-wrapper text-center">
		<div class="p-3 rounded d-flex justify-content-center">
			<div class="avatar-wrapper__default rounded overflow-hidden">				
				<?php 
				// Get profile src uploaded in panel
				$profile_picture_src = mi_woocommerce_get_profile_picture($current_user->ID);
				// Show custom profile or gravetar
				if ( !empty($profile_picture_src) ) {
					echo '<img src="' . esc_url( $profile_picture_src ) . '" alt="' . $current_user->display_name . '" style="width: 100px; height: auto;" />';
				} else {
					echo get_avatar( $current_user->ID, '100', '', '' );
				}
				?>				
			</div>
		</div>
		<span class="fw-600 name"><?php esc_html_e( $current_user->display_name ) ?></span>
	</div>
	<nav class="woocommerce-MyAccount-navigation" aria-label="<?php esc_html_e( 'Account pages', 'woocommerce' ); ?>">
		<ul class="d-flex flex-column gap-3">
			<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<?php if ($endpoint === 'payment-methods') continue; ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?> rounded-3 position-relative">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>"
					<?php echo wc_is_current_account_menu_item( $endpoint ) ? 'aria-current="page"' : ''; ?>>
					<svg style="width: 18px; height: 18px; fill: #989898;">
						<use xlink:href="#<?php esc_html_e($endpoint) ?>"></use>
					</svg>
					<?php echo esc_html( $label ); ?>
				</a>
			</li>
			<?php endforeach; ?>
		</ul>
	</nav>
</div>
<?php do_action( 'woocommerce_after_account_navigation' ); ?>