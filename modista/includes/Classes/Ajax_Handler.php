<?php

namespace Modista\Classes;

use Modista\Plugins\Google_Api_Client;

class Ajax_Handler {

	public function __construct() {
		$this->hooks();
	}

	private function hooks() {
		// Single post actions.
		add_action('wp_ajax_update_action_count', [$this, 'update_action_count']);
		add_action('wp_ajax_nopriv_update_action_count', [$this, 'update_action_count']);
		
		// Google Identity Services
		add_action('wp_ajax_nopriv_auth_with_google', [$this, 'auth_with_google']);
		add_action('wp_ajax_nopriv_auth_with_google_depecated', [$this, 'auth_with_google']);

		// Post wishlist
		add_action('wp_ajax_mi_toggle_wishlist', [$this, 'user_update_wishlist']);

		add_action( 'wp_ajax_mi_el_widget_form_submission', [$this, 'elementor_widget_form_submission_update'] );
		add_action( 'wp_ajax_nopriv_mi_el_widget_form_submission', [$this, 'elementor_widget_form_submission_update'] );

		if ( class_exists( 'WooCommerce' ) ) {
            add_action( 'wp_ajax_mi_remove_cart_item', [$this, 'woocommerce_remove_cart_item'] );
			add_action( 'wp_ajax_nopriv_mi_remove_cart_item', [$this, 'woocommerce_remove_cart_item'] );

			add_action('wp_ajax_mi_update_cart_item', [$this, 'woocommerce_update_cart_item']);
			add_action('wp_ajax_nopriv_mi_update_cart_item', [$this, 'woocommerce_update_cart_item']);
        }
	}

	/**
	 * Post count action.
	 * Update count action in posts template, eg: like, share, dislike ...
	 */
	public function update_action_count() {
		// Verify nonce for security
		check_ajax_referer('update_action_nonce', 'security');
	
		// Validate input
		if (empty($_POST['post_id']) || empty($_POST['action_type'])) {
			wp_send_json_error(['message' => 'Invalid data request']);
		}
	
		$post_id = intval($_POST['post_id']);
		$action_type = sanitize_text_field($_POST['action_type']);
	
		// Define actions that are only recorded and do not require conflicting action checking.
		$simple_actions = ['share_instagram', 'share_whatsapp', 'share_facebook', 'share_telegram'];
		$toggle_actions = ['like', 'dislike']; // Actions that we should eliminate the opposing action
	
		if (!in_array($action_type, array_merge($simple_actions, $toggle_actions), true)) {
			wp_send_json_error(['message' => 'Invalid Action name']);
		}
	
		// Define a meta key to store the number
		$meta_key = '_mi_action_' . $action_type;
	
		// Get previous actions from a cookie
		$cookie_name = 'mi_post_actions';
		$last_actions = isset($_COOKIE[$cookie_name]) ? explode(',', $_COOKIE[$cookie_name]) : [];
	
		$response_data = [];
	
		// If the action is "like" or "dislike", check the opposite action.
		if (in_array($action_type, $toggle_actions, true)) {
			$opposite_meta_key = ($action_type === 'like') ? '_mi_action_dislike' : '_mi_action_like';
	
			if (in_array("{$opposite_meta_key}_{$post_id}", $last_actions, true)) {
				// Remove conflicting action
				$opposite_count = intval(get_post_meta($post_id, $opposite_meta_key, true));
				$new_opposite_count = max(0, $opposite_count - 1);
				update_post_meta($post_id, $opposite_meta_key, $new_opposite_count);
	
				// Remove from cookie
				$last_actions = array_diff($last_actions, ["{$opposite_meta_key}_{$post_id}"]);
	
				// Send the new value of the conflicting action in the JSON response.
				$response_data['opposite_new_count'] = $new_opposite_count;
			}
		}
	
		// Check if the new function does not contain a cookie, add it.
		if (!in_array($meta_key, $last_actions, true)) {

			$count = intval(get_post_meta($post_id, $meta_key, true)) ?: 0;
			$new_count = $count + 1;
			update_post_meta($post_id, $meta_key, $new_count);
	
			$last_actions[] = "{$meta_key}_{$post_id}";

			$response_data['new_count'] = $new_count;
		}

		$last_actions = empty($last_actions) ? '' : implode(',', $last_actions);
		setcookie($cookie_name, $last_actions, time() + 14400, COOKIEPATH, COOKIE_DOMAIN, is_ssl(), true);
	
		wp_send_json_success($response_data);
	}
	

	/**
	 * Authentication user with google method in login page.
	 */
	public function auth_with_google()
	{
		if ( !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'update_action_nonce' ) || !isset($_POST['code'])) {
			wp_send_json_error( ["message" => __('درخواست نامعتبر', 'modista')] );
		}

		// Get the config from panel
		global $redux_mi_theme;

		// If in option panel login disabled
        if ( ! $redux_mi_theme || ! array_key_exists('mi_auth_with_google', $redux_mi_theme) || $redux_mi_theme['mi_auth_with_google'] == '0') {
			wp_send_json_error( ["message" => __('ورود با گوگل غیرفعال است', 'modista')] );
        }
        
