<?php
/**
 * Template part for displaying posts with format "status".
  * @package _pa
 */
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
			<div class="entry-content">
				<?php the_content(); ?>
				<?php echo '<strong>- ' . _pa_posted_by('return', false) . '</strong>'; ?>
			</div><!-- .entry-content -->
		</div>
	</div>
</div>