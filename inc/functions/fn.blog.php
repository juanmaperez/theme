<?php

/**
 * Esta función se utiliza como lanzadera para mostrar diferentes elementos y
 * contenidos generales del blog.
 *
 * @since 1.0.0
 *
 * @global ic_theme_blog()
 *
 * @param string  $type     Contenido a mostrar. Acepta 'title', 'subtitle', 'category' y 'hero-mask'.
 * @param array   $option   Nos permite pasar opciones de configuración independientes para cada elemento.
 *
 * @return function Retornamos la función especíca para el tipo de elemento especificado.
 */
function get_ic_theme_blog( $type = null, $options = null ) {
  // Parametros por defecto.
  $active = true;
  // Llamar a la función en base la configuración
  if ( $active ) {
    switch ( $type ) {
      case 'logotype'     : return ic_theme_blog_logotype( $options ); break;
      case 'title'        : return ic_theme_blog_title(); break;
      case 'subtitle'     : return ic_theme_blog_subtitle(); break;
      case 'category'     : return ic_theme_blog_category( $options ); break;
      case 'tag'          : return ic_theme_blog_tag( $options ); break;
      case 'search'       : return ic_theme_blog_search( $options ); break;
      case 'hero-mask'    : return ic_theme_blog_hero_mask(); break;
      case 'latest-posts' : return ic_theme_blog_latest_posts( $options ); break;
      case 'copyright'    : return ic_theme_blog_copyright(); break;
      case 'header-image' : return ic_theme_blog_header_image(); break;
    }
  }
}

/**
 * Con esta función mostramos el logotipo del blog.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @todo Terminar el comentario con toda la información
 *
 * @return string Logotipo.
 */
function ic_theme_blog_logotype( $options ) {
  // Opciones preformateadas
  $location = 'header';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'location': $location = $option; break;
      }
    }
  }
  // Devolviendo el logotipo
  switch ( $location ) {
    case 'header': return '<img class="logotype" src="'. get_theme_mod( 'logotype' ) .'">'; break;
    case 'footer': return '<img class="footer-logotype" src="'. get_theme_mod( 'footer-logotype' ) .'">'; break;
  }
}

/**
 * Con esta función mostramos el título del blog. Le añadimos o no el enlace y le
 * aplicamos una etiqueta u otra en base a la plantilla donde estemos.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @return string Título del blog.
 */
function ic_theme_blog_title() {
  // Recogiendo todas las opciones de título
  $blog_color         = get_theme_mod( 'header-image-title-color' );
  $landing_display    = get_theme_mod( 'ic-landing-pages-title-display' );
  $landing_color      = get_theme_mod( 'ic-landing-pages-title-color');
  $thank_you_display  = get_theme_mod( 'ic-thank-you-pages-title-display' );
  $thank_you_color    = get_theme_mod( 'ic-thank-you-pages-title-color' );
  // Definiendo las opciones correctas
  if ( is_singular('ic-landing') ) {
    if ( ! $color = $landing_color ) $color = $blog_color;
    if ( $landing_display ) $hide_title = true;
  } else if ( is_singular('ic-thank-you') ) {
    if ( ! $color = $thank_you_color ) $color = $blog_color;
    if ( $thank_you_display ) $hide_title = true;
  } else {
    $color = $blog_color;
  }
  // Aplicando unas opciones u otras en base a la página en la que está el usuario
  if ( is_front_page() ) {
    if ( !$tag ) $tag = 'h1 style="color:' . $color . '"';
  } else {
    if ( !$tag ) $tag = 'p';
    $link_open = '<a href="'. get_bloginfo( 'url' ) .'" title="' . __( 'Ir a la página de inicio', 'ic-theme' ) . '" style="color:' . $color . '">';
    $link_close = '</a>';
  }
  // Devolviendo el título
  if ( !$hide_title ) {
    echo '<'.$tag.' class="blog-title">';
    if ( $link_open ) echo $link_open;
    echo html_entity_decode( get_bloginfo( 'title' ) );
    if ( $link_close ) echo $link_close;
    echo '</'.$tag.'>';
  }
}

/**
 * Función para mostrar la descripción del blog.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @return string Subtítulo del blog.
 */
