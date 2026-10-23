<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-single-product.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * Hook: woocommerce_before_single_product.
 *
 * @hooked woocommerce_output_all_notices - 10
 */
do_action( 'woocommerce_before_single_product' );

if ( post_password_required() ) {
	echo get_the_password_form(); // WPCS: XSS ok.
	return;
}

?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( 'd-flex flex-wrap gap-4', $product ); ?>>
	<?php
	/**
	 * Hook: woocommerce_before_single_product_summary.
	 *
	 * @hooked woocommerce_show_product_sale_flash - 10
	 * @hooked woocommerce_show_product_images - 20
	 */
	do_action( 'woocommerce_before_single_product_summary' );
	?>
	<div class="summary entry-summary flex-1">
        <div class="summery-header d-flex justify-content-between align-items-center mb-3">

            <?php
            /**
             * Hook: woocommerce_single_product_summary.
             *
             * @hooked woocommerce_template_single_title - 5
             * @hooked woocommerce_template_single_sharing - 50
             */
            do_action( 'woocommerce_single_product_summary_header' );
            ?>
        </div>
        <?php
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_meta - 6
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked mi_woocommerce_template_single_short_attributes - 10
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );
		?>
    </div>
    <div class="summary aside-summary w-100 w-md-25">
        <div>
	        <?php
	        /**
	         * Hook: mi_woocommerce_single_product_aside.
	         *
	         * @hooked woocommerce_template_single_add_to_cart - 30
	         * @hooked woocommerce_template_single_price - 10
	         */
	        do_action( 'mi_woocommerce_single_product_aside' );
	        ?>
        </div>
    </div>
</div>
<?php
/**
 * Hook: woocommerce_after_single_product_summary.
 *
 * @hooked woocommerce_output_product_data_tabs - 10
 * @hooked woocommerce_upsell_display - 15
 * @removed woocommerce_output_related_products - 20
 */
do_action( 'woocommerce_after_single_product_summary' );

do_action( 'woocommerce_after_single_product' );
?>