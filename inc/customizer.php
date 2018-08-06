<?php

require_once( get_template_directory() . '/inc/customizer/control-multiple-checkboxes.php');

/**
 * Parámetros generales
 *
 * @param logotype Campo para añadir el logotipo principal.
 * @param favicon Icono que aparecerá en las pestaña de los navegadores
 * @param background Imagen de fondo que aparecerá en la cabecera.
 *
 * @since   1.0.0
 */
function ic_theme_customizer_global( $param ){

  $param -> add_setting( 'logotype' );
  $param -> add_control(
    new WP_Customize_Image_Control( $param, 'logotype',
      array(
        'label'       => __( 'Logotipo', 'ic-theme' ),
        'section'     => 'title_tagline',
        'settings'    => 'logotype',
        'description' => 'Añade un logotipo en formato PNG con transparéncia y ten en cuenta que tenga una visualización óptima en pantallas retina.'
      )
    )
  );

}
add_action( 'customize_register', 'ic_theme_customizer_global' );
/**
 * Imagen de cabecera
 *
 * @param header-image-file     Imagen de fondo que aparecerá en la cabecera.
 * @param header-image-color    Color de la máscara que estará por encima de la imagen.
 * @param header-image-opacity  Opacidad del color.
 *
 * @version 1.0.0
 */
function ic_theme_customizer_header_image( $param ){

  $param -> add_section( 'header-image',
    array(
      'title'       => __( 'Imagen de cabecera', 'ic-theme' ),
      'priority'    => 30,
      'description' => 'En este apartado puede seleccionar un .',
    )
  );

  $param -> add_setting( 'header-image-file' );
  $param -> add_control(
    new WP_Customize_Image_Control( $param, 'header-image-file',
      array(
        'label'     => __( 'Imagen de cabecera', 'ic-theme' ),
        'section'   => 'header-image',
        'settings'  => 'header-image-file',
        'description' => 'Esta imágen aparecerá en la cabecera y no ha de tener tamaño de archivo de no mas de 200Kb.'
      )
    )
  );

  $param -> add_setting( 'header-image-title-color' );
  $param -> add_control(
    new WP_Customize_Color_Control( $param, 'header-image-title-color',
      array(
        'label'     => __( 'Color del título', 'ic-theme' ),
        'section'   => 'header-image',
        'settings'  => 'header-image-title-color',
        'description' => 'Color del tíutlo que aparece en la cabecera.'
      )
    )
  );

  $param -> add_setting( 'header-image-color' );
  $param -> add_control(
    new WP_Customize_Color_Control( $param, 'header-image-color',
      array(
        'label'     => __( 'Tonalidad de la imagen', 'ic-theme' ),
        'section'   => 'header-image',
        'settings'  => 'header-image-color',
        'description' => 'Este color estará por encima de la imagen de cabecera.'
      )
    )
  );

  $param -> add_setting( 'header-image-opacity' );
  $param -> add_control( 'header-image-opacity',
    array(
      'label'    => __( 'Opacidad', 'ic-theme' ),
      'section'  => 'header-image',
      'settings' => 'header-image-opacity',
      'type'     => 'number',
      'description' => 'Indica que porcentale de opacidad quieres aplicar al color.'
    )
  );

  $param -> add_setting( 'header-image-color-gradent' );
  $param -> add_control( 'header-image-color-gradent',
    array(
      'label'    => __( 'Aplicar degradado al color', 'ic-theme' ),
      'section'  => 'header-image',
      'settings' => 'header-image-color-gradent',
      'type'     => 'checkbox'
    )
  );

}
add_action( 'customize_register', 'ic_theme_customizer_header_image' );

/**
 * Opciones de entradas
 *
 * @param author Campo boleano para mostrar u ocultar el autor del post.
 * @param categories Campo boleano para mostrar u ocultar las categorías.
 *
 * @since   1.0.0
 */
