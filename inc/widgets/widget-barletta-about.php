<?php

/**
 * Homepage Team Section Widget
 *
 * @package Barletta
 *
 */

class barletta_about_author extends WP_Widget
{
	function __construct(){

		$widget_ops = array('classname' => 'widget-about-author','description' => esc_html__( "Widget to author" ,'barletta') );
		parent::__construct('barletta_about_author', esc_html__('Barletta About Author','barletta'), $widget_ops);

	}

	function widget($args , $instance) {
		extract($args);

		$title = isset($instance['title']) ? esc_html( $instance['title'] ) : esc_html__('About Me', 'barletta');
		$name = isset($instance['name']) ? $instance['name'] : '';
		$position = isset($instance['position']) ? $instance['position'] : '';
		$body_content = isset($instance['body_content']) ? $instance['body_content'] : '';
		$more_text_url = isset($instance['more_text_url']) ? $instance['more_text_url'] : '';
		$attachment_style = $instance[ 'attachment_style' ] ? 'on' : 'off';
		$attachment_id = isset($instance['attachment_id']) ? $instance['attachment_id'] : '';
		$attachment_url = isset($instance['attachment_url']) ? $instance['attachment_url'] : '';

		echo $before_widget;
		echo force_balance_tags($before_title.$title.$after_title);


		/**
		 * Widget Content
		 */

		if( $name != '' ) {

			if ($attachment_id != "") {
				$attachmentID = $attachment_id;
				$imageSizeName = "barletta-author-thumbnail";
				$img = wp_get_attachment_image_src($attachmentID, $imageSizeName);
				$imgsrc = $img[0];
			} elseif ($attachment_url != "") {
				$imgsrc = $attachment_url;
			}


			if ($attachment_style == 'on') {
				$attachment_css = "rounded";
			} else {
				$attachment_css = "";
			}
		?>

			<div class="author-item">
				<div class="author-image">
					<img src="<?php echo esc_url($imgsrc); ?>" alt="<?php echo esc_attr($name); ?>" class="<?php echo esc_attr($attachment_css); ?>" />
				</div>
				<div class="author-post">
					<h3><?php echo esc_attr($name); ?></h3>
					<div class="author-position"><?php echo esc_attr($position); ?></div>
					<p><?php echo esc_attr($body_content); ?></p>
					<div class="read-more"><a href="<?php echo esc_url($more_text_url); ?>"><?php _e('Read More','barletta'); ?></a></div>
				</div>
			</div>

		<?php }

		echo $after_widget;
	}

