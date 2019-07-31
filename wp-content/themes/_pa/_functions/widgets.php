<?php
/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function _pa_widgets_init() {
	register_sidebar( array(
		'name'          => esc_html__( 'Blog Sidebar', '_pa' ),
		'id'            => 'blog-sidebar',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Page Sidebar', '_pa' ),
		'id'            => 'page-sidebar',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 1', '_pa' ),
		'id'            => 'footercol1',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 2', '_pa' ),
		'id'            => 'footercol2',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 3', '_pa' ),
		'id'            => 'footercol3',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 4', '_pa' ),
		'id'            => 'footercol4',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 5', '_pa' ),
		'id'            => 'footercol5',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );

	register_sidebar( array(
		'name'          => esc_html__( 'Footer Column 6', '_pa' ),
		'id'            => 'footercol6',
		'description'   => esc_html__( 'Add widgets here.', '_pa' ),
		'before_widget' => '<aside role="complimentary" id="%1$s" class="widget %2$s">',
		'after_widget'  => '</aside>',
		'before_title'  => '<h2 class="widget-title">',
		'after_title'   => '</h2>',
	) );
}
add_action( 'widgets_init', '_pa_widgets_init' );