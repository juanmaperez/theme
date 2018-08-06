<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-md-9 col-sm-8 col-xs-12">
      <section class="post-body project-body">
        <?php if ( have_posts('project') ) : the_post('project'); ?>
          <div class="post-header">
            <?php ic_theme_post( 'title' ) ?>
          </div>
          <div class="post-meta clearfix">
            <div class="ic-social-icons ic-social-icons-share">
              <ul class="ic-social-icons-container">
                <!-- Twitter -->
                  <li class="ic-social-icons-share-item ic-social-icons-twitter">
                    <a href="https://twitter.com/share?url=<?php the_permalink(); ?>">
                      <i class="fa fa-twitter"></i>
                      <span>Twitter</span>
                    </a>
                  </li>

                <!-- Facebook -->
                  <li class="ic-social-icons-share-item ic-social-icons-facebook">
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>">
                      <i class="fa fa-facebook"></i>
                      <span>Facebook</span>
                    </a>
                  </li>

                <!-- Linkedin -->
                  <li class="ic-social-icons-share-item ic-social-icons-linkedin">
                    <a href="https://www.linkedin.com/shareArticle?mini=true&amp;url=<?php the_permalink(); ?>">
                      <i class="fa fa-linkedin"></i>
                      <span>LinkedIn</span>
                    </a>
                  </li>

                <!-- Google Plus -->
                  <li class="ic-social-icons-share-item ic-social-icons-google-plus">
                    <a href="https://plus.google.com/share?url=<?php the_permalink(); ?>">
                      <i class="fa fa-google-plus"></i>
                      <span>Google+</span>
                    </a>
                  </li>

              </ul>
            </div>
          </div>
          <div class="post-content">
            <?php ic_theme_post( 'thumbnail', array( 'size' => 'large' ) ) ?>
            <?php ic_theme_post( 'content' ) ?>
          </div>
          <div class="post-footer">
            <?php ic_theme_post( 'tags' ) ?>
          </div>
          <?php ic_theme_post( 'author', array( 'format' => 'complete', 'avatar_size' => 200 ) ) ?>
          <?php ic_theme_post( 'related-posts' ) ?>
          <?php comments_template() ?>
        <?php else: ?>
          <p class="lead"><?php echo __( 'Ups!, el post no existe.','ic-theme' ) ?></p>
        <?php endif; ?>
      </section>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
