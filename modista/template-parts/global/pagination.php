<?php
/**
 * Pagination - Show numbered pagination for catalog pages
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $wp_query;

$total   = $wp_query->max_num_pages;
$current = get_query_var('paged');

if ( $total <= 1 ) {
	return;
}

?>
<nav class="mi-pagination mt-16" aria-label="<?php esc_attr_e( 'Archive Pagination', 'modista' ); ?>">
	<?php
	echo paginate_links(
		array( // WPCS: XSS ok.
			'add_args'  => false,
			'current'   => max( 1, $current ),
			'total'     => $total,
			'prev_text' => __( 'قبلی' ),
			'next_text' => __( 'بعدی' ),
			'type'      => 'list',
		)
	);
	?>
</nav>
