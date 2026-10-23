<?php
/**
 * Order details
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.1.0
 *
 * @var bool $show_downloads Controls whether the downloads table should be rendered.
 */

 // phpcs:disable WooCommerce.Commenting.CommentHooks.MissingHookComment

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited

if ( ! $order ) {
	return;
}

$order_items        = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$downloads          = $order->get_downloadable_items();
$actions            = array_filter(
	wc_get_account_orders_actions( $order ),
	function ( $action ) {
		return 'View' !== $action['name'];
	}
);

// We make sure the order belongs to the user. This will also be true if the user is a guest, and the order belongs to a guest (userID === 0).
$show_customer_details = $order->get_user_id() === get_current_user_id();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => false,
		)
	);
}
?>
<section class="woocommerce-order-details mt-8 mb-16">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>

	<h2 class="woocommerce-order-details__title fw-600 color-text-500 fs-4"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></h2>

	<div class="woocommerce-table woocommerce-table--order-details shop_table order_details w-100 mt-6 color-text-500 text-right">

		<div class="thead mb-3">
			<div class="d-flex">
				<div class="woocommerce-table__product-name product-name flex-1 text-right fw-600"><?php esc_html_e( 'Product', 'woocommerce' ); ?></div>
				<div class="woocommerce-table__product-table product-total flex-1 text-right fw-600"><?php esc_html_e( 'Total', 'woocommerce' ); ?></div>
			</div>
		</div>

		<div class="tbody">
			<?php
			do_action( 'woocommerce_order_details_before_order_table_items', $order );

			foreach ( $order_items as $item_id => $item ) {
				$product = $item->get_product();

				wc_get_template(
					'order/order-details-item.php',
					array(
						'order'              => $order,
						'item_id'            => $item_id,
						'item'               => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'      => $product ? $product->get_purchase_note() : '',
						'product'            => $product,
					)
				);
			}

			do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
		</div>

		<?php
		if ( ! empty( $actions ) ) :
			?>
		<div class="tfooter">
			<div class="d-flex text-right">
				<div class="order-actions--heading flex-1 fw-400"><?php esc_html_e( 'Actions', 'woocommerce' ); ?>:</div>
				<div class="flex-1">
						<?php
						$wp_button_class = wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '';
						foreach ( $actions as $key => $action ) { // phpcs:ignore WordPress.WP.GlobalVariablesOverride.Prohibited
							if ( empty( $action['aria-label'] ) ) {
								// Generate the aria-label based on the action name.
								/* translators: %1$s Action name, %2$s Order number. */
								$action_aria_label = sprintf( __( '%1$s order number %2$s', 'woocommerce' ), $action['name'], $order->get_order_number() );
							} else {
								$action_aria_label = $action['aria-label'];
							}
								echo '<a href="' . esc_url( $action['url'] ) . '" class="woocommerce-button' . esc_attr( $wp_button_class ) . ' button ' . sanitize_html_class( $key ) . ' order-actions-button " aria-label="' . esc_attr( $action_aria_label ) . '">' . esc_html( $action['name'] ) . '</a>';
								unset( $action_aria_label );
						}
						?>
					</div>
				</div>
			</div>
			<?php endif ?>
		<div class="tfooter">
			<?php
			foreach ( $order->get_order_item_totals() as $key => $total ) {
				?>
					<div class="d-flex text-right">
						<div class="flex-1 fw-400"><?php echo esc_html( $total['label'] ); ?></div>
						<div class="flex-1 fw-400"><?php echo wp_kses_post( $total['value'] ); ?></div>
					</div>
					<?php
			}
			?>
			<?php if ( $order->get_customer_note() ) : ?>
				<div class="d-flex text-right">
					<div class="flex-1 fw-400"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></div>
					<div class="flex-1 fw-400"><?php echo wp_kses( nl2br( wptexturize( $order->get_customer_note() ) ), array() ); ?></div>
				</div>
			<?php endif; ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</section>

<hr class="m-0 mb-8">

<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}
