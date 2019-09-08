<?php
/**
 * Template part for displaying posts with format "image".
  * @package _pa
 */

_pa_container_tag_post();
	if ( has_post_thumbnail() ) {
		_pa_post_thumbnail('full');
	} else {
		preg_match('/<img.+src=[\'"](?P<src>.+?)[\'"].*>/i', get_the_content(), $first_image);
		_pa_post_thumbnail( 'full', find_post_id_from_path( $first_image['src'] ) );
	}
_pa_container_tag_post('end');