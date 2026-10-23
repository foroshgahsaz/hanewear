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
?>
<div class="variations-color mi-variation-select" data-variation-name="attribute_<?php echo $attribute; ?>">
    <p class="mi-variation-select__title fs-3--1 fw-400">
        <?php echo wc_attribute_label( $attribute ); ?>:
        (<span><?php _e('انتخاب نشده', 'modista') ?></span>)
    </p>
    <ul class="variations-color__list d-grid d-grid-2 d-grid-md-3 gap-3 fs-4 fw-400 mt-3">
		<?php
		// Get selected value.
		$selected = false;
		if ( $attribute && $product instanceof WC_Product ) {
			$selected_key = 'attribute_' . sanitize_title( $attribute );
			// phpcs:disable WordPress.Security.NonceVerification.Recommended
			$selected = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $product->get_variation_default_attribute( $attribute );
			// php  cs:enable WordPress.Security.NonceVerification.Recommended
		}

		if ( ! empty( $options ) ) if ( $product && taxonomy_exists( $attribute ) ) {
            // Get terms if this is a taxonomy - ordered. We need the names too.
            $terms = wc_get_product_terms(
                $product->get_id(),
                $attribute,
                array(
                    'fields' => 'all',
                )
            );

            foreach ( $terms as $term ) if ( in_array( $term->slug, $options, true ) ) {

                $color_value = get_term_meta($term->term_id, $attribute, true);
                $selected = ($selected === $term->slug) ? ' selected' : '';

                echo '<li id="' . esc_attr( $term->slug ) . '" class="d-flex align-items-center justify-content-center border cursor-pointer p-2 rounded-4' . $selected . '">' .
                     '<span class="option-name">' .  esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</span>' .
                     '<span class="badge" style="display: none;"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none">'.
                     '<path fill-rule="evenodd" clip-rule="evenodd" d="M14.6666 8C14.6666 11.6819 11.6818 14.6667 7.99992 14.6667C4.31802 14.6667 1.33325 11.6819 1.33325 8C1.33325 4.3181 4.31802 1.33333 7.99992 1.33333C11.6818 1.33333 14.6666 4.3181 14.6666 8ZM10.6868 5.97978C10.8821 6.17504 10.8821 6.49162 10.6868 6.68688L7.35347 10.0202C7.15821 10.2155 6.84163 10.2155 6.64636 10.0202L5.31303 8.68689C5.11777 8.49162 5.11777 8.17504 5.31303 7.97978C5.50829 7.78452 5.82488 7.78452 6.02014 7.97978L6.99992 8.95956L8.48981 7.46967L9.9797 5.97978C10.175 5.78452 10.4915 5.78452 10.6868 5.97978Z" fill="#598865"/>' .
                     '</svg></span>' .
                     '</li>';
            }
        } else {
            foreach ( $options as $option ) {
                echo '<li id="' . esc_attr( $option ) . '" class="rounded-4 border p-4 cursor-pointer">' .
                     esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</li>';
            }
        }
		?>
	</ul>
</div>