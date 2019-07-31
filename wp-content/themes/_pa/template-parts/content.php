<?php
/**
 * Template part for displaying posts
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package _pa
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<?php
	$format = get_post_format();
	if ($format) {
		get_template_part( 'template-parts/formats/content', $format );
	} else {
		get_template_part( 'template-parts/formats/content', 'standard' );
	}
	?>
</article><!-- #post-<?php the_ID(); ?> -->
