<?php
/**
 * The template for displaying the footer
 * Contains the closing of the #content div and all content after.
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 * @package _pa
 */
?>

	</div><!-- #content -->
	
	<?php
	$no_of_sidebars = 0;
	if ( is_active_sidebar( 'footercol1' ) || is_active_sidebar( 'footercol2' ) || is_active_sidebar( 'footercol3' ) || is_active_sidebar( 'footercol4' ) || is_active_sidebar( 'footercol5' ) || is_active_sidebar( 'footercol6' ) ) {
		$display_widgets = TRUE;
		if ( is_active_sidebar( 'footercol1' ) ) { $no_of_sidebars++; }
		if ( is_active_sidebar( 'footercol2' ) ) { $no_of_sidebars++; }
		if ( is_active_sidebar( 'footercol3' ) ) { $no_of_sidebars++; }
		if ( is_active_sidebar( 'footercol4' ) ) { $no_of_sidebars++; }
		if ( is_active_sidebar( 'footercol5' ) ) { $no_of_sidebars++; }
		if ( is_active_sidebar( 'footercol6' ) ) { $no_of_sidebars++; }
		$widget_extraclass = 'active-widgets-' . $no_of_sidebars;
	}
	?>

	<footer id="colophon" class="site-footer">
		<?php
		if ( $display_widgets ) { ?>
			<div class="widgets <?php echo $widget_extraclass; ?>">
				<?php
				if ( is_active_sidebar( 'footercol1' ) ) {
					dynamic_sidebar( 'footercol1' );
				}
				if ( is_active_sidebar( 'footercol2' ) ) {
					dynamic_sidebar( 'footercol2' );
				}
				if ( is_active_sidebar( 'footercol3' ) ) {
					dynamic_sidebar( 'footercol3' );
				}
				if ( is_active_sidebar( 'footercol4' ) ) {
					dynamic_sidebar( 'footercol4' );
				}
				if ( is_active_sidebar( 'footercol5' ) ) {
					dynamic_sidebar( 'footercol5' );
				}
				if ( is_active_sidebar( 'footercol6' ) ) {
					dynamic_sidebar( 'footercol6' );
				}
				?>
			</div>
			<?php
		}
		?>
		<div class="site-info">
			<?php
			echo __('Copyright &copy;', '_pa') . date('Y') . ' <a href="' . get_bloginfo( 'wpurl' ) . '">' . get_bloginfo( 'name' ) . '</a>';
			/**
			 * Echo's the privacy policy URL if there is one.
			 */
			if ( function_exists( 'get_the_privacy_policy_link' ) ) {
				echo get_the_privacy_policy_link( '<div>', '</div>' );
			} ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon -->
</div><!-- #page -->

<?php wp_footer(); ?>

</body>
</html>
