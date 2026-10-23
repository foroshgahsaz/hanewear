<?php

if ( is_home() || is_search() ) {

	get_template_part('archive');

} else {

	get_header();

	if ( have_posts() ) :
		while (have_posts()) : the_post();
			the_content();
		endwhile;
	else:
		_e( 'Sorry, no posts matched your criteria.', 'modista' );
	endif;

	get_footer();
}