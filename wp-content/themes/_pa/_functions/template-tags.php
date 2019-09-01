<?php
/**
 * Custom template tags for this theme
 * 
 * I'm allergic to the endif shit, so I will stand by the {} notation.
 * 
 * @package _pa
 */

if ( ! function_exists( '_pa_posted_on' ) ) {
	/**
	 * Prints HTML with meta information for the current post-date/time.
	 */
	function _pa_posted_on() {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			// 															 _1__  _2__											_3__  _4__
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <span class="modified">/<time class="updated" datetime="%3$s">%4$s</time></span>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ), // _1__
			esc_html( get_the_date('Y-m-d') ), // _2__
			esc_attr( get_the_modified_date( DATE_W3C ) ), // _3__
			esc_html( get_the_modified_date('Y-m-d H:i') ) // _4__
		);
		/*
		$posted_on = sprintf(
			// translators: %s: post date.
			esc_html_x( 'Posted on %s', 'post date', '_pa' ),
			'<a href="' . esc_url( get_permalink() ) . '" rel="bookmark">' . $time_string . '</a>'
		);
		*/
		echo '<div class="posted-on">' . $time_string . '</div>';
	}
}

if ( ! function_exists( '_pa_posted_by' ) ) {
	/**
	 * Prints HTML with meta information for the current author.
	 * @param method
	 * @param div
	 * 
	 * the 'method' param takes either 'echo' or 'return' and is pretty self-explanatory.
	 * the 'div' param is boolean and merely defines if the output returned/echo'd is wrapped in a div or not.
	 */
	function _pa_posted_by($method = 'echo', $div = true) {
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', '_pa' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		if ($div) {
			$fullstring = '<div class="byline"> ' . $byline . '</div>';
		} else {
			$fullstring = $byline;
		}
		
		if ($method == 'return') {
			return $fullstring;
		} else {
			echo $fullstring;
		}
	}
}







// REMOVE LATER WHEN ALL REFERENCES HAVE BEEN REMOVED.
if ( ! function_exists( '_pa_entry_footer' ) ) {
	/**
	 * Prints HTML with meta information for the categories, tags and comments.
	 */
	function _pa_entry_footer() {
		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', '_pa' ) );
			if ( $categories_list || $tags_list ) {
				printf( '<div class="tagged">' );
			}
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				printf( '<span class="cat-links">' . esc_html__( 'Posted in %1$s', '_pa' ) . '</span>', $categories_list ); // WPCS: XSS OK.
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ', ', 'list item separator', '_pa' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				printf( '<span class="tags-links">' . esc_html__( 'Tagged %1$s', '_pa' ) . '</span>', $tags_list ); // WPCS: XSS OK.
			}
			if ( $categories_list || $tags_list ) {
				printf( '</div>' );
			}
		}

		/* I... I... don't want this.
		if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
			echo '<span class="comments-link">';
			comments_popup_link(
				sprintf(
					wp_kses(
						// translators: %s: post title
						__( 'Leave a Comment<span class="screen-reader-text"> on %s</span>', '_pa' ),
						array(
							'span' => array(
								'class' => array(),
							),
						)
					),
					get_the_title()
				)
			);
			echo '</span>';
		}
		*/
	}
}


if ( ! function_exists( '_pa_post_footer' ) ) {
	function _pa_post_footer() {
		/**
		 * Posted on/modified at date's.
		 */
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			// 															 _1__  _2__											_3__  _4__
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time> <span class="modified"><time class="updated" datetime="%3$s">%4$s</time></span>';
		}
		$time_string = sprintf( $time_string,
			esc_attr( get_the_date( DATE_W3C ) ), // _1__
			esc_html( get_the_date('Y-m-d') ), // _2__
			esc_attr( get_the_modified_date( DATE_W3C ) ), // _3__
			esc_html( get_the_modified_date('Y-m-d H:i') ) // _4__
		);
		$post_date_output = '<div class="post-date">' . $time_string . '</div>';


		/**
		 * Tags and categories smashed together because reall, who cares at this point.
		 * Tags are used by instagram models and celebrities anyways, so anyone using
		 * this theme shouldn't be bothering with such silly things.
		 * 
		 * Categories and tags are hidden on any post type except posts by default. Remove
		 * that if-statement if you wanna use this function for anything else. Or change it, whatever.
		 * 
		 * Just don't pull request this because I'm not gonna care.
		 */
		if ( 'post' === get_post_type() ) {
			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list( esc_html__( ', ', '_pa' ) );
			
			if ( $categories_list ) {
				/* translators: 1: list of categories. */
				$cats_output = '<span class="cat-links">' . strtolower($categories_list) . '</span>';
			}

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list( '', esc_html_x( ' ', 'list item separator', '_pa' ) );
			if ( $tags_list ) {
				/* translators: 1: list of tags. */
				$tags_output = '<span class="tags-links">' . strtolower($tags_list) . '</span>';
			}
			// If both tags and categories have content, add a separator in between them.
			if ( isset($tags_output) && isset($cats_output) ) {
				$separator = ', ';
			} else {
				$separator = '';
			}
			if ( !isset($tags_output) ) { $tags_output = ' '; }
			if ( !isset($cats_output) ) { $cats_output = ' '; }
			$tagged_output = '<div class="tagged">' . $cats_output . $separator . $tags_output . '</div>';
		}


		/**
		 * Author info
		 */
		$byline = sprintf(
			/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', '_pa' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);
		$post_author_output = '<div class="posted-by">' . $byline . '</div>';


		/**
		 * Echo it all.
		 */
		echo $post_date_output . $tagged_output . $post_author_output;
	}
}











