<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package _pa
 * 
 * Look, this is a content-centric, blog-oriented theme. If you want fancy things
 * for your regular pages, you'll need to code it yourself.
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>> <?php
	_pa_title_in_post_thumbnail();
	_pa_container_tag_post(); ?>
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
			<div class="entry-content">
				<?php the_content(); ?>
			</div>
		</div>
	<?php _pa_container_tag_post('end'); ?>
</article><!-- #post-<?php the_ID(); ?> -->

