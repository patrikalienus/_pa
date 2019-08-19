<?php
/**
 * Template part for displaying posts with format "audio".
  * @package _pa
 */

_pa_container_tag_post(); ?>
	<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
		<div class="entry-content">
			<blockquote cite="<?php echo get_the_title(); ?>">
				<?php
				echo strip_tags( get_the_content() );
				echo sprintf( ' <strong>- %1$s</strong>', get_the_title() );
				?>
			</blockquote>
		</div><!-- .entry-content -->
	</div>
<?php _pa_container_tag_post('end'); ?>