<?php
/*
	Plugin Name: _pa Tweaks
	Plugin URI: http://www.alienus.se
	Description: Removes junk *I* don't need, adds useful stuff for the Admin view. It doesn't add any external files or other performance decreasing things.
	Version: 1.2
	Author: Patrik Alienus
	Author URI: http://www.alienus.se
	Copyright: CC0. I.e. do what you want. I claim no copyright.
*/

/* 	--------------------------------------------
	$DASHBOARD
	-------------------------------------------- */

// Add CPTs to WP-ADMIN Right Now-Widget
function vm_right_now_content_table_end() {
	$args = array(
		'public' => true,
		'_builtin' => false
	);
	$output = 'object';
	$operator = 'and';
	$post_types = get_post_types( $args , $output , $operator );
	foreach($post_types as $post_type) {
		$num_posts = wp_count_posts( $post_type->name );
		$num = number_format_i18n( $num_posts->publish );
		$text = _n($post_type->labels->singular_name, $post_type->labels->name , intval($num_posts->publish));
		if (current_user_can( 'edit_posts')) {
			$cpt_name = $post_type->name;
		}
		echo '<li class="'.$cpt_name.'-count"><tr><a href="edit.php?post_type='.$cpt_name.'"><td class="first b b-' . $post_type->name . '"></td>' . $num . ' <td class="t ' . $post_type->name . '">' . $text . '</td></a></tr></li>';
	}
	$taxonomies = get_taxonomies( $args , $output , $operator );
	foreach( $taxonomies as $taxonomy ) {
		$num_terms  = wp_count_terms( $taxonomy->name );
		$num = number_format_i18n( $num_terms );
		$text = _n( $taxonomy->labels->name, $taxonomy->labels->name , intval( $num_terms ));
		if ( current_user_can( 'manage_categories' ) ) {
			$cpt_tax = $taxonomy->name;
		}
		echo '<li class="post-count"><tr><a href="edit-tags.php?taxonomy='.$cpt_tax.'"><td class="first b b-' . $taxonomy->name . '"></td>' . $num . ' <td class="t ' . $taxonomy->name . '">' . $text . '</td></a></tr></li>';
	}
}
add_action('dashboard_glance_items', 'vm_right_now_content_table_end' );


/**
 * 
 * Self-explanatory I think.
 * 
 * I truly dislike a lot of the dashboard widgets. They clutter up my workspace and thus, I remove them.
 * You can disable or modify this as you please.
 * 
 */
function remove_dashboard_widgets() {
	global $wp_meta_boxes;
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_quick_press']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_incoming_links']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_plugins']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_drafts']);
	unset($wp_meta_boxes['dashboard']['normal']['core']['dashboard_recent_comments']);
	unset($wp_meta_boxes['dashboard']['side']['core']['dashboard_primary']);
	remove_meta_box( 'dashboard_activity', 'dashboard', 'normal');
}
add_action('wp_dashboard_setup', 'remove_dashboard_widgets' );



/* 	--------------------------------------------
	$LOGIN PAGE
	-------------------------------------------- */

// Replace the login logo and some other stuff
function namespace_login_headerurl( $url ) {
	$url = home_url( '/' );
	return $url;
}
add_filter( 'login_headerurl', 'namespace_login_headerurl' );

function namespace_login_headertitle( $title ) {
	$title = 'Log in to' . get_bloginfo( 'name' );
	return $title;
}
add_filter( 'login_headertitle', 'namespace_login_headertitle' );

/**
 * 
 * Change the logo and the background of the login page, if the files exist.
 * Requires /_hc/logo.png and /_hc/loginbg.png to be present in order to show up.
 * Change this as you see fit.
 * 
 */
clearstatcache();
$siteRoot = "{$_SERVER['DOCUMENT_ROOT']}";
$logo = '/_hc/logo.png';
$loginBG = '/_hc/loginbg.png';

if ( file_exists( realpath($siteRoot . $logo) ) ) {
	$GLOBALS['logo_css'] = '
	.login h1 a {
		background-image: url("' .$logo. '") !important;
		width: 322px;
		height: 100px;
		background-size: contain;
		background-position: center center;
	}';
} else {
	$logo_file = '';
}
if ( file_exists( realpath($siteRoot . $loginBG) ) ) {
	$GLOBALS['loginbg_css'] = '
	body {
		background-image: url("' .$loginBG. '");
		background-repeat: no-repeat;
		-webkit-background-size: cover;
		-moz-background-size: cover;

		background-size: cover;
	}

	a {
		color: #fff !important;
		transition: all .3s ease;
	}
	a:hover {
		color: #000 !important;
		text-shadow: 0 0 5px #ffffff;
	}';
}

function namespace_login_style() {
	echo '<style>';
	echo $GLOBALS['logo_css'] . $GLOBALS['loginbg_css'];
	echo '</style>';
}
add_action( 'login_head', 'namespace_login_style' );
