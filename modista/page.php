<?php get_header(); ?>

<div class="container-fluid">
    <div class="container">
        <?php
        if ( have_posts() ) :
            while (have_posts()) : the_post();
                the_content();
            endwhile;
        else:
            _e( 'Sorry, no posts matched your criteria.', 'modista' );
        endif;
        ?>
    </div>
</div>

<?php get_footer(); ?>