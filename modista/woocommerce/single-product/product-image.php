<?php
/**
 * Single Product Image
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/product-image.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 9.7.0
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;
global $redux_mi_theme;

$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 4 );
$post_thumbnail_id = $product->get_image_id();
$wrapper_classes   = apply_filters(
	'woocommerce_single_product_image_gallery_classes',
	array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $post_thumbnail_id ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
		'mi-product-image',
		'd-flex',
		'flex-row-reverse',
		'gap-md-6',
		'gap-4',
		'mi-gallery-carousel',
		'position-relative',
	)
);
// Gallery
$single_product_gallery_status = $redux_mi_theme['single_product_gallery'] ?? false;
$attachment_ids = $product->get_gallery_image_ids();
?>
<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?> mi-product-card__item" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
    <div class="woocommerce-product-gallery__wrapper mi-product-card__image">
		<?php
		if ( function_exists( 'woocommerce_show_product_sale_flash' ) ) {

			/**
			 * Output the product sale flash.
			 */
			woocommerce_show_product_sale_flash();
		}

		if ( $post_thumbnail_id ) {
			$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
		} else {
			$wrapper_classname = $product->is_type( 'variable' ) && ! empty( $product->get_available_variations( 'image' ) ) ?
				'woocommerce-product-gallery__image woocommerce-product-gallery__image--placeholder' :
				'woocommerce-product-gallery__image--placeholder';
			$html              = sprintf( '<div class="%s">', esc_attr( $wrapper_classname ) );
			$html             .= sprintf( '<img src="%s" alt="%s" width="410px" height="470px" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
			$html             .= '</div>';
		}

		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id ); // phpcs:disable WordPress.XSS.EscapeOutput.OutputNotEscaped
		?>
    </div>
    <?php
	// Gallery
    if ( $attachment_ids && $single_product_gallery_status === 'on' ) :
		$slides_per_view = 7;
		$active_slider = count($attachment_ids) > $slides_per_view;
    	?>
		<div class="mi-product-card__gallery-thumbnails single-product">
			<div class="woocommerce-product-gallery__thumbnails swiper loop--enabled status-<?php echo $active_slider ? 'active' : 'off'; ?>" data-direction="vertical" data-slides-per-view="<?php echo esc_attr( $slides_per_view ); ?>">
				<div class="swiper-wrapper">
					<?php do_action( 'woocommerce_product_thumbnails' );  ?>
				</div>	
			</div>
			<div class="prev-button swiper-button-prev swiper-button--svg p-1 rounded-2">
				<svg xmlns="http://www.w3.org/2000/svg" width="34" height="34" viewBox="0 0 34 34" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M16.9707 29.0924L7.27324 19.3949L7.2734 19.3948L7.2734 19.3948L7.28201 14.6475L14.2323 14.6601L13.6139 8.57853L17.1572 5.03522L20.514 8.39203L14.2459 14.6602L26.6039 14.6826L26.5952 19.4298L13.9989 19.407L20.3275 25.7356L16.9707 29.0924Z" fill="#9B9B9B"/>
				</svg>
			</div>
			<div class="next-button swiper-button-next swiper-button--svg p-1 rounded-2">
				<svg xmlns="http://www.w3.org/2000/svg" width="35" height="34" viewBox="0 0 35 34" fill="none">
					<path fill-rule="evenodd" clip-rule="evenodd" d="M17.9116 29.0924L27.6091 19.3949L27.6089 19.3948L27.6089 19.3948L27.6003 14.6475L20.65 14.6601L21.2684 8.57853L17.7251 5.03522L14.3683 8.39203L20.6364 14.6602L8.27847 14.6826L8.28708 19.4298L20.8834 19.407L14.5548 25.7356L17.9116 29.0924Z" fill="#9B9B9B"/>
				</svg>
			</div>
		</div>
    <?php endif; ?>
</div>