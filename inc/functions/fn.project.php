<?php
/**
 * Esta función se utiliza para mostrar el contenido de las
 * proyectos.
 *
 * @since 1.0.0
 *
 * @return function Retornamos la función especíca para el tipo de elemento especificado.
 */
 function codex_custom_init() {
   $labels = array(
     'name' => _x('Proyectos', 'post type general name'),
     'singular_name' => _x('Proyecto', 'post type singular name'),
     'add_new' => _x('Añadir nuevo proyecto', 'project'),
     'add_new_item' => __('Añadir nuevo proyecto'),
     'edit_item' => __('Editar proyecto'),
     'new_item' => __('Nuevo Proyecto'),
     'all_items' => __('Todos los Proyectos'),
     'view_item' => __('Ver Proyecto'),
     'search_items' => __('Buscar Proyecto'),
     'not_found' =>  __('No se han encontrado proyectos'),
     'not_found_in_trash' => __('No se han encontrado proyectos en la papelera'),
     'parent_item_colon' => '',
     'menu_name' => __('Proyectos')

   );
   $args = array(
     'labels' => $labels,
     'public' => true,
     'publicly_queryable' => true,
     'show_ui' => true,
     'show_in_menu' => true,
     'query_var' => true,
     'rewrite' => true,
     'capability_type' => 'post',
     'has_archive' => true,
     'hierarchical' => false,
     'menu_position' => null,
     'supports' => array( 'title', 'editor', 'author', 'thumbnail', 'excerpt', 'comments' )
   );
   register_post_type('project',$args);
 }
 add_action( 'init', 'codex_custom_init' );

flush_rewrite_rules();
 ?>
