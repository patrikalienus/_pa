<?php
/**
 * Courtesy of: https://codepen.io/ckayra/pen/eNrGXZ
 */
?>
<nav class="drawer-nav" role="navigation">
	<?php
	wp_nav_menu( array(
		'theme_location'	=> 'menu-1',
		'depth'				=> 2, // 1 = no dropdowns, 2 = with dropdowns.
		'container'			=> 'div',
		'container_class'	=> 'primary-menu',
		'container_id'		=> 'main-menu',
		'menu_class'		=> 'navbar-nav mr-auto',
		'fallback_cb'		=> 'WP_Bootstrap_Navwalker::fallback',
		'menu_id'			=> 'slideout-menu',
		'walker'			=> new WP_Bootstrap_Navwalker(),
	) );
	?>

	<?php get_sidebar(); ?>
</nav>