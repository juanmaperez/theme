<?php global $post; if ( have_posts() ) : ?>
  <section class="post-listing">
    <?php while ( have_posts() ) : the_post(); ?>
      <article class="post-item">
        <div class="post-header">
          <?php ic_theme_post( 'title' ) ?>
        </div>
        <div class="post-meta clearfix">
          <?php ic_theme_post( 'author' ) ?>
          <?php ic_theme_post( 'categories' ) ?>
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
        <div class="row">
          <div class="col-sm-5">
            <?php ic_theme_post( 'thumbnail' ) ?>
          </div>
          <div class="col-sm-7">
            <div class="post-content">
              <?php ic_theme_post( 'date' ); ?>
              <?php ic_theme_post( 'excerpt' )?>
            </div>
            <div class="post-footer">
              <?php ic_theme_post( 'tags' ); ?>
              <?php ic_theme_post( 'readmore' ); ?>
            </div>
          </div>
        </div>
      </article>
    <?php endwhile; ?>
    <?php if ( $pagination ) { ic_theme_post( 'pagination' ); } ?>
  </section>
<?php else: ?>
  <p class="lead"><?php echo __( 'Ups!, todavía no hay ninguna entrada publicada.', 'ic-theme' ) ?></p>
<?php endif; ?>
