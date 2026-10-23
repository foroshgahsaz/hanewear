<?php
/**
 * Product attributes
 *
 * Used by list_attributes() in the products class.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-attributes.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.3.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! $product_attributes ) {
	return;
}
?>
<table class="woocommerce-product-attributes shop_attributes w-100 fs-3--1 fw-400" aria-label="<?php esc_attr_e( 'Product Details', 'woocommerce' ); ?>">
	<?php foreach ( $product_attributes as $product_attribute_key => $product_attribute ) : ?>
		<tr class="woocommerce-product-attributes-item woocommerce-product-attributes-item--<?php echo esc_attr( $product_attribute_key ); ?>">
			<th class="woocommerce-product-attributes-item__label pb-3 ps-3 text-right" scope="row">
                <div class="py-3 px-4 fw-400 rounded-3">
	                <?php echo wp_kses_post( $product_attribute['label'] ); ?>
                </div>
            </th>
			<td class="woocommerce-product-attributes-item__value pe-3 pb-3">
                <div class="py-3 px-4 rounded-3">
	                <?php echo wp_kses_post( $product_attribute['value'] ); ?>
                </div>
            </td>
		</tr>
	<?php endforeach; ?>
</table>
