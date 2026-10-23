<?php
/**
 * The template for displaying search form
 *
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form role="search" method="get" class="mi-product-search d-flex rounded-3" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label class="screen-reader-text" for="mi-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>"><?php esc_html_e( 'Search for:', 'modista' ); ?></label>
	<input type="search" id="mi-product-search-field-<?php echo isset( $index ) ? absint( $index ) : 0; ?>" class="search-field" placeholder="<?php echo esc_attr__( 'جست و جو کنید', 'modista' ); ?>" value="<?php echo get_search_query(); ?>" name="s" />
	<button type="submit" value="<?php echo esc_attr_x( 'Search', 'submit button', 'modista' ); ?>" class="button">
		<svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
			<path opacity="0.4" d="M11.5 21C16.7467 21 21 16.7467 21 11.5C21 6.25329 16.7467 2 11.5 2C6.25329 2 2 6.25329 2 11.5C2 16.7467 6.25329 21 11.5 21Z" fill="#919191"/>
			<path d="M21.3001 22C21.1201 22 20.9401 21.93 20.8101 21.8L18.9501 19.94C18.6801 19.67 18.6801 19.23 18.9501 18.95C19.2201 18.68 19.6601 18.68 19.9401 18.95L21.8001 20.81C22.0701 21.08 22.0701 21.52 21.8001 21.8C21.6601 21.93 21.4801 22 21.3001 22Z" fill="#919191"/>
		</svg>
	</button>
</form>