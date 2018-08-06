<?php get_header(); ?>
<div class="container template-404">
  <div class="page-header text-center">
    <h2><?php echo __( 'Ups!', 'ic-theme' ) ?></h2>
    <p class="lead"><?php echo __( "We couldn't find what you were looking for.", 'ic-theme' ) ?></p>
    <form method="get" class="form-inline" action="<?php bloginfo( 'url' ) ?>">
      <p><?php __( 'You can try to make a search:', 'ic-theme' ) ?></p>
      <div class="form-group">
        <p class="text-muted">You can try to make a search here.</p>
        <input type="search" name="s" class="form-control" size="32" placeholder="<?php echo __( 'Type here...', 'ic-theme' ) ?>">
        <button type="submit" class="btn btn-active"><?php echo __( 'Search', 'ic-theme' ) ?></button>
      </div>
    </form>
  </div>
  <!-- Últimas entradas del blog -->
  <div class="panel panel-default latest-posts">
    <div class="panel-heading">
      <h3 class="panel-title">
        <?php echo __( 'Latest post', 'ic-theme' ) ?>
      </h3>
    </div>
    <div class="panel-body">
      <?php ic_theme_listing( 'latest' ) ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
