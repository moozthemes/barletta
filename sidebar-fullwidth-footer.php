<?php
/**
 * The Sidebar widget area for footer.
 *
 * @package Barletta
 */
?>

	<?php

	// If footer sidebars do not have widget let's by pass.
	if ( ! is_active_sidebar( 'footer-fullwidth-widget' )) return;

	// If footer have widgets
	?>

	<div class="fullwidth-widgets">

		<!-- left widget -->
		<?php if ( is_active_sidebar( 'footer-fullwidth-widget' ) ) : ?>

				<?php dynamic_sidebar( 'footer-fullwidth-widget' ); ?>

		<?php endif; ?>

	</div>