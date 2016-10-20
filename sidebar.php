<?php
/**
 * The Sidebar containing the main widget areas.
 *
 * @package Barletta
 */
?>
				</div>

				<?php
				/* read layout options */
				$show_sidebar = true;
				if( is_singular() && ( get_post_meta($post->ID, 'site_layout', true) ) ){
					if( get_post_meta($post->ID, 'site_layout', true) == 'no-sidebar' || get_post_meta($post->ID, 'site_layout', true) == 'mz-full-width' ) {
						$show_sidebar = false;               
					}
				} elseif( get_theme_mod( 'barletta_sidebar_position' ) == "no-sidebar" ||  get_theme_mod( 'barletta_sidebar_position' ) == "mz-full-width" ) {
					$show_sidebar = false;
				}
				$barletta_sidebar_id = "sidebar-1";
				if(  function_exists ( "is_woocommerce" ) && is_woocommerce()) {
					$barletta_sidebar_id = "WooCommerce Sidebar";
				}
				?>

			<?php if( $show_sidebar ): ?>            

				<div class="col-md-3">
					<div id="sidebar" class="sidebar">

						<?php if ( ! dynamic_sidebar( $barletta_sidebar_id ) ) : ?>
							<!-- sidebar-widget -->

							<div id="search" class="widget widget_search">
								<?php get_search_form(); ?>
							</div>

							<div id="archives" class="widget">
								<div class="widget-title"><span><?php esc_html_e( 'Archives', 'barletta' ); ?></span></div>
								<ul>
									<?php wp_get_archives( array( 'type' => 'monthly' ) ); ?>
								</ul>
							</div>

						<?php endif; /* dinamic_sidebar */ ?>

					</div>
				</div>

			<?php endif;