	function form($instance) {

		if(!isset($instance['title']) ) $instance['title']='';
		if(!isset($instance['name']) ) $instance['name']='';
		if(!isset($instance['body_content'])) $instance['body_content']='';        
		if(!isset($instance['position'])) $instance['position']='';        
		if(!isset($instance['more_text_url'])) $instance['more_text_url']='';        
		if(!isset($instance['attachment_style'])) $instance['attachment_style']='';        
		if(!isset($instance['attachment_id'])) $instance['attachment_id']='';        
		if(!isset($instance['attachment_url'])) $instance['attachment_url']='';        

	?>

		<p><label for="Title"><?php esc_html_e('Title ','barletta') ?></label>
			<input type="text" value="<?php echo esc_attr($instance['title']); ?>"
			name="<?php echo esc_attr($this->get_field_name('title')); ?>"
			id="<?php echo esc_attr($this->get_field_id('title')); ?>"
			class="widefat" />
		</p>

		<p><label for="Name"><?php esc_html_e('Name ','barletta') ?></label>
			<input type="text" value="<?php echo esc_attr($instance['name']); ?>"
			name="<?php echo esc_attr($this->get_field_name('name')); ?>"
			id="<?php echo esc_attr($this->get_field_id('name')); ?>"
			class="widefat" />
		</p>

		<p><label for="position"><?php esc_html_e('Position ','barletta') ?></label>
			<input type="text" value="<?php echo esc_attr($instance['position']); ?>"
			name="<?php echo esc_attr($this->get_field_name('position')); ?>"
			id="<?php echo esc_attr($this->get_field_id('position')); ?>"
			class="widefat" />
		</p>

		<p><label for="<?php echo esc_attr($this->get_field_id('body_content')); ?>"><?php esc_html_e('Content ','barletta') ?></label>
			<textarea name="<?php echo esc_attr($this->get_field_name('body_content')); ?>"
			id="<?php echo esc_attr($this->get_field_id('body_content')); ?>"
			class="widefat"
			rows="5" cols="20"><?php echo esc_attr($instance['body_content']); ?></textarea>
		</p>

		<p><label for="more_text_url"><?php esc_html_e('Link to more info ','barletta') ?></label>
			<input type="text" value="<?php echo esc_attr($instance['more_text_url']); ?>"
			name="<?php echo esc_attr( $this->get_field_name('more_text_url')); ?>"
			id="<?php echo esc_attr( $this->get_field_id('more_text_url')); ?>"
			class="widefat" />
		</p>

		<p><label for="attachment_style"><?php esc_html_e('Rounded Author Image? ','barletta') ?></label>
			<input type="checkbox" <?php checked( $instance[ 'attachment_style' ], 'on' ); ?> 
			name="<?php echo esc_attr($this->get_field_name( 'attachment_style' )); ?>" 
			id="<?php echo esc_attr($this->get_field_id( 'attachment_style' )); ?>" 
			class="checkbox" /> 
		</p>

		<p style="overflow: auto;">
			<!-- Image Thumbnail -->
			<a href="#" class="button custom_media_upload"><?php esc_html_e('Upload Image','barletta') ?></a>
			<img class="custom_media_image" src="<?php echo esc_attr($instance['attachment_url']); ?>" style="max-width:275px; float:left; margin: 0px 10px 0px 0px; display:inline-block;" />
			<input class="custom_media_url" type="hidden" name="<?php echo esc_attr($this->get_field_name('attachment_url')); ?>" value="<?php echo esc_attr($instance['attachment_url']); ?>">
			<input class="custom_media_id" type="hidden" name="<?php echo esc_attr($this->get_field_name('attachment_id')); ?>" value="<?php echo esc_attr($instance['attachment_id']); ?>">
		</p>

		<script type="text/javascript">
			jQuery(document).ready(function($){
				$('.custom_media_upload').click(function() {

				var send_attachment_bkp = wp.media.editor.send.attachment;

				wp.media.editor.send.attachment = function(props, attachment) {

				$('.custom_media_image').attr('src', attachment.url);
				$('.custom_media_url').val(attachment.url);
				$('.custom_media_id').val(attachment.id);

				wp.media.editor.send.attachment = send_attachment_bkp;
				}

				wp.media.editor.open();

				return false;
				});
			});
		</script>

	<?php }

	/**
	* Sanitize widget form values as they are saved.
	*
	* @see WP_Widget::update()
	*
	* @param array $new_instance Values just sent to be saved.
	* @param array $old_instance Previously saved values from database.
	*
	* @return array Updated safe values to be saved.
	*/
	public function update( $new_instance, $old_instance ) {

		$instance = array();
		$instance['title'] = ( ! empty( $new_instance['title'] ) ) ? esc_html( $new_instance['title'] ) : '';
		$instance['name'] = ( ! empty( $new_instance['name'] ) ) ? esc_html( $new_instance['name'] ) : '';
		$instance['body_content'] = ( ! empty( $new_instance['body_content'] ) ) ? esc_html( $new_instance['body_content'] ) : '';
		$instance['more_text_url'] = ( ! empty( $new_instance['more_text_url'] ) ) ? esc_html( $new_instance['more_text_url'] ) : '';
		$instance['position'] = ( ! empty( $new_instance['position'] ) ) ? esc_html( $new_instance['position'] ) : '';
		$instance['attachment_style'] = ( ! empty( $new_instance['attachment_style'] ) ) ? esc_html( $new_instance['attachment_style'] ) : '';
		$instance['attachment_id'] = ( ! empty( $new_instance['attachment_id'] ) ) ? esc_html( $new_instance['attachment_id'] ) : '';
		$instance['attachment_url'] = ( ! empty( $new_instance['attachment_url'] ) ) ? esc_html( $new_instance['attachment_url'] ) : '';

		return $instance;
	}

}

function enqueue_media() {
	if( function_exists( 'wp_enqueue_media' ) ) {
		wp_enqueue_media();
	}
}

add_action('admin_enqueue_scripts', 'enqueue_media');

?>