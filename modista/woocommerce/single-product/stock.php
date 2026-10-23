<?php
/**
 * Single Product stock.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/stock.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<p class="stock <?php echo esc_attr( $class ); ?> feature-box mb-8">
    <?php if ( $product->is_in_stock() ) : ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M7.75 12L10.58 14.83L16.25 9.17" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    <?php else: ?>
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
            <path d="M9.16998 14.8299L14.83 9.16992" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M14.83 14.8299L9.16998 9.16992" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
            <path d="M9 22H15C20 22 22 20 22 15V9C22 4 20 2 15 2H9C4 2 2 4 2 9V15C2 20 4 22 9 22Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
        </svg>
    <?php endif; ?>
    <?php echo wp_kses_post( $availability ); ?>
</p>