<?php
/**
 * Empty cart page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cart-empty.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 7.0.1
 */

defined( 'ABSPATH' ) || exit;


/*
* @hooked woocommerce_cart_is_empty - 5
* @hooked wc_empty_cart_message - 10
*/
do_action( 'woocommerce_cart_is_empty' );
?>
<div class="d-flex flex-column align-items-center py-24 bg-text-100 rounded-4 gap-6">
	<div class="d-flex flex-column align-items-center h-100 color-text-400">
		<svg width="120px" height="120px" style="fill:#989898;">
			<use xlink:href="#cart"></use>
		</svg>
		<?php echo esc_html__( 'No order has been made yet.', 'woocommerce' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>
	</div>
	<?php
	if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
		<p class="return-to-shop">
			<a class="button px-4 py-1 rounded-3 wc-backward<?php echo esc_attr( wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '' ); ?>" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
				<?php
					/**
					 * Filter "Return To Shop" text.
					 *
					 * @since 4.6.0
					 * @param string $default_text Default text.
					 */
					echo esc_html( apply_filters( 'woocommerce_return_to_shop_text', __( 'مرور محصولات', 'modista' ) ) );
				?>
			</a>
		</p>
	<?php endif; ?>
</div>