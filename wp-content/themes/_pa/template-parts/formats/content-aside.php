<?php
/**
 * Template part for displaying posts with format "aside".
  * @package _pa
 */
?>
<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2 aside">
			<aside>
				<?php _pa_post_thumbnail(); ?>
				<div class="entry-content">
					<?php the_content(); ?>
				</div><!-- .entry-content -->
			</aside>
		</div>
	</div>
</div>