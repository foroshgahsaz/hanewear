<?php
if ( did_action( 'elementor/loaded' ) && function_exists( 'elementor_theme_do_location' )
    && elementor_theme_do_location( 'footer' ) ) {
    elementor_theme_do_location( 'footer' );
} else {
    get_template_part( 'template-parts/footer' );
}

wp_footer();
?>
</body>
</html>