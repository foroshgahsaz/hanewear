<?php

defined( 'ABSPATH' ) || exit;

get_header();

global $redux_mi_theme;
?>
<div id="primary" class="container-fluid">
	<main id="main" class="site-main container mt-12" role="main">
		<?php
		// Load breadcrumb template
		get_template_part( 'template-parts/global/breadcrumb' );
		?>
		<div class="d-flex gap-6 mt-9">
			<?php if(is_array($redux_mi_theme) && $redux_mi_theme['mi_archive_sidebar_display'] == true) : // Manage by panel ?>
				<div class="mi-archive-aside mi-modal-side d-flex w-md-25 flex-column px-4 pt-4 pb-6 p-md-0 gap-6" id="mi_modal_side">
					<?php dynamic_sidebar( 'sidebar' ); ?>
				</div>
			<?php endif; ?>
			<div class="flex-1">
				<div class="d-flex align-items-center justify-content-between mb-4 gap-2 mb-md-8">
					<h1 class="woocommerce-products-header__title page-title fs-4 fw-800 ">
						<?php the_archive_title(); ?>
					</h1>
                    <?php
                    mi_add_star_divider();

					if(is_array($redux_mi_theme) && $redux_mi_theme['mi_archive_sidebar_display'] == true) {
                    	mi_show_filter_aside(); // Render aside toggle
					}

					if(is_array($redux_mi_theme) && $redux_mi_theme['mi_archive_sort_filter'] == true) { // Manage by panel
                    	get_template_part('template-parts/archive/orderby');
					}
                    ?>
				</div>
				<div class="flex-1 d-grid d-grid-1 d-grid-md-2 d-grid-lg-3 gap-6">
					<?php
					if ( have_posts() ) :
						while (have_posts()) : the_post();
							get_template_part('template-parts/content', 'post');
						endwhile;
					else:
						_e( 'Sorry, no posts matched your criteria.', 'modista' );
					endif;
					?>
				</div>
                <?php
                // Load pagination template
                get_template_part( 'template-parts/global/pagination' );
                ?>
			</div>
		</div>
	</main>
</div>
<?php

get_footer();