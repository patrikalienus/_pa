<?php
/**
 * Template part for displaying posts with format "audio".
  * @package _pa
 */

if ( is_singular() ) {
	_pa_title_in_post_thumbnail();
} else { 
	_pa_title_on_archive_pages();
	_pa_post_thumbnail();
}

_pa_container_tag_post(); ?>
	<div class="col-xs-12 col-xsm-12 col-sm-12 col-md-10 col-lg-10 col-xl-12 offset-md-1 offset-lg-1 offset-xl-0">
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

		<footer class="entry-footer">
			<?php _pa_post_footer(); ?>
		</footer><!-- .entry-footer -->
	</div>
<?php _pa_container_tag_post('end'); ?>