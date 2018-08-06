<?php get_header(); ?>
<div class="container">
  <div class="row">
    <div class="col-sm-9">
      <section class="post-body">
        <?php if ( have_posts() ) : the_post(); ?>
          <section>
            <h1><?php the_title(); ?></h1>
            <?php the_content(); ?>
          </section>
        <?php endif; ?>
      </section>
    </div>
    <div class="col-sm-3">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
