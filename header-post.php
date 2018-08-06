<!DOCTYPE html>
<html lang="<?php bloginfo('language'); ?>">
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name=viewport content="width=device-width, initial-scale=1">
    <title><?php wp_title() ?></title>
    <link rel="apple-touch-icon" href="<?php echo get_theme_mod( 'favicon' ) ?>">
    <link rel="icon" type="image/png" href="<?php echo get_theme_mod( 'favicon' ) ?>">
    <link rel="stylesheet" href="<?php bloginfo('stylesheet_url') ?>">
    <script>
        (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
        (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
        m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
        })(window,document,'script','https://www.google-analytics.com/analytics.js','ga');

        ga('create', 'UA-98892695-1', 'auto');
        ga('send', 'pageview');
    </script>
    <?php wp_head(); ?>
  </head>
  <body>
    <!-- Header -->
    <header>
      <!-- Navegation & Logo -->
      <?php require_once( ic_theme_include( 'partials/navegation.php' ) ); ?>
      <!-- Hero -->
      <div class="jumbotron hero" style="background-size:cover;background-position:center top;background-image: url('<?php echo get_the_post_thumbnail_url() ?>')">
        <div class="hero-caption">
          <div class="title-container">

          </div>
        </div>
      </div>
    </header>
    <!-- Breadcrumbs -->
    <div class="container">
      <?php ic_theme_breadcrumbs(); ?>
    </div>
