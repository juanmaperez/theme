<?php

/**
 * Esta función se utiliza como lanzadera para mostrar el contenido de las
 * entradas haciendo llamadas a segundas funciones que gestionan cada contenido
 * independientemente.
 *
 * @since 1.0.0
 *
 * @param string  $type     Contenido a mostrar. Acepta 'title', 'content', 'excerpt', 'author', 'categories', 'date' y 'tags'.
 * @param array   $option   Nos permite pasar opciones de configuración independientes para cada elemento.
 *
 * @return function Retornamos la función especíca para el tipo de elemento especificado.
 */
function ic_theme_post( $type = null, $options = null ) {
  // Parametros por defecto.
  $active = true;
  // Escoger el tipo de página
  if ( is_front_page() )
    $page = 'front-page';
  else if ( is_single() )
    $page = 'single';
  else if ( is_category() )
    $page = 'category';
  else if ( is_tag() )
    $page = 'tag';
  else if ( is_search() )
    $page = 'search';
  // Recogiendo valores customizados
  if (
    $type == 'author' ||
    $type == 'categories' ||
    $type == 'date' ||
    $type == 'tags' )
  {
    $active = false;
    $param_array = get_theme_mod( 'posts-options-' . $page . '-metadata');
    if ( $param_array ) {
      foreach ( $param_array as $param ) {
        if (
          $param == 'author' and $param == $type or
          $param == 'categories' and $param == $type or
          $param == 'date' and $param == $type or
          $param == 'tags' and $param == $type
        ) {
          $active = true;
        }
      }
    } else {
      $active = true;
    }
  }
  // Llamar a la función en base la configuración
  if ( $active ) {
    switch ( $type ) {
      case 'title'        : ic_theme_post_title( $options ); break;
      case 'content'      : ic_theme_post_content(); break;
      case 'excerpt'      : ic_theme_post_excerpt( $options ); break;
      case 'thumbnail'    : ic_theme_post_thumbnail( $options ); break;
      case 'author'       : return ic_theme_post_author( $options ); break;
      case 'categories'   : ic_theme_post_categories( $options ); break;
      case 'date'         : ic_theme_post_date( $options ); break;
      case 'tags'         : ic_theme_post_tags( $options ); break;
      case 'readmore'     : ic_theme_post_readmore( $options ); break;
      case 'related-posts': ic_theme_post_related_posts( $options ); break;
      case 'pagination'   : ic_theme_post_pagination( $option ); break;
    }
  }
}

/**
 * Con esta función mostramos el título de un post. Le añadimos un enlace en el
 * caso que no estemos en la plantilla 'single' y también cambiamos automáticamente
 * la etiqueta además de poder personalizarla.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type string  $tag  Tag para el título. Default 'h1' o 'h2'.
 * }
 *
 * @return string Con el título del formulario.
 */
function ic_theme_post_title( $options = null ) {
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'tag': $tag = $option; break;
      }
    }
  }
  // Determinando los contenedores del título en base al tipo de página
  if ( is_single() || is_page() ) {
    if ( !$tag ) $tag = 'h1';
  } else {
    $link = true;
    if ( !$tag ) $tag = 'h2';
  }
  // Devolviendo el título
  echo '<'.$tag.'>';
  if ( $link ) echo '<a href="'. get_the_permalink() .'" title="' . __( 'Ir al post', '' ) . ' ' . get_the_title() . '">';
  echo get_the_title();
  if ( $link ) echo '</a>';
  echo '</'.$tag.'>';
}

/**
 * Con esta función devolvemos el contenido de una entrada.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @return string Contenido del post.
 */
function ic_theme_post_content() {
  // Devolviendo el contenido
  the_content();
}

/**
 * Con esta función devolvemos el texto reducido de una entrada.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type int     $length   Número máximo de carácteres. Default '';
 *    @type bool    $words    Número máximo de palabras. Default ''. Sobreescribe $length.
 * }
 *
 * @todo Habilitar soporte para número máximo de carácteres.
 * @todo Habilitar limitación de número de palabras.
 *
 * @return string Con el título del formulario.
 */
function ic_theme_post_excerpt( $options = null ) {
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'length': $length = $option; break;
      }
    }
  }
  // Devolviendo el excerpt
  echo the_excerpt();
}

