<?php get_header(); ?>
<div class="container template-landing">
  <?php require_once( ic_theme_include( 'partials/landing/form-' . ic_landing( 'form-position' ) . '.php' ) ); ?>
</div>
<div class="share-module-wrapper">
  <strong><?php echo __( 'Compártelo con tus contactos', 'ic-theme' ) ?></strong>
  <?php if ( function_exists( 'ic_social_icons' ) ) { ?>
    <?php ic_social_icons( 'share' ); ?>
  <?php } ?>
</div>
<?php get_footer(); ?>
