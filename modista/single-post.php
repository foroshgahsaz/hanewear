<?php

defined( 'ABSPATH' ) || exit;

get_header();

?>
<div id="primary" class="container-fluid">
	<main id="main" class="site-main container mt-12" role="main">
		<?php
		// Load breadcrumb template
		get_template_part( 'template-parts/global/breadcrumb' );
		?>
		<div class="single__content-before position-relative" style="background-image: url('<?php echo MI_URL ?>/assets/image/hero-pattern-bg.png');"></div>
		<div class="single__content d-flex flex-column gap-9 mt-9 mb-24">
			<?php the_post_thumbnail(['860', '370'], ['alt' => get_the_title(), 'load' => 'lazy']); ?>
			<div class="d-flex flex-wrap gap-9">
				<div class="content flex-1">
					<h1 class="fw-900 mb-1"><?php the_title() ?></h1>
					<div class="meta mb-2">
						<?php mi_post_get_meta_data([ 'date', 'comments', 'view', 'author'], ['date_format' => 'Y/m/d']); ?>
          			</div>
					<?php the_content(); ?>
				</div>
				<div class="single__aside d-flex flex-column gap-6 flex-none sticky">
					<?php
            			mi_post_get_meta_data( ['date'], ['hide_icon' => true, 'date_format' => 'j F Y'] );
						get_template_part( 'template-parts/global/count-action' );
					?>
				</div>
			</div>
		</div>
        <?php comments_template(); ?>
	</main>
    <?php mi_single_render_after_base_template(); ?>
</div>
<?php

get_footer();