if ( ! function_exists( '_pa_title_in_post_thumbnail' ) ) {
	/**
	 * Displays the post thumbnail and title of the post.
	 * if no featured image is selected, only the title will be displayed.
	 */
	function _pa_title_in_post_thumbnail() {
		$fimage_id		= get_post_thumbnail_id();
		
		$image 			= wp_get_attachment_image_src( $fimage_id, '_pa-wide-narrow', false )[0];
		
		$image_alt		= get_post_meta($fimage_id, '_wp_attachment_image_alt', TRUE); if ( ! $image_alt ) { $image_alt = get_the_title(); }
		$image_title	= get_the_title($fimage_id); if ( ! $image_title ) { $image_title = get_the_title(); }

		$post_title_output = '
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-10 col-xl-10 offset-lg-1 offset-xl-1 post-title-container"><h1 class="entry-title"> ' . get_the_title() . '</h1></div>
			</div>
		</div>';
		if ( post_password_required() || is_attachment() ) {
			return;
		}
		if ( has_post_thumbnail() ) { ?>
			<figure class="post-thumbnail stretch">
				<img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
				<?php echo $post_title_output; ?>
			</figure><?php
		} else {
			echo $post_title_output;
		}
	}
}

if ( ! function_exists( '_pa_post_thumbnail' ) ) {
	/**
	 * Displays an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function _pa_post_thumbnail($size = '_pa-wide-narrow') {
		if ( post_password_required() || is_attachment() || ! has_post_thumbnail() ) {
			return;
		}
		$fimage_id		= get_post_thumbnail_id();
		$image 			= wp_get_attachment_image_src( $fimage_id, $size, false )[0];
		
		$image_alt		= get_post_meta($fimage_id, '_wp_attachment_image_alt', TRUE); if ( ! $image_alt ) { $image_alt = get_the_title(); }
		$image_title	= get_the_title($fimage_id); if ( ! $image_title ) { $image_title = get_the_title(); }

		if ( is_singular() ) { ?>
			<figure class="post-thumbnail stretch">
				<img src="<?php echo $image; ?>" alt="<?php echo $image_alt; ?>">
			</figure><?php
		} else { ?>
			<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
				<figure class="post-thumbnail">
					<a class="post-thumbnail" href="<?php the_permalink(); ?>" aria-hidden="true" tabindex="-1">
					<?php
						the_post_thumbnail( $size, array(
							'alt' => the_title_attribute( array( 'echo' => false) ),						'class'  => 'img-fluid',
						) );
						?>
					</a>
				</figure>
			</div>
			<?php
		} // End is_singular().
	}
}



if ( ! function_exists('_pa_title_on_archive_pages') ) {
	/**
	 * This merely echo's the title on posts on archive pages.
	 */
	function _pa_title_on_archive_pages() {
		echo '
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
			<header class="entry-header">';
				the_title( '<h2 class="entry-title"><a href="' . esc_url( get_permalink() ) . '" rel="bookmark">', '</a></h2>' );
			echo '</header><!-- .entry-header -->
		</div>
		';
	}
}




if ( ! function_exists('_pa_container_tag_post') ) {
	/**
	 * This injects container HTML if we're on a single post.
	 * This is so that we don't have unnecessary nesting of .container>.row's when index.php is in effect.
	 * 
	 * @param $loc
	 * 
	 * It takes only one optional parameter: loc.
	 * If it's 'end', it'll inject the $container_tag['end'], otherwise $container_tag['start'].
	 * 
	 */
	function _pa_container_tag_post($loc = 'start') {
		if ( is_singular() ) {
			$container_tag['start'] = '<div class="container"><div class="row">';
			$container_tag['end'] = '</div></div>';
		} else {
			$container_tag['start'] = '';
			$container_tag['end'] = '';
		}
		
		if ($loc == 'end') {
			echo $container_tag['end'];
		} else {
			echo $container_tag['start'];
		}
	}
}