<?php
/**
 * Template part for displaying posts with format "link".
  * @package _pa
 */
?>

<div class="container">
	<div class="row">
		<div class="col-xs-12 col-sm-12 col-md-10 col-lg-8 col-xl-8 offset-md-1 offset-lg-2 offset-xl-2">
			<?php
				$link_title = get_the_title();
				$full_content = get_the_content();
				$regex = '/https?\:\/\/[^\" ]+/i';
				preg_match($regex, $full_content, $matched);
				if ( !empty( $matched ) ) {
					$first_link = $matched[0];
				}

				if ( ! $first_link ) {
					if ( current_user_can( 'manage_plugins' ) ) {
						echo 'No links present in this post. Choose a different post format.';
					}
				} else { ?>
					<a title="<?php echo $link_title; ?>" href="<?php echo $first_link; ?>"><?php echo $link_title; ?> <i class="fas fa-external-link-alt"></i></a>
					<?php
				}
			?>
		</div>
	</div>
</div>