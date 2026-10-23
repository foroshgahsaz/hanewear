<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
* Breadcrumb
*/
add_filter( 'woocommerce_breadcrumb_defaults', 'mi_wcc_breadcrumb_filter' );

function mi_wcc_breadcrumb_filter( $defaults ) {

	// Change the breadcrumb delimiter from '/' to '>' svg.
	$delimiter = '<svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
		<path d="M12.5 15L7.5 10L12.5 5" stroke="#B9B9B9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
	</svg>';

	$defaults['delimiter'] = $delimiter;
	$defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb d-flex align-items-center fs-3--1 fw-400 " itemprop="breadcrumb">';
	$defaults['home'] = __('صفحه اصلی', 'modista');

	return $defaults;
}

/**
 * ---------------------------------------
 * Archive products and Shop hook and filters.
 * ---------------------------------------
 */

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

function mi_woocommerce_template_loop_color() {

	global $loop_skin_two;
	global $product;

	// This template just load for skin two card.
	if ( $loop_skin_two !== true ) {
		return;
	}

	if ($product->is_type('variable')) {
		$available_variations = $product->get_available_variations();
		$attribute_name = 'pa_color';
		// Navigation for thumbnails
		?>
        <button class="product-gallery-button product-gallery-button--prev position-absolute">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L4.84873 12.93L4.84883 12.9299L4.85458 9.76505L9.48809 9.77345L9.07583 5.71905L11.438 3.35684L13.6759 5.59472L9.49716 9.77347L17.7358 9.78841L17.7301 12.9532L9.33251 12.938L13.5516 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
            </svg>
        </button>
        <button class="product-gallery-button product-gallery-button--next position-absolute">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L17.7787 12.93L17.7786 12.9299L17.7728 9.76505L13.1393 9.77345L13.5516 5.71905L11.1894 3.35684L8.95152 5.59472L13.1303 9.77347L4.89162 9.78841L4.89736 12.9532L13.2949 12.938L9.07584 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
            </svg>
        </button>

        <div class="mi-product-card__color-options d-flex">
			<?php foreach ($available_variations as $variation) :
				if (isset($variation['attributes']["attribute_$attribute_name"])) {
					$color = $variation['attributes']["attribute_$attribute_name"];
					$image_id = $variation['image_id']; // دریافت ID تصویر متغیر
					$image_url = $image_id ? wp_get_attachment_image_url($image_id, 'thumbnail') : ''; // URL تصویر
					?>
                    <span
                            class="color-circle"
                            style="background-color: <?php echo esc_attr($color); ?>"
                            data-variation-id="<?php echo esc_attr($variation['variation_id']); ?>"
                            data-image-src="<?php echo esc_attr($image_url); ?>"
                            title="<?php echo esc_attr($color); ?>">
                        </span>
					<?php
				}
			endforeach; ?>
        </div>
		<?php
	}
}

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
add_action( 'woocommerce_before_shop_loop_item_title', 'mi_woocommerce_template_loop_product_gallery', 10 );

function mi_woocommerce_template_loop_product_gallery() {

	global $product;
	global $loop_skin_two;

    if ( $loop_skin_two === true ) {
        return;
    }

	$gallery_image_ids = $product->get_gallery_image_ids();

	if ( ! empty($gallery_image_ids) ) :

        // Navigation for thumbnails
		?>
        <button class="product-gallery-button product-gallery-button--prev position-absolute">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L4.84873 12.93L4.84883 12.9299L4.85458 9.76505L9.48809 9.77345L9.07583 5.71905L11.438 3.35684L13.6759 5.59472L9.49716 9.77347L17.7358 9.78841L17.7301 12.9532L9.33251 12.938L13.5516 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
            </svg>
        </button>
        <button class="product-gallery-button product-gallery-button--next position-absolute">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L17.7787 12.93L17.7786 12.9299L17.7728 9.76505L13.1393 9.77345L13.5516 5.71905L11.1894 3.35684L8.95152 5.59472L13.1303 9.77347L4.89162 9.78841L4.89736 12.9532L13.2949 12.938L9.07584 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
            </svg>
        </button>

		<?php

		echo '<div class="mi-product-card__gallery-thumbnails d-flex justify-content-between overflow-hidden">';

            echo '<div class="thumbnail" data-index="' .  0  . '">';
                woocommerce_template_loop_product_thumbnail();
            echo '</div>';

            foreach ($gallery_image_ids as $key => $image_id) {
                $image_src = wp_get_attachment_image_url($image_id, 'thumbnail');
                ?>
                <div class="thumbnail" data-index="<?php echo $key + 1 ?>">
                    <img decoding="async" src="<?php echo esc_url($image_src); ?>" alt="gallery-thumbnail">
                </div>
                <?php
            }

        echo '</div>';
	endif;
}

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

