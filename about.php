<?php

/**
 * Template Name: About
 *
 * @package WordPress
 * @subpackage ic-theme
 * @since InboundCycle Startup Theme 1.0.4
 */

get_header('about'); ?>
<div class="container about-container">
  <div class="row">
    <div class="col-md-9 col-sm-8 col-xs-12">
      <section class="post-body about-template">
        <?php if ( have_posts() ) : the_post(); ?>
          <section>
            <img width="200" height="auto" class="img-circle me-img" src="<?php echo get_the_post_thumbnail_url(); ?>">
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </section>
        <?php endif; ?>
      </section>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
