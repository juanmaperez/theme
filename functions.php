<?php

// Configuraciones básicas
require_once( get_template_directory() . '/inc/functions/fn.config.php');

// Funciones para mostrar contenidos en la plantilla
require_once( get_template_directory() . '/inc/functions/fn.blog.php');
require_once( get_template_directory() . '/inc/functions/fn.post.php');
require_once( get_template_directory() . '/inc/functions/fn.listing.php');
require_once( get_template_directory() . '/inc/functions/fn.project.php');


// Funciones especiales
require_once( get_template_directory() . '/inc/functions/fn.breadcrumb.php');

// Funciones de personalización de contenidos en la plantilla
global $wp_customize;
if ( isset( $wp_customize ) ) {
  require_once( get_template_directory() . '/inc/customizer.php');
}

/**
 * Habilitar soporte al uso de imagenes destacadas en el editor de contenidos
 * del administrador de las entradas ('post') y las páginas ('page').
 *
 * Las imágnes se han de recoger con la función 'the_post_thumbnail()' desde las
 * plantillas correspondientes de cada tipo de contenido.
 *
 * @since 1.0.0
 */
function ic_theme_thumbnails(){
  add_theme_support( 'post-thumbnails',
    array(
      'post',
      'page',
      'project'
    )
  );
}
add_action( 'init', 'ic_theme_thumbnails' );

/**
 * Registrando los menús de navegación principales que tendrá la plantilla y que
 * se podrán gestionar desde el apartado menús del administrador.
 *
 * @since 1.0.0
 */
function ic_theme_menu() {
 register_nav_menus(
   array(
     'nav_header' => __( 'Menú de navegación', 'ic-theme' ),
     'nav_footer' => __( 'Menú de pié de página', 'ic-theme' )
   )
 );
}
add_action( 'init', 'ic_theme_menu' );

/**
 * Registro de las zonas de Widget que se aplicarán en la plantilla y que se
 * gestionarán des de la selcción Widgets del administrador.
 *
 * @since 1.0.0
 */
function ic_theme_widgets(){
  register_sidebar(
    array(
      'name'          => __( 'Sidebar', 'ic-theme' ),
      'id'            => 'sidebar',
      'before_widget' => '<div class="widget %2$s">',
      'after_widget'  => '</div>',
      'before_title'  => '<p class="widget-title">',
      'after_title'   => '</p>'
    )
  );
  register_sidebar(
    array(
      'name'          => __( 'Footer', 'ic-theme' ),
      'id'            => 'footer',
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '',
      'after_title'   => ''
    )
  );

}
add_action('init','ic_theme_widgets');

/**
 * Limitar el número de carácteres en un texto.
 *
 * @since 1.0.0
 *
 * @param string  $text   Texto que se quiere limitar.
 * @param int     $max    Máximo de carácteres que devolver del string. Si no se
 *                        indica ninguno el valor por defecto será de 30.
 *
 * @return string Texto recortado si supera el máximo indicado.
 */
function ic_theme_length( $text, $max = null ) {
  // Definiendo el número de carácteres por defecto
  if ( !$max ) $max = 30;
  // Comprobamos si superamos el máximo
  if ( strlen( $text ) > $max ) {
    $text = substr( $text, 0, ( $max - 3 ) ) . '...';
  }
  // Devolviendo el texto
  return $text;
}

/**
 * Hacemos comprobaciones de si hay nuevas versiones del template cuando hayan
 * peticiones desde el administrador. Las actualizaciones requieres de una
 * licencia que autorize la descarga, está comprobación se hace mediante la
 * función 'ic_theme_authorization()'.
 *
 * @since 1.0.0
 *
 * @return string Con la URL de descarga.
 */
if ( is_admin() ){
 if ( $license = ic_theme_authorization( 'update', 'ic-theme' ) ) {
   require get_template_directory() . '/inc/update/theme-update-checker.php';
   $update_checker = new ThemeUpdateChecker( 'ic-theme', $license );
 }
}

/**
 * Añadir campos extra en el editor de usuarios.
 *
 * @since 1.0.0
 *
 * @return array Campos añadidos.
 */
function ic_theme_profile_methods( $fields ) {

  // Añadiendo campos
  $profile_fields['position'] = 'Ocupación o cargo';
 	$profile_fields['twitter'] = 'Twitter';
 	$profile_fields['facebook'] = 'Facebook';
 	$profile_fields['google_plus'] = 'Google+';
  $profile_fields['linkedin'] = 'Linkedin';

 	return $profile_fields;

 }
 add_filter('user_contactmethods', 'ic_theme_profile_methods');

/**
 * Esta función nos permite comprobar si un archivo existe en el child template
 * para modificar la ruta del include.
 *
 * @since 1.0.4
 *
 * @return array Dirección URL del archivo.
 */
 function ic_theme_include( $file ) {
   // Definiendo path por defecto
   $path = get_template_directory() . '/' . $file;
   // En caso de que el archivo exista en el child modificamos el path
   if ( file_exists( get_stylesheet_directory() . '/' . $file ) ) {
     $path = get_stylesheet_directory() . '/' . $file;
   }
   // Devolviendo el path definitivo
   return $path;
 }

 /**
  * Esta función elimina el paréntesi y además añade un span contenedor al
  * contador de entradas que se puede activar en el widget de categorías que
  * trae Wordpress por defecto.
  *
  * @since 1.0.9
  *
  * @return array Listado de categorías con el contador modificado.
  */
function ic_theme_categories_widget_customization( $content ) {
  // Buscar y reemplazar contadores
  $content = str_replace( '(', ' <span class="cat-count">', $content );
  $content = str_replace( ')', '</span> ', $content );
  // Devolviendo el listado modificado
  return $content;
}
add_filter('wp_list_categories', 'ic_theme_categories_widget_customization');
