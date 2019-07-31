<?php
/**
 * Template part for displaying posts with format "image".
  * @package _pa
 */

_pa_container_tag_post();
	_pa_post_thumbnail('full');
	if ( ! has_post_thumbnail() ) {
		// No featured image defined. We'll need to find the first image within get_the_content().
	}
_pa_container_tag_post('end');