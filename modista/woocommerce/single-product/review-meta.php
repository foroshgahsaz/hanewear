<?php
/**
 * The template to display the reviewers meta data (name, verified owner, review date)
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review-meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

global $comment;
$verified = wc_review_is_from_verified_owner( $comment->comment_ID );

if ( '0' === $comment->comment_approved ) { ?>

	<p class="meta d-flex flex-column">
		<span class="woocommerce-review__author"><?php comment_author(); ?> </span>
		<span class="fs-3 color-text-400"><?php esc_html_e( 'Your review is awaiting approval', 'woocommerce' ); ?></span>
	</p>

<?php } else { ?>

	<p class="meta d-flex flex-column">
		<span class="woocommerce-review__author"><?php comment_author(); ?> </span>
		<?php
		if ( 'yes' === get_option( 'woocommerce_review_rating_verification_label' ) && $verified ) {
			echo '<small class="woocommerce-review__verified verified">(' . esc_attr__( 'verified owner', 'woocommerce' ) . ')</small> ';
		}

		// Get the user ID from the comment
		$user = get_userdata( $comment->user_id );

		// Check if the user exists and process roles
		if ( $user && ! empty( $user->roles ) ) {
			$roles = in_array( 'subscriber', $user->roles, true ) ? esc_html__( 'کاربر', 'modista' ) : esc_html__( 'پشتیبان', 'modista' );
		} else {
			$roles = esc_html__( 'کاربر', 'modista' );
		}

		echo '<span class="fs-3 color-text-300">' . esc_html( $roles ) . '</span>';
		?>
    </p>

	<?php
}
