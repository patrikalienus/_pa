<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package _pa
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function _pa_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', '_pa_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function _pa_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', '_pa_pingback_header' );


/**
 * This function filters the post content when viewing a post with the "chat" post format. It formats the
 * content with structured HTML markup to make it easy for theme developers to style chat posts.
 * 
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $content The content of the post.
 * @return string $chat_output The formatted content of the post.
 */
add_filter( 'the_content', 'my_format_chat_content' );
add_filter( 'my_post_format_chat_text', 'wpautop' );

function my_format_chat_content( $content ) {
	global $_post_format_chat_ids;

	if ( ! has_post_format( 'chat' ) ) {
		return $content;
	}
	
	$_post_format_chat_ids = array(); // Set the global variable of speaker IDs to a new, empty array for this chat.
	$separator = apply_filters( 'my_post_format_chat_separator', ':' ); // Allow the separator (separator for speaker/text) to be filtered.
	$chat_output = "\n\t\t\t" . '<div id="chat-transcript-' . esc_attr( get_the_ID() ) . '" class="chat-transcript">'; // Open the chat transcript div and give it a unique ID based on the post ID.
	$chat_rows = preg_split( "/(\r?\n)+|(<br\s*\/?>\s*)+/", $content ); // Split the content to get individual chat rows.

	/**
	 * Loop through each row and format the output.
	 */
	foreach ( $chat_rows as $chat_row ) {
		/* If a speaker is found, create a new chat row with speaker and text. */
		if ( strpos( $chat_row, $separator ) ) {
			/* Split the chat row into author/text. */
			$chat_row_split = explode( $separator, trim( $chat_row ), 2 );

			/* Get the chat author and strip tags. */
			$chat_author = strip_tags( trim( $chat_row_split[0] ) );

			/* Get the chat text. */
			$chat_text = trim( $chat_row_split[1] );

			/* Get the chat row ID (based on chat author) to give a specific class to each row for styling. */
			$speaker_id = my_format_chat_row_id( $chat_author );

			/* Open the chat row. */
			$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

			/* Add the chat row author. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-author ' . sanitize_html_class( strtolower( "chat-author-{$chat_author}" ) ) . ' vcard"><cite class="fn">' . apply_filters( 'my_post_format_chat_author', $chat_author, $speaker_id ) . '</cite>' . $separator . '</div>';

			/* Add the chat row text. */
			$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_text, $chat_author, $speaker_id ) ) . '</div>';

			/* Close the chat row. */
			$chat_output .= "\n\t\t\t\t" . '</div><!-- .chat-row -->';
		}

		/**
		 * If no author is found, assume this is a separate paragraph of text that belongs to the
		 * previous speaker and label it as such, but let's still create a new row.
		 */
		else {
			/* Make sure we have text. */
			if ( !empty( $chat_row ) ) {

				/* Open the chat row. */
				$chat_output .= "\n\t\t\t\t" . '<div class="chat-row ' . sanitize_html_class( "chat-speaker-{$speaker_id}" ) . '">';

				/* Don't add a chat row author.  The label for the previous row should suffice. */

				/* Add the chat row text. */
				$chat_output .= "\n\t\t\t\t\t" . '<div class="chat-text">' . str_replace( array( "\r", "\n", "\t" ), '', apply_filters( 'my_post_format_chat_text', $chat_row, $chat_author, $speaker_id ) ) . '</div>';

				/* Close the chat row. */
				$chat_output .= "\n\t\t\t</div><!-- .chat-row -->";
			}
		}
	}

	/* Close the chat transcript div. */
	$chat_output .= "\n\t\t\t</div><!-- .chat-transcript -->\n";

	/* Return the chat content and apply filters for developers. */
	return apply_filters( 'my_post_format_chat_content', $chat_output );
}

/**
 * This function returns an ID based on the provided chat author name.  It keeps these IDs in a global
 * array and makes sure we have a unique set of IDs.  The purpose of this function is to provide an "ID"
 * that will be used in an HTML class for individual chat rows so they can be styled.  So, speaker "John"
 * will always have the same class each time he speaks.  And, speaker "Mary" will have a different class
 * from "John" but will have the same class each time she speaks.
 *
 * @author David Chandra
 * @link http://www.turtlepod.org
 * @author Justin Tadlock
 * @link http://justintadlock.com
 * @copyright Copyright (c) 2012
 * @license http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 * @link http://justintadlock.com/archives/2012/08/21/post-formats-chat
 *
 * @global array $_post_format_chat_ids An array of IDs for the chat rows based on the author.
 * @param string $chat_author Author of the current chat row.
 * @return int The ID for the chat row based on the author.
 */
function my_format_chat_row_id( $chat_author ) {
	global $_post_format_chat_ids;

	$chat_author = strtolower( strip_tags( $chat_author ) ); /* Sanitize the chat author to avoid  "Join" vs "john". */
	$_post_format_chat_ids[] = $chat_author; /* Add the chat author to the array. */
	$_post_format_chat_ids = array_unique( $_post_format_chat_ids ); /* Make sure the array only holds unique values. */
	return absint( array_search( $chat_author, $_post_format_chat_ids ) ) + 1; /* Return array key for the author and add "1" to avoid ID "0". */
}

/**
 * Numeric Posts Navigation
 * Courtesy of: https://www.wpbeginner.com/wp-themes/how-to-add-numeric-pagination-in-your-wordpress-theme/
 * 
 * @var wp_query
 * @var paged
 * @var max
 * @var links
 * @var class
 */
function _pa_numeric_posts_nav() {
	global $wp_query;
	if ( is_singular() || $wp_query->max_num_pages <= 1 ) {
		return;
	}

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	/** Add current page to the array */
	if ( $paged >= 1 )
		$links[] = $paged;

	/** Add the pages around the current page to the array */
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	// Start the list.
	echo '<div class="pagination-nav"><ul>' . "\n";

	/** Previous Post Link */
	if ( get_previous_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_previous_posts_link( __( '« ' ) ) );
	}

	/** Link to first page, plus ellipses if necessary */
	if ( ! in_array( 1, $links ) ) {
		$class = 1 == $paged ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( 1 ) ), '1' );
		if ( ! in_array( 2, $links ) ) {
			echo '<li>…</li>';
		}
	}

	/** Link to current page, plus 2 pages in either direction if necessary */
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $link ) ), $link );
	}

	/** Link to last page, plus ellipses if necessary */
	if ( ! in_array( $max, $links ) ) {
		if ( ! in_array( $max - 1, $links ) ) {
			echo '<li>…</li>' . "\n";
		}
		$class = $paged == $max ? ' class="active"' : '';
		printf( '<li%s><a href="%s">%s</a></li>' . "\n", $class, esc_url( get_pagenum_link( $max ) ), $max );
	}

	/** Next Post Link */
	if ( get_next_posts_link() ) {
		printf( '<li>%s</li>' . "\n", get_next_posts_link( __( ' »' ) ) );
	}

	// Finalize the list.
	echo '</ul></div>' . "\n";
}

