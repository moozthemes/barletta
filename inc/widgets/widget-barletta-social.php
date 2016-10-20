<?php
/**
 * Custom author widget
 *
 * @package Barletta
 */

class barletta_social_widget extends WP_Widget
{

	function __construct(){

	$widget_ops = array('classname' => 'barletta-social','description' => esc_html__( "Barletta Social Widget" ,'barletta') );
	parent::__construct('barletta-social', esc_html__('Barletta Social Widget','barletta'), $widget_ops);

	}

	/**
	* Helper function that holds widget fields
	* Array is used in update and form functions
	*/

	private function widget_fields() {
	$fields = array(
		// Title
		'widget_title' => array(
			'barletta_widgets_name'      => 'widget_title',
			'barletta_widgets_title'     => __( 'Title', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),

		// Other fields
		'twitter' => array (
			'barletta_widgets_name'      => 'twitter',
			'barletta_widgets_title'     => __( 'Twitter', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'facebook' => array (
			'barletta_widgets_name'      => 'facebook',
			'barletta_widgets_title'     => __( 'Facebook', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'linkedin' => array (
			'barletta_widgets_name'      => 'linkedin',
			'barletta_widgets_title'     => __( 'LinkedIn', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'google' => array (
			'barletta_widgets_name'      => 'google',
			'barletta_widgets_title'     => __( 'Google+', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'pinterest' => array (
			'barletta_widgets_name'      => 'pinterest',
			'barletta_widgets_title'     => __( 'Pinterest', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'youtube' => array (
			'barletta_widgets_name'      => 'youtube',
			'barletta_widgets_title'     => __( 'YouTube', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'vimeo' => array (
			'barletta_widgets_name'      => 'vimeo',
			'barletta_widgets_title'     => __( 'Vimeo', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'flickr' => array (
			'barletta_widgets_name'      => 'flickr',
			'barletta_widgets_title'     => __( 'Flickr', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'dribbble' => array (
			'barletta_widgets_name'      => 'dribbble',
			'barletta_widgets_title'     => __( 'Dribbble', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'tumblr' => array (
			'barletta_widgets_name'      => 'tumblr',
			'barletta_widgets_title'     => __( 'Tumblr', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'instagram' => array (
			'barletta_widgets_name'      => 'instagram',
			'barletta_widgets_title'     => __( 'Instagram', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'lastfm' => array (
			'barletta_widgets_name'      => 'lastfm',
			'barletta_widgets_title'     => __( 'Last.fm', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
		'soundcloud' => array (
			'barletta_widgets_name'      => 'soundcloud',
			'barletta_widgets_title'     => __( 'SoundCloud', 'barletta' ),
			'barletta_widgets_field_type'    => 'text'
		),
	);

	return $fields;

	}

	function widget($args , $instance) {

		extract($args);

		$widget_title = apply_filters('widget_title', $instance['title'] );

		echo $before_widget;

		// Show title
		if( isset( $widget_title ) ) {
			echo $before_title . $widget_title . $after_title;
		}

		/**
		* Widget Content
		*/
		?>

		<div class="widget-container">

			<?php
			echo '<div class="widget-socials">';

			// Loop through fields
			$widget_fields = $this->widget_fields();
			foreach( $widget_fields as $widget_field ) {

				// Make array elements available as variables
				extract( $widget_field );

				// Check if field has value and skip title field
				unset( $barletta_widgets_field_value );

				if( isset( $instance[$barletta_widgets_name] ) && 'widget_title' != $barletta_widgets_name ) { 

					$barletta_widgets_field_value = esc_url( $instance[$barletta_widgets_name] ); 

					if( '' != $barletta_widgets_field_value ) {  ?>

					<a href="<?php echo $barletta_widgets_field_value; ?>" title="<?php echo esc_attr($barletta_widgets_title); ?>"><i class="fa fa-<?php echo esc_attr($barletta_widgets_name); ?>"></i></a>

				<?php }
				}
			}
			echo '</div>';
			?>

		</div>

		<?php

		echo $after_widget;

	}

	/**
	* Update values and sanitize widget form values as they are saved.
	*/
	function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['rss'] = ( ! empty( $new_instance['rss'] ) ) ? esc_html( $new_instance['rss'] ) : '';
		$instance['facebook'] = ( ! empty( $new_instance['facebook'] ) ) ? esc_html( $new_instance['facebook'] ) : '';
		$instance['google'] = ( ! empty( $new_instance['google'] ) ) ? esc_html( $new_instance['google'] ) : '';
		$instance['twitter'] = ( ! empty( $new_instance['twitter'] ) ) ? esc_html( $new_instance['twitter'] ) : '';
		$instance['pinterest'] = ( ! empty( $new_instance['pinterest'] ) ) ? esc_html( $new_instance['pinterest'] ) : '';
		$instance['instagram'] = ( ! empty( $new_instance['instagram'] ) ) ? esc_html( $new_instance['instagram'] ) : '';
		$instance['tumblr'] = ( ! empty( $new_instance['tumblr'] ) ) ? esc_html( $new_instance['tumblr'] ) : '';
		$instance['lastfm'] = ( ! empty( $new_instance['lastfm'] ) ) ? esc_html( $new_instance['lastfm'] ) : '';
		$instance['soundcloud'] = ( ! empty( $new_instance['soundcloud'] ) ) ? esc_html( $new_instance['soundcloud'] ) : '';
		$instance['dribbble'] = ( ! empty( $new_instance['dribbble'] ) ) ? esc_html( $new_instance['dribbble'] ) : '';
		$instance['youtube'] = ( ! empty( $new_instance['youtube'] ) ) ? esc_html( $new_instance['youtube'] ) : '';
		$instance['flickr'] = ( ! empty( $new_instance['flickr'] ) ) ? esc_html( $new_instance['flickr'] ) : '';

		return $instance;

	}


	function form( $instance ) {

	/* Set up some default widget settings. */
	$defaults = array( 'title' => 'Follow Me', 'rss' => '', 'facebook' => '', 'twitter' => '', 
						'google' => '', 'pinterest' => '', 'instagram' => '', 'tumblr' => '', 'lastfm' => '',
						'soundcloud' => '', 'dribbble' => '', 'youtube' => '', 'flickr' => '');
	
	$instance = wp_parse_args( (array) $instance, $defaults ); ?>

	<!-- Widget Title: Text Input -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" type="text" value="<?php echo esc_attr($instance['title']); ?>" />
	</p>

	<p><?php _e('Enter full URL. If you don\'t want to display element, leave it\'s URL field empty.','barletta') ?></p>

	<!-- Facebook URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>"><?php _e('URL address of your Facebook profile or page','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'facebook' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'facebook' )); ?>" type="text" value="<?php echo esc_attr($instance['facebook']); ?>" />
	</p>

	<!-- Twitter URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>"><?php _e('URL address of your Twitter profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'twitter' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'twitter' )); ?>" type="text" value="<?php echo esc_attr($instance['twitter']); ?>" />
	</p>

	<!-- Google Plus URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'google' )); ?>"><?php _e('URL address of your Google+ profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'google' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'google' )); ?>" type="text" value="<?php echo esc_attr($instance['google']); ?>" />
	</p>    

	<!-- Pinterest URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>"><?php _e('URL address of your Pinterest profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'pinterest' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'pinterest' )); ?>" type="text" value="<?php echo esc_attr($instance['pinterest']); ?>" />
	</p>

	<!-- Instagram URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>"><?php _e('URL address of your Instagram profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'instagram' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'instagram' )); ?>" type="text" value="<?php echo esc_attr($instance['instagram']); ?>" />
	</p>

	<!-- Tumblr URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>"><?php _e('URL address of your Tumblr profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'tumblr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'tumblr' )); ?>" type="text" value="<?php echo esc_attr($instance['tumblr']); ?>" />
	</p>

	<!-- Dribbble URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'dribbble' )); ?>"><?php _e('URL address of your Dribbble profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'dribbble' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'dribbble' )); ?>" type="text" value="<?php echo esc_attr($instance['dribbble']); ?>" />
	</p>

	<!-- Last FM URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'lastfm' )); ?>"><?php _e('URL address of your Last FM profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'lastfm' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'lastfm' )); ?>" type="text" value="<?php echo esc_attr($instance['lastfm']); ?>" />
	</p>

	<!-- Soundcloud URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'soundcloud' )); ?>"><?php _e('URL address of your Soundcloud profile','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'soundcloud' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'soundcloud' )); ?>" type="text" value="<?php echo esc_attr($instance['soundcloud']); ?>" />
	</p>

	<!-- YouTube URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>"><?php _e('URL address of your YouTube channel','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'youtube' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'youtube' )); ?>" type="text" value="<?php echo esc_attr($instance['youtube']); ?>" />
	</p>

	<!-- Flickr URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>"><?php _e('URL address of your Flickr profile page','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'flickr' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'flickr' )); ?>" type="text" value="<?php echo esc_attr($instance['flickr']); ?>" />
	</p>

	<!-- RSS URL -->
	<p>
		<label for="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>"><?php _e('URL address of your RSS feed','barletta') ?>:</label>
		<input class="widefat" id="<?php echo esc_attr($this->get_field_id( 'rss' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'rss' )); ?>" type="text" value="<?php echo esc_attr($instance['rss']); ?>" style="width:90%;" />
	</p>

	<?php
	}

}