/**
 * Función que nos permite sacar la imagen destacada (thumbnail) de una entrada
 * y además comprobamos si la entrada tiene añadida o no una de imagen, si no la
 * tiene mostramos la primera imagen que se encuentra en el contenido de la entrada.
 *
 * Podemos personalizar el tamaño de la imagen que se va a mostrar siendo 'medium'
 * el valor de tamaño por defecto.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type string  $size   Tamaño de la imagen. Default 'medium'. Acepta 'thumbnail', 'medium', 'large' y 'full'.
 *    @type string  $class  Clase personalizada. Default vacía.
 * }
 *
 * @todo Añadir soporte para que se muestre la primera imagen del contenido de
 * una entrada en el caso de que no hay thumbnail especificado.
 *
 * @return string Con la imagen destacada de la entrada.
 */
function ic_theme_post_thumbnail( $options ) {
  // Opciones preformateadas
  $size = 'medium';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'size': $size = $option; break;
        case 'class': $class = $option; break;
      }
    }
  }
  // Recuperando el thumbnail del post
  $thumbnail = wp_get_attachment_image_src(
    get_post_thumbnail_id(
      $post_id
    ),
    $size
  );
  // Mostrando imagen
  if ( $thumbnail ) {
    echo '<img src="' . $thumbnail[0] . '" class="post-thumbnail';
    if ( $class ) echo ' ' . $class;
    echo'" title="">';
  }
}

/**
 * Con esta función mostramos el autor de un post.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type string  $format       Formato en el que mostrar el autor. Default 'simple'. Acepta 'simple' y 'complete';
 *    @type int     $size         Tamaño del avatar. Default '42'.
 *    @type bool    $avatar_size  Si se muestra o no avatar. Default 'false'. Acepta 'true' o 'false'.
 *    @type string  $avatar_class Para poder aplicar una classe al avatar. Default 'img-circle';
 *    @type string  $link_class   Tag para el título. Default 'h1' o 'h2'.
 * }
 *
 * @return string Con el título del formulario.
 */
function ic_theme_post_author( $options = null ) {

  // Opciones preformateadas
  $format         = 'simple';
  $avatar_active  = true;
  $avatar_size    = 42;
  $avatar_class   = 'img-circle';

  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'format'       : $format         = $option; break;
        case 'avatar'       : $avatar_active  = $option; break;
        case 'avatar_size'  : $avatar_size    = $option; break;
        case 'avatar_class' : $avatar_class   = $option; break;
        case 'link_class'   : $link_class     = $option; break;
        case 'data'         : $data           = $option; break;
      }
    }
  }

  // Recuperando datos del autor de la entrada
  $author_name        = get_the_author_meta( 'first_name' );
  $author_lastname    = get_the_author_meta( 'last_name' );
  $author_nicename    = get_the_author_meta( 'user_nicename' );
  $author_position    = get_the_author_meta( 'position' );
  $author_description = get_the_author_meta( 'description' );
  $author_website     = get_the_author_meta( 'user_url' );
  $author_twitter     = get_the_author_meta( 'twitter' );
  $author_facebook    = get_the_author_meta( 'facebook' );
  $author_google      = get_the_author_meta( 'google_plus' );
  $author_linkedin    = get_the_author_meta( 'linkedin' );
  $author_posts       = get_author_posts_url( get_the_author_meta( 'ID' ), get_the_author_meta( 'user_nicename' ) );

  // Definiendo en nombre definitivo del autor
  if ( $author_name or $author_lastname ) {
    $author = $author_name . ' ' . $author_lastname;
  } else {
    $author = $author_nicename;
  }

  // Componiendo el autor en base al formato solicitado
  switch ( $format ) {

    case 'single':
      switch ( $data ) {
        case 'name': return $author; break;
      }
    break;

    case 'simple':
      echo '<div class="meta-item meta-author">';
        if ( $avatar_active ) {
          echo get_avatar( get_the_author_meta( 'ID' ), $avatar_size, '', '', array( 'class' => $avatar_class ) );
        }
        echo '<a href="'.$author_posts.'" title="'.__( 'Ver todas las entradas de', 'ic-theme' ).' '.$author.'" class="'.$link_class.'">';
          echo $author;
        echo '</a>';
      echo '</div>';
    break;

    case 'complete':

      echo '<div class="panel panel-default post-author">';
        echo '<div class="panel-body">';
          echo '<div class="row">';
            echo '<div class="col-md-2">';
              echo get_avatar( get_the_author_meta( 'ID' ), $avatar_size, '', '', array( 'class' => $avatar_class ) );
            echo '</div>';
            echo '<div class="col-md-10">';
              // Nombre del autor
              echo '<p class="post-author-name">';
                echo '<a href="'.$author_posts.'" title="'.__( 'Ver todas las entradas de', 'ic-theme' ).' '.$author.'">';
                  echo $author;
                echo '</a>';
              echo '</p>';
              // Ocupación o cargo
              if ( $author_position ){
                echo '<p class="post-author-position text-muted">';
                  echo $author_position;
                echo '</p>';
              }
              // Información biográfica
              if ( $author_description ){
                echo '<p class="post-author-description">';
                  echo $author_description;
                echo '</p>';
              }
              // Página web del autor
              if ( $author_website ){
                echo '<a href="'.$author_website.'" class="post-author-web" target="_blank" title="'.__( 'Página web del autor', 'ic-theme' ).'">';
                  echo $author_website;
                echo '</a>';
              }
              // Iconos sociales
              if (
                $author_twitter or
                $author_facebook or
                $author_google or
                $author_linkedin )
              {
                echo '<ul class="post-author-social list-inline">';
                  if ( $author_twitter ) {
                    echo '<li class="post-author-twitter">';
                      echo '<a href="'.$author_twitter.'" class="fa fa-twitter-square fa-2x" target="_blank"></a>';
                    echo '</li>';
                  }
                  if ( $author_facebook ) {
                    echo '<li class="post-author-facebook">';
                      echo '<a href="'.$author_facebook.'" class="fa fa-facebook-square fa-2x" target="_blank"></a>';
                    echo '</li>';
                  }
                  if ( $author_google ) {
                    echo '<li class="post-author-google-plus">';
                      echo '<a href="'.$author_google.'" class="fa fa-google-plus-square fa-2x" target="_blank"></a>';
                    echo '</li>';
                  }
                  if ( $author_linkedin ) {
                    echo '<li class="post-author-linkedin">';
                      echo '<a href="'.$author_linkedin.'" class="fa fa-linkedin-square fa-2x" target="_blank"></a>';
                    echo '</li>';
                  }
                echo '</ul>';
              }
            echo '</div>';
          echo '</div>';
        echo '</div>';
      echo '</div>';
    break;

  }

}

/**
 * Con esta función hacemos una llamada al a función nativa de Wordpress para
 * listar las categorias que se han atorgado a una entrada, pero añadimos la
 * opción de que se pueda mostrar o todas las categorías (por defecto) o solo
 * una (en orden alfabético).
 *
 * Además añadimos un paso intermedio para añadir unas clases de Bootstrap que nos
 * permite disponer el listado en linea.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type int $single   Muestra una sola categoría. Default 'false'. Acepta 'true' o 'false';
 *    @type int $label    Muestra un texto antes del listado.;
 * }
 *
 * @todo Habilitar la opción de mostrar una única categoría
 *
 * @return string Con el listado de categorias.
 */
function ic_theme_post_categories( $options = null ) {
  // Opciones preformateadas
  $single = false;
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'single': $single = $option; break;
        case 'label': $label = $option; break;
      }
    }
  }
  // Devolviendo el listado de categorías
  echo '<div class="meta-item meta-categories">';
  // Mostrando label si así se especifica
  if ( $label ) {
    echo '<span class="meta-categories-label">' . $label . '</span>';
  }
  echo the_category();
  echo '</div>';
}

/**
 * Reemplazar la clase 'post-categories' del elemento ul de la lista por la
 * clase 'list-inline' de Bootstrap que diposne los elementos en línea.
 *
 * @since 1.0.0
 * @global ic_theme_post_categories()
 *
 * @return string El listado de categorías con la clase del elemento ul modificada.
 */
function ic_theme_post_categories_customization( $categories = null, $separator = null, $parents = null ){
  return str_replace(
    'post-categories',  // Clase a reemplzar
    'list-inline',      // Nueva clase
    $categories         // Listado de categorías
  );
}
// Añadir el filtro a la función de categorías
add_filter( 'the_category', 'ic_theme_post_categories_customization', 10, 3 );

/**
 * Con esta función mostramos la fecha de publicación de un artículo y personalizamos
 * el formato en que aparece.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type string  $format   Formato de la fecha. Default 'j F, Y'.
 *    @type string  $class    Classe personalizada. Default ''.
 * }
 *
 * @return string Con la fecha de publicación del post.
 */
function ic_theme_post_date( $options = null ) {
  // Opciones preformateadas
  $format = 'j F, Y';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'format': $format = $option; break;
        case 'class': $class = $option; break;
      }
    }
  }
  // Mostrando la fecha de publicación de la entrada.
  echo '<div class="meta-item meta-date">';
  echo '<time datatime="' . get_the_time( 'Y-m-j' ).'" class="text-muted';
  if ( $class ) echo ' ' . $class;
  echo '">'. get_the_time( $format ) . '</time>';
  echo '</div>';
}

/**
 * Función para mostrar el listado de tags otorgados en la entrada.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type string  $label      Permite añadir un texto antes del listado de tags.
 *    @type string  $separator  Permite personalizar el separador entre tags.
 * }
 *
 * @return string Listado de tags.
 */
function ic_theme_post_tags( $options = null ) {
  // Opciones preformateadas
  $label = '';
  $separator = ', ';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'label': $label = $option; break;
        case 'separator': $separator = $option; break;
      }
    }
  }
  // Definiendo label
  if ( $label ) $label = '<span class="meta-tags-label">' . $label . '</span> ';
  // Mostrando el listado de tags.
  echo '<div class="meta-item meta-tags">';
  the_tags( $label, $separator );
  echo '</div>';
}

/**
 * Con esta función mostramos el botón de leer mas en el listado de entradas.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @param array $options {
 *    @type string  $value        Texto del botón. Default 'Leer más'.
 *    @type string  $class        Classe personalizada.
 *    @type string  $before_value Contenido antes del value.
 *    @type string  $after_value  Contenido después del value.
 * }
 *
 * @return string Con el botón de leer más.
 */
function ic_theme_post_readmore( $options = null ) {
  // Opciones preformateadas
  $value = 'Read more';
  // Recogida de opciones enviadas
  if ( $options ) {
    foreach ( $options as $key => $option ) {
      switch ( $key ) {
        case 'value': $value = $option; break;
        case 'class': $class = $option; break;
        case 'before_value': $before_value = $option; break;
        case 'after_value': $after_value = $option; break;
      }
    }
  }
  // Mostrando el botón de leer más.
  echo '<a ';
  echo 'href="' . get_the_permalink() . '" ';
  echo 'title="' . __( 'Go to the post', 'ic-theme' ) . ' ' . get_the_title() . '" ';
  echo 'role="button" ';
  echo 'class="btn btn-default read-more';
  if ( $class ) echo ' ' . $class;
  echo '">';
  if ( $before_value ) echo $before_value;
  echo __( $value, 'ic-theme' );
  if ( $after_value ) echo $after_value;
  echo '</a>';
}

/**
 * Enlaces relacionados.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @return function Que lanza el plugin Related Posts by Zemanta.
 */
function ic_theme_post_related_posts() {

  echo '<div class="panel panel-default post-related-posts">';
    echo '<div class="panel-heading">';
      echo '<p class="panel-title">'.__( 'Related posts', 'ic-theme' ).'</p>';
    echo '</div>';
    echo '<div class="panel-body">';
      if ( function_exists( 'zemanta_related_posts' ) ) {
        zemanta_related_posts( array( 'title' => false ) );
      } else {
        echo '<p>'.__( 'Active <strong>Related Posts by Zemanta</strong>', 'ic-theme' ).'</p>';
      }
      echo '</div>';
  echo '</div>';
}

/**
 * Paginación de listados.
 *
 * @since 1.0.0
 * @global ic_theme_post()
 *
 * @return function Que lanza el plugin WP-Paginate.
 */
function ic_theme_post_pagination() {
  if ( function_exists( 'wp_pagenavi' ) ) {
    function ic_pagination($html) {
      $out = '';
      $out = str_replace("<div","",$html);
      $out = str_replace("class='wp-pagenavi'>","",$out);
      $out = str_replace("<a","<li><a",$out);
      $out = str_replace("</a>","</a></li>",$out);
      $out = str_replace("<span","<li><span",$out);
      $out = str_replace("</span>","</span></li>",$out);
      $out = str_replace("</div>","",$out);
      return '
        <div class="text-center">
          <ul class="pagination">'.$out.'</ul>
        </div>';
    }
    add_filter( 'wp_pagenavi', 'ic_pagination', 10, 2 );
    wp_pagenavi();
  } else {
    echo '<div class="alert alert-warning" role="alert">';
    echo __( 'Para mostrar la paginación has de instalar el plugin <a href="https://srd.wordpress.org/plugins/wp-pagenavi/screenshots/" target="_blank">WP-PageNavi</a>', 'ic-theme' );
    echo '</div>';
  }
}