function ic_theme_blog_subtitle() {
  // Recogiendo todas las opciones de título
  $blog_color         = get_theme_mod( 'header-image-title-color' );
  $landing_display    = get_theme_mod( 'ic-landing-pages-title-display' );
  $landing_color      = get_theme_mod( 'ic-landing-pages-title-color');
  $thank_you_display  = get_theme_mod( 'ic-thank-you-pages-title-display' );
  $thank_you_color    = get_theme_mod( 'ic-thank-you-pages-title-color' );
  // Definiendo las opciones correctas
  if ( is_singular('ic-landing') ) {
    if ( ! $color = $landing_color ) $color = $blog_color;
    if ( $landing_display ) $hide_title = true;
  } else if ( is_singular('ic-thank-you') ) {
    if ( ! $color = $thank_you_color ) $color = $blog_color;
    if ( $thank_you_display ) $hide_title = true;
  } else {
    $color = $blog_color;
  }
  // Devolviendo el subtítulo
  if ( !$hide_title ) {
    echo '<p class="lead blog-subtitle" style="color:' . $color . '">';
    echo html_entity_decode( get_bloginfo( 'description' ) );
    echo '</p>';
  }
}

/**
 * Función que muestra el título de la categoría de la cual se está mostrando el
 * listado de entradas.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @param array $options {
 *    @type string  $tag          Etiqueta que engloba el título. Default 'p'.
 *    @type string  $label        Personalizar el texto anterior a la categoría.
 *    @type bool    $hide-label   Ocultar el texto anterior a la categoría.
 * }
 *
 * @return string Título de la categoría actual.
 */
function ic_theme_blog_category( $options = null ) {
  // Opciones preformateadas
  $tag = 'p';
  $label = false;
  $hide_label = false;
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'tag':         $tag        = $option; break;
        case 'label':       $label      = $option; break;
        case 'hide-label':  $hide_label = $option; break;
      }
    }
  }
  // Devolviendo el título
  echo '<'.$tag.' class="blog-category lead">';
    if ( !$hide_label ) {
      echo '<span>';
        if ( $label ) { echo $label; } else { echo __( 'Entradas filtradas por', 'ic-theme' ); }
      echo '</span>&nbsp;';
    }
    echo '<strong>';
      single_cat_title();
    echo '</strong>';
  echo '</'.$tag.'>';
}

/**
 * Función que muestra el título de la categoría de la cual se está mostrando el
 * listado de entradas.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @param array $options {
 *    @type string  $tag          Etiqueta que engloba el título. Default 'p'.
 *    @type string  $label        Personalizar el texto anterior a la categoría.
 *    @type bool    $hide-label   Ocultar el texto anterior a la categoría.
 * }
 *
 * @return string Título de la categoría actual.
 */
function ic_theme_blog_tag( $options = null ) {
  // Opciones preformateadas
  $tag = 'p';
  $label = false;
  $hide_label = false;
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'tag':         $tag        = $option; break;
        case 'label':       $label      = $option; break;
        case 'hide-label':  $hide_label = $option; break;
      }
    }
  }  // Devolviendo el título
  echo '<'.$tag.' class="blog-tag lead">';
    if ( !$hide_label ) {
      echo '<span>';
        if ( $label ) { echo $label; } else { echo __( 'Entradas filtradas por', 'ic-theme' ); }
      echo '</span>&nbsp;';
    }
    echo '<strong>';
      single_cat_title();
    echo '</strong>';
  echo '</'.$tag.'>';
}

/**
 * Con esta función mostramos el texto que ayuda a saber que busqueda se ha
 * realizado y cuantos resultados hay.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @param array $options {
 *    @type string  $tag          Etiqueta que engloba el título. Default 'p'.
 *    @type string  $label        Personalizar el texto anterior a la categoría.
 *    @type bool    $hide-label   Ocultar el texto anterior a la categoría.
 *    @type bool    $hide-counter Ocultar el número de resultados.
 * }
 *
 * @return string Título de la categoría actual.
 */
function ic_theme_blog_search( $options = null ) {
  // Opciones preformateadas
  $tag = 'p';
  $label = false;
  $hide_label = false;
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'tag':         $tag        = $option; break;
        case 'label':       $label      = $option; break;
        case 'hide-label':  $hide_label = $option; break;
      }
    }
  }
  // Devolviendo el título
  echo '<'.$tag.' class="blog-search lead">';
    if ( !$hide_label ) {
      echo '<span>';
        if ( $label ) { echo $label; } else { echo __( 'Resultados de búsqueda para', 'ic-theme' ); }
      echo '</span>&nbsp;';
    }
    echo '<strong>'.get_search_query().'</strong>';
  echo '</'.$tag.'>';
}

/**
 * Esta función da la funcionalidad de poder añadir una máscara de color con una
 * opacidad personalizable a la imagen de fondo de la cabecera.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @return string El tag "style" con los párametro de la máscara.
 */
