<?php
/**
 * Product short measurement attributes (single product summary).
 *
 * @package Modista
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
?>
<ul class="woocommerce-product-short-attributes shop_attributes mi-product-measurements d-flex flex-md-column flex-row flex-md-wrap flex-nowrap gap-md-7 gap-4 gap-row-2 fs-3--1 fw-400 lh-6 mb-3" aria-label="<?php esc_attr_e( 'Product Details', 'woocommerce' ); ?>">
	<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
        <li class="d-flex gap-1 position-relative pe-3 flex-none"><?php echo wp_kses_post( $product_attribute['label'] ); ?>: <?php echo wp_kses_post( $product_attribute['value'] ); ?></li>
	<?php endforeach; ?>
</ul>
