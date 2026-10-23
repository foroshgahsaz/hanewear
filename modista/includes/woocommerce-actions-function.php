<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'mi_wcc_breadcrumb_filter' ) ) {

    function mi_wcc_breadcrumb_filter( $defaults ) {

        // Change the breadcrumb delimiter from '/' to '>' svg.
        $delimiter = '<div class="breadcrumb-delimiter d-flex"><svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20" fill="none">
            <path d="M12.5 15L7.5 10L12.5 5" stroke="#B9B9B9" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
        </svg></div>';

        $defaults['delimiter'] = $delimiter;
        $defaults['wrap_before'] = '<nav class="woocommerce-breadcrumb d-flex align-items-center fs-3--1 fw-400 overflow-x-scroll hide-scroll" itemprop="breadcrumb">';
        $defaults['home'] = __('صفحه اصلی', 'modista');

        return $defaults;
    }
}

if ( ! function_exists( 'mi_woocommerce_template_loop_color' ) ) {
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
            <button class="product-gallery-button product-gallery-button--prev prev-button position-absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L4.84873 12.93L4.84883 12.9299L4.85458 9.76505L9.48809 9.77345L9.07583 5.71905L11.438 3.35684L13.6759 5.59472L9.49716 9.77347L17.7358 9.78841L17.7301 12.9532L9.33251 12.938L13.5516 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
                </svg>
            </button>
            <button class="product-gallery-button product-gallery-button--next next-button position-absolute">
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
}

if ( ! function_exists( 'mi_woocommerce_template_loop_product_gallery' ) ) {
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
            <button class="product-gallery-button product-gallery-button--prev prev-button position-absolute">
                <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                    <path fill-rule="evenodd" clip-rule="evenodd" d="M11.3137 19.395L4.84873 12.93L4.84883 12.9299L4.85458 9.76505L9.48809 9.77345L9.07583 5.71905L11.438 3.35684L13.6759 5.59472L9.49716 9.77347L17.7358 9.78841L17.7301 12.9532L9.33251 12.938L13.5516 17.1571L11.3137 19.395Z" fill="#E2E2E2"/>
                </svg>
            </button>
            <button class="product-gallery-button product-gallery-button--next next-button position-absolute">
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
                    
                    if ($key == 4) break;

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
}

