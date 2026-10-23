<?php
/**
 * Loop Price
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/price.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

if ( $product->is_type( 'variable' ) ) {
    $min_regular_price = $product->get_variation_regular_price( 'min', true );
    $min_sale_price    = $product->get_variation_sale_price( 'min', true );
	
    if ( $min_sale_price && $min_sale_price !== $min_regular_price ) {
		    
		$discount_amount = $min_regular_price - $min_sale_price;
    
		if ($discount_amount > 0) {
			$discount_percentage = round(($discount_amount / $min_regular_price) * 100);
		} else { $discount_percentage = 100; }

        // Show varation price if on sale
        echo '<div class="price text-left"><del class="d-flex align-items-center justify-content-end gap-1">' . wc_price($min_regular_price, [ 'currency' => ' ' ]) . '<span class="mi-product-loop__discount">' . $discount_percentage . '%</span></del> <ins>' . wc_price( $min_sale_price ) . '</ins></div>';
    } else {
        // Show varation price
        echo '<div class="price text-left">' . wc_price( $min_regular_price ) . '</div>';
    }
} else {
    // Show simple price
    if ( $price_html = $product->get_price_html() ) {
        echo '<div class="price text-left">' . $price_html . '</div>';
    }
}