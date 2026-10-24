<?php
/**
 * Single product layout — three columns on desktop (RTL: gallery | summary | aside).
 *
 * @package modista-child
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'hanewear-single-product-layout d-flex flex-wrap flex-md-nowrap gap-4 gap-md-6 align-items-start w-100', $product ); ?>>
	<?php do_action( 'woocommerce_before_single_product_summary' ); ?>

	<div class="summary entry-summary flex-1 w-100 w-md-auto min-w-0">
		<div class="summery-header d-flex justify-content-between align-items-center mb-3">
			<?php do_action( 'woocommerce_single_product_summary_header' ); ?>
		</div>
		<?php do_action( 'woocommerce_single_product_summary' ); ?>
	</div>

	<div class="summary aside-summary w-100 w-md-auto flex-shrink-0 hanewear-product-aside">
		<div>
			<?php do_action( 'mi_woocommerce_single_product_aside' ); ?>
		</div>
	</div>
</div>
<?php
do_action( 'woocommerce_after_single_product_summary' );
do_action( 'woocommerce_after_single_product' );
