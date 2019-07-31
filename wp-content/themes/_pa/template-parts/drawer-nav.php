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

<?php /*
<ul class="list-unstyled main-menu">
	<li class="text-right"><a href="#" id="nav-close">X</a></li>
	<li><a href="#">Menu One <span class="icon"></span></a></li>
	<li><a href="#">Menu Two <span class="icon"></span></a></li>
	<li><a href="#">Menu Three <span class="icon"></span></a></li>
	<li><a href="#">Dropdown</a>
		<ul class="list-unstyled">
			<li class="sub-nav"><a href="#">Sub Menu One <span class="icon"></span></a></li>
			<li class="sub-nav"><a href="#">Sub Menu Two <span class="icon"></span></a></li>
			<li class="sub-nav"><a href="#">Sub Menu Three <span class="icon"></span></a></li>
			<li class="sub-nav"><a href="#">Sub Menu Four <span class="icon"></span></a></li>
			<li class="sub-nav"><a href="#">Sub Menu Five <span class="icon"></span></a></li>
		</ul>
	</li>
	<li><a href="#">Menu Four <span class="icon"></span></a></li>
	<li><a href="#">Menu Five <span class="icon"></span></a></li>
</ul>
*/ ?>