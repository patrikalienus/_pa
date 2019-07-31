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

		wp_register_script( 'jquery', 			BUILD . '/js/jquery-3.4.1.min.js', 			false, null, true ); // In footer
		wp_register_script( 'jquery-migrate',	BUILD . '/js/jquery-migrate-3.1.0.min.js', 	array('jquery'), null, true ); // In footer
		wp_enqueue_script( 'jquery' );
		wp_enqueue_script( 'jquery-migrate' );

		wp_enqueue_script( '_pa', 					BUILD . '/js/_pa-min.js',					array('jquery'), null, true ); // In footer
		wp_enqueue_script( '_components',			BUILD . '/js/components-min.js',			array('jquery'), null, true ); // In footer

		// These are all part of _components-min.js
		//wp_enqueue_script( 'bootstrap', 			BUILD . '/js/bootstrap.min-min.js',			array('jquery'), null, true ); // In footer
		//wp_enqueue_script( 'cleave',				BUILD . '/js/cleave-min.js',				array('jquery'), null, true ); // In footer
		//wp_enqueue_script( 'fancybox',				BUILD . '/js/jquery.fancybox-min.js',		array('jquery'), null, true ); // In footer
		//wp_enqueue_script( 'shave',				BUILD . '/js/jquery.shave-min.js',			array('jquery'), null, true ); // In footer

		//wp_enqueue_script( 'popper', 				BUILD . '/js/popper.min-min.js',			false, null, true ); // In footer
		//wp_enqueue_script( 'scrollreveal',			BUILD . '/js/scrollreveal-min.js',			false, null, true ); // In footer
		//wp_enqueue_script( 'superembed',			BUILD . '/js/superembed-min.js',			false, null, true ); // In footer
		//wp_enqueue_script( 'tooltip',				BUILD . '/js/tooltip.min-min.js',			false, null, true ); // In footer
	}
}
add_action( 'wp_enqueue_scripts', '_pa_js' );

function _pa_css() {
	// I hate /style.css...
	//wp_enqueue_style( '_pa-style', get_stylesheet_uri() );

	wp_enqueue_style( 'googlefonts', 'https://fonts.googleapis.com/css?family=DM+Serif+Display|Muli&display=swap', false, null, 'all' ); // no deps, no version, show on all devices
	wp_enqueue_style( 'primary', get_stylesheet_directory_uri() . '/_build/css/_pa.css', false, null, 'all' ); // no deps, no version, show on all devices
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


/**
 * Setting the theme for Prettify.
 */
if ( function_exists('add_prettify_scripts') ) {
	add_filter( 'prettify_skin', function() {
		return 'Sons-Of-Obsidian';
	} );
}