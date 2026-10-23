<?php
/**
 * Order Customer Details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details-customer.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.7.0
 */

defined( 'ABSPATH' ) || exit;

$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<section class="woocommerce-customer-details">

	<?php if ( $show_shipping ) : ?>

	<section class="woocommerce-columns woocommerce-columns--2 woocommerce-columns--addresses col2-set addresses">
		<div class="woocommerce-column woocommerce-column--1 woocommerce-column--billing-address">

	<?php endif; ?>

	<h2 class="woocommerce-column__title mb-4 fs-4 fw-800 color-text-400"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h2>

	<address class="bg-white p-6 rounded-4 d-flex flex-wrap gap-4 align-items-center color-text-500">
		<span class="address__icon d-flex rounded-4 p-3 p-md-6">
			<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
				<path d="M15.9993 29.3337C23.3631 29.3337 29.3327 26.6474 29.3327 23.3337C29.3327 21.6449 27.7821 20.119 25.2866 19.0286C23.7638 21.8231 21.4416 24.2317 18.492 25.4922C16.9066 26.1698 15.0921 26.1698 13.5067 25.4922C10.557 24.2317 8.2349 21.8231 6.71212 19.0286C4.21662 20.119 2.66602 21.6449 2.66602 23.3337C2.66602 26.6474 8.63555 29.3337 15.9993 29.3337Z" fill="white"/>
				<path fill-rule="evenodd" clip-rule="evenodd" d="M6.66602 11.3529C6.66602 6.55562 10.8447 2.66669 15.9993 2.66669C21.154 2.66669 25.3327 6.55562 25.3327 11.3529C25.3327 16.1125 22.3538 21.6666 17.7061 23.6528C16.6226 24.1158 15.376 24.1158 14.2926 23.6528C9.64489 21.6666 6.66602 16.1125 6.66602 11.3529ZM15.9993 14.6667C17.4721 14.6667 18.666 13.4728 18.666 12C18.666 10.5273 17.4721 9.33335 15.9993 9.33335C14.5266 9.33335 13.3327 10.5273 13.3327 12C13.3327 13.4728 14.5266 14.6667 15.9993 14.6667Z" fill="white"/>
			</svg>
		</span>
		<?php		
		$address = $order->get_formatted_billing_address( esc_html__( 'N/A', 'woocommerce' ) );
		echo str_replace('<br/>', ', ', $address);
		?>

		<?php if ( $order->get_billing_phone() ) : ?>
			<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
		<?php endif; ?>

		<?php if ( $order->get_billing_email() ) : ?>
			<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
		<?php endif; ?>

		<?php
			/**
			 * Action hook fired after an address in the order customer details.
			 *
			 * @since 8.7.0
			 * @param string $address_type Type of address (billing or shipping).
			 * @param WC_Order $order Order object.
			 */
			do_action( 'woocommerce_order_details_after_customer_address', 'billing', $order );
		?>
	</address>

	<?php if ( $show_shipping ) : ?>

		</div><!-- /.col-1 -->

		<div class="woocommerce-column woocommerce-column--2 woocommerce-column--shipping-address">
			<h2 class="woocommerce-column__title mb-4 fs-4 fw-800 color-text-400"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h2>
			<address class="bg-white p-6 rounded-4 d-flex flex-wrap gap-4 align-items-center color-text-500">
				<span class="address__icon d-flex rounded-4 p-3 p-md-6">
					<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
						<path d="M15.9993 29.3337C23.3631 29.3337 29.3327 26.6474 29.3327 23.3337C29.3327 21.6449 27.7821 20.119 25.2866 19.0286C23.7638 21.8231 21.4416 24.2317 18.492 25.4922C16.9066 26.1698 15.0921 26.1698 13.5067 25.4922C10.557 24.2317 8.2349 21.8231 6.71212 19.0286C4.21662 20.119 2.66602 21.6449 2.66602 23.3337C2.66602 26.6474 8.63555 29.3337 15.9993 29.3337Z" fill="white"/>
						<path fill-rule="evenodd" clip-rule="evenodd" d="M6.66602 11.3529C6.66602 6.55562 10.8447 2.66669 15.9993 2.66669C21.154 2.66669 25.3327 6.55562 25.3327 11.3529C25.3327 16.1125 22.3538 21.6666 17.7061 23.6528C16.6226 24.1158 15.376 24.1158 14.2926 23.6528C9.64489 21.6666 6.66602 16.1125 6.66602 11.3529ZM15.9993 14.6667C17.4721 14.6667 18.666 13.4728 18.666 12C18.666 10.5273 17.4721 9.33335 15.9993 9.33335C14.5266 9.33335 13.3327 10.5273 13.3327 12C13.3327 13.4728 14.5266 14.6667 15.9993 14.6667Z" fill="white"/>
					</svg>
				</span>
				<?php		
				$address = $order->get_formatted_shipping_address( esc_html__( 'N/A', 'woocommerce' ) );
				echo str_replace('<br/>', ', ', $address);
				?>

				<?php if ( $order->get_shipping_phone() ) : ?>
					<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_shipping_phone() ); ?></p>
				<?php endif; ?>

				<?php
					/**
					 * Action hook fired after an address in the order customer details.
					 *
					 * @since 8.7.0
					 * @param string $address_type Type of address (billing or shipping).
					 * @param WC_Order $order Order object.
					 */
					do_action( 'woocommerce_order_details_after_customer_address', 'shipping', $order );
				?>
			</address>
		</div><!-- /.col-2 -->

	</section><!-- /.col2-set -->

	<?php endif; ?>

	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>

</section>
