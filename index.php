<?php get_header(); ?>
		
<?php if ( have_posts() ) : ?>

	<?php
	// Start the loop.
	while ( have_posts() ) : the_post();

		/*
		 * Include the Post-Format-specific template for the content.
		 * If you want to override this in a child theme, then include a file
		 * called content-___.php (where ___ is the Post Format name) and that will be used instead.
		 */
		get_template_part( 'content', get_post_format() );

	// End the loop.
	endwhile;

	// Previous/next page navigation.
	$nav = get_the_posts_pagination( array(
		'type'          => 'list',
		'prev_text'          => __( 'Previous page', 'barletta' ),
		'next_text'          => __( 'Next page', 'barletta' )
	) );
	echo $nav;

// If no content, include the "No posts found" template.
else :

	get_template_part( 'content', 'none' );

endif;
?>

<?php
get_sidebar();

get_footer();