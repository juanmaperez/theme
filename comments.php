<?php if ( !empty( $post -> post_password ) && $_COOKIE['wp-postpass_'.COOKIEHASH] != $post -> post_password ) : ?>
  <p><?php echo __('Log in to see comments.', 'ic-theme'); ?></p>
<?php return; endif; ?>

<div class="panel panel-default post-comments">
  <div class="panel-heading">
    <p class="panel-title">
      <?php comments_number( __( 'There are not comments', 'ic-theme' ), __( '<span>1</span> comment', 'ic-theme' ), __( '<span>1</span> comments', 'ic-theme' ) ) ?>
    </p>
  </div>
  <div class="panel-body">
    <?php if ( $comments && get_comments_number() > 0 ) : ?>
      <?php foreach ( $comments as $comment ) : ?>
        <div class="media">
          <div class="media-left">
            <?php echo get_avatar( get_comment_author_email(), 120 , false, false, array( 'class' => 'img-circle' ) ) ?>
          </div>
          <div class="media-body">
            <p class="media-heading post-comments-list-author"><?php comment_author_link() ?></p>
            <p class="text-muted post-comments-list-date">
              <?php comment_date() ?> <span class="label label-default"><?php comment_time() ?></span>
            </p>
            <div class="post-comments-list-content">
              <?php comment_text() ?>
            </div>
            <?php edit_comment_link( __( 'Edit', 'ic-theme' ) ); ?>
          </div>
        </div>
      <?php endforeach; ?>
    <?php else: ?>
      <p><?php echo __( 'There are not comments for this post.', 'ic-theme' ) ?></p>
    <?php endif; ?>
  </div>
</div>

<?php if ( comments_open() ) : ?>
  <div class="panel panel-default post-comments-form">
    <div class="panel-heading">
      <p class="panel-title">
        <?php echo __( 'Leave a comment', 'ic-theme' ) ?>
      </p>
    </div>
    <div class="panel-body">
      <?php if ( get_option('comment_registration') && !$user_ID ) : ?>
        <p><?php printf( __( 'You must be<a href="%s">logged</a> to comment.', 'ic-theme' ), get_options( 'siteurl' ) . '/wp-login.php?redirect_to=' . urlencode( get_permalink() ) ) ?>
      <?php else : ?>
        <form action="<?php echo get_option( 'siteurl' ); ?>/wp-comments-post.php" method="post" id="commentform">
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="text" name="author" id="author" value="<?php echo $comment_author ?>" tabindex="1" placeholder="<?php echo __( 'Your name', 'ic-theme' ) ?> <?php if ( $req ) { echo '*'; } ?>" />
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <input class="form-control" type="text" name="email" id="email" value="<?php echo $comment_author_email; ?>" tabindex="2" placeholder="<?php echo __( 'example@email.com', 'ic-theme' ) ?> <?php if ( $req ) { echo '*'; } ?>" />
              </div>
            </div>
            <div class="col-md-12">
              <div class="form-group">
                <textarea class="form-control" name="comment" id="comment" cols="100%" rows="10" tabindex="3">Type your message</textarea>
              </div>
            </div>
            <div class="col-md-12">
              <div class="post-comments-form-actions">
                <input class="btn btn-default" name="submit" type="submit" id="submit" tabindex="5" value="<?php echo attribute_escape(__('Leave a comment')); ?>" />
                <input type="hidden" name="comment_post_ID" value="<?php echo $id; ?>" />
              </div>
            </div>
          <?php do_action( 'comment_form', $post->ID ); ?>
        </form>
      <?php endif; ?>
    </div>
  <?php else: ?>
    <p class="post-comments-closed"><?php __( 'Sorry, comments are closed for this post.', 'ic-theme' ); ?></p>
  <?php endif; ?>
