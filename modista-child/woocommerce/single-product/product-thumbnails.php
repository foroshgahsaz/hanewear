<?php
/**
 * Single Product Thumbnails
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$image_ids = $GLOBALS['mi_product_gallery_image_ids'] ?? array();

if ( empty( $image_ids ) ) {
	$post_thumbnail_id = $product->get_image_id();
	$attachment_ids    = $product->get_gallery_image_ids();

	if ( $post_thumbnail_id ) {
		$image_ids[] = $post_thumbnail_id;
	}

	if ( $attachment_ids ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( ! in_array( $attachment_id, $image_ids, true ) ) {
				$image_ids[] = $attachment_id;
			}
		}
	}
}

foreach ( $image_ids as $attachment_id ) {
	echo '<div class="swiper-slide thumbnail">';
	echo wp_get_attachment_image( $attachment_id, array( 410, 470 ) );
	echo '</div>';
}
