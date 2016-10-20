<?php
/**
 * The template used for displaying content single
 *
 * @package Barletta
 */
?>

				</div><!-- /.columns -->

			</div><!-- /.row -->
		</section><!-- /.container -->
		</div><!-- /.container -->

		<!-- back to top button -->
		<p id="back-top" style="display: block;">
			<a href="#top"><i class="fa fa-angle-up"></i></a>
		</p>

		<footer class="mz-footer">

			<!-- footer widgets -->
			<div class="container footer-inner">
				<div class="row row-gutter">
					<?php get_sidebar( 'footer' ); ?>
				</div>
			</div>

			<div class="footer-fullwidth">
					<?php get_sidebar( 'fullwidth-footer' ); ?>
			</div>

			<div class="footer-bottom">
				<?php do_action('barletta_footer'); ?>
			</div>
		</footer>

		<?php wp_footer(); ?>
		
	</body>
</html>