function ic_theme_customizer_posts_options( $param ){

  $param -> add_panel( 'posts-options',
    array(
      'title'          => __('Opciones de posts', 'ic-theme'),
      'description'    => __('En este apartado puedes personalizar que elementos del blog han de aparecer en los diferentes páginas del blog.', 'ic-theme'),
      'priority'       => 35,
    )
  );

  /* Página de inicio
  --------------------------------------------------------------------------- */

  $param -> add_section( 'posts-options-front-page',
    array(
      'title'       => __( 'Página de inicio', 'ic-theme' ),
      'description' => __( 'Opciones del listado de entradas de la página de inicio.', 'ic-theme' ),
      'priority'    => 10,
      'panel' => 'posts-options'
    )
  );

  $param -> add_setting( 'posts-options-front-page-metadata',
    array(
      'default' => array(
        'author',
        'categories',
        'date',
        'tags'
      ),
      'sanitize_callback' => 'jt_sanitize_favorite_fruit'
    )
  );

  $param -> add_control(
    new JT_Customize_Control_Checkbox_Multiple( $param, 'posts-options-front-page-metadata',
      array(
        'section' => 'posts-options-front-page',
        'label'   => __( 'Información de cada post', 'ic-theme' ),
        'choices' => array(
          'author'      => __( 'Autor', 'ic-theme' ),
          'categories'  => __( 'Categorias', 'ic-theme' ),
          'date'        => __( 'Fecha de publicación', 'ic-theme' ),
          'tags'        => __( 'Tags', 'ic-theme' )
        )
      )
    )
  );

  /* Página de post
  --------------------------------------------------------------------------- */

  $param -> add_section( 'posts-options-single',
    array(
      'title'       => __( 'Página de post', 'ic-theme' ),
      'description' => __( 'Opciones de configuración de listado de entradas filtradas por una categoría.', 'ic-theme' ),
      'priority'    => 20,
      'panel' => 'posts-options'
    )
  );

  $param -> add_setting( 'posts-options-single-metadata',
    array(
      'default' => array(
        'author',
        'categories',
        'date',
        'tags'
      ),
      'sanitize_callback' => 'jt_sanitize_favorite_fruit'
    )
  );

  $param -> add_control(
    new JT_Customize_Control_Checkbox_Multiple( $param, 'posts-options-single-metadata',
      array(
        'section' => 'posts-options-single',
        'label'   => __( 'Información de cada entrada', 'ic-theme' ),
        'choices' => array(
          'author'      => __( 'Autor', 'ic-theme' ),
          'categories'  => __( 'Categorias', 'ic-theme' ),
          'date'        => __( 'Fecha de publicación', 'ic-theme' ),
          'tags'        => __( 'Tags', 'ic-theme' )
        )
      )
    )
  );

  /* Página de categorias
  --------------------------------------------------------------------------- */

  $param -> add_section( 'posts-options-category',
    array(
      'title'       => __( 'Página de categoría', 'ic-theme' ),
      'description' => __( 'Opciones de configuración de la página que filtra por categoría.', 'ic-theme' ),
      'priority'    => 30,
      'panel' => 'posts-options'
    )
  );

  $param -> add_setting( 'posts-options-category-metadata',
    array(
      'default' => array(
        'author',
        'categories',
        'date',
        'tags'
      ),
      'sanitize_callback' => 'jt_sanitize_favorite_fruit'
    )
  );

  $param -> add_control(
    new JT_Customize_Control_Checkbox_Multiple( $param, 'posts-options-category-metadata',
      array(
        'section' => 'posts-options-category',
        'label'   => __( 'Información de cada entrada', 'ic-theme' ),
        'choices' => array(
          'author'      => __( 'Autor', 'ic-theme' ),
          'categories'  => __( 'Categorias', 'ic-theme' ),
          'date'        => __( 'Fecha de publicación', 'ic-theme' ),
          'tags'        => __( 'Tags', 'ic-theme' )
        )
      )
    )
  );

  /* Página de tags
  --------------------------------------------------------------------------- */

  $param -> add_section( 'posts-options-tag',
    array(
      'title'       => __( 'Página de tag', 'ic-theme' ),
      'description' => __( 'Opciones de configuración de la página que filtra por tag.', 'ic-theme' ),
      'priority'    => 30,
      'panel' => 'posts-options'
    )
  );

  $param -> add_setting( 'posts-options-tag-metadata',
    array(
      'default' => array(
        'author',
        'categories',
        'date',
        'tags'
      ),
      'sanitize_callback' => 'jt_sanitize_favorite_fruit'
    )
  );

  $param -> add_control(
    new JT_Customize_Control_Checkbox_Multiple( $param, 'posts-options-tag-metadata',
      array(
        'section' => 'posts-options-tag',
        'label'   => __( 'Información de cada entrada', 'ic-theme' ),
        'choices' => array(
          'author'      => __( 'Autor', 'ic-theme' ),
          'categories'  => __( 'Categorias', 'ic-theme' ),
          'date'        => __( 'Fecha de publicación', 'ic-theme' ),
          'tags'        => __( 'Tags', 'ic-theme' )
        )
      )
    )
  );

  /* Página de search results
  --------------------------------------------------------------------------- */

  $param -> add_section( 'posts-options-search',
    array(
      'title'       => __( 'Página de resultados de búsqueda', 'ic-theme' ),
      'description' => __( 'Opciones de configuración de la página que filtra por tag.', 'ic-theme' ),
      'priority'    => 30,
      'panel' => 'posts-options'
    )
  );

  $param -> add_setting( 'posts-options-search-metadata',
    array(
      'default' => array(
        'author',
        'categories',
        'date',
        'tags'
      ),
      'sanitize_callback' => 'jt_sanitize_favorite_fruit'
    )
  );

  $param -> add_control(
    new JT_Customize_Control_Checkbox_Multiple( $param, 'posts-options-search-metadata',
      array(
        'section' => 'posts-options-search',
        'label'   => __( 'Información de cada entrada', 'ic-theme' ),
        'choices' => array(
          'author'      => __( 'Autor', 'ic-theme' ),
          'categories'  => __( 'Categorias', 'ic-theme' ),
          'date'        => __( 'Fecha de publicación', 'ic-theme' ),
          'tags'        => __( 'Tags', 'ic-theme' )
        )
      )
    )
  );

}
add_action( 'customize_register', 'ic_theme_customizer_posts_options' );

