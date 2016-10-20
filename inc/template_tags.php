<?php
/**
 * Custom template tags
 *
 * @package barletta
 */

if ( ! function_exists( 'barletta_paging_nav' ) ) :
/**
 * Display navigation to next/previous set of posts when applicable.
 *
 * @return void
 */

function barletta_paging_nav() {

	// Don't print empty markup if there's only one page.

	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
		return;
	}

	?>

	<nav class="navigation paging-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php esc_html_e( 'Posts navigation', 'barletta' ); ?></h1>
		<div class="nav-links">

			<?php if ( get_next_posts_link() ) : ?>
			<div class="nav-previous"> <?php next_posts_link( __( 'Older posts', 'barletta' ) ); ?></div>
			<?php endif; ?>

			<?php if ( get_previous_posts_link() ) : ?>
			<div class="nav-next"><?php previous_posts_link( __( 'Newer posts', 'barletta' ) ); ?> </div>
			<?php endif; ?>

		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
}
endif;

if ( ! function_exists( 'barletta_post_nav' ) ) :

/*
 * Display navigation to next/previous post when applicable.
 */

function barletta_post_nav() {

	// Don't print empty markup if there's nowhere to navigate.
	
	$previous = ( is_attachment() ) ? get_post( get_post()->post_parent ) : get_adjacent_post( false, '', true );
	$next     = get_adjacent_post( false, '', false );
	if ( ! $next && ! $previous ) {
		return;
	}
	?>

	<nav class="navigation post-navigation" role="navigation">
		<h1 class="screen-reader-text"><?php _e( 'Post navigation', 'barletta' ); ?></h1>
		<div class="nav-links">
			<?php
			if ( is_attachment() ) :
				previous_post_link( '%link', __( '<div class="meta-nav"><span>Published In</span>%title</div>', 'barletta' ) );
			else :
				previous_post_link( '%link', __( '<div class="meta-nav meta-nav-left"><span>Previous Post</span>%title</div>', 'barletta' ) );
				next_post_link( '%link', __( '<div class="meta-nav meta-nav-right"><span>Next Post</span>%title</div>', 'barletta' ) );
			endif;
			?>
		</div><!-- .nav-links -->
	</nav><!-- .navigation -->

	<?php
}

endif;