function mi_add_star_divider () {
    ?>
    <div class="d-flex justify-content-center align-items-center flex-1 position-relative mi-star-divider">
        <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
            <path d="M11.5 0C11.5 0 12.1345 5.92243 14.606 8.39396C17.0776 10.8655 23 11.5 23 11.5C23 11.5 17.0776 12.1345 14.606 14.606C12.1345 17.0776 11.5 23 11.5 23C11.5 23 10.8655 17.0776 8.39396 14.606C5.92243 12.1345 0 11.5 0 11.5C0 11.5 5.92243 10.8655 8.39396 8.39396C10.8655 5.92243 11.5 0 11.5 0Z" fill="#FD5504"/>
        </svg>
    </div>
    <?php
}
function mi_show_filter_aside () {
    ?>
    <div class="mi-modal__toggle d-md-none rounded-3 fs-3--1 px-4 px-md-6 py-1 cursor-pointer" data-modal="mi_modal_side">
        فیلترها
    </div>
    <?php
}

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
add_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_short_attributes', 10 );
add_filter( 'woocommerce_get_star_rating_html', 'mi_wc_get_rating_html', 10, 3 );
add_action( 'woocommerce_single_product_summary', 'mi_woocommerce_template_single_variation', 30 );

if ( ! function_exists( 'mi_woocommerce_template_single_short_attributes' ) ) {

	function mi_woocommerce_template_single_short_attributes() {

        global $product;

        $product_attributes = array();

		// Add product attributes to list.
		$attributes = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );

		foreach ( $attributes as $attribute ) {
			$values = array();

			if ( $attribute->is_taxonomy() ) {
				$attribute_taxonomy = $attribute->get_taxonomy_object();
				$attribute_values   = wc_get_product_terms( $product->get_id(), $attribute->get_name(), array( 'fields' => 'all' ) );

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

			$product_attributes[ 'attribute_' . sanitize_title_with_dashes( $attribute->get_name() ) ] = array(
				'label' => wc_attribute_label( $attribute->get_name() ),
				'value' => apply_filters( 'woocommerce_attribute', wpautop( wptexturize( implode( ', ', $values ) ) ), $attribute, $values ),
			);
		}

		wc_get_template(
			'single-product/product-short-attributes.php',
			array( 'product_attributes' => $product_attributes )
		);
	}
}
if ( ! function_exists( 'mi_wc_get_rating_html' ) ) {

    function mi_wc_get_rating_html( $html, $rating, $count ) {

		$label = sprintf( __( 'Rated %s out of 5', 'woocommerce' ), $rating );

		if (fmod($rating, 1) == 0 ) {
			$rating = intval($rating);
		}

		ob_start(); ?>

		<div class="d-flex align-items-center gap-2 fs-3--1 fw-600 woocommerce-product-rating star-rating mb-3" role="img" aria-label="<?php echo esc_attr( $label ); ?>">
			<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
				<path d="M4.30502 12C4.38752 11.6325 4.23752 11.1075 3.97502 10.845L2.15252 9.0225C1.58252 8.4525 1.35752 7.845 1.52252 7.32C1.69502 6.795 2.22752 6.435 3.02252 6.3L5.36252 5.91C5.70002 5.85 6.11252 5.55 6.27002 5.2425L7.56002 2.655C7.93502 1.9125 8.44502 1.5 9.00002 1.5C9.55502 1.5 10.065 1.9125 10.44 2.655L11.73 5.2425C11.8275 5.4375 12.03 5.625 12.2475 5.7525L4.17002 13.83C4.06502 13.935 3.88502 13.8375 3.91502 13.6875L4.30502 12Z" fill="#FD5504"/>
				<path d="M14.0251 10.845C13.7551 11.115 13.6051 11.6325 13.6951 12L14.2126 14.2575C14.4301 15.195 14.2951 15.9 13.8301 16.2375C13.6426 16.3725 13.4176 16.44 13.1551 16.44C12.7726 16.44 12.3226 16.2975 11.8276 16.005L9.6301 14.7C9.2851 14.4975 8.7151 14.4975 8.3701 14.7L6.1726 16.005C5.3401 16.4925 4.6276 16.575 4.1701 16.2375C3.9976 16.11 3.8701 15.9375 3.7876 15.7125L12.9076 6.5925C13.2526 6.2475 13.7401 6.09 14.2126 6.1725L14.9701 6.3C15.7651 6.435 16.2976 6.795 16.4701 7.32C16.6351 7.845 16.4101 8.4525 15.8401 9.0225L14.0251 10.845Z" fill="#FD5504"/>
			</svg>
			<span>
				5/
				<span class="rating"><?php echo esc_html($rating) ?></span>
			</span>
		</div>

		<?php

		return ob_get_clean();
	}
}
if ( ! function_exists( 'mi_woocommerce_template_single_variation' ) ) {

	/**
	 * Output the variable product add to cart area.
	 */
	function mi_woocommerce_template_single_variation() {
		global $product;

		// This template just load for variable type.
		if ($product->get_type() !== 'variable') return;

		// Enqueue variation scripts.
		wp_enqueue_script( 'wc-add-to-cart-variation' );

		// Get Available variations?
		$get_variations = count( $product->get_children() ) <= apply_filters( 'woocommerce_ajax_variation_threshold', 30, $product );

		// Load the template.
		wc_get_template(
			'single-product/variable.php',
			array(
				'available_variations' => $get_variations ? $product->get_available_variations() : false,
				'attributes'           => $product->get_variation_attributes(),
				'selected_attributes'  => $product->get_default_attributes(),
			)
		);
	}
}

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
add_action( 'woocommerce_after_add_to_cart_quantity', 'woocommerce_template_single_price', 20 );
add_action( 'mi_woocommerce_single_product_aside', 'woocommerce_template_single_add_to_cart', 30 );
add_action( 'mi_woocommerce_single_product_aside', 'mi_woocommerce_single_product_features_aside', 10 );
add_filter( 'woocommerce_get_availability', 'remove_variation_availability', 10, 2 );

