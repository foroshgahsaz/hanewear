<?php

defined( 'ABSPATH' ) || exit;

/**
 * Hook overrides — فقط در child تا آپدیت parent خراب نشود.
 */
add_action( 'after_setup_theme', 'hanewear_woocommerce_reorder_hooks', 20 );

function hanewear_woocommerce_reorder_hooks() {
	remove_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_short_attributes', 10 );
	remove_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_variation', 30 );

	add_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_variation', 8 );
	add_action( 'woocommerce_single_product_summary', 'hanewear_template_single_short_attributes', 25 );

	remove_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_template_single_price', 20 );
	add_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price', 10 );

	remove_action( 'mi_woocommerce_single_product_aside', 'mi_woocommerce_single_product_features_aside', 10 );
	remove_action( 'mi_woocommerce_single_product_aside', 'woocommerce_template_single_add_to_cart', 30 );

	add_action( 'mi_woocommerce_single_product_aside', 'hanewear_single_product_features_aside', 10 );
	add_action( 'mi_woocommerce_single_product_aside', 'hanewear_single_size_variation_aside', 25 );
	add_action( 'mi_woocommerce_single_product_aside', 'woocommerce_template_single_add_to_cart', 30 );
}

function hanewear_template_single_short_attributes() {
	global $product;

	if ( ! $product instanceof WC_Product ) {
		return;
	}

	$product_attributes        = [];
	$attributes                = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
	$variation_attribute_names = array_keys( $product->get_variation_attributes() );

	foreach ( $attributes as $attribute ) {
		$attribute_name = $attribute->get_name();

		if ( in_array( $attribute_name, $variation_attribute_names, true ) ) {
			continue;
		}

		$values = [];

		if ( $attribute->is_taxonomy() ) {
			$attribute_taxonomy = $attribute->get_taxonomy_object();
			$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), [ 'fields' => 'all' ] );

			foreach ( $attribute_values as $attribute_value ) {
				$value_name = esc_html( $attribute_value->name );

				if ( $attribute_taxonomy->attribute_public ) {
					$values[] = '<a href="' . esc_url( get_term_link( $attribute_value->term_id, $attribute->get_name() ) ) . '" rel="tag">' . $value_name . '</a>';
				} else {
					$values[] = $value_name;
				}
			}
		} else {
			$values = $attribute->get_options();
			foreach ( $values as &$value ) {
				$value = make_clickable( esc_html( $value ) );
			}
		}

		$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = [
			'label' => wc_attribute_label( $attribute->get_name() ),
			'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
		];
	}

	if ( empty( $product_attributes ) ) {
		return;
	}

	wc_get_template(
		'single-product/product-short-attributes.php',
		[ 'product_attributes' => $product_attributes ]
	);
}

function hanewear_single_size_variation_aside() {
	global $product;

	if ( ! $product instanceof WC_Product || $product->get_type() !== 'variable' ) {
		return;
	}

	$attributes = $product->get_variation_attributes();

	if ( empty( $attributes['pa_size'] ) ) {
		return;
	}

	wc_get_template(
		'single-product/variable-pa_size.php',
		[
			'options'   => $attributes['pa_size'],
			'attribute' => 'pa_size',
			'product'   => $product,
			'context'   => 'aside',
		]
	);
}

function hanewear_single_product_features_aside() {
	?>
	<div class="mi-aside-trust-boxes d-flex flex-column gap-2 mb-3">
		<div class="feature-box express-shipping">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
				<path d="M12 14H13C14.1 14 15 13.1 15 12V2H6C4.5 2 3.19001 2.82999 2.51001 4.04999" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2 17C2 18.66 3.34 20 5 20H6C6 18.9 6.9 18 8 18C9.1 18 10 18.9 10 20H14C14 18.9 14.9 18 16 18C17.1 18 18 18.9 18 20H19C20.66 20 22 18.66 22 17V14H19C18.45 14 18 13.55 18 13V10C18 9.45 18.45 9 19 9H20.29L18.58 6.01001C18.22 5.39001 17.56 5 16.84 5H15V12C15 13.1 14.1 14 13 14H12" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M8 22C9.10457 22 10 21.1046 10 20C10 18.8954 9.10457 18 8 18C6.89543 18 6 18.8954 6 20C6 21.1046 6.89543 22 8 22Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M16 22C17.1046 22 18 21.1046 18 20C18 18.8954 17.1046 18 16 18C14.8954 18 14 18.8954 14 20C14 21.1046 14.8954 22 16 22Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M22 12V14H19C18.45 14 18 13.55 18 13V10C18 9.45 18.45 9 19 9H20.29L22 12Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2 8H8" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2 11H6" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M2 14H4" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<span><?php esc_html_e( 'ارسال اکسپرس', 'modista-child' ); ?></span>
		</div>
		<div class="feature-box product-authenticity">
			<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
				<path d="M12 3L4 7V11C4 16.55 7.84 21.74 12 23C16.16 21.74 20 16.55 20 11V7L12 3Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				<path d="M9 12L11 14L15.5 9.5" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
			</svg>
			<span><?php esc_html_e( 'ضمانت اصالت و سلامت فیزیکی کالا', 'modista-child' ); ?></span>
		</div>
	</div>
	<?php
}

add_action( 'wp_enqueue_scripts', 'hanewear_enqueue_assets', 100 );

function hanewear_enqueue_assets() {
	if ( is_product() ) {
		wp_dequeue_script( 'mi-single-product' );
		wp_enqueue_script(
			'hanewear-single-product',
			get_stylesheet_directory_uri() . '/assets/js/hanewear-single-product.js',
			[ 'mi-swiper' ],
			'1.0.1',
			true
		);
		wp_enqueue_style(
			'hanewear-product',
			get_stylesheet_directory_uri() . '/assets/css/hanewear-product.css',
			[ 'mi-frontend' ],
			'1.0.1'
		);
	}

	wp_enqueue_script(
		'hanewear-nav',
		get_stylesheet_directory_uri() . '/assets/js/hanewear-nav.js',
		[ 'mi-frontend' ],
		'1.0.1',
		true
	);

	wp_enqueue_style(
		'hanewear-nav',
		get_stylesheet_directory_uri() . '/assets/css/hanewear-nav.css',
		[ 'mi-widget-nav-menu' ],
		'1.0.1'
	);
}
