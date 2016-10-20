<?php
/**
 * Custom Recent Posts Widget
 *
 * @package Barletta
 */

class barletta_recent_posts extends WP_Widget
{
	function __construct(){

		$widget_ops = array('classname' => 'barletta-recent-posts','description' => esc_html__( "Barletta Recent Posts Widget", 'barletta') );
		parent::__construct('barletta_recent_posts', esc_html__('Barletta Recent Posts Widget','barletta'), $widget_ops);
		}

	function widget($args , $instance) {
		extract($args);
			$title = isset($instance['title']) ? esc_html( $instance['title'] ) : esc_html__('Recent Posts', 'barletta');
			$limit = isset($instance['limit']) ? esc_html( $instance['limit'] ) : 5;

		echo $before_widget;
		echo $before_title;
		echo $title;
		echo $after_title;

		/**
		* Widget Content
		*/
		?>

		<!-- recent posts -->
		<div class="widget-container">

			<?php

			$featured_args = array(
			'posts_per_page' => $limit ,
			'ignore_sticky_posts' => 1
			);

			$featured_query = new WP_Query($featured_args);

			if($featured_query->have_posts()) : while($featured_query->have_posts()) : $featured_query->the_post();

			?>

			<?php if(get_the_content() != '') : ?>

				<!-- post -->
				<div class="widget-post">

					<!-- image -->
					<div class="post-image <?php echo esc_attr(get_post_format()); ?>">

					<a href="<?php echo esc_url(get_permalink()); ?>">
						<?php if(get_post_format() != 'quote') { echo get_the_post_thumbnail(get_the_ID() , 'thumbnail'); } ?>
					</a>

					</div> <!-- end post image -->

					<!-- content -->
					<div class="post-body">

						<h2><a href="<?php echo esc_url(get_permalink()); ?>"><?php echo esc_attr(get_the_title()); ?></a></h2>
						<div class="post-meta"><span><?php echo esc_attr(get_the_date('d. M , Y')); ?></span><span><i class="fa fa-comment-o"></i> <?php echo get_comments_number(); ?></span></div>

					</div><!-- end content -->

				</div><!-- end post -->

			<?php endif; ?>

			<?php

			endwhile; endif; wp_reset_query();

			?>

		</div> <!-- end widget container -->

		<?php

		echo $after_widget;
		}

	function form($instance) {

		if(!isset($instance['title'])) $instance['title'] = esc_html__('recent Posts', 'barletta');
		if(!isset($instance['limit'])) $instance['limit'] = 5;

		?>

		<!-- Widget Title: Text Input -->
		<p>
			<label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title','barletta') ?>:</label>
			<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $instance['title']; ?>" />
		</p>

		<p>
			<label for="<?php echo $this->get_field_id('limit'); ?>"><?php esc_html_e('Limit Posts Number', 'barletta') ?></label>
			<input class="widefat" id="<?php $this->get_field_id('limit'); ?>" name="<?php echo $this->get_field_name('limit'); ?>" type="text" value="<?php echo esc_attr($instance['limit']); ?>" />
		</p>

	<?php
	}

	/**
	* Update values and sanitize widget form values as they are saved.
	*/
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['limit'] = ( ! empty( $new_instance['limit'] ) && is_numeric( $new_instance['limit'] )  ) ? esc_html( $new_instance['limit'] ) : '';

		return $instance;

	}

}