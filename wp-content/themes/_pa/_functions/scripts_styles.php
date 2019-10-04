<?php
/**
 * Enqueue scripts and styles.
 */
function _pa_js() {
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
	if ( ! is_admin() ) {
		// None of this is needed on the admin side
		wp_deregister_script( 'jquery' );
		wp_deregister_script( 'jquery-migrate' );

		wp_register_script( 'jquery', JS . '/jquery-min.js', false, null, true ); // In footer
		//wp_register_script( 'jquery-migrate', JS . '/jquery-migrate-3.1.0.min.js', 	array('jquery'), null, true ); // In footer
		//wp_register_script( '_pa', JS . '/_pa-min.js', array('jquery'), null, true ); // In footer
		wp_register_script( 'components', JS . '/components-min.js', array('jquery'), null, true ); // In footer
		wp_register_script( 'prettify', JS . '/prettify/run_prettify.js?skin=sons-of-obsidian', array(), false, true); // Footer

		wp_enqueue_script( 'jquery' );
		//wp_enqueue_script( 'jquery-migrate' );
		//wp_enqueue_script( '_pa' );
		wp_enqueue_script( 'components' );
		wp_enqueue_script( 'prettify' );
		wp_localize_script( 'prettify', 'codePrettifyLoaderBaseUrl', JS . '/prettify');
	}
}
add_action( 'wp_enqueue_scripts', '_pa_js' );

function _pa_css() {
	/**
	 * I really despise the style.css crap that WordPress doesn't seem to want to get away from.
	 * Theme information should not be inside a file that is loaded on the front-end. Sure, the
	 * number of bytes is small, but that doesn't matter - it's a matter of principle. It's not
	 * optimized by default, which is wrong.
	 * 
	 * Therefore, if you include style.css in the front-end, you're doing it wrong.
	 * WP is doing it wrong.
	 * I'm correcting it here by not including it.
	 */
	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=DM+Serif+Display|Muli&display=swap', false, null, 'all' );
	wp_enqueue_style( 'primary', 				CSS . '/_pa.css', false, null, 'all' );
}
add_action( 'wp_enqueue_scripts', '_pa_css' );


/**
 * Add preload stuff to CSS files.
 */
function _pa_css_rel_preload( $html, $handle, $href, $media ) {
	if ( ! is_admin() ) {
		$html = '<link rel="preload" as="style" onload="this.onload=null;this.rel=\'stylesheet\' " id="' . $handle . '" href="' . $href . '" type="text/css" media="all" />';
	}
	return $html;
}
add_filter( 'style_loader_tag', '_pa_css_rel_preload', 10, 4 );

/**
 * This takes the content of /_build/css/_critical.css and injects it into <head> within <style> tags.
 * 
 * MASSIVE props to Jonas for the generator: https://jonassebastianohlsson.com/criticalpathcssgenerator/
 * 
 */
function _pa_critical_css() {
	$critical_css = file_get_contents( CSS . '/_critical.css');
	echo '<style>' . $critical_css . '</style>';
}
add_action('wp_head', '_pa_critical_css');