function ic_theme_blog_hero_mask() {
  // Recogiendo los parámetros de tonalidad y opacidad
  $blog_image_color         = get_theme_mod( 'header-image-color' );
  $blog_image_opacity       = get_theme_mod( 'header-image-opacity' );
  $landing_image_color      = get_theme_mod( 'ic-landing-pages-image-color' );
  $landing_image_opacity    = get_theme_mod( 'ic-landing-pages-image-opacity' );
  $thank_you_image_color    = get_theme_mod( 'ic-thank-you-pages-image-color' );
  $thank_you_image_opacity  = get_theme_mod( 'ic-thank-you-pages-image-opacity' );
  $blog_color_gradent       = get_theme_mod( 'header-image-color-gradent' );
  // Definiendo parámetros correctos
  if ( is_singular('ic-landing') ) {
    if ( ! $header_image_color = $landing_image_color ) $header_image_color = $blog_image_color;
    if ( ! $header_image_opacity = $landing_image_opacity ) $header_image_opacity = $blog_image_opacity;
  } else if ( is_singular('ic-thank-you') ) {
    if ( ! $header_image_color = $thank_you_image_color ) $header_image_color = $blog_image_color;
    if ( ! $header_image_opacity = $thank_you_image_opacity ) $header_image_opacity = $blog_image_opacity;
  } else {
    $header_image_color   = $blog_image_color;
    $header_image_opacity = $blog_image_opacity;
  }
  // Aplicando las opciones de máscara
  if ( $header_image_color ) {
    if ( $blog_color_gradent ) {
      echo ' style="';
        echo "background: -moz-linear-gradient(top, rgba(" . ic_theme_rgb( $header_image_color );
          if (  $header_image_opacity ) {
            echo ','.$header_image_opacity;
          } else {
            echo ',1';
          }
        echo ") 0%, rgba(" . ic_theme_rgb( $header_image_color ) . ",0) 100%);";
        echo "background: -webkit-linear-gradient(top, rgba(" . ic_theme_rgb( $header_image_color );
          if (  $header_image_opacity ) {
            echo ','.$header_image_opacity;
          } else {
            echo ',1';
          }
        echo ") 0%,rgba(" . ic_theme_rgb( $header_image_color ) . ",0) 100%);";
        echo "background: linear-gradient(to bottom, rgba(" . ic_theme_rgb( $header_image_color ) ;
          if (  $header_image_opacity ) {
            echo ','.$header_image_opacity;
          } else {
            echo ',1';
          }
        echo ") 0%,rgba(" . ic_theme_rgb( $header_image_color ) . ",0) 100%);";
        echo "filter: progid:DXImageTransform.Microsoft.gradient( startColorstr='#" . $header_image_color . "', endColorstr='#" . $header_image_color . "',GradientType=0 );";
      echo '"';
    } else {
      echo ' style="background-color:rgba(';
      echo ic_theme_rgb( $header_image_color );
      if (  $header_image_opacity ) {
        echo ','.$header_image_opacity;
      } else {
        echo ',1';
      }
      echo ')"';
    }
  }
}

/**
 * Función que muestra la imagen correcta en la cabecera en base a la tipo de
 * página que se está navegando y de si se han añadido imagenes o no.
 *
 * @since 1.0.3
 *
 * @return string URL de la imagen de fondo.
 */

function ic_theme_blog_header_image() {
  // Recogiendo todas las imágenes añadidas
  $img_blog       = get_theme_mod( 'header-image-file' );
  $img_landing    = get_theme_mod( 'ic-landing-pages-image-file');
  $img_thank_you  = get_theme_mod( 'ic-thank-you-pages-image-file' );
  // Seleccionando la imagen correcta
  if ( is_singular('ic-landing') ) {
    if ( ! $image = $img_landing ) {
      $image = $img_blog;
    }
  } else if ( is_singular('ic-thank-you') ) {
    if ( ! $image = $img_thank_you ) {
      $image = $img_blog;
    }
  } else {
    $image = $img_blog;
  }
  // Devolviendo imagen
  return $image;
}

/**
 * Función que devuelve el texto de copyright
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @todo Terminar el comentario con toda la información
 *
 * @return string Texto de copyright.
 */
function ic_theme_blog_copyright() {
  // Devolviendo el texto de copyright
  return get_theme_mod( 'copyright' );
}

/**
 * Función que devuelve la función principal con echo
 *
 * @since 1.0.0
 *
 * @todo Terminar el comentario con toda la información
 *
 * @return string Función hija con parámetro solicitado.
 */

function ic_theme_blog( $type = null, $options = null ) {
  echo get_ic_theme_blog( $type, $options );
}
