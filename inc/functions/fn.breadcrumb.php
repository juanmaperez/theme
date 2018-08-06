<?php

/**
 * Función que devuelve las migas de pan automáticamente dependiendo de el nivel
 * y página de contenido donde se encuentre el usuario.
 *
 * @since 1.0.0
 *
 * @param string  $home   Texto del primer objecto del breadcrumb que enlaza a la
 *                        página de inicio.
 *
 * @return string Con el breadcrumb completo.
 */
function ic_theme_breadcrumbs( $home = null ) {
  if ( !is_singular('ic-landing') && !is_singular('ic-thank-you') ) {
    if ( !$home ) $home = __( 'Home', 'ic-theme' );
    // Mostramos el breadcrumb cuando no estemos en la página principal
    if ( !is_front_page() ) {
      echo '<ol class="breadcrumb">';
        echo '<li><a href="' . get_home_url() . '" title="' . __( 'Go to the Home', 'ic-theme') . '">' . $home . '</a></li>';
        // Estamos filtrando por categoría o es la página de un post
        if ( is_category() ) {
          if ( has_category() ) {
            $category_id = get_queried_object() -> term_id;
            $category_name = get_cat_name( $category_id );
            $category_link = get_category_link( $category_id );
            // echo '<li>' . __( 'Categoría', 'ic-theme' ) . '</li>';
            echo '<li><a href="'.$category_link.'">'.$category_name.'</a></li>';
          }
        }
        // Estamos filtrando por tag
        if ( is_tag() ) {
          $tag_id = get_queried_object() -> term_id;
          $tag = get_tag( $tag_id );
          $tag_name = $tag -> name;
          $tag_link = get_tag_link( $tag_id );
          echo '<li><a href="'.$tag_link.'">'.$tag_name.'</a></li>';
        }
        // Estamos en una entrada o página
        if ( is_single() || is_page() ) {
          echo '<li class="active">' . ic_theme_length( get_the_title(), 60 ) . '</li>';
        }
        // Estamos en la página de author
        if ( is_author() ) {
          // echo '<li>' . __( 'Autor', 'ic-theme' ) . '</li>';
          echo '<li class="active">' . ic_theme_post( 'author', array( 'format' => 'single', 'data' => 'name' ) ) . '</li>';
        }
        // Estamos en la página de resultados de búsqueda
        if ( is_search() ) {
          echo '<li class="active">' . __( 'Search Results', 'ic-theme' ) . '</li>';
        }
        // Estamos en la página 404
        if ( is_404() ) {
          echo '<li class="active">' . __( 'Error 404', 'ic-theme' ) . '</li>';
        }
      echo '</ol>';
    }
  }
}
