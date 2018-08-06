<?php

/**
 * Habilitar actualizaciones remotas del theme.
 *
 * @todo Habilitar el validador de seguridad.
 *
 * @since 1.0.0
 */
 function ic_theme_authorization( $action, $plugin ) {

   /* Generando los parámetros 'auth' y 'action' que se
    * enviarán por POST para ser recogidos por la funcion en
    * nuestros servidores */
   $data = http_build_query(
     array(
       'key'    => 'ic-theme',
       'url'    => sha1( get_site_url() ),
       'object' => 'themes',
       'action' => $action,
       'plugin' => $plugin
     )
   );

   /* Generando los parámetros con protocolo http para
    * enviarlos con método POST */
   $options = array(
     'http' => array(
       'method' => 'POST',
       'header' => 'Content-type: application/x-www-form-urlencoded',
       'content' => $data
     )
   );

   /* Generando llamada y recibiendo respuesta */
   $context = stream_context_create( $options );
   $licence = file_get_contents( ' ', false, $context );

   return $licence;

 }

 /**
  * Conversor de colores hexadecimales a RGB.
  *
  * @since 1.0.0
  *
  * @return string Color RGB separados por comas.
  */

function ic_theme_rgb( $hex ) {
  $hex = str_replace( '#', '', $hex );
  if ( strlen( $hex ) == 3) {
    $r = hexdec( substr( $hex, 0, 1 ).substr( $hex, 0, 1 ) );
    $g = hexdec( substr( $hex, 1, 1 ).substr( $hex, 1, 1 ) );
    $b = hexdec( substr( $hex, 2, 1 ).substr( $hex, 2 ,1 ) );
  } else {
    $r = hexdec( substr( $hex, 0, 2 ) );
    $g = hexdec( substr( $hex, 2, 2 ) );
    $b = hexdec( substr( $hex, 4, 2 ) );
  }
  $rgb = array( $r, $g, $b );
  return implode( ',', $rgb );
}
