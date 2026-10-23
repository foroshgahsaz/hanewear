<?php
/**
 * My Addresses
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/my-address.php.
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

defined( 'ABSPATH' ) || exit;

$customer_id = get_current_user_id();

if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing'  => __( 'Billing address', 'woocommerce' ),
			'shipping' => __( 'Shipping address', 'woocommerce' ),
		),
		$customer_id
	);
} else {
	$get_addresses = apply_filters(
		'woocommerce_my_account_get_addresses',
		array(
			'billing' => __( 'Billing address', 'woocommerce' ),
		),
		$customer_id
	);
}

$oldcol = 1;
$col    = 1;
?>

<p class="color-text-400 fw-600 lh-200 mb-8">
	<?php echo apply_filters( 'woocommerce_my_account_my_address_description', esc_html__( 'The following addresses will be used on the checkout page by default.', 'woocommerce' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
</p>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	<div class="u-columns woocommerce-Addresses col2-set addresses d-flex flex-column flex-md-row gap-2 gap-md-6">
<?php endif; ?>

<?php foreach ( $get_addresses as $name => $address_title ) : ?>
	<?php

		$address = mi_woocommerce_addresses( $name, $customer_id );			

		$col     = $col * -1;
		$oldcol  = $oldcol * -1;
	?>	

	<div class="woocommerce-Address flex-1">
		<div class="woocommerce-Address-title title d-flex bg-white rounded-4 justify-content-between align-content-center px-4 py-6 color-text-400 mb-4">
			<h4 class="d-flex gap-2 fw-800">
				<svg width="32" height="32" style="fill: #989898;">
					<use xlink:href="#address-<?php echo esc_html( $name ) ?>"></use>
				</svg>
				<?php echo esc_html( $address_title ); ?>
			</h4>
			<a href="<?php echo esc_url( wc_get_endpoint_url( 'edit-address', $name ) ); ?>" class="edit d-flex align-items-center gap-1 fs-3--1">
				<svg width="18" height="18" style="stroke: #414141;">
					<use xlink:href="#plus"></use>
				</svg>
				<?php echo $address ? esc_html__( 'Edit', 'woocommerce' ) : esc_html__( 'Add', 'woocommerce' ); ?>
			</a>
		</div>
		<?php if ( is_array($address) && !empty($address) ) : ?>
			<address class="bg-white rounded-4 px-4 py-6 color-text-400">
				<?php
					// echo $address ? wp_kses_post( $address ) : esc_html_e( 'You have not set up this type of address yet.', 'woocommerce' );

					$full_address = $address['country_name'] . '، ' . $address['state_name'] . '، ' . $address['city'] . '، ' . $address['address_1'];				

					$full_address .= ( $address['address_2'] ) ? '، ' . $address['address_2'] : $address['address_2'];

					if ( !empty($address['first_name']) || !empty($address['last_name']) ) {
						echo '<p class="fs-4 color-text-500 fw-600">' . $address['first_name'] . ' ' . $address['last_name'] . '</p>';
					}
					
					echo '<p class="fs-3--1 color-text-300 fw-400">' . $full_address . '</p>';

					if ( !empty($address['postcode']) ) {
						echo '<p class="fs-3--1 color-text-300 fw-400">' . __('کدپستی', 'modista') . ' ' . $address['postcode'] . '</p>';
					}
					
					/**
					 * Used to output content after core address fields.
					 *
					 * @param string $name Address type.
					 * @since 8.7.0
					 */
					do_action( 'woocommerce_my_account_after_my_address', $name );
				?>
			</address>
		<?php endif; ?>
	</div>

<?php endforeach; ?>

<?php if ( ! wc_ship_to_billing_address_only() && wc_shipping_enabled() ) : ?>
	</div>
	<?php
endif;
