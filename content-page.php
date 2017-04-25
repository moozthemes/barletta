<?php
/**
 * The template used for displaying page content in page.php
 *
 * @package barletta
 */
?>

<article  id="post-<?php the_ID(); ?>">
	<div class="blog-post-image">

	<?php if ( has_post_thumbnail() ) : ?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php the_post_thumbnail( 'barletta-large-thumbnail' ); ?>
		</a>
	<?php endif; ?>
		
	</div>
	<div class="blog-post">
	<div class="post-cats"><?php the_category( ' ' ); ?></div>
	<h1 class="entry-title"><?php the_title(); ?></h1>

		<div class="post-date">
			<?php
				edit_post_link(
					sprintf(
						/* translators: %s: Name of current post */
						esc_html__( 'Edit %s', 'barletta' ),
						the_title( '<span class="screen-reader-text">"', '"</span>', false )
					),
					'<span class="edit-link">',
					'</span>'
				);
			?>
		</div>

		<div class="entry-content">
			<?php the_content(); ?>
			<?php			
			wp_link_pages( array(
				'before'      => '<div class="page-links"><span class="page-links-title">' . __( 'Pages:', 'barletta' ) . '</span>',
				'after'       => '</div>',
				'link_before' => '<span>',
				'link_after'  => '</span>',
				'pagelink'    => '<span class="screen-reader-text">' . __( 'Page', 'barletta' ) . ' </span>%',
				'separator'   => '<span class="screen-reader-text">, </span>',
			) );
			?>
		</div>
	</div>
</article>