<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Breadcrumb
*/
add_filter( 'woocommerce_breadcrumb_defaults', 'mi_wcc_breadcrumb_filter' );

/**
 * ---------------------------------------
 * Archive products and Shop hook and filters.
 * ---------------------------------------
 */

// Post per page from panel
add_filter( 'loop_shop_per_page', 'mi_custom_products_per_page', 20 );

/**
 * Hook: woocommerce_after_shop_loop_item_title.
 *
 * @removed woocommerce_template_loop_price - 10
 */
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10 );
remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

/**
 * Hook: woocommerce_after_shop_loop_item.
 *
 * @removed woocommerce_template_loop_add_to_cart - 10
 */
remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );

/**
 * Hook: mi_woocommerce_after_shop_loop_item.
 *
 * @package modista
 * @hooked woocommerce_template_loop_add_to_cart - 10
 * @hooked woocommerce_template_loop_price - 10
 */
add_action( 'mi_woocommerce_after_shop_loop_item', 'woocommerce_template_loop_price', 20 );
add_action( 'mi_woocommerce_after_shop_loop_item', 'mi_woocommerce_template_loop_color', 10 );


/**
 * Sale flashes.
 *
 * @removed woocommerce_show_product_loop_sale_flash()
 * @removed woocommerce_show_product_sale_flash()
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_show_product_loop_sale_flash', 10 );
remove_action( 'woocommerce_before_single_product_summary', 'woocommerce_show_product_sale_flash', 10 );

/**
 * Hook: woocommerce_before_shop_loop_item_title.
 *
 * @hooked mi_woocommerce_template_loop_product_gallery - 10
 */
remove_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_product_thumbnail', 10 );
add_action( 'woocommerce_before_shop_loop_item_title', 'mi_woocommerce_template_loop_product_gallery', 10 );

/**
 * Hook: woocommerce_shop_loop_header.
 *
 * @removed  woocommerce_product_taxonomy_archive_header - 10
 */
remove_action( 'woocommerce_shop_loop_header', 'woocommerce_product_taxonomy_archive_header' );

/**
 * Hook: woocommerce_before_shop_loop.
 *
 * @removed  woocommerce_output_all_notices - 10
 * @removed  woocommerce_result_count - 20
 * @hooked  woocommerce_product_taxonomy_archive_header - 10
 */
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_output_all_notices', 10 );
remove_action( 'woocommerce_before_shop_loop', 'woocommerce_result_count', 20 );
add_action( 'woocommerce_before_shop_loop', 'woocommerce_product_taxonomy_archive_header', 10 );
add_action( 'woocommerce_before_shop_loop', 'mi_add_star_divider', 10 );
add_action( 'woocommerce_before_shop_loop', 'mi_show_filter_aside', 15 );

/**
 * ---------------------------------------
 * Single product hook and filters.
 * ---------------------------------------
 */

/**
 * Product Summary Box.
 *
 * @removed woocommerce_template_single_price()
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 );
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );

add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 6 );
add_filter( 'woocommerce_get_star_rating_html', 'mi_wc_get_rating_html', 10, 3 );
add_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_variation', 8 );
add_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_short_attributes', 25 );

/**
 * Product Summary Header.
 *
 * @package modista
 * @hooked woocommerce_template_single_title - 5
 * @hooked woocommerce_template_single_sharing - 50
 */
add_action( 'woocommerce_single_product_summary_header', 'woocommerce_template_single_title', 5 );
add_action( 'woocommerce_single_product_summary_header', 'woocommerce_template_single_sharing', 50 );

/**
 * Product Add to cart.
 *
 * @removed woocommerce_template_single_add_to_cart - 30
 * @removed woocommerce_single_variation - 10
 * @hooked mi_woocommerce_template_single_variation - 30
 */
remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_add_to_cart', 30 );
remove_action( 'woocommerce_single_variation', 'woocommerce_single_variation', 10 );

/**
 * Product Summary Aside.
 *
 * @package modista
 * @see woocommerce_template_single_add_to_cart()
 * @see woocommerce_template_single_price()
 */
add_action( 'woocommerce_before_add_to_cart_button', 'woocommerce_template_single_price', 10 );
add_action( 'mi_woocommerce_single_product_aside', 'mi_woocommerce_single_product_features_aside', 10 );
add_action( 'mi_woocommerce_single_product_aside', 'mi_woocommerce_template_single_size_variation_aside', 25 );
add_action( 'mi_woocommerce_single_product_aside', 'woocommerce_template_single_add_to_cart', 30 );
add_filter( 'woocommerce_get_availability', 'remove_variation_availability', 10, 2 );

/**
 * Product Comments.
 */
add_filter( 'comment_form_fields', 'mi_comment_form_fields_sort', 10, 1 );

/**
 * After Summery section.
 *
 * @hooked woocommerce_output_product_features - 30
 */
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_features', 5 );

/**
 * Product Related.
 *
 * @removed woocommerce_output_related_products - 10
 * @filter woocommerce_product_related_products_heading - 30
 * @hooked mi_woocommerce_single_product_features_aside - 30
 */
remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_related_products', 20 );
add_filter( 'woocommerce_product_related_products_heading', '__return_false' );
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_best_seller_products', 10 );

/**
 * Login form actions.
 *
 * @hooked mi_woocommerce_myaccount_redirect
 * @filter mi_woocommerce_error_messages
 */
add_action('template_redirect', 'mi_woocommerce_myaccount_redirect');
add_filter('woocommerce_add_error', 'mi_woocommerce_error_messages', 10, 1);
add_filter('woocommerce_registration_redirect', 'mi_redirect_after_login', 10, 1);
add_filter('woocommerce_login_redirect', 'mi_redirect_after_login', 10, 1);
add_filter( 'woocommerce_register_post', 'mi_custom_phone_number_validation', 10, 3 );
add_action( 'woocommerce_created_customer', 'mi_save_phone_number_to_user_meta' );
add_action( 'woocommerce_after_customer_login_form', 'mi_login_with_google' );

/**
 * My account actions.
 *
 * @hooked mi_woocommerce_account_menu_items
 * @hooked mi_woocommerce_register_rewrite_endpoint
 * @hooked mi_woocommerce_account_comments
 * @hooked mi_woocommerce_account_notification
 * @hooked mi_woocommerce_account_wishlist
 * @hooked mi_woocommerce_account_tickets
 * @hooked mi_woocommerce_save_profile_picture_upload
 */
add_filter( 'woocommerce_account_menu_items', 'mi_woocommerce_account_menu_items', 10, 1 );
add_action('init', 'mi_woocommerce_register_rewrite_endpoint');
add_action( 'woocommerce_account_comments_endpoint', 'mi_woocommerce_account_comments' );
add_action( 'woocommerce_account_notification_endpoint', 'mi_woocommerce_account_notification' );
add_action( 'woocommerce_account_wishlist_endpoint', 'mi_woocommerce_account_wishlist' );
add_action( 'woocommerce_account_tickets_endpoint', 'mi_woocommerce_account_tickets' );
add_action( 'woocommerce_save_account_details', 'mi_woocommerce_save_profile_picture' );
remove_action( 'woocommerce_account_content', 'woocommerce_output_all_notices', 5 );
add_action( 'woocommerce_before_account_content', 'woocommerce_output_all_notices', 5 );

/**
 * Empty cart page
 * 
 * @hooked woocommerce_breadcrumb - 0
 * @hooked mi_woocommerce_shipping_route - 0
 */
add_action( 'woocommerce_cart_is_empty', 'woocommerce_breadcrumb', 0 );
add_action( 'woocommerce_cart_is_empty', 'mi_woocommerce_shipping_route', 0 );
remove_action( 'woocommerce_cart_is_empty', 'wc_empty_cart_message', 10 );

/**
 * Cart Page
 * 
 * @hooked woocommerce_breadcrumb - 5
 * @hooked mi_woocommerce_shipping_route - 5
 */
add_action( 'woocommerce_before_cart', 'woocommerce_breadcrumb', 5 );
add_action( 'woocommerce_before_cart', 'mi_woocommerce_shipping_route', 5 );

/**
 * Checkout Form
 * 
 * @hooked woocommerce_breadcrumb - 5
 * @hooked mi_woocommerce_shipping_route - 5
 */
add_action( 'woocommerce_before_checkout_wrapper', 'woocommerce_breadcrumb', 5 );
add_action( 'woocommerce_before_checkout_wrapper', 'mi_woocommerce_shipping_route', 10 );
remove_action( 'woocommerce_before_checkout_form', 'woocommerce_output_all_notices', 10 );

/**
 * Thankyou Page
 * 
 * @hooked woocommerce_breadcrumb - 10
 */
add_action( 'woocommerce_before_thankyou_wrapper', 'woocommerce_breadcrumb', 10 );

/**
 * Price
 * 
 * @hooked mi_woocommerce_get_price_html - 10
 */
add_filter('woocommerce_get_price_html', 'mi_woocommerce_get_price_html', 10, 2);