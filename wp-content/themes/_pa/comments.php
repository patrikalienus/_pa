<?php
/**
 * The template for displaying comments
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 * @package _pa
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) { return; } ?>

<div id="comments" class="comments-area">
	<?php
	if ( have_comments() ) { ?>
		<div class="container">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2">

					<h2 class="comments-title"><?php
						$_pa_comment_count = get_comments_number();
						if ( $_pa_comment_count === '0' ) {
							printf( esc_html__( 'No comments', '_pa' ) );
						} elseif ( $_pa_comment_count === '1' ) {
							/* translators: 1 comment available */
							printf( esc_html__( 'One lonely comment', '_pa' ) );
						} else {
							printf(
								/* translators: Comment count number. */
								esc_html( _nx( 'One lonely comment:', '%1$s comments:', $_pa_comment_count, 'comments title', '_pa' ) ),
								number_format_i18n( $_pa_comment_count )
							);
						} ?>
					</h2><!-- .comments-title -->

					<?php the_comments_navigation(); ?>

					<ol class="comment-list"><?php
						wp_list_comments( 
							array (
								'style'			=> 'ol',
								'short_ping'	=> true,
								'format'		=> 'html5',
								'avatar_size'	=> 24,
								'walker'		=> new _pa_WalkerForComments()
							)
						); ?>
					</ol><!-- .comment-list -->

					<?php the_comments_navigation(); ?>
					<?php
					// If comments are closed and there are comments, let's leave a little note, shall we?
					if ( ! comments_open() ) { ?>
						<p class="no-comments"><?php esc_html_e( 'Comments are closed.', '_pa' ); ?></p><?php
					} ?>
				</div>
			</div>
		</div> <?php
	} ?>
	
	<div class="container">
		<div class="row">
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-8 offset-lg-2"><?php
				$fields =  array(
					'author' =>
						'<div class="left">
						<div class="comment-form-input-wrapper author comment-form-author"><label class="screen-reader-only" for="author">' . __( 'Name', 'domainreference' ) .
						( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
						'<input id="author" name="author" type="text" required placeholder="Name" value="' . esc_attr( $commenter['comment_author'] ) .
						'" size="30"></div>',
					
					'email' =>
						'<div class="comment-form-input-wrapper email comment-form-email"><label class="screen-reader-only" for="email">' . __( 'Email', 'domainreference' ) .
						( $req ? '<span class="required">*</span>' : '' ) . '</label>' .
						'<input id="email" name="email" type="text" required placeholder="Email" value="' . esc_attr(  $commenter['comment_author_email'] ) .
						'" size="30"></div>',
					
					'url' =>
						'<div class="comment-form-input-wrapper url comment-form-url"><label class="screen-reader-only" for="url">' . __( 'Website', 'domainreference' ) . '</label>' .
						'<input id="url" name="url" type="text" placeholder="Website URL" value="' . esc_attr( $commenter['comment_author_url'] ) .
						'" size="30"></div>',
					
					'cookies' =>
						'<div class="comment-form-input-wrapper cookies comment-form-cookies-consent">
							<span>
								<input id="wp-comment-cookies-consent" name="wp-comment-cookies-consent" type="checkbox" value="yes">
							</span>
							<label for="wp-comment-cookies-consent">' . __( 'Save my name, email, and website in this browser for the next time I comment.' ) . '</label>
						</div>
						</div><!-- .left ENDs here -->',
				);

				$commentFormArgs = array (
					'id_form'				=> 'commentform',
					'class_form'			=> 'comment-form',
					'id_submit'				=> 'submit',
					'class_submit'			=> 'submit',
					'name_submit'			=> 'submit',
					'title_reply'			=> __( 'Leave a Reply' ),
					'title_reply_to'		=> __( 'Leave a Reply to %s' ),
					'cancel_reply_link'		=> __( 'Cancel Reply' ),
					'label_submit'			=> __( 'Post Comment' ),
					'format'				=> 'html5',
					'fields'				=> apply_filters( 'comment_form_default_fields', $fields ),

					'comment_field'			=>
						'<div class="right">
						<div class="comment-form-input-wrapper comment_field">
							<label class="screen-reader-only" for="comment">' . _x( 'Comment', 'noun' ) . '</label>
							<textarea required id="comment" placeholder="Comment goes here, in this slightly larger box." name="comment" cols="45" rows="8" aria-required="true"></textarea>
						</div>',

					'must_log_in'			=>
						'<p class="must-log-in">' . sprintf(
							__( 'You must be <a href="%s">logged in</a> to post a comment.' ),
							wp_login_url( apply_filters( 'the_permalink', get_permalink() ) )
						) . '</p>',

					'logged_in_as'			=>
						'<p class="logged-in-as">' . sprintf(
							__( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" title="Log out of this account">Log out?</a>' ),
							admin_url( 'profile.php' ),
							$user_identity,
							wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
						) . '</p>',

					'comment_notes_before'	=>
						'<div class="comment-notes">' . __( 'Your email address will not be published.<br>Required fields are marked.' ) . '</div>',

					'comment_notes_after'	=>
						'<div class="form-allowed-tags">' . sprintf(
							__( 'Allowed <abbr title="HyperText Markup Language">HTML</abbr>: %s' ),
							' <span class="monospace">' . allowed_tags() . '</span>'
						) . '</div></div><!-- .right ENDS -->',
				);
				
				comment_form( $commentFormArgs ); ?>
			</div>
		</div>
	</div>

</div><!-- #comments -->