if ( ! function_exists( 'mi_woocommerce_template_single_short_attributes' ) ) {

	function mi_woocommerce_template_single_short_attributes() {

        global $product;

        $product_attributes = array();

		$attributes                 = array_filter( $product->get_attributes(), 'wc_attributes_array_filter_visible' );
		$variation_attribute_names  = array_keys( $product->get_variation_attributes() );

		foreach ( $attributes as $attribute ) {
			$attribute_name = $attribute->get_name();

			if ( in_array( $attribute_name, $variation_attribute_names, true ) ) {
				continue;
			}

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

if ( ! function_exists( 'mi_woocommerce_template_single_size_variation_aside' ) ) {

	function mi_woocommerce_template_single_size_variation_aside() {
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
			array(
				'options'   => $attributes['pa_size'],
				'attribute' => 'pa_size',
				'product'   => $product,
				'context'   => 'aside',
			)
		);
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

if ( ! function_exists( 'mi_woocommerce_single_product_features_aside' ) ) {

	/**
	 * Output the product features add to aside area.
	 */
	function mi_woocommerce_single_product_features_aside() {
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
				<span><?php esc_html_e( 'ارسال اکسپرس', 'modista' ); ?></span>
			</div>
			<div class="feature-box product-authenticity">
				<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" aria-hidden="true">
					<path d="M12 3L4 7V11C4 16.55 7.84 21.74 12 23C16.16 21.74 20 16.55 20 11V7L12 3Z" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
					<path d="M9 12L11 14L15.5 9.5" stroke="#545454" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
				</svg>
				<span><?php esc_html_e( 'ضمانت اصالت و سلامت فیزیکی کالا', 'modista' ); ?></span>
			</div>
		</div>
		<?php
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

if ( ! function_exists( 'woocommerce_output_product_features' ) ) {

	function woocommerce_output_product_features() {
        wc_get_template('single-product/features-box.php');
	}
}

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

if ( ! function_exists( 'mi_woocommerce_myaccount_redirect' ) ) {

	function mi_woocommerce_myaccount_redirect() {

        global $redux_mi_theme;

        $login_page_id = $redux_mi_theme['mi_login_register_id'] ?? null;

		// If user not logged in and open my account page
		if ( $login_page_id && is_account_page() && ! is_user_logged_in() ) {
        
            // Register custom style.
            wp_enqueue_style( 'mi-login-register' );
            wp_enqueue_script( 'mi-login-register' );

            // Get target page url
            $redirect_url = get_permalink($login_page_id);

            $query_args = $_GET;
            
            unset($query_args['action']);

            if ( isset($_GET['show-reset-form']) 
                && array_key_exists('wp-resetpass-' . COOKIEHASH, $_COOKIE) ) {

                return;
            }

            if ( ! empty($query_args) ) {
                $redirect_url = add_query_arg($query_args, $redirect_url);            
            }

            wp_safe_redirect( $redirect_url );

            exit;
            
		}

		// If user logged in and open login page
		if ( $login_page_id && is_user_logged_in() ) {

            if ( array_key_exists('elementor-preview', $_GET) || array_key_exists('preview_id', $_GET) || array_key_exists('DOING_AJAX', $_GET) ) {
                return;
            }

            if ( is_page( $login_page_id ) ) {
                
				$redirect_url = mi_redirect_after_login();

                wp_safe_redirect( $redirect_url );

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
			return '<strong>خطا: </strong>' . 'نام کاربری یا رمز عبور اشتباه است.';
		}
		// Password incorrecet
		if ( strpos($error, 'رمز عبوری که برای نام کاربری') !== false ) {
			return '<strong>خطا: </strong>' . 'نام کاربری یا رمز عبور اشتباه است.';
		}
		// Email not found
		if ( strpos($error, 'آدرس ایمیل ناشناس') !== false ) {
			return '<strong>خطا: </strong>' . 'نام کاربری یا رمز عبور اشتباه است.';
		}

		return $error;
	}
}
if ( ! function_exists( 'mi_custom_phone_number_validation' ) ) {

    function mi_custom_phone_number_validation( $username, $email, $validation_errors ) {
        
        if ( isset( $_POST['reg_phone'] ) ) {

            $phone_valid = preg_match('/(\+98|0|98|0098)?([ ]|-|[()]){0,2}9[0-9]([ ]|-|[()]){0,2}(?:[0-9]([ ]|-|[()]){0,2}){8}/',  $_POST['reg_phone'] );

            if ( ! $phone_valid) {
                $validation_errors->add( 'reg_phone_error', __( 'شماره وارد شده معتبر نیست!', 'modista' ) );
            }

        }
        
        return $validation_errors;
    }
}
if ( ! function_exists( 'mi_save_phone_number_to_user_meta' ) ) {

	function mi_save_phone_number_to_user_meta($customer_id) {
		if ( isset( $_POST['reg_phone'] ) ) {
            $phone_number = sanitize_text_field( $_POST['reg_phone'] );
            update_user_meta( $customer_id, '_mi_phone', $phone_number );
        }
	}
}
if ( ! function_exists('mi_login_with_google') ) {
 
    function mi_login_with_google() {

        global $redux_mi_theme;


        if ( !$redux_mi_theme || ! array_key_exists('mi_auth_with_google', $redux_mi_theme)
         || $redux_mi_theme['mi_auth_with_google'] == '0') {
            return;
        }

        $clientID       = $redux_mi_theme['mi_auth_with_google_client_id'];
        $clientSecret   = $redux_mi_theme['mi_auth_with_google_secret_id'];
        $redirectUri    = $redux_mi_theme['mi_auth_with_google_redirect_url'];

        $google_api_client = new \Modista\Plugins\Google_Api_Client($clientID, $clientSecret, $redirectUri);

        echo '<div class="mi-star-divider my-6 d-flex justify-content-center align-items-center flex-1 position-relative"><span>' . __('یا', 'modista') . '</span></div>';

        if ($redux_mi_theme['auth_with_google_method'] === 'gapi') {
            $google_api_client->render_gapi_button();
        } else {
            $google_api_client->render_gis_button();
        }
    }   
}

if ( ! function_exists('mi_woocommerce_account_menu_items') ) {

    function mi_woocommerce_account_menu_items( $items ) {

        // Add custom item
        $custom_items = array(
            'comments' => __('دیدگاه ها', 'modista'),
            'notification' => __('اطلاع رسانی', 'modista'),
            'wishlist' => __('علاقه مندی', 'modista'),
            'tickets' => __('تیکت ها', 'modista'),
        );

        // Default labels.
        $items['customer-logout'] = __('خروج', 'modista');

        // Change default items order.
        $first_menus = array_slice($items, 0, 3, true);
        $end_menus = array_slice($items, 3, count($items), true);

        return array_merge($first_menus, $custom_items, $end_menus);
    }

}
if ( ! function_exists('mi_woocommerce_register_rewrite_endpoint') ) {
    function mi_woocommerce_register_rewrite_endpoint() {
        add_rewrite_endpoint('comments', EP_PAGES);
        add_rewrite_endpoint('notification', EP_PAGES);
        add_rewrite_endpoint('wishlist', EP_PAGES);
        add_rewrite_endpoint('tickets', EP_PAGES);
    }
}

if ( ! function_exists( 'mi_woocommerce_account_comments' ) ) {

	/**
	 * My Account > Comments template.
	 */
	function mi_woocommerce_account_comments() {

        // Get current user object
        $current_user = wp_get_current_user();
            
        // Get all current user comments
        $comments = get_comments([
            'user_id' => $current_user->ID, // Use user_id.
        ]);

        $args = [
            'comments' => $comments,
            'has_comment' => count($comments) > 0, // Use boolean for checking presence
        ];

		wc_get_template( 
            'myaccount/comments.php',
             $args 
            );
	}
}
if ( ! function_exists( 'mi_woocommerce_account_notification' ) ) {

	/**
	 * My Account > Notification template.
	 */
	function mi_woocommerce_account_notification() {

        $notification = new Modista\Modules\Notification();

        // Get alerts
        $notification_data = $notification->get_notifications();

        $args = [
          'notifications'       => $notification_data,
          'has_notification'    => count($notification_data) > 0,
          'notification_types'  => $notification->notifications_types
        ];

		wc_get_template( 
            'myaccount/notification.php',
            $args
         );
	}
}
if ( ! function_exists( 'mi_woocommerce_account_wishlist' ) ) {

	/**
	 * My Account > Wishlist template.
	 */
	function mi_woocommerce_account_wishlist() {
        
        $user_id = get_current_user_id();
        $wishlist = get_user_meta($user_id, '_mi_wishlist', true);

        // Seperate by post type.
        if ( is_array($wishlist) ) {

            $wishlist = array_reverse($wishlist);

            foreach ($wishlist as $post_ID) {

                $post_type = get_post_type($post_ID);
    
                if ($post_type) {
                    $favorited_type[$post_type][] = $post_ID;
                }
            }  
        }

        $args = [
            'has_wishlist'  => ( is_array($wishlist) && count($wishlist) > 0 ),
            'wishlists'     => $favorited_type ?? [],
        ];
    
		wc_get_template( 
            'myaccount/wishlist.php', 
            $args 
        );
	}
}
if ( ! function_exists( 'mi_woocommerce_account_tickets' ) ) {

	/**
	 * My Account > Tickets template.
	 */
	function mi_woocommerce_account_tickets() {
        
        global $wp;

        $current_user_id = get_current_user_id();

        if ( !$current_user_id ) return;

        // Get all tickets template the user.
        $args = [
            'ticket_status_count'   => Modista\Modules\Tickets::get_ticket_statuses( $current_user_id ),
            'field_status'          => array_merge(['all' => __('همه', 'modista') ], Modista\Modules\Tickets::$field_status ),
            'field_priority'        => Modista\Modules\Tickets::$field_priority,
            'field_department'      => Modista\Modules\Tickets::$field_department
        ];

        // If has ticket id in url show single ticket.
        if ( !empty($wp->query_vars['tickets']) && is_numeric($wp->query_vars['tickets']) ) {

            $ticket_id = intval( $wp->query_vars['tickets'] );

            $current_ticket = \Modista\Modules\Tickets::get_ticket(['id' => $ticket_id]);
            $current_ticket = !empty($current_ticket) ? array_shift($current_ticket) : null;

            // Ticekt id is valid and for current user
            if ( !empty($current_ticket) && $current_ticket->user_id == $current_user_id ) {

                $args = array_merge($args, [
                    'ticket_id'             => $ticket_id,
                    'ticket'                => $current_ticket,
                    'ticket_messages'       => Modista\Modules\Tickets::get_ticket_message(['ticket_id' => $ticket_id]),
                ]);
        
                wc_get_template(
                    'myaccount/ticket.php',
                    $args
                );

                return;
            }
        }

        $ticket_list = Modista\Modules\Tickets::get_ticket(['user_id' => $current_user_id ]);

        // Get all tickets template the user.
        $args = array_merge( $args, [
            'ticket_list'   => $ticket_list,
            'has_ticket'    => count($ticket_list) > 0,
        ]);

		wc_get_template(
            'myaccount/tickets.php',
            $args
        );        
	}
}
if ( ! function_exists( 'mi_woocommerce_addresses' ) ) {

    // Shpping or Billing address
	function mi_woocommerce_addresses( $address_type, $user_id = 0 ) {

        if ( $user_id === 0 ) {
            $user_id = get_current_user_id();
        }

        $address_array = [
            'first_name'    => '',
            'last_name'     => '',
            'address_1'     => '',
            'address_2'     => '',
            'city'          => '',
            'postcode'      => '',
            'country'       => '',
            'country_name'  => '',
            'state'         => '',
            'state_name'    => '',
        ];

        // Get all address data.
        foreach ($address_array as $name => $value) {
            $address_array[ $name ] = get_user_meta($user_id, $address_type . '_' . $name , true);
        }

        // If all fields is null
        $filtered = array_filter($address_array, function( $value ) {
            return !empty($value);
        });

        if ( empty($filtered) ) return false;

        $country_code = $address_array['country'];
        $state_code = $address_array['state'];

        $countries = WC()->countries->get_countries(); // States array for a country
		$states = WC()->countries->get_states($country_code); // States array for a country
        
        // Get state full name.
		if ( isset($states[$state_code]) ) {
			$address_array['state_name'] = $states[$state_code];
		}

        // Get country full name.
		if ( isset($countries[$country_code]) ) {
			$address_array['country_name'] = $countries[$country_code];
		}

        return $address_array;
	}
}
if ( ! function_exists('mi_woocommerce_save_profile_picture') ) {

    /**
     * Save custom profile image for user in woocommerce dashboard
     */
    function mi_woocommerce_save_profile_picture( $user_id ) {

        if ( isset( $_FILES['mi_profile_picture'] ) && ! empty( $_FILES['mi_profile_picture']['name'] ) ) {
                    
            require_once( ABSPATH . 'wp-admin/includes/file.php' );

            $uploaded_file = $_FILES['mi_profile_picture'];
    
            $upload_overrides = array( 'test_form' => false );
            $movefile = wp_handle_upload( $uploaded_file, $upload_overrides );
    
            if ( $movefile && ! isset( $movefile['error'] ) ) {
                update_user_meta( $user_id, '_mi_profile_src', $movefile['url'] );
            } else {
                error_log('Error uploading file: ' . $movefile['error']);
            }
        }
    }
}
if ( ! function_exists('mi_woocommerce_get_profile_picture') ) {

    /**
     * Save custom profile image for user in woocommerce dashboard
     */
    function mi_woocommerce_get_profile_picture( $user_id = 0 ) {

        if ( $user_id === 0 ) {
            $user_id = get_current_user_id();
        }
        
        return get_user_meta( $user_id, '_mi_profile_src', true );    
    }
}

if ( ! function_exists('mi_woocommerce_shipping_route') ) {
    function mi_woocommerce_shipping_route() {
        
        wc_get_template('global/shopping-route.php');    
    }
}

if ( ! function_exists('mi_woocommerce_get_price_html') ) {
    function mi_woocommerce_get_price_html ($price, $product, $type = 'block') {
        
        if ( $product->is_type( 'variable' ) ) {
            $min_price = $product->get_variation_price( 'min', true );
            $min_regular_price = $product->get_variation_regular_price( 'min', true );
            $min_sale_price = $product->get_variation_sale_price( 'min', true );

            if ( empty($min_sale_price) ) {
                $min_sale_price = $min_price;
            }

            if ( $min_sale_price && $min_sale_price !== $min_regular_price ) {
                $discount_amount = $min_regular_price - $min_sale_price;
                $discount_percentage = ($discount_amount > 0) ? round(($discount_amount / $min_regular_price) * 100) : 0;

                $price  = '<del class="d-flex align-items-center justify-content-end gap-1">';
                $price .= wc_price($min_regular_price, [ 'currency' => ' ' ]);
                $price .= '<span class="mi-product-loop__discount">' . $discount_percentage . '%</span>';
                $price .= '</del> <ins>' . wc_price($min_sale_price) . '</ins>';
            } else {
                $price = '<div class="price text-left">' . wc_price($min_price) . '</div>';
            }
        } else {
            $regular_price = (float) $product->get_regular_price();
            $sale_price = (float) $product->get_sale_price();

            if ( empty($sale_price) ) {
                $sale_price = $regular_price;
            }

            if ($product->is_on_sale() && $sale_price < $regular_price) {
                $discount_amount = $regular_price - $sale_price;
                $discount_percentage = ($discount_amount > 0) ? round(($discount_amount / $regular_price) * 100) : 0;

                $price  = '<del class="d-flex align-items-center justify-content-end gap-1">';
                $price .= wc_price($regular_price, [ 'currency' => ' ' ]);
                $price .= '<span class="mi-product-loop__discount">' . $discount_percentage . '%</span>';
                $price .= '</del> <ins>' . wc_price($sale_price) . '</ins>';
            } else {
                $price = '<div class="price text-left">' . wc_price($sale_price) . '</div>';
            }
        }
        
        return $price;
    }
}
add_filter('woocommerce_get_price_html', 'mi_woocommerce_get_price_html', 10, 2);


if ( ! function_exists('mi_custom_products_per_page') ) {

    function mi_custom_products_per_page( $cols ) {

        global $redux_mi_theme;

        $per_page = $cols;

        if($redux_mi_theme) {
            $per_page = $redux_mi_theme['mi_shop_products_per_page'];
        }
        
        return $per_page;
    }
}
