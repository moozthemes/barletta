<?php
/**
 * Custom functions that act independently of the theme templates
 *
 * Eventually, some of the functionality here could be replaced by core features
 *
 * @package Barletta
 */

/*
 * barletta Slider
 */
if ( ! function_exists( 'barletta_slider' ) ) :

/*
 * Featured image slider, displayed on front page for static page and blog
 */
function barletta_slider() {

	if ( ( is_home() || is_front_page() ) && true == get_theme_mod('show_barletta_slider') ) {

		echo '<div class="container">';
		echo '<div id="slider" class="main-slider"><ul class="mz-slider">';

		$count = 4;
		$slidecat = get_theme_mod( 'barletta_slider_cat' );
		$active_slide = "active";

		$query = new WP_Query( array( 'cat' => $slidecat,'posts_per_page' => $count ) );

		if ($query->have_posts()) :
			while ($query->have_posts()) : $query->the_post();

				echo '<li><div class="slider-item">';

				if ( (function_exists( 'has_post_thumbnail' )) && ( has_post_thumbnail() ) ) :
					echo get_the_post_thumbnail( get_the_ID(), 'barletta-large-thumbnail' );
				endif;

				echo '<div class="slide-title">';
				if ( get_the_title() != '' ) echo '<a href="' . esc_url(get_permalink()) . '"><h2 class="entry-title">'. get_the_title().'</h2></a>';
				echo '</div>';
				echo '</div>'; // .slider-item
				echo '</li>';
				$active_slide = "";

			endwhile; wp_reset_query();
		endif;

		echo '</ul></div>';
		echo '</div><!-- .container-->';
	}

}
endif;

/*
 * Add boostrap classes fot tables
 */
add_filter( 'the_content', 'barletta_add_custom_table_class' );

function barletta_add_custom_table_class( $content ) {
	return str_replace( '<table>', '<table class="table table-hover">', $content );
}

/**
 * Password protected post form using Boostrap classes
 */
add_filter( 'the_password_form', 'barletta_custom_password_form' );

function barletta_custom_password_form() {

	global $post;
	$label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );
	$o = 
	'<form class="protected-post-form" action="' . get_option('siteurl') . '/wp-login.php?action=postpass" method="post">
		<div class="row">
			<div class="col-md-12 password-form">
				' . esc_html__( "This post is password protected. To view it please enter your password below:" ,'barletta') . '
				<label for="' . $label . '">' . esc_html__( "Password:" ,'barletta') . ' </label>

				<div class="input-group">
				<input class="form-control" value="' . get_search_query() . '" name="post_password" id="' . $label . '" type="password">
				<span class="input-group-btn"><button type="submit" class="btn btn-default" name="submit" id="searchsubmit" value="' . esc_attr__( "Submit",'barletta' ) . '">' . esc_html__( "Submit" ,'barletta') . '</button></span>
				</div>

			</div>
		</div>
	</form>';

	return $o;

}