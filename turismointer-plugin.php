<?php
/*
Plugin Name: IMGD Turismo Interoceanico
Plugin URI: http://imgdigital.com.ar/portfolio/projects/
Description: Este es un Plug-in para el sitio del Turismo Interoceanicoes
Version: 1.0.0
Author: Federico Reinoso
Author URI: http://imgdigital.com.ar
Text Domain: imgd
Domain Path: languages/
Plugin Type: Piklist
License: GPL2
*/

define( 'SHOWS_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

/**
 * Check if Piklist is activated and installed
 */
add_action('init', 'turimo_init_function');
function casino_init_function()
{
    if(is_admin())
    {
        include_once(plugin_dir_path(__FILE__).'class-piklist-checker.php');

        if (!piklist_checker::check(__FILE__))
        {
            return;
        }
    }
}

/**
 * Loading Translation
 */
function casino_plugin_init() {
    $plugin_dir = basename(dirname(__FILE__)).'/languages';
    //echo '<h1>'.$plugin_dir.'</h1>';
    load_plugin_textdomain( 'imgd', false, $plugin_dir );
}
add_action('plugins_loaded', 'turismo_plugin_init');

/**
 * Definir El Custom Post Type
 *
 * @name: Casino
 * @dependencies: Piklist
 */
add_filter('piklist_post_types', 'casino_post_type');

function casino_post_type($post_types)
{
    $singular = 'Programa';
    $plural = 'Programas';

    $post_types['imgd_programas'] = array(
        'labels' => array(
                'name'               => _x( $plural, 'post type general name', 'imgd' ),
                'singular_name'      => _x( $singular, 'post type singular name', 'imgd' ),
                'menu_name'          => _x( $plural, 'admin menu', 'imgd' ),
                'name_admin_bar'     => _x( $singular, 'add new on admin bar', 'imgd' ),
                'add_new'            => _x( 'Agregue un '.$singular, 'barco', 'imgd' ),
                'add_new_item'       => __( 'Agregue un nuevo '.$singular, 'imgd' ),
                'new_item'           => __( 'Nuevo '.$singular, 'imgd' ),
                'edit_item'          => __( 'Edite el '.$singular, 'imgd' ),
                'view_item'          => __( 'Ver '.$singular, 'imgd' ),
                'all_items'          => __( 'Todos los '.$plural, 'imgd' ),
                'search_items'       => __( 'Buscar '.$plural, 'imgd' ),
                'parent_item_colon'  => __( $singular.' Pariente:', 'imgd' ),
                'not_found'          => __( 'No se encontraron '.$plural, 'imgd' ),
                'not_found_in_trash' => __( 'No se encontraron '.$plural.' en la Basura.', 'imgd' )
            )
        ,'type' => 'page'
        ,'title' => __('Ingrese un nuevo '.$singular, 'imgd')
        ,'public' => true
        ,'capability_type' => 'page'
        ,'has_archive' => __('programas','imgd')
        ,'menu_icon' => 'dashicons-tickets-alt'
        ,'page_icon' => 'dashicons-tickets-alt'
        ,'rewrite' => array(
            'slug' => __('programa', 'imgd')
        )
    ,'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail'
        )
    ,'menu_position'=>20
    ,'edit_columns' => array(
            'title' => __($plural, 'imgd')
        )
    ,'hide_meta_box' => array(
            'slug'
            ,'author'
            ,'revisions'
            ,'comments'
            ,'mymetabox_revslider_0' // Rev Slider Metabox
            ,'postimagediv' //Feature Image div
            ,'commentstatus'
        )
    );
    return $post_types;
}


/**
 * Definir Taxonomía del Custom Post Type
 *
 * @name: IMGD Categoria del Show
 * @dependencies: Piklist
 */

add_filter('piklist_taxonomies', 'show_categoria');

function show_categoria($taxonomies)
{
    $taxonomies[] = array(
        'post_type' => 'imgd_programas'
        ,'name' => 'imgd_programa_ciudad'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => piklist('taxonomy_labels', __('Ciudad', 'imgd'))
            ,'hide_meta_box' => true
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('ciudad', 'imgd')
                )
            )
    );
    $taxonomies[] = array(
        'post_type' => 'imgd_programas'
        ,'name' => 'imgd_programa_pais'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => piklist('taxonomy_labels', __('Pais', 'imgd'))
            ,'hide_meta_box' => true
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('pais', 'imgd')
                )
            )
    );
    return $taxonomies;

}

/**
 * Get terms dropdown
 *
 * Arma un Dropdwn de los términos de las categorías
 *
 * @param $taxonomies
 * @param $args
 * @return string
 */
function get_terms_dropdown($taxonomies, $args){

    $myterms = get_terms($taxonomies, $args);

    $output ="<select name='.$taxonomies.'>";

    foreach($myterms as $term){
        $root_url = get_bloginfo('url');
        $term_taxonomy=$term->taxonomy;
        $term_slug=$term->slug;
        $term_name =$term->name;
         $link = get_term_link($term->term_id, $term->taxonomy);
        $output .="<option value='".$link."'>".$term_name."</option>";
    }
    $output .="</select>";
    return $output;
}

// add_filter('piklist_admin_pages', 'imgd_casino_setting_pages');
// function imgd_casino_setting_pages($pages)
// {
//     $pages[] = array(
//         'page_title' => __('Preferencias Casino','imgd')
//     ,'menu_title' => __('Casino', 'imgd')
//     ,'capability' => 'manage_options'
//     ,'menu_slug' => 'custom_settings'
//     ,'setting' => 'casino_settings'
//     ,'menu_icon' => plugins_url('casino-plugin/assets/img/casino-icono.png')
//     ,'page_icon' => plugins_url('casino-plugin/assets/img/casino-icono-32.png')
//     ,'single_line' => true
//     ,'position'=> '59'
//     ,'default_tab' => 'Pozos'
//     ,'save_text' => __('Actualizar','imgd')
//     );
//
//     return $pages;
// }


function imgd_get_email(){
    return $imgd_email;
}


/*
 * Obtengo la Fecha del Show
 */
function get_imgd_casino_show_date($post_ID){

    $data='';

    $fecha = get_post_meta($post_ID , 'imgd_casino_show_date', true);


    if (!empty($fecha)) {
        $data ='<h5>El '.$fecha.' a las '. get_post_meta($post_ID , 'imgd_casino_show_hora', true).'</h5>';
    }

    return $data;
}

/*
 * Obtengo el nombre de Salón
 */
function get_imgd_casino_show_salon($post_ID){

    $data='';

    $salones = get_post_meta($post_ID , 'imgd_casino_show_salon');
//echo var_dump($salones);
    $salon = get_term( $salones[0],'imgd_casino_salon');


    if(!empty($salon)) {
        $data = '<h4>'.$salon->name.'</h4>';
    }

    return $data;
}

/*
 * Obtengp la data correspondiente al show
 */
function get_imgd_casino_show_data($post_ID) {

    $data = '';

    $data .= get_imgd_casino_show_date($post_ID);

    $data .= get_imgd_casino_show_salon($post_ID);

    return $data;

}

/*
 * Devuelve la data del Show
 */
function imgd_casino_show_data ($post_ID){
   echo  get_imgd_casino_show_data ($post_ID);
}
