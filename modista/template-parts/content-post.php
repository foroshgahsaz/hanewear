<?php

defined( 'ABSPATH' ) || exit;

?>
<div class="d-flex position-relative mi-card">
    <?php
    if ( ! array_key_exists('hide_badge', $args) ) {
	    $term_name = mi_post_get_first_term();

	    if ( ! is_null($term_name) ) {
		    echo '<div class="mi-card__badge position-absolute">' . $term_name . '</div>';
	    }
    }
    ?>
    <div class="mi-card__image">
        <a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
            <?php the_post_thumbnail('full', ['alt' => get_the_title()]); ?>
        </a>
    </div>
    <div class="d-flex flex-1 gap-3 mi-card__content">
        <h3 class="mi-card__title">
            <a href="<?php echo esc_url(get_permalink()); ?>" class="d-block" title="<?php echo esc_url(get_the_title()); ?>" >
                <?php the_title(); ?>
            </a>
        </h3>
        <?php
        // Render the excerpt
        if ( array_key_exists('show_excerpt', $args) ) {
	        echo '<p class="mi-card__excerpt">';
	            mi_post_the_excerpt(14);
	        echo '</p>';
        }
        ?>
	    <div class="d-flex justify-content-between">
		    <?php
            // Render meta data
		    $meta_data = array_key_exists('meta_data', $args) ? $args['meta_data'] : ['read_time', 'date'];
		    mi_post_get_meta_data( $meta_data );

		    // Render meta data
		    if ( array_key_exists('show_read_more', $args) ) {
                echo '<a href="' . esc_url( get_the_permalink() ) . '" class="mi-card__readmore d-flex gap-2 align-items-center">';
                    _e('مطالعه کن', 'modista');
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16" fill="none"> <path fill-rule="evenodd" clip-rule="evenodd" d="M13.7144 2.28577H4.5715V2.28592L4.5715 2.28592L2.33768 4.52785L5.62001 7.79829L2.46161 10.3737V13.7143H5.62644V7.8047L11.4626 13.6197L13.6964 11.3778L7.74768 5.4506H13.7144V2.28577Z" fill="#B0B0B0"/> </svg>';
			    echo '</a>';
		    }
		    ?>
        </div>
    </div>
</div>