<?php

/**
 * Esta función actua de lanzadera llamado a segundas funciones para mostrar
 * diferentes tipos de listados con opciones personalizables para cada tipo.
 *
 * @since 1.0.0
 *
 * @param string  $type     Tipo de listado a mostrar. Default 'default'. Acepta 'default', 'latest', 'viewed' y 'search-results'.
 * @param array   $option   Nos permite pasar opciones de configuración independientes para cada elemento.
 *
 * @return function Retornamos la función especíca para el tipo de elemento especificado.
 */
 function ic_theme_listing( $type = null, $options = null ) {
   // Parametros por defecto.
   $active = true;
   if ( !$type ) {
     $type = 'default';
   }
   // Llamar a la función en base la configuración
   if ( $active ) {
     switch ( $type ) {
       case 'default'         : return ic_theme_listing_default( $options ); break;
       case 'resources'       : return ic_theme_listing_resources( $options ); break;
       case 'latest'          : return ic_theme_listing_latest( $options ); break;
       case 'project'         : return ic_theme_listing_project( $options ); break;
       case 'viewed'          : return ic_theme_listing_viewed( $options ); break;
       case 'search-results'  : return ic_theme_listing_search_results( $options ); break;
     }
   }
 }

/**
 * Listado por defecto de entradas.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @todo Completar el comentario
 * @todo Soporte para cuadrícula
 * @todo Soporte para llamar a una plantilla personalizada
 *
 * @return array Con los posts seleccionados.
 */
function ic_theme_listing_default( $options = null ) {
  // Opciones preformateadas
  $pagination = true;
  $template = 'listing-list.php';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'pagination': $pagination= $option; break;
        case 'template': $template= $option; break;
      }
    }
  }
  require_once( ic_theme_include( 'partials/' . $template ) );
}

/**
  * Con esta función podemo rescatar un número limitado de entradas ordenadas por
  * diferentes parámetros.
  *
  * @since 1.0.0
  * @global ic_theme_blog()
  *
  * @param array $options {
  *    @type int  $type   Tipo de contenido a devolver. Default 'post'. Acepta 'post' y 'page';
  *    @type int  $max    Número máxime de elementos a devolver. Default '3'. Acepta '1', '2', '3' y '4';
  * }
  *
  * @return array Con los posts seleccionados.
  */
  function ic_theme_listing_project( $options = null ) {
    // Llamando a la classe global de posts
    global $post;
    // Opciones preformateadas
    $pagination = true;
    $template = 'projects.php';
    $type = 'project';
    // Recogida de opciones enviadas
    if ( $options ) {
      foreach ( $options as $key => $option ) {
        switch ( $key ) {
          case 'type': $type= $option; break;
          case 'pagination': $pagination= $option; break;
          case 'template': $template= $option; break;
        }
      }
    }


    // Recogiendo entradas
    $args = array(
      'posts_per_page'   => 12,
      'offset'           => 0,
      'orderby'          => 'date',
      'order'            => 'DESC',
      'post_type'        => $type,
      'post_status'      => 'publish');
    // Array final de entradas
    $projects = get_posts( $args );
    // Imprimeindo resultados
    if ( $projects ) {
      echo '<div class="row">';
        foreach ( $projects as $post ) {
          echo '<div class="col-xs-12 col-sm-6 col-md-4 project-item">';
            echo '<div class="project-image-wrapper" style="background:url(' . get_the_post_thumbnail_url() . ')">';
            echo '</div>';
            echo '<a href="' . get_the_permalink() . '" class="cover">';
              echo '<i class="fa fa-plus-circle" aria-hidden="true"></i>';
              ic_theme_post( 'title', array( 'tag' => 'h4' ) );
            echo '</a>';
          echo '</div>';
        }
      echo '</div>';
    }

    require_once( ic_theme_include( $template ) );
  }


function ic_theme_listing_latest( $options = null ) {
  // Llamando a la classe global de posts
  global $post;
  // Opciones preformateadas
  $type = 'post';
  $max = 3;
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'type': $type= $option; break;
        case 'max' : $max = $option; break;
      }
    }
  }
  // Calculando columnas
  if ( !$max ) {
    $max = 3;
  } elseif ( $max > 4 ) {
    $max = 4;
  }
  $col = ( 12 / $max );
  // Recogiendo entradas
  $args = array(
    'posts_per_page'   => $max,
    'offset'           => 0,
    'orderby'          => 'date',
    'order'            => 'DESC',
    'post_type'        => $type,
    'post_status'      => 'publish');
  // Array final de entradas
  $latest_posts = get_posts( $args );
  // Imprimeindo resultados
  if ( $latest_posts ) {
    echo '<div class="row">';
      foreach ( $latest_posts as $post ) {
        echo '<div class="col-sm-'.$col.'">';
        ic_theme_post( 'thumbnail' );
        ic_theme_post( 'date' );
        ic_theme_post( 'title', array( 'tag' => 'h4' ) );
        ic_theme_post( 'readmore' );
        echo '</div>';
      }
    echo '</div>';
  }
}

/**
 * Listado por defecto de entradas.
 *
 * @since 1.0.0
 * @global ic_theme_blog()
 *
 * @todo Completar el comentario
 * @todo Soporte para cuadrícula
 * @todo Soporte para llamar a una plantilla personalizada
 *
 * @return array Con los posts seleccionados.
 */
function ic_theme_listing_resources( $options = null ) {
  // Opciones preformateadas
  $pagination = true;
  $template = 'resources-center-list.php';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'pagination': $pagination= $option; break;
        case 'template': $template= $option; break;
      }
    }
  }
  // Recogiendo entradas
  $args = array(
    'post_type' => array(
      'ic-landing',
      'ic-resource'
    ),
    'posts_per_page' => -1 );
  // Array final de recursos
  $resources = new WP_Query( $args );
  require_once( ic_theme_include( 'partials/' . $template ) );
}
