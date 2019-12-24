<?php
/**
 * _pa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _pa
 */

define('BUILD', 	get_stylesheet_directory_uri() . '/_build' );
define('JS', 		BUILD . '/js' );
define('CSS', 		BUILD . '/css' );
define('IMG', 		BUILD . '/images' );
define('FONTS', 	BUILD . '/webfonts' );

define('FUNCTIONS', get_template_directory() . '/_functions');
require_once( FUNCTIONS . '/global.php');
require_once( FUNCTIONS . '/widgets.php');
require_once( FUNCTIONS . '/scripts_styles.php');
require_once( FUNCTIONS . '/class-tgm-plugin-activation.php');
require_once( FUNCTIONS . '/tgmpa.php' );
require_once( FUNCTIONS . '/custom-header.php');
require_once( FUNCTIONS . '/template-tags.php');
require_once( FUNCTIONS . '/template-functions.php');
require_once( FUNCTIONS . '/customizer.php');
require_once( FUNCTIONS . '/jetpack.php');
