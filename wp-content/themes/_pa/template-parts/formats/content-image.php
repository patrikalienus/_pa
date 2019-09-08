<?php
/**
 * Template part for displaying posts with format "image".
  * @package _pa
 */

_pa_container_tag_post();
	if ( has_post_thumbnail() ) {
		_pa_post_thumbnail('full');
	} else {
		/**
		 * Get the post thumbnail from the post id found based on image path, in turn found within the content.
		 */
		_pa_post_thumbnail( 'full', find_post_id_from_path( _pa_find_first_img_tag( get_the_content() ) ) );
	}
_pa_container_tag_post('end');