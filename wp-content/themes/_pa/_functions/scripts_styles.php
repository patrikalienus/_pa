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

		wp_register_script( 'jquery', JS . '/jquery-3.4.1.min.js', false, null, true ); // In footer
		wp_register_script( 'jquery-migrate', JS . '/jquery-migrate-3.1.0.min.js', 	array('jquery'), null, true ); // In footer
		wp_register_script( '_pa', JS . '/_pa-min.js', array('jquery'), null, true ); // In footer
		wp_register_script( 'components', JS . '/components-min.js', array('jquery'), null, true ); // In footer
		wp_register_script( 'prettify', JS . '/prettify/run_prettify.js?skin=sons-of-obsidian', array(), false, true); // Footer

		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-migrate' );
		wp_enqueue_script( '_pa' );
		wp_enqueue_script( 'components' );
		wp_enqueue_script( 'prettify' );
		wp_localize_script( 'prettify', 'codePrettifyLoaderBaseUrl', JS . '/prettify');
	}
}
add_action( 'wp_enqueue_scripts', '_pa_js' );

function _pa_css() {
	// I hate /style.css...
	//wp_enqueue_style( '_pa-style', get_stylesheet_uri() );

	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=DM+Serif+Display|Muli&display=swap', false, null, 'all' );
	wp_enqueue_style( 'primary', 				CSS . '/_pa.css', false, null, 'all' ); 
}
add_action( 'wp_enqueue_scripts', '_pa_css' );


/**
 * Add preload stuff to CSS files.
 */
function css_rel_preload($html, $handle, $href, $media) {
	if ( is_admin() || is_user_logged_in() ) {
		// nuffin.
	} else {
		$html = '<link rel="preload" as="style" onload="this.onload=null;this.rel=stylesheet" id="' . $handle . '" href="' . $href . '" type="text/css" media="all" />';
	}
	return $html;
}
// add_filter( 'style_loader_tag', 'css_rel_preload', 10, 4 );





add_action( 'wp_enqueue_scripts', 'add_prettify_scripts' );
function add_prettify_scripts() {
	
}
