<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<section class="woocommerce-order-downloads">
	<?php if ( isset( $show_title ) ) : ?>
		<h2 class="woocommerce-order-downloads__title mb-4 fs-4 fw-800 color-text-500"><?php esc_html_e( 'Downloads', 'woocommerce' ); ?></h2>
	<?php endif; ?>

	<div class="woocommerce-table woocommerce-table--order-downloads shop_table shop_table_responsive order_details d-flex flex-column gap-4">
		<?php foreach ( $downloads as $download ) : ?>
			<div class="download-item d-flex flex-column flex-md-row px-4 py-3 bg-white rounded-3 gap-3">
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<div class="<?php echo esc_attr( $column_id ); ?> flex-1 d-flex flex-column justify-content-center fw-600 color-text-500" data-title="<?php echo esc_attr( $column_name ); ?>">
						<?php
						if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
							do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
						} else {							
							switch ( $column_id ) {
								case 'download-product':
									if ( $download['product_url'] ) {
										echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
									} else {
										echo esc_html( $download['product_name'] );
									}
									// echo '<span class="rounded-3 fs-3--1 fw-400 color-text-300">' . esc_html( 'دسته بندی', 'modista' ) . ':' . mi_post_get_first_term( $download['product_id'], 'product_cat' ) . '</span>';
									echo '<span class="rounded-3 fs-3--1 fw-400 color-text-300">' . esc_html( 'نام فایل', 'modista' ) . ': ' . esc_html( $download['download_name']) . '</span>';
									break;
								case 'download-file':
									echo '<div class="d-flex justify-content-end">';
									echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file button alt d-flex py-2 px-3 rounded-3 fs-3--1 fw-400 bg-text-100">' . __( 'دانلود فایل اصلی', 'modista' ) . '</a>';
									echo '</div>';
									break;
								case 'download-remaining':
									echo '<span class="color-text-300 fw-400 fs-3--1">' . esc_html( $column_name ) . ':</span>';
									echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : esc_html__( 'بی نهایت', 'modista' );
									break;
								case 'download-expires':
									echo '<span class="color-text-300 fw-400 fs-3--1">' . esc_html( $column_name ) . ':</span>';
									if ( ! empty( $download['access_expires'] ) ) {
										echo '<time datetime="' . esc_attr( date( 'Y-m-d', strtotime( $download['access_expires'] ) ) ) . '" title="' . esc_attr( strtotime( $download['access_expires'] ) ) . '">' . esc_html( jdate( 'd F Y', strtotime( $download['access_expires'] ) ) ) . '</time>';
									} else {
										esc_html_e( 'Never', 'woocommerce' );
									}
									break;
							}
						}
						?>
					</div>
				<?php endforeach; ?>
			</div>
		<?php endforeach; ?>
	</div>
</section>