/**
 * Pié de página
 *
 * @param string $key Campo para guardar la licencia de uso.
 *
 * @since   1.0.0
 */
function ic_theme_customizer_footer( $param ){

  $param -> add_section( 'footer',
    array(
      'title'       => __( 'Pié de página', 'ic-theme' ),
      'priority'    => 800,
      'description' => 'Opciones de personalización del pié de página.',
    )
  );

  $param -> add_setting( 'footer-logotype' );
  $param -> add_control(
    new WP_Customize_Image_Control( $param, 'footer-logotype',
      array(
        'label'       => __( 'Logotipo', 'ic-theme' ),
        'section'     => 'footer',
        'settings'    => 'footer-logotype',
        'description' => 'Añade un logotipo en formato PNG con transparéncia y ten en cuenta que tenga una visualización óptima en pantallas retina.'
      )
    )
  );

  $param -> add_setting( 'copyright' );
  $param -> add_control( 'copyright',
    array(
  		'label'    => __( 'Texto de Copyright', 'ic-theme' ),
  		'section'  => 'footer',
  		'settings' => 'copyright',
  		'type'     => 'text',
  	)
  );

}
add_action( 'customize_register', 'ic_theme_customizer_footer' );

/**
 * Licencia
 *
 * @param string $key Campo para guardar la licencia de uso.
 *
 * @since   1.0.0
 */
function ic_theme_customizer_license( $param ){

  $param -> add_section( 'license',
    array(
      'title'       => __( 'Licencia', 'ic-theme' ),
      'priority'    => 900,
      'description' => 'Indica aquí la clave de licencia para habilitar las actualizaciones de la plantilla.',
    )
  );

  $param -> add_setting( 'key' );
  $param -> add_control( 'key',
    array(
  		'label'    => __( 'Código de licencia', 'ic-theme' ),
  		'section'  => 'license',
  		'settings' => 'key',
  		'type'     => 'text',
  	)
  );

}
add_action( 'customize_register', 'ic_theme_customizer_license' );

/**
 * Ocultando opciones
 *
 * @since   1.0.0
 */

function ic_theme_customizer_hide_panels( $param ) {

  $param -> remove_section( 'static_front_page' );

}
add_action( 'customize_register', 'ic_theme_customizer_hide_panels' );
