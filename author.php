<?php get_header(); ?>
<div class="container template-author">
  <div class="row">
    <div class="col-md-9 col-sm-8 col-xs-12">
      <?php ic_theme_post( 'author', array( 'format' => 'complete', 'avatar_size' => 200 ) ) ?>
      <?php ic_theme_listing() ?>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
