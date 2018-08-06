<?php

/* Para que el menú de Wordpress sea compatible con los
 * estilos de Bootstrap */

require_once( get_template_directory() . '/inc/bootstrap_navegation.php'); ?>

<nav class="navbar navbar-inverse navbar-fixed-top blog-navbar">
  <div class="container">

    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php bloginfo('url') ?>">
        <?php ic_theme_blog( 'logotype' ) ?>
      </a>
    </div><?php

    wp_nav_menu(
      array(
        'menu'            => 'primary',
        'theme_location'  => 'nav_header',
        'depth'           => 2,
        'container'       => 'div',
        'container_class' => 'collapse navbar-collapse',
        'container_id'    => 'bs-example-navbar-collapse-1',
        'menu_class'      => 'nav navbar-nav navbar-right',
        'fallback_cb'     => 'wp_bootstrap_navwalker::fallback',
        'walker'          => new wp_bootstrap_navwalker()
      )
    ); ?>

  </div>
</nav>
