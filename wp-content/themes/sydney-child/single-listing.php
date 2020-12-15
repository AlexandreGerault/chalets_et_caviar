<?php
/**
 * The template for displaying all single posts.
 *
 * @package Sydney
 */

get_header(); ?>

	<?php if (get_theme_mod('fullwidth_single')) { //Check if the post needs to be full width
		$width = 'fullwidth';
	} else {
		$width = 'col-md-9';
	} ?>

	<?php do_action('sydney_before_content'); ?>

	<div id="primary" class="content-area <?php echo esc_attr( apply_filters( 'sydney_content_area_class', $width ) ); ?>">

		<?php sydney_yoast_seo_breadcrumbs(); ?>

		<main id="main" class="post-wrap" role="main">

		<?php while ( have_posts() ) : the_post(); ?>

			<?php do_action( 'epl_property_single' ); ?>

		<?php endwhile; // end of the loop. ?>

		</main><!-- #main -->
	</div><!-- #primary -->
<?php get_footer(); ?>
