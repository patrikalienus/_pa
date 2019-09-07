<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package _pa
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.0, user-scalable=no">
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div id="page" class="site">
	<header id="masthead" class="site-header">
		<?php
		// Disabled because I ended up not liking it.
		/* <a id="nav-expander" class="nav-expander"></a> */ ?>
		<nav class="" role="navigation">
			<?php
			wp_nav_menu( array(
				'theme_location'	=> 'menu-1',
				'depth'				=> 1, // no children
				'container'			=> 'div',
				'container_class'	=> 'primary-menu',
				'container_id'		=> 'main-menu',
				'menu_class'		=> 'pa-nav',
				'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
				'menu_id'			=> 'single-line-menu',
				'walker'			=> new WP_Bootstrap_Navwalker(),
			) );
			?>
		</nav>
	</header><!-- #masthead -->

	<?php
	// Disabled drawer.
	/* get_template_part( 'template-parts/drawer', 'nav' ); */ ?>
	
	<div id="content" class="site-content">
		