<?php
/**
 * Single Product Image
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
global $redux_mi_theme;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$attachment_ids    = $product->get_gallery_image_ids();
$gallery_image_ids = array();

if ( $post_thumbnail_id ) {
	$gallery_image_ids[] = $post_thumbnail_id;
}

if ( $attachment_ids ) {
	foreach ( $attachment_ids as $attachment_id ) {
		if ( ! in_array( $attachment_id, $gallery_image_ids, true ) ) {
			$gallery_image_ids[] = $attachment_id;
		}
	}
}

$wrapper_classes = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
		'mi-product-image',
		'd-flex',
		'flex-column',
		'gap-md-6',
		'gap-4',
		'mi-gallery-carousel',
		'position-relative',
		'w-100',
	)
);

$single_product_gallery_status = $redux_mi_theme['single_product_gallery'] ?? false;
$show_thumbnails               = $gallery_image_ids && $single_product_gallery_status === 'on';
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> mi-product-card__item" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
	<div class="mi-product-gallery-main swiper woocommerce-product-gallery__wrapper mi-product-card__image">
		<div class="swiper-wrapper">
			<?php
			if ( function_exists( 'woocommerce_show_product_sale_flash' ) ) {
				woocommerce_show_product_sale_flash();
			}

			if ( ! empty( $gallery_image_ids ) ) {
				foreach ( $gallery_image_ids as $gallery_index => $image_id ) {
					echo '<div class="swiper-slide">';
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $image_id, $gallery_index === 0 ), $image_id ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
					echo '</div>';
				}
			} else {
				$wrapper_classname = $product->is_type( 'variable' ) && ! empty( $product->get_available_variations( 'image' ) ) ?
					'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
					'woocommerce-product-gallery__image--placeholder';
				echo '<div class="swiper-slide"><div class="' . esc_attr( $wrapper_classname ) . '">';
				echo sprintf( '<img src="%s" alt="%s" width="410" height="470" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				echo '</div></div>';
			}
			?>
		</div>
		<?php if ( count( $gallery_image_ids ) > 1 ) : ?>
			<div class="mi-gallery-main-prev swiper-button-prev swiper-button--svg p-1 rounded-2"></div>
			<div class="mi-gallery-main-next swiper-button-next swiper-button--svg p-1 rounded-2"></div>
		<?php endif; ?>
	</div>
	<?php if ( $show_thumbnails ) :
		$slides_per_view = 5;
		$active_slider   = count( $gallery_image_ids ) > $slides_per_view;
		?>
		<div class="mi-product-card__gallery-thumbnails single-product">
			<div class="woocommerce-product-gallery__thumbnails swiper loop--enabled status-<?php echo $active_slider ? 'active' : 'off'; ?>" data-direction="horizontal" data-slides-per-view="<?php echo esc_attr( $slides_per_view ); ?>">
				<div class="swiper-wrapper">
					<?php
					$GLOBALS['mi_product_gallery_image_ids'] = $gallery_image_ids;
					do_action( 'woocommerce_product_thumbnails' );
					unset( $GLOBALS['mi_product_gallery_image_ids'] );
					?>
				</div>
			</div>
		</div>
	<?php endif; ?>
</div>
