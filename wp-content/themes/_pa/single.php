<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package _pa
 */

get_header();
?>

	<div id="primary" class="content-area">
		<main id="main" class="site-main">

		<?php
		while ( have_posts() ) {
			the_post();
			get_template_part( 'template-parts/content', get_post_type() );
			/**
			 * sigh. I really dislike this type of navigation.
			 * Why would I want to read the next or the previous post just because I'm on a specific one?
			 * 
			 * Nah, totally not gonna want this crap.
			 */
			//the_post_navigation();

			if ( comments_open() || get_comments_number() ) {
				comments_template();
			}
		}
		?>

		</main><!-- #main -->
	</div><!-- #primary -->

<?php
get_footer();
