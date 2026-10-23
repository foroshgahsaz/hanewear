<?php

defined( 'ABSPATH' ) || exit;

/**
 * Get first term of post.
 *
 * @return string|null
 */
if ( ! function_exists( 'mi_post_get_first_term' ) ) {

	function mi_post_get_first_term( $postID = null, $taxonomy = 'category' ) {

		$taxonomies = ( $postID ) ? get_the_terms( $postID, $taxonomy ) : get_terms( $taxonomy );

		if ( ! is_wp_error( $taxonomies ) && ! empty( $taxonomies ) ) {
			return $taxonomies[0]->name;
		}

		return null;
	}
}

/**
 * Post meta data.
 *
 * @param $meta_data
 * @param bool $icon
 *
 * @return void
 */
if ( ! function_exists( 'mi_post_get_meta_data' ) ) {

	function mi_post_get_meta_data( $meta_data, array $args = [] ) {

		if ( empty( $meta_data ) ) {
			return;
		}

		echo '<ul class="d-flex mi-card__meta-data flex-1">';
		foreach ( $meta_data as $meta ) {
			echo '<li class="d-flex gap-2">';
			// Render data text
			switch ( $meta ) {
				case 'author':
					$data_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"> <path d="M9 9C11.0711 9 12.75 7.32107 12.75 5.25C12.75 3.17893 11.0711 1.5 9 1.5C6.92893 1.5 5.25 3.17893 5.25 5.25C5.25 7.32107 6.92893 9 9 9Z" stroke="#7C7C7C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path d="M14.4073 11.805L11.7523 14.46C11.6473 14.565 11.5498 14.76 11.5273 14.9025L11.3848 15.915C11.3323 16.2825 11.5873 16.5375 11.9548 16.485L12.9673 16.3425C13.1098 16.32 13.3123 16.2225 13.4098 16.1175L16.0648 13.4625C16.5223 13.005 16.7398 12.4725 16.0648 11.7975C15.3973 11.13 14.8648 11.3475 14.4073 11.805Z" stroke="#7C7C7C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/> <path d="M14.0244 12.1875C14.2494 12.9975 14.8794 13.6275 15.6894 13.8525" stroke="#7C7C7C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/> <path d="M2.55762 16.5C2.55762 13.5975 5.44514 11.25 9.00014 11.25C9.78014 11.25 10.5301 11.3625 11.2276 11.5725" stroke="#7C7C7C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>';
					$data_value = get_the_author();
					break;
				case 'read_time':
					$data_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"> <g clip-path="url(#clip0_537_14766)"> <path d="M9 6V9L10.875 10.875" stroke="#989898" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path d="M5.25 2.50337C6.35315 1.86523 7.63392 1.5 9 1.5C13.1421 1.5 16.5 4.85786 16.5 9C16.5 13.1421 13.1421 16.5 9 16.5C4.85786 16.5 1.5 13.1421 1.5 9C1.5 7.63392 1.86523 6.35315 2.50337 5.25" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/> </g> <defs> <clipPath id="clip0_537_14766"> <rect width="18" height="18" fill="white"/> </clipPath> </defs> </svg>';
					$data_value = sprintf( __( '%d دقیقه', 'modista' ), mi_post_reading_time() );
					break;
				case 'date':
					$data_icon = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"> <path d="M10.5 16.5H7.5C4.67157 16.5 3.25736 16.5 2.37868 15.6213C1.5 14.7426 1.5 13.3284 1.5 10.5V9C1.5 6.17157 1.5 4.75736 2.37868 3.87868C3.25736 3 4.67157 3 7.5 3H10.5C13.3284 3 14.7426 3 15.6213 3.87868C16.5 4.75736 16.5 6.17157 16.5 9V10.5C16.5 13.3284 16.5 14.7426 15.6213 15.6213C15.1314 16.1112 14.4751 16.328 13.5 16.4239" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/> <path d="M5.25 3V1.875" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/> <path d="M12.75 3V1.875" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/> <path d="M16.125 6.75H12.4688H8.0625M1.5 6.75H4.40625" stroke="#989898" stroke-width="1.5" stroke-linecap="round"/> <path d="M13.5 12.75C13.5 13.1642 13.1642 13.5 12.75 13.5C12.3358 13.5 12 13.1642 12 12.75C12 12.3358 12.3358 12 12.75 12C13.1642 12 13.5 12.3358 13.5 12.75Z" fill="#989898"/> <path d="M13.5 9.75C13.5 10.1642 13.1642 10.5 12.75 10.5C12.3358 10.5 12 10.1642 12 9.75C12 9.33579 12.3358 9 12.75 9C13.1642 9 13.5 9.33579 13.5 9.75Z" fill="#989898"/> <path d="M9.75 12.75C9.75 13.1642 9.41421 13.5 9 13.5C8.58579 13.5 8.25 13.1642 8.25 12.75C8.25 12.3358 8.58579 12 9 12C9.41421 12 9.75 12.3358 9.75 12.75Z" fill="#989898"/> <path d="M9.75 9.75C9.75 10.1642 9.41421 10.5 9 10.5C8.58579 10.5 8.25 10.1642 8.25 9.75C8.25 9.33579 8.58579 9 9 9C9.41421 9 9.75 9.33579 9.75 9.75Z" fill="#989898"/> <path d="M6 12.75C6 13.1642 5.66421 13.5 5.25 13.5C4.83579 13.5 4.5 13.1642 4.5 12.75C4.5 12.3358 4.83579 12 5.25 12C5.66421 12 6 12.3358 6 12.75Z" fill="#989898"/> <path d="M6 9.75C6 10.1642 5.66421 10.5 5.25 10.5C4.83579 10.5 4.5 10.1642 4.5 9.75C4.5 9.33579 4.83579 9 5.25 9C5.66421 9 6 9.33579 6 9.75Z" fill="#989898"/> </svg>';
					// Set date
					if ( array_key_exists( 'date_format', $args ) ) {
						$data_value = get_the_date($args['date_format']);
					} else {
						$data_value = get_the_date('Y/m/d');
					}
					break;
				case 'time':
					$data_icon  = '';
					$data_value = get_the_time();
					break;
				case 'comments':
					$data_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"> <path d="M6.375 7.875H11.625" stroke="#7C7C7C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/> <path d="M5.25 13.8225H8.25L11.5875 16.0425C12.0825 16.3725 12.75 16.02 12.75 15.42V13.8225C15 13.8225 16.5 12.3225 16.5 10.0725V5.57251C16.5 3.32251 15 1.82251 12.75 1.82251H5.25C3 1.82251 1.5 3.32251 1.5 5.57251V10.0725C1.5 12.3225 3 13.8225 5.25 13.8225Z" stroke="#7C7C7C" stroke-width="1.5" stroke-miterlimit="10" stroke-linecap="round" stroke-linejoin="round"/> </svg>';
					$data_value = get_comments_number();
					break;
				case 'view':
					$data_icon  = '<svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M11.6854 9C11.6854 10.485 10.4854 11.685 9.00043 11.685C7.51543 11.685 6.31543 10.485 6.31543 9C6.31543 7.515 7.51543 6.315 9.00043 6.315C10.4854 6.315 11.6854 7.515 11.6854 9Z" stroke="#7C7C7C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> <path d="M8.99988 15.2025C11.6474 15.2025 14.1149 13.6425 15.8324 10.9425C16.5074 9.88501 16.5074 8.10751 15.8324 7.05001C14.1149 4.35001 11.6474 2.79001 8.99988 2.79001C6.35238 2.79001 3.88488 4.35001 2.16738 7.05001C1.49238 8.10751 1.49238 9.88501 2.16738 10.9425C3.88488 13.6425 6.35238 15.2025 8.99988 15.2025Z" stroke="#7C7C7C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/> </svg>';
					$data_value = get_post_meta( get_the_ID(), '_mi_view_count', true );
					if ( empty( $data_value ) ) {
						$data_value = 0;
					}
					break;
				case 'date_modified':
					$modified_date = get_the_modified_date();
					$modified_time = get_the_modified_time();
					$data_value    = sprintf( __( 'Last updated on %s at %s', 'modista' ), $modified_date, $modified_time );
					break;
				default:
					$data_icon  = '';
					$data_value = '';
			}

			if ( ! array_key_exists( 'hide_icon', $args ) ) {
				echo '<div class="d-flex align-items-center">';
				echo $data_icon;
				echo '</div>';
			}

			echo '<span class="d-flex">';
			echo $data_value;
			echo '</span>';

			echo '</li>';
		}
		echo '</ul>';
	}
}

/**
 * Calculate Content Read time.
 *
 * @used-by mi_post_get_meta_data
 * @return false|float
 */
if ( ! function_exists( 'mi_post_reading_time' ) ) {

	function mi_post_reading_time() {

		$content = get_the_content();

		$clean_content = wp_strip_all_tags( $content );
		$clean_content = trim( $clean_content );

		// if content is empty.
		if ( empty( $clean_content ) ) {
			return 0;
		}

		// counter of the content characters.
		$word_count    = preg_match_all( '/\p{L}+/u', $clean_content );
		$reading_speed = 200;

		return ceil( $word_count / $reading_speed );
	}
}

// Order By in blog and archive of posts.
if ( ! function_exists( 'mi_pre_get_posts_orderby' ) ) {

	function mi_pre_get_posts_orderby( $query ) {

		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( is_home() || is_archive() ) {

			if ( isset( $_GET['orderby'] ) ) {
				switch ( $_GET['orderby'] ) {

					case 'popularity':
						$query->set( 'orderby', 'comment_count' );
						$query->set( 'order', 'DESC' );
						break;

					default:
						$query->set( 'orderby', 'date' );
						$query->set( 'order', 'DESC' );
						break;
				}
			}
		}
	}
}

if ( ! function_exists( 'mi_get_data_actions' ) ) {

	function mi_get_data_actions( $postID ) {
		global $wpdb;

		$results = $wpdb->get_results(
			$wpdb->prepare( "SELECT meta_key as name, meta_value as value FROM {$wpdb->prefix}postmeta WHERE post_id=%d AND meta_key LIKE '%_mi_action_%'", $postID ),
			ARRAY_A
		);

		foreach ( $results as $result ) {
			$results[ $result['name'] ] = $result['value'];
		}

		return $results;
	}
}

// Increase post views
if ( ! function_exists( 'mi_increase_post_views' ) ) {

	function mi_increase_post_views() {
		if ( is_single() ) {

			$post_id     = get_the_ID();
			$cookie_name = 'mi_post_viewed_' . $post_id;

			if ( ! isset( $_COOKIE[ $cookie_name ] ) ) {
				
				$data_value = get_post_meta( $post_id, '_mi_view_count', true );
				$data_value = empty( $data_value ) ? 1 : $data_value + 1;

				update_post_meta( $post_id, '_mi_view_count', $data_value );

				// Set for one hour
				setcookie( $cookie_name, '1', time() + 3600, '/' );
			}
		}
	}
}

/**
 * Render elementor section after single base template.
 * manage in redux panel
 */
if ( ! function_exists( 'mi_single_render_after_base_template' ) ) {

	function mi_single_render_after_base_template() {
		global $redux_mi_theme;
		$selected_section_ID = $redux_mi_theme['mi_single_section_after_base_template'] ?? false;
		\Modista\Classes\PostType_Modista_Library::load($selected_section_ID);
	}
}

/**
 * Render related post.
 */
if ( ! function_exists( 'mi_single_render_related_post' ) ) {

	function mi_single_render_related_post() {

		$current_post_id = get_the_ID();
		$categories = wp_get_post_categories($current_post_id);

		if ( ! empty($categories) ) {
			$args = array(
				'category__in'   => $categories,
				'post__not_in'   => array($current_post_id),
				'posts_per_page' => 1,
				'orderby'        => 'rand'
			);

			$related_posts = new WP_Query($args);

			if ($related_posts->have_posts()) {
				echo '<ul class="related-post-list">';
				while ($related_posts->have_posts()) {
					$related_posts->the_post();

					$args = [
						'hide_badge' => true,
						'meta_data' => ['author'],
						'show_excerpt' => true,
						'show_read_more' => true,
					];
					get_template_part('template-parts/content', 'post', $args);
				}
				echo '</ul>';
			} else {
				// echo '<p>مقاله مرتبطی یافت نشد.</p>';
			}
			wp_reset_postdata();
		}
	}
}

/**
 * Get excerpt with set length.
 *
 * @param int $count
 * @param string $ellipsis
 * @return void
 */
if ( ! function_exists( 'mi_post_the_excerpt' ) ) {

	function mi_post_the_excerpt( $count = 0, $ellipsis = 'yes' )
	{
		$excerpt = get_the_excerpt();
		$excerpt = trim($excerpt);

		$excerpt_array = explode(' ', $excerpt);
		$excerpt_array = array_slice($excerpt_array, 0, $count);

		$excerpt = implode(' ', $excerpt_array);

		if ( strlen($excerpt) > 0 && $ellipsis === 'yes' )  $excerpt = $excerpt . '...';

		echo $excerpt;
	}
}

// Remove () characters of before and after category count.
if ( ! function_exists( 'mi_wp_list_categories' ) ) {

	function mi_wp_list_categories ( $output ) {
		return preg_replace_callback('/\((\d+)\)/', function ( $matches ) {
			return '<span class="widget-categories__count">' . $matches[1] . '</span>';
		}, $output);
	}
}

// Convert wordpress dates to jajali
if ( ! function_exists( 'mi_date_to_jalali' ) ) {

	function mi_date_to_jalali($date, $format = '', $post = null) {

		if ( !$date || !function_exists('jdate') ) return $date;

		// Try to get timestamp directly from WordPress
		$timestamp = is_numeric($date) ? $date : strtotime($date);

		// Fallback to get_post_time if conversion fails
		if (!$timestamp && $post) {
			$timestamp = get_post_time('U', true, $post);
		}

		if (!$timestamp) return $date;

		$format = ($format !== '') ? $format : 'Y/m/d';

		// Convert to Jalali
		return jdate($format, $timestamp);
	}
}


if ( ! function_exists( 'mi_custom_posts_per_page' ) ) {

	function mi_custom_posts_per_page( $query ) {

		global $redux_mi_theme;

		if ( is_admin() || ! $query->is_main_query() ) {
			return;
		}

		if ( $redux_mi_theme && ( $query->is_home() || $query->is_archive() ) ) {
			$per_page = $redux_mi_theme['mi_archive_posts_per_page'];

			if ( $per_page ) {
				$query->set( 'posts_per_page', $per_page );
			}
		}
	}
}

if ( ! function_exists( 'mi_add_star_divider' ) ) {
    function mi_add_star_divider () {
        ?>
        <div class="d-flex justify-content-center align-items-center flex-1 position-relative mi-star-divider">
            <svg xmlns="http://www.w3.org/2000/svg" width="23" height="23" viewBox="0 0 23 23" fill="none">
                <path d="M11.5 0C11.5 0 12.1345 5.92243 14.606 8.39396C17.0776 10.8655 23 11.5 23 11.5C23 11.5 17.0776 12.1345 14.606 14.606C12.1345 17.0776 11.5 23 11.5 23C11.5 23 10.8655 17.0776 8.39396 14.606C5.92243 12.1345 0 11.5 0 11.5C0 11.5 5.92243 10.8655 8.39396 8.39396C10.8655 5.92243 11.5 0 11.5 0Z" fill="#FD5504"/>
            </svg>
        </div>
        <?php
    }
}
if ( ! function_exists( 'mi_show_filter_aside' ) ) {

    function mi_show_filter_aside () {

        global $redux_mi_theme;
        if(!$redux_mi_theme || $redux_mi_theme['mi_shop_sidebar_display'] != true) return;
        ?>
        <div class="mi-modal__toggle d-md-none rounded-3 fs-3--1 px-4 px-md-6 py-1 cursor-pointer" data-modal="mi_modal_side">
            فیلترها
        </div>
        <?php
    }
}