if ( ! function_exists( 'mi_woocommerce_single_product_features_aside' ) ) {

	/**
	 * Output the product features add to aside area.
	 */
	function mi_woocommerce_single_product_features_aside() {
		global $woocommerce;

        if ( $woocommerce->cart->needs_shipping() && in_array( 'free_shipping', array_keys( $woocommerce->shipping->get_shipping_methods() ) ) ) :
            ?>
            <div class="free-shipping feature-box">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M12 14H13C14.1 14 15 13.1 15 12V2H6C4.5 2 3.19001 2.82999 2.51001 4.04999" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 17C2 18.66 3.34 20 5 20H6C6 18.9 6.9 18 8 18C9.1 18 10 18.9 10 20H14C14 18.9 14.9 18 16 18C17.1 18 18 18.9 18 20H19C20.66 20 22 18.66 22 17V14H19C18.45 14 18 13.55 18 13V10C18 9.45 18.45 9 19 9H20.29L18.58 6.01001C18.22 5.39001 17.56 5 16.84 5H15V12C15 13.1 14.1 14 13 14H12" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M8 22C9.10457 22 10 21.1046 10 20C10 18.8954 9.10457 18 8 18C6.89543 18 6 18.8954 6 20C6 21.1046 6.89543 22 8 22Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M16 22C17.1046 22 18 21.1046 18 20C18 18.8954 17.1046 18 16 18C14.8954 18 14 18.8954 14 20C14 21.1046 14.8954 22 16 22Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M22 12V14H19C18.45 14 18 13.55 18 13V10C18 9.45 18.45 9 19 9H20.29L22 12Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 8H8" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 11H6" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M2 14H4" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
                <span><?php esc_html_e( 'ارسال رایگان', 'modista' ); ?></span>
            </div>
        <?php
        endif;
	}
}
if ( ! function_exists( 'remove_variation_availability' ) ) {

    function remove_variation_availability( $availability, $product ) {
        if ( $product->is_type( 'variation' ) ) {
            $availability = ''; // اینجا محتوای موجودی را خالی می‌کنیم
        }
        return $availability;
    }
}

