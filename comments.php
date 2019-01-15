<?php
/**
 * The template for displaying comments
 *
 * The area of the page that contains both current comments
 * and the comment form.
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				$comments_number = get_comments_number();
				if ( 1 === $comments_number ) {
					/* translators: %s: post title */
					printf( _x( 'One comment <i class="fa fa-comments-o" aria-hidden="true"></i>', 'comments title', 'jeffhow' ), get_the_title() );
				} else {
					printf(
						/* translators: 1: number of comments, 2: post title */
						_nx(
							'%1$s Comment <i class="fa fa-comments-o" aria-hidden="true"></i>',
							'%1$s Comments <i class="fa fa-comments-o" aria-hidden="true"></i>',
							$comments_number,
							'comments title',
							'jeffhow'
						),
						number_format_i18n( $comments_number ),
						get_the_title()
					);
				}
			?>
		</h3>

		<?php the_comments_navigation(); ?>

		<ol class="comment-list">
			<?php
				wp_list_comments( array(
				  'callback'    => 'jeffhow_comments_callback',
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 42,
				) );
			?>
		</ol><!-- .comment-list -->

		<?php the_comments_navigation(); ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php _e( 'Comments are closed.', 'jeffhow' ); ?></p>
	<?php endif; ?>

	<?php
		comment_form( array(
			'title_reply_before' => '<h4 id="reply-title" class="comment-reply-title">',
			'title_reply_after'  => '</h4>',
			'class_submit'      => 'submit btn btn-primary',
			
			'comment_field'=>'<p class="comment-form-comment"><label for="comment" class="control-label">' . _x( 'Comment', 'noun' ) .
      '</label><textarea id="comment" name="comment" class="form-control" cols="45" rows="8" aria-required="true">' .
      '</textarea></p>',
    
      'logged_in_as' => '<p class="logged-in-as">' .
      sprintf(
        __( 'Logged in as <a href="%1$s">%2$s</a>. <a href="%3$s" class="btn btn-default btn-sm" title="Log out of this account"><span class="glyphicon glyphicon-log-out"></span> Log out?</a>' ),
        admin_url( 'profile.php' ),
        $user_identity,
        wp_logout_url( apply_filters( 'the_permalink', get_permalink( ) ) )
      ) . '</p>',
      
      'fields' => $fields =  array( 
        'author' =>
        '<p class="comment-form-author"><label for="author" class="control-label">' . __( 'Name', 'domainreference' ) . '</label> ' .
        ( $req ? '<span class="required">*</span>' : '' ) .
        '<input id="author" class="form-control" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) .
        '" size="30"' . $aria_req . ' /></p>',

        'email' =>
          '<p class="comment-form-email"><label for="email" class="control-label">' . __( 'Email', 'domainreference' ) . '</label> ' .
            ( $req ? '<span class="required">*</span>' : '' ) .
          '<input id="email" class="form-control" name="email" type="text" value="' . esc_attr(  $commenter['comment_author_email'] ) .
          '" size="30"' . $aria_req . ' /></p>',
      ),
      
		) );
	?>

</div><!-- .comments-area -->
