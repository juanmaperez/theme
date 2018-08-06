<?php get_header(); ?>
<div class="container template-search">
  <div class="row">
    <div class="col-md-9 col-sm-8 col-xs-12">
      <?php ic_theme_blog( 'search' ) ?>
      <?php ic_theme_listing() ?>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