/**
 * Product Comments.
 */
add_filter( 'comment_form_fields', 'mi_comment_form_fields_sort', 10, 1 );

if ( ! function_exists( 'mi_comment_form_fields_sort' ) ) {

	function mi_comment_form_fields_sort( $comment_fields ) {

		return [
			'author'  => array_key_exists( 'author', $comment_fields ) ? $comment_fields['author'] : '',
			'email'   => array_key_exists( 'email', $comment_fields ) ? $comment_fields['email'] : '',
			'comment' => array_key_exists( 'comment', $comment_fields ) ? $comment_fields['comment'] : '',
			'cookies' => array_key_exists( 'cookies', $comment_fields ) ? $comment_fields['cookies'] : '',
			'url'     => array_key_exists( 'url', $comment_fields ) ? $comment_fields['url'] : '',
		];
	}
}


/**
 * After Summery section.
 *
 * @hooked woocommerce_output_product_features - 30
 */
add_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_features', 5 );

if ( ! function_exists( 'woocommerce_output_product_features' ) ) {

	function woocommerce_output_product_features() {
        wc_get_template('single-product/features-box.php');
	}
}

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

if ( ! function_exists( 'woocommerce_output_best_seller_products' ) ) {

	function woocommerce_output_best_seller_products() {

		if ( did_action( 'elementor/loaded' ) ) {

			global $redux_mi_theme;
			$selected_section_ID = $redux_mi_theme['single_product_after_summary_section'] ?? false;

			if ( $selected_section_ID ) {

				if (class_exists('Elementor\Plugin') && \Elementor\Plugin::$instance->documents->get($selected_section_ID)) {
					echo \Elementor\Plugin::$instance->frontend->get_builder_content_for_display($selected_section_ID);
				} else {
					$post = get_post($selected_section_ID);
					apply_filters('the_content', $post->post_content);
					the_content();
				}

                wp_reset_postdata();
			}
		}

	}
}


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

if ( ! function_exists( 'mi_woocommerce_myaccount_redirect' ) ) {

	function mi_woocommerce_myaccount_redirect() {

		// If user not logged in and open my account page
		if ( is_account_page() && ! is_user_logged_in() ) {

			global $redux_mi_theme;
			$login_page_ID = $redux_mi_theme['mi_login_register_id'] ?? null;

            if ($login_page_ID) {
	            wp_redirect( get_permalink($login_page_ID) );

	            exit;
            }
		}

		// If user logged in and open login page
		if ( is_user_logged_in() ) {

			global $redux_mi_theme;
			$login_page_ID = $redux_mi_theme['mi_login_register_id'] ?? null;

            if ( is_page( $login_page_ID ) ) {
				$redirect = mi_redirect_after_login();
	            wp_redirect($redirect);
	            exit;
            }
		}
	}
}
if ( ! function_exists( 'mi_redirect_after_login' ) ) {

    function mi_redirect_after_login( $redirect = '' ) {

        global $redux_mi_theme;
        $mi_after_login_redirect = $redux_mi_theme['mi_after_login_redirect'] ?? null;

        if ($mi_after_login_redirect) {
            return $mi_after_login_redirect;
        } elseif ( wc_get_page_id('myaccount') ) {
            return get_permalink(wc_get_page_id('myaccount'));
        }

        return home_url();
    }
}
if ( ! function_exists( 'mi_woocommerce_error_messages' ) ) {

	function mi_woocommerce_error_messages($error) {
		// Username incorrect
		if ( strpos($error, 'اگر از نام کاربری خود مطمئن نیستید') !== false ) {
			return 'نام کاربری یا رمز عبور اشتباه است. لطفاً دوباره تلاش کنید!';
		}
		// Password incorrecet
		if ( strpos($error, 'رمز عبوری که برای نام کاربری') !== false ) {
			return 'نام کاربری یا رمز عبور اشتباه است. لطفاً دوباره تلاش کنید!';
		}
		// Email not found
		if ( strpos($error, 'آدرس ایمیل ناشناس') !== false ) {
			return 'نام کاربری یا رمز عبور اشتباه است. لطفاً دوباره تلاش کنید!';
		}

		error_log(print_r($error, true));

		return $error;
	}
}