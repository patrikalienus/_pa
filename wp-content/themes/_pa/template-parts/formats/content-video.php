<?php
/**
 * Template part for displaying posts with format "audio".
  * @package _pa
 */

_pa_container_tag_post(); ?>
	<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
		<div class="entry-content"><?php
			the_content( sprintf(
				wp_kses(
					/* translators: %s: Name of current post. Only visible to screen readers */
					__( 'Continue reading<span class="screen-reader-text"> "%s"</span>', '_pa' ),
					array(
						'span' => array(
							'class' => array(),
						),
					)
				),
				get_the_title()
			) );
			?>
		</div><!-- .entry-content -->
	</div>
<?php _pa_container_tag_post('end'); ?>