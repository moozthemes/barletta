<?php
/**
 * The template used for displaying content single
 *
 * @package Barletta
 */
?>

<article  id="post-<?php the_ID(); ?>">
	<div class="blog-post-image">

	<?php if ( has_post_thumbnail() ) : ?>
		<?php
			$barletta_thumb_size = get_theme_mod( 'barletta_sidebar_position' );
			if ($barletta_thumb_size == 'mz-full-width') $barletta_thumbnail = 'barletta-large-thumbnail';
			else $barletta_thumbnail = 'barletta-thumbnail';
		?>
		<a href="<?php the_permalink(); ?>" title="<?php the_title_attribute(); ?>">
		<?php echo get_the_post_thumbnail( get_the_ID(), $barletta_thumbnail ); ?>
		</a>
	<?php endif; ?>
		
	</div>
	<div class="blog-post">

		<header class="entry-header">
			<div class="post-cats"><?php the_category( ' ' ); ?></div>
			<h1 class="entry-title"><?php the_title(); ?></h1>

	<?php if ( 'post' == get_post_type() ) : ?>
			<div class="entry-meta">
				<span><?php the_author_posts_link(); ?></span>/<span><i class="fa fa-clock-o"></i><?php echo get_the_date(); ?></span>/

				<?php if ( ! post_password_required() && ( comments_open() || '0' != get_comments_number() ) ) : ?>
					<span><i class="fa fa-comment-o"></i><?php comments_popup_link( esc_html__( 'Leave a comment', 'barletta' ), esc_html__( '1 Comment', 'barletta' ), esc_html__( '% Comments', 'barletta' ) ); ?></span>
				<?php else: ?>
					<span class="post-comments-off"><i class="fa fa-comment-o"></i><?php esc_html_e( 'Comments Off', 'barletta' ); ?></span>
				<?php endif; ?>

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
	<?php endif; ?>

		</header>

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
	<?php if(has_tag()) : ?>
	<!-- tags -->
	<div class="entry-tags">
		<span>
			<i class="fa fa-tags"></i>
		</span>
		<?php
			$tags = get_the_tags(get_the_ID());
			foreach($tags as $tag){
				echo '<a href="'.get_tag_link($tag->term_id).'">'.$tag->name.'</a> ';
			}
		?>

	</div>
	<!-- end tags -->
	<?php endif; ?>

	</div>
</article>
