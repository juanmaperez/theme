<?php
/**
 * Template Name: Proyectos
 *
 * @package WordPress
 * @subpackage jp-theme
 * @since InboundCycle Theme 1.0.4
 */


get_header(); ?>
<div class="container template-projects">
  <div class="row">
    <div class="col-md-9 col-sm-8 col-xs-12 project-list">
      <?php ic_theme_listing('project') ?>
    </div>
    <div class="col-md-3 col-sm-4 col-xs-12">
      <?php get_sidebar(); ?>
    </div>
  </div>
</div>
<?php get_footer(); ?>
