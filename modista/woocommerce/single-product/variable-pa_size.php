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

// Detail of size term in term_meta.
$sizes_detail = [];

$attributes_meta = [
    'product_attributes' => [
        'pa_height' => __( 'قد', 'modista' ),
        'pa_waist'  => __( 'دور کمر', 'modista' ),
        'pa_hips'   => __( 'دور باسن', 'modista' ),
        'pa_thigh'  => __( 'دور ران', 'modista' )
    ],
    'metas'     => [],
];

?>
<div class="mi-variation-select d-flex flex-wrap flex-md-nowrap gap-4 justify-content-between mt-8 fw-400" data-variation-name="attribute_<?php echo $attribute; ?>">
    <div class="d-flex align-items-center gap-4">
        <p class="mi-variation-select__title fs-3--1"><?php echo wc_attribute_label( $attribute ) . ':'; ?></p>
        <ul class="variations-list d-flex gap-2 fs-4">
		    <?php
		    // Get selected value.
		    $selected = false;
		    if ( $attribute && $product instanceof WC_Product ) {
			    $selected_key = 'attribute_' . sanitize_title( $attribute );
			    // phpcs:disable WordPress.Security.NonceVerification.Recommended
			    $selected = isset( $_REQUEST[ $selected_key ] ) ? wc_clean( wp_unslash( $_REQUEST[ $selected_key ] ) ) : $product->get_variation_default_attribute( $attribute );
			    // php  cs:enable WordPress.Security.NonceVerification.Recommended
		    }

		    if ( !empty( $options ) ) {

                if ( $product && taxonomy_exists( $attribute ) ) {
                    // Get terms if this is a taxonomy - ordered. We need the names too.
                    $terms = wc_get_product_terms(
                        $product->get_id(),
                        $attribute,
                        array(
                            'fields' => 'all',
                        )
                    );

                    foreach ( $terms as $term ) {
                        if ( in_array( $term->slug, $options, true ) ) {

                            foreach ($attributes_meta['product_attributes'] as $name => $label) {
                                $value = get_term_meta( $term->term_id, $name, true );
                                if ( !empty($value) ) {
                                    $attributes_meta['metas'][$term->slug][$name] = $value;
                                }
                            }

                            $selected = ($selected === $term->slug) ? ' selected' : '';

                            echo '<li id="' . esc_attr( $term->slug ) . '" class="d-flex align-items-center justify-content-center border cursor-pointer px-2 rounded-2' . $selected . '">' .
                                '<span class="option-name">' .  esc_html( apply_filters( 'woocommerce_variation_option_name', $term->name, $term, $attribute, $product ) ) . '</span>' .
                                '</li>';
                        }
                    }
                } else {
                    foreach ( $options as $option ) {
                        echo '<li id="' . esc_attr( $option ) . '" class="d-flex align-items-center justify-content-center border cursor-pointer px-2 rounded-2">' .
                        esc_html( apply_filters( 'woocommerce_variation_option_name', $option, null, $attribute, $product ) ) . '</li>';
                    }
                }
            }
		    ?>
        </ul>
    </div>
    <?php if( !empty($attributes_meta['metas']) ) : ?>
        <?php
        $attribute_id = wc_attribute_taxonomy_id_by_name($attribute);
        $help_note = get_option( "wc_attribute_pa_size_note-$attribute_id" );
        ?>
        <div class="d-flex flex-none align-items-center justify-content-center border cursor-pointer px-2 gap-2 rounded-2" data-micromodal-trigger="modal_pa_size">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path d="M19 12.2315L19.9546 11.2769C21.3182 9.91327 22 9.23148 22 8.38426C22 7.53704 21.3182 6.85525 19.9546 5.49167L18.5083 4.04537C17.1448 2.68179 16.463 2 15.6157 2C14.7685 2 14.0867 2.68179 12.7231 4.04537L4.04537 12.7231C2.68179 14.0867 2 14.7685 2 15.6157C2 16.463 2.68179 17.1448 4.04537 18.5083L5.49167 19.9546C6.85525 21.3182 7.53704 22 8.38426 22C9.23148 22 9.91327 21.3182 11.2769 19.9546L16.2315 15" stroke="#414141" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M8.46436 8.46446L9.87857 9.87868" stroke="#414141" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M12.707 4.22183L14.1212 5.63605" stroke="#414141" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M4.22192 12.7071L5.63614 14.1213" stroke="#414141" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M6.34326 10.5858L8.46458 12.7071" stroke="#414141" stroke-width="1.5" stroke-linecap="round"/>
                <path d="M10.5857 6.34314L12.707 8.46446" stroke="#414141" stroke-width="1.5" stroke-linecap="round"/>
            </svg>
            <span>سایزت چنده؟</span>
        </div>
        <div id="modal_pa_size" aria-hidden="true" class="modal">
            <div tabindex="-1" class="modal__overlay" data-micromodal-close>
                <div role="dialog" aria-modal="true" aria-labelledby="modal-1-title" class="modal__container">
                    <div class="modal__header">
                        <div class="color-text-500 fw-600">
                            <?php echo wp_kses_post( $help_note ); ?>
                        </div>
                        <div aria-label="Close modal" class="modal__close" data-micromodal-close>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M14.5 9.50002L9.5 14.5M9.49998 9.5L14.5 14.5" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/>
                                <path d="M22 12C22 16.714 22 19.0711 20.5355 20.5355C19.0711 22 16.714 22 12 22C7.28595 22 4.92893 22 3.46447 20.5355C2 19.0711 2 16.714 2 12C2 7.28595 2 4.92893 3.46447 3.46447C4.92893 2 7.28595 2 12 2C16.714 2 19.0711 2 20.5355 3.46447C21.5093 4.43821 21.8356 5.80655 21.9449 8" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/>
                            </svg>
                        </div>
                    </div>
                    <div id="modal-1-content" class="modal__content">
                        <div class="thead pa_size-thead d-flex gap-1 gap-md-4 py-2 py-md-3 fs-3--1">
                            <?php
                            // Print size meta data as head
                            echo '<div class="flex-1 text-center fw-600">' . __('سایز', 'modista') . '</div>'; // First column
                            foreach($attributes_meta['product_attributes'] as $term_name => $label) {
                                echo '<span class="flex-1 text-center fw-600">' . $label . '</span>';
                            }
                            ?>
                        </div>
                        <div class="tbody pa_size-tbody bg-text-100">
                            <?php
                            // Print size meta value as size details
                            foreach($attributes_meta['metas'] as $label => $size) {
                                echo '<div class="d-flex gap-1 gap-md-4 py-2 py-md-4 border-bottom fs-3--1">';
                                    echo '<div class="d-flex flex-1 justify-content-center" style="text-transform: uppercase;">' . wc_attribute_label( $label ). '</div>';
                                    foreach($attributes_meta['product_attributes'] as $term_name => $value) {
                                        echo '<div class="d-flex flex-1 justify-content-center">';
                                        echo array_key_exists($term_name, $size) ? $size[$term_name] : "";
                                        echo '</div>';
                                    }
                                echo '</div>';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endif; ?>
</div>