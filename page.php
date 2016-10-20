<?php
/**
 * The template for displaying pages.
 *
 * @package Barletta
 */

get_header(); ?>

	<section id="primary" class="content-area">
		<main id="main" class="site-main" role="main">

			<?php while ( have_posts() ) : the_post(); ?>

				<?php get_template_part( 'content', 'page' ); ?>

			<?php endwhile; // end of the loop. ?>

		</main>
	</section>

<?php
get_sidebar();

get_footer();