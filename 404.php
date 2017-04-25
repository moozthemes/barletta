<?php
/**
 * The template for displaying 404 pages (Not Found).
 *
 * @package Barletta
 */

get_header(); ?>
<section class="content-area">
	<main id="main" class="site-main" role="main">
		<div class="text-center error-box">
			<h1><?php _e('Page not found', 'barletta'); ?></h1>
		
			<div class="row">
				<div class="col-md-8 col-md-offset-2">
					<?php get_search_form(); ?>
				</div>
			</div>
		</div>
	</main>
</section> <!-- /.content-box -->
<?php
get_sidebar();

get_footer();