<?php
/**
 * Variable product add to cart
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/add-to-cart/variable.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.5.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

$attribute_keys  = array_keys( $attributes );
$variations_json = wp_json_encode( $available_variations );
$variations_attr = function_exists( 'wc_esc_json' ) ? wc_esc_json( $variations_json ) : _wp_specialchars( $variations_json, ENT_QUOTES, 'UTF-8', true );
?>

<form class="cart variations_form_without_button pt-4 pt-md-6 border-top" action="<?php echo esc_url( apply_filters( 'woocommerce_add_to_cart_form_action', $product->get_permalink() ) ); ?>" method="post" enctype='multipart/form-data' data-product_id="<?php echo absint( $product->get_id() ); ?>" data-product_variations="<?php echo $variations_attr; // WPCS: XSS ok. ?>">
	<?php do_action( 'woocommerce_before_variations_form' ); ?>

    <?php if ( empty( $available_variations ) && false !== $available_variations ) :
        // Must be change
        ?>
		<p class="stock out-of-stock"><?php echo esc_html( apply_filters( 'woocommerce_out_of_stock_message', __( 'This product is currently out of stock and unavailable.', 'woocommerce' ) ) ); ?></p>
	<?php else :
        // Load skin of color attribute selection.
	    if ( array_key_exists('pa_color', $attributes) ) {

		    $attribute_name = 'pa_color';

		    // Load the template.
		    wc_get_template(
			    'single-product/variable-'. $attribute_name .'.php',
			    array(
				    'options'   => $attributes[$attribute_name],
				    'attribute'   => $attribute_name,
				    'product'   => $product,
			    )
            );

            // Not render in default skin.
            unset($attributes[$attribute_name]);

	    }
        if ( array_key_exists('pa_size', $attributes) ) {

            $attribute_name = 'pa_size';

	        wc_get_template(
		        'single-product/variable-' . $attribute_name . '.php',
		        array(
			        'options'   => $attributes[ $attribute_name ],
			        'attribute' => $attribute_name,
			        'product'   => $product,
			        'context'   => 'summary',
		        )
	        );

	        unset( $attributes[ $attribute_name ] );
        }
        ?>
		<table class="variations" role="presentation">
			<tbody>
				<?php foreach ( $attributes as $attribute_name => $options ) : ?>
					<tr>
						<th class="label"><label for="<?php echo esc_attr( sanitize_title( $attribute_name ) ); ?>"><?php echo wc_attribute_label( $attribute_name ); // WPCS: XSS ok. ?></label></th>
						<td class="value">
							<?php
								wc_dropdown_variation_attribute_options(
									array(
										'options'   => $options,
										'attribute' => $attribute_name,
										'product'   => $product,
									)
								);
							?>
						</td>
					</tr>
				<?php endforeach; ?>
			</tbody>
		</table>
		<div class="reset_variations_alert screen-reader-text" role="alert" aria-live="polite" aria-relevant="all"></div>
		<?php do_action( 'woocommerce_after_variations_table' ); ?>
    <?php endif; ?>

	<?php do_action( 'woocommerce_after_variations_form' ); ?>
</form>