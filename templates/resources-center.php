<?php

/**
 * Template Name: Centro de Recursos
 *
 * @package WordPress
 * @subpackage ic-theme
 * @since InboundCycle Startup Theme 1.0.4
 */

get_header(); ?>
<div class="container template-resources-center">
  <div class="page-wrapper">
    <div class="page-header">
      <?php ic_resource( 'page_title' ) ?>
      <div class="page-intro">
        <?php ic_resource( 'page_content' ) ?>
      </div>
    </div>
    <div class="page-body">
      <?php ic_resource( 'listing' ) ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