        $clientID = $redux_mi_theme['mi_auth_with_google_client_id'] ?? false;
        $clientSecret = $redux_mi_theme['mi_auth_with_google_secret_id'] ?? false;
        $redirectUri = $redux_mi_theme['mi_auth_with_google_redirect_url'] ?? '';

		// If in option panel login disabled
        if ( !$clientID || !$clientSecret) {
			wp_send_json_error( ["message" => __('توکن نامعتبر', 'modista')] );
        }

		$google_api_client = new Google_Api_Client($clientID, $clientSecret, $redirectUri);
		$user_info = $google_api_client->oauth2_token_info($_POST['code']);

		if ( $user_info === false ) {
			wp_send_json_error( ["message" => __('احراز هویت با خطا مواجه شد', 'modista')] );
		}

		// Get data from google response data.
		$email = $user_info['email'];
        $name = $user_info['name'];
        // $first_name = $user_info['given_name'];
        // $family_name = $user_info['family_name'];

		$user = get_user_by('email', $email);

		// login or register user
		if ( !$user ) {
            $user_id = wp_create_user($email, wp_generate_password(), $email);
            wp_update_user(
				[	'ID' => $user_id,
				 	'display_name' => $name,
				]);
        } else {
            $user_id = $user->ID;
        }

        wp_set_auth_cookie($user_id);

		// Get redirect url
		$redirect_uri = mi_redirect_after_login();

		wp_send_json_success([
			'message' => __('با موفقیت وارد شدید', 'modista'),
			'redirect' => $redirect_uri
		]);		
	}

	/**
	 * Update user wishlist
	 * Update or create wishlist of post or product.
	 */
	public function user_update_wishlist() {
		
		// Verify nonce for security
		check_ajax_referer('update_action_nonce', 'security');

		if (!isset($_POST['post_id']) || !isset($_POST['action_type'])) {
			wp_send_json_error(['message' => 'Invalid data request']);
		}

		if (!is_user_logged_in()) {
			wp_send_json_error(['message' => 'ابتدا وارد حساب کاربری شوید.']);
		}
	
		$user_id = get_current_user_id();
		$post_id = isset($_POST['post_id']) ? intval($_POST['post_id']) : 0;
		$action_type = isset($_POST['action_type']) ? sanitize_text_field($_POST['action_type']) : '';
	
		if ( !$post_id ) {
			wp_send_json_error(['message' => 'آیدی پست نامعتبر است.']);
		}
	
		$wishlist = get_user_meta($user_id, '_mi_wishlist', true);
		$wishlist = is_array($wishlist) ? $wishlist : [];
	
		if ($action_type === 'add' && !in_array($post_id, $wishlist)) {
			$wishlist[] = $post_id;
			$new_action = 'remove';
		} elseif ($action_type === 'remove' && in_array($post_id, $wishlist)) {
			$wishlist = array_diff($wishlist, [$post_id]);
			$new_action = 'add';
		} else {
			wp_send_json_error(['message' => 'عملیات نامعتبر است.']);
		}
	
		update_user_meta($user_id, '_mi_wishlist', $wishlist);
	
		wp_send_json_success([
			'action' => $new_action,
		]);
	}

	public function elementor_widget_form_submission_update() {
		

		if ( !isset($_POST['nonce']) || !wp_verify_nonce( $_POST['nonce'], 'mi_form_submission' ) || !isset($_POST['field'])) {
			wp_send_json_error( ['message' => 'Unauthorized request']);
		}

		$result = \Modista\Widgets\Base_Form_Submission::create_field( $_POST['field'] );

		wp_send_json_success( ['message' => $result]);
	}

	public function woocommerce_remove_cart_item()
	{
		if ( isset( $_POST['cart_key'] ) ) {
			$cart_key = sanitize_text_field( $_POST['cart_key'] );
			
			WC()->cart->remove_cart_item( $cart_key );
	
			ob_start();
			woocommerce_mini_cart();
			$mini_cart = ob_get_clean();
	
			wp_send_json_success([
				'mini_cart'  => $mini_cart,
				'cart_count' => WC()->cart->get_cart_contents_count()
			]);
		} else {
			wp_send_json_error(['message' => 'Cart key not found']);
		}
		
		wp_die();
	}

	public function woocommerce_update_cart_item() {
		if (!isset($_POST['cart_key']) || !isset($_POST['quantity'])) {
			wp_send_json_error(['message' => 'Invalid request']);
		}
	
		$cart_key = sanitize_text_field($_POST['cart_key']);
		$quantity = absint($_POST['quantity']);
	
		if ($quantity > 0 && isset(WC()->cart->cart_contents[$cart_key])) {
			WC()->cart->set_quantity($cart_key, $quantity);
		}
	
		ob_start();
		woocommerce_mini_cart();
		$mini_cart = ob_get_clean();
	
		wp_send_json_success([
			'mini_cart'  => $mini_cart,
			'cart_count' => WC()->cart->get_cart_contents_count()
		]);
	
		wp_die();
	}
	
}