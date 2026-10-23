<?php
/**
 * "Order received" message.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/order-received.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 8.8.0
 *
 * @var WC_Order|false $order
 */

defined( 'ABSPATH' ) || exit;
?>

<p class="woocommerce-notice woocommerce-notice--success woocommerce-thankyou-order-received d-flex gap-1 align-items-center fs-4 fs-md-6 fw-900">
	<svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" viewBox="0 0 32 32" fill="none">
		<path opacity="0.4" d="M14.6124 2.74666L7.27909 5.49333C5.87909 6.02666 4.73242 7.68 4.73242 9.18666V19.9867C4.73242 21.0667 5.43909 22.4933 6.30576 23.1333L13.6391 28.6133C14.9324 29.5867 17.0524 29.5867 18.3458 28.6133L25.6791 23.1333C26.5458 22.48 27.2524 21.0667 27.2524 19.9867V9.18666C27.2524 7.69333 26.1058 6.02666 24.7058 5.50666L17.3724 2.76C16.6258 2.46666 15.3724 2.46666 14.6124 2.74666Z" fill="#FD5504"/>
		<path d="M14.2136 18.9733C13.9603 18.9733 13.707 18.88 13.507 18.68L11.3603 16.5333C10.9736 16.1467 10.9736 15.5067 11.3603 15.12C11.747 14.7333 12.387 14.7333 12.7736 15.12L14.2136 16.56L19.2403 11.5333C19.627 11.1467 20.267 11.1467 20.6536 11.5333C21.0403 11.92 21.0403 12.56 20.6536 12.9467L14.9203 18.68C14.7203 18.88 14.467 18.9733 14.2136 18.9733Z" fill="#FD5504"/>
	</svg>
	<?php
	/**
	 * Filter the message shown after a checkout is complete.
	 *
	 * @since 2.2.0
	 *
	 * @param string         $message The message.
	 * @param WC_Order|false $order   The order created during checkout, or false if order data is not available.
	 */
	$message = apply_filters(
		'woocommerce_thankyou_order_received_text',
		esc_html( __( 'Thank you. Your order has been received.', 'woocommerce' ) ),
		$order
	);

	// phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	echo $message;
	?>
</p>
