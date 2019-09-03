<?php
/**
 * _pa functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package _pa
 */

define('BUILD', get_stylesheet_directory_uri() . '/_build' );
define('JS', 	BUILD . '/js' );
define('CSS', 	BUILD . '/css' );
define('IMG', 	BUILD . '/images' );
define('FONTS', BUILD . '/webfonts' );

require_once( get_template_directory() . '/_functions/global.php');
require_once( get_template_directory() . '/_functions/widgets.php');
require_once( get_template_directory() . '/_functions/scripts_styles.php');
require_once( get_template_directory() . '/_functions/class-tgm-plugin-activation.php');
require_once( get_template_directory() . '/_functions/tgmpa.php' );
require_once( get_template_directory() . '/_functions/custom-header.php');
require_once( get_template_directory() . '/_functions/template-tags.php');
require_once( get_template_directory() . '/_functions/template-functions.php');
require_once( get_template_directory() . '/_functions/customizer.php');
require_once( get_template_directory() . '/_functions/jetpack.php');
