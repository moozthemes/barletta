<?php
/**
 * The Sidebar widget area for footer.
 *
 * @package Barletta
 */
?>

	<?php

	// If footer sidebars do not have widget let's by pass.
	if ( ! is_active_sidebar( 'footer-widget-1' ) 
		&& ! is_active_sidebar( 'footer-widget-2' ) 
		&& ! is_active_sidebar( 'footer-widget-3' ) )
		return;

	// If footer have widgets
	?>

	<div class="footer-widgets">

		<!-- left widget -->
		<?php if ( is_active_sidebar( 'footer-widget-1' ) ) : ?>

			<div class="col-sm-4 col-gutter footer-widget" role="complementary">
				<?php dynamic_sidebar( 'footer-widget-1' ); ?>
			</div>

		<?php endif; ?>

		<!-- middle widget -->
		<?php if ( is_active_sidebar( 'footer-widget-2' ) ) : ?>

			<div class="col-sm-4 col-gutter footer-widget" role="complementary">
				<?php dynamic_sidebar( 'footer-widget-2' ); ?>
			</div>

		<?php endif; ?>

		<!-- right widget -->
		<?php if ( is_active_sidebar( 'footer-widget-3' ) ) : ?>

			<div class="col-sm-4 col-gutter footer-widget" role="complementary">
				<?php dynamic_sidebar( 'footer-widget-3' ); ?>
			</div>

		<?php endif; ?>

	</div>