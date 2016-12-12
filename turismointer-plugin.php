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

define( 'TURISMO_PLUGIN_PATH', plugin_dir_url( __FILE__ ) );

/**
 * Check if Piklist is activated and installed
 */
add_action('init', 'turismo_init_function');
function turismo_init_function()
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
function turismo_plugin_init() {
    $plugin_dir = basename(dirname(__FILE__)).'/languages';
    //echo '<h1>'.$plugin_dir.'</h1>';
    load_plugin_textdomain( 'imgd', false, $plugin_dir );
    wp_enqueue_script( 'turismo-programa', TURISMO_PLUGIN_PATH.'assets/js/jquery.fitvids.js', array( 'jquery' ), null, true );
}
add_action('plugins_loaded', 'turismo_plugin_init');

/**
 * Definir El Custom Post Type
 *
 * @name: Casino
 * @dependencies: Piklist
 */
add_filter('piklist_post_types', 'turismo_post_type');

function turismo_post_type($post_types)
{
    $singular = 'Programa';
    $plural = 'Programas';

    $post_types['imgd_programa'] = array(
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
        /*,'status' => array(
          'draft' => array(
              'label' => __('draft', LANG),
              'public' => false
              ),
          'pending' => array(
              'label' => __('pending', LANG),
              'public' => false
              ),
          'publish' => array(
            'label' => __('publish', LANG),
            'public' => true
        )
      )*/
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

    $singular = 'Operador';
    $plural = 'Operadores';

    $post_types['imgd_servicio'] = array(
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
        ,'has_archive' => __('operadores','imgd')
        ,'menu_icon' => 'dashicons-groups'
        ,'page_icon' => 'dashicons-groups'
        ,'rewrite' => array(
            'slug' => __('servicio', 'imgd')
        )
    ,'supports' => array(
            'title',
            'editor',
            'author',
            'thumbnail'
        )
    ,'menu_position'=> 20
    ,'edit_columns' => array(
            'title' => __($plural, 'imgd')
        )
    ,'hide_meta_box' => array(
            'slug'
            ,'author'
            ,'revisions'
            ,'comments'
            ,'mymetabox_revslider_0' // Rev Slider Metabox
            ,'commentstatus'
        )
    );


    return $post_types;
}


/**
 * Definir Taxonomía del Custom Post Type
 *
 * @name: IMGD Ciudad y Pais del Programa
 * @dependencies: Piklist
 */

add_filter('piklist_taxonomies', 'show_categoria');

function show_categoria($taxonomies)
{
  $labelUbica = array(
    'name'                          => __( 'Ubicaciones', 'imgd' ),
    'singular_name'                 => __( 'Ubicación', 'imgd' ),
    'search_items'                  => __( 'Buscar la Ubicación', 'imgd' ),
    'popular_items'                 => __( 'Ubicaciones Populares', 'imgd' ),
    'all_items'                     => __( 'Todas las Ubicaciones', 'imgd' ),
    'parent_item'                   => __( 'Ubicación pariente', 'imgd' ),
    'edit_item'                     => __( 'Editar Ubicación', 'imgd' ),
    'update_item'                   => __( 'Actualizar Ubicación', 'imgd' ),
    'add_new_item'                  => __( 'Agregar una nueva Ubicación', 'imgd' ),
    'new_item_name'                 => __( 'Nueva Ubicación', 'imgd' ),
    'separate_items_with_commas'    => __( 'Separe las Ubicaciones con comas', 'imgd' ),
    'add_or_remove_items'           => __( 'Agregue o Borre Ubicaciones', 'imgd' ),
    'choose_from_most_used'         => __( 'Elija alguna ubicación entre las más usadas', 'imgd' )
);
    $taxonomies[] = array(
        'post_type' => array('imgd_programa', 'post', 'page')
        ,'name' => 'imgd_programa_ubicacion'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => true
            ,'labels' => $labelUbica
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('ubicacion', 'imgd')
                )
            )
    );

    $labelempresa = array(
      'name'                          => __( 'Empresas', 'imgd' ),
      'singular_name'                 => __( 'Empresa', 'imgd' ),
      'search_items'                  => __( 'Buscar la Empresa', 'imgd' ),
      'popular_items'                 => __( 'Empresas Populares', 'imgd' ),
      'all_items'                     => __( 'Todas las Empresas', 'imgd' ),
      'parent_item'                   => __( 'Empresa pariente', 'imgd' ),
      'edit_item'                     => __( 'Editar Empresa', 'imgd' ),
      'update_item'                   => __( 'Actualizar Empresa', 'imgd' ),
      'add_new_item'                  => __( 'Agregar una nueva Empresa', 'imgd' ),
      'new_item_name'                 => __( 'Nueva Empresa', 'imgd' ),
      'separate_items_with_commas'    => __( 'Separe las Empresas con comas', 'imgd' ),
      'add_or_remove_items'           => __( 'Agregue o Borre Empresas', 'imgd' ),
      'choose_from_most_used'         => __( 'Elija alguna Empresa entre las más usadas', 'imgd' )
    );

    $taxonomies[] = array(
        'post_type' => array('imgd_servicio')
        ,'name' => 'imgd_servicio_empresa'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => $labelempresas
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('empresa', 'imgd')
                )
            )
    );

    $labelcategorias = array(
      'name'                          => __( 'Categorias', 'imgd' ),
      'singular_name'                 => __( 'Categoría', 'imgd' ),
      'search_items'                  => __( 'Buscar la Categoría', 'imgd' ),
      'popular_items'                 => __( 'Categorias Populares', 'imgd' ),
      'all_items'                     => __( 'Todas las Categorias', 'imgd' ),
      'parent_item'                   => __( 'Categoría pariente', 'imgd' ),
      'edit_item'                     => __( 'Editar Categoría', 'imgd' ),
      'update_item'                   => __( 'Actualizar Categoría', 'imgd' ),
      'add_new_item'                  => __( 'Agregar una nueva Categoría', 'imgd' ),
      'new_item_name'                 => __( 'Nueva Categoría', 'imgd' ),
      'separate_items_with_commas'    => __( 'Separe las Categorias con comas', 'imgd' ),
      'add_or_remove_items'           => __( 'Agregue o Borre Categorias', 'imgd' ),
      'choose_from_most_used'         => __( 'Elija alguna Categoría entre las más usadas', 'imgd' )
    );

    $taxonomies[] = array(
        'post_type' => array('imgd_servicio')
        ,'name' => 'imgd_servicio_categoria'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => $labelcategorias
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('categoria', 'imgd')
                )
            )
    );

    $labelciudad = array(
      'name'                          => __( 'Ciudades', 'imgd' ),
      'singular_name'                 => __( 'Ciudad', 'imgd' ),
      'search_items'                  => __( 'Buscar la Ciudad', 'imgd' ),
      'popular_items'                 => __( 'Ciudades Populares', 'imgd' ),
      'all_items'                     => __( 'Todas las Ciudades', 'imgd' ),
      'parent_item'                   => __( 'Ciudad pariente', 'imgd' ),
      'edit_item'                     => __( 'Editar Ciudad', 'imgd' ),
      'update_item'                   => __( 'Actualizar Ciudad', 'imgd' ),
      'add_new_item'                  => __( 'Agregar una nueva Ciudad', 'imgd' ),
      'new_item_name'                 => __( 'Nueva Ciudad', 'imgd' ),
      'separate_items_with_commas'    => __( 'Separe las Ciudades con comas', 'imgd' ),
      'add_or_remove_items'           => __( 'Agregue o Borre Ciudades', 'imgd' ),
      'choose_from_most_used'         => __( 'Elija alguna ciudad entre las más usadas', 'imgd' )
    );

    $taxonomies[] = array(
        'post_type' => array('imgd_servicio')
        ,'name' => 'imgd_servicio_ciudad'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => $labelciudad
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('ciudad', 'imgd')
                )
            )
    );

    $labelestado = array(
      'name'                          => __( 'Estados', 'imgd' ),
      'singular_name'                 => __( 'Estado', 'imgd' ),
      'search_items'                  => __( 'Buscar la Estado', 'imgd' ),
      'popular_items'                 => __( 'Estado Populares', 'imgd' ),
      'all_items'                     => __( 'Todas las Estado', 'imgd' ),
      'parent_item'                   => __( 'Estado pariente', 'imgd' ),
      'edit_item'                     => __( 'Editar Estado', 'imgd' ),
      'update_item'                   => __( 'Actualizar Estado', 'imgd' ),
      'add_new_item'                  => __( 'Agregar una nueva Estado', 'imgd' ),
      'new_item_name'                 => __( 'Nueva Estado', 'imgd' ),
      'separate_items_with_commas'    => __( 'Separe los Estados con comas', 'imgd' ),
      'add_or_remove_items'           => __( 'Agregue o Borre Estado', 'imgd' ),
      'choose_from_most_used'         => __( 'Elija algún Estado entre las más usadas', 'imgd' )
    );

    $taxonomies[] = array(
        'post_type' => array('imgd_servicio')
        ,'name' => 'imgd_servicio_estado'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => $labelestado
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('estado', 'imgd')
                )
            )
    );

    $labelpais = array(
      'name'                          => __( 'Paises', 'imgd' ),
      'singular_name'                 => __( 'País', 'imgd' ),
      'search_items'                  => __( 'Buscar el País', 'imgd' ),
      'popular_items'                 => __( 'Paises Populares', 'imgd' ),
      'all_items'                     => __( 'Todas los Paises', 'imgd' ),
      'parent_item'                   => __( 'País pariente', 'imgd' ),
      'edit_item'                     => __( 'Editar País', 'imgd' ),
      'update_item'                   => __( 'Actualizar País', 'imgd' ),
      'add_new_item'                  => __( 'Agregar un nuevo País', 'imgd' ),
      'new_item_name'                 => __( 'Nuevo País', 'imgd' ),
      'separate_items_with_commas'    => __( 'Separe los Paises con comas', 'imgd' ),
      'add_or_remove_items'           => __( 'Agregue o Borre País', 'imgd' ),
      'choose_from_most_used'         => __( 'Elija algún País entre los más usadas', 'imgd' )
    );

    $taxonomies[] = array(
        'post_type' => array('imgd_servicio')
        ,'name' => 'imgd_servicio_pais'
        ,'show_admin_column' => true
        ,'configuration' => array(
            'hierarchical' => false
            ,'labels' => $labelpais
            ,'show_ui' => true
            ,'query_var' => true
            ,'rewrite' => array(
                    'slug' => __('pais', 'imgd')
                )
            )
    );

    return $taxonomies;

}

/*
* Obtengo los últimos Programas
*
* @param number $cant default 'All' (-1)
* @return object WP Query
*/
function get_ultimos_programas($cant='-1'){
  $args = array(
      'post_type' => array('imgd_programa'),
      'post_status' => 'publish',
      'posts_per_page' => intval($cant)
  );
  //echo var_dump($args);
  $loop = new WP_Query($args);

  return $loop;
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


/* Datos del Video */
function get_datos_video($post_ID){
  $datos='';

  $nro = get_post_meta($post_ID , 'imgd_programa_nro', true);
  $produccion = get_post_meta($post_ID , 'imgd_programa_produccion', true);
  $director = get_post_meta($post_ID , 'imgd_programa_director', true);
  $ano = get_post_meta($post_ID , 'imgd_programa_ano', true);

  if($nro) $datos .= '<strong>Programa Nro:</strong> '.$nro.'<br>';
  if($produccion) $datos .= '<strong>Productor:</strong> '.$produccion.'<br>';
  if($director) $datos .= '<strong>Director:</strong> '.$director.'<br>';
  if($ano) $datos .= '<strong>Año:</strong> '.$ano.'<br>';

  if($datos!='') $datos = '<div class="datos"> <h3>'.__('Datos de Producción', 'imgd').'</h3>'.$datos.'</div>';

  return $datos;
}


/* Datos del servicio */
function get_datos_servicio($post_ID){
  $datos='';

  $contactos = get_post_meta($post_ID , 'imgd_servicio_contacto_name');
  if ($contactos) {
    $datos .= '<strong>Contacto:</strong> ';
    foreach ($contactos as $contacto) {
      if($contacto) $datos .= $contacto;
    }
  }
  $direcciones = get_post_meta($post_ID , 'imgd_direccion_group');
  if ($direcciomes) {
    $datos .= '<strong>Direccióm:</strong> ';
    foreach ($direcciones as $contacto) {
      if($direccion) $datos .= $contacto;
    }
  }

  $tels = get_post_meta($post_ID , 'imgd_servicio_tel');
  $cels = get_post_meta($post_ID , 'imgd_servicio_cel');
  $emails = get_post_meta($post_ID , 'imgd_servicio_cel');



 //var_dump($direcciom);

  // $produccion = get_post_meta($post_ID , 'imgd_programa_produccion', true);
  // $director = get_post_meta($post_ID , 'imgd_programa_director', true);
  // $ano = get_post_meta($post_ID , 'imgd_programa_ano', true);
  //
  // if($nro) $datos .= '<strong>Programa Nro:</strong> '.$nro.'<br>';
  // if($produccion) $datos .= '<strong>Productor:</strong> '.$produccion.'<br>';
  // if($director) $datos .= '<strong>Director:</strong> '.$director.'<br>';
  // if($ano) $datos .= '<strong>Año:</strong> '.$ano.'<br>';
  //
  // if($datos!='') $datos = '<div class="datos"> <h3>'.__('Datos de Producción', 'imgd').'</h3>'.$datos.'</div>';

  return $datos;
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

/**
 * Devuelve la data del Show
 **/
function imgd_casino_show_data ($post_ID){
   echo  get_imgd_casino_show_data ($post_ID);
}

/**
* IMGD Paises
* Devuelve un array con los países
*
**/
function imgd_paises(){
  $paises = array(
		"Afghanistan",
		"Albania",
		"Algeria",
		"Andorra",
		"Angola",
		"Antigua and Barbuda",
		"Argentina",
		"Armenia",
		"Australia",
		"Austria",
		"Azerbaijan",
		"Bahamas",
		"Bahrain",
		"Bangladesh",
		"Barbados",
		"Belarus",
		"Belgium",
		"Belize",
		"Benin",
		"Bhutan",
		"Bolivia",
		"Bosnia and Herzegovina",
		"Botswana",
		"Brazil",
		"Brunei",
		"Bulgaria",
		"Burkina Faso",
		"Burundi",
		"Cambodia",
		"Cameroon",
		"Canada",
		"Cape Verde",
		"Central African Republic",
		"Chad",
		"Chile",
		"China",
		"Colombia",
		"Comoros",
		"Congo (Brazzaville)",
		"Congo",
		"Costa Rica",
		"Cote d'Ivoire",
		"Croatia",
		"Cuba",
		"Cyprus",
		"Czech Republic",
		"Denmark",
		"Djibouti",
		"Dominica",
		"Dominican Republic",
		"East Timor (Timor Timur)",
		"Ecuador",
		"Egypt",
		"El Salvador",
		"Equatorial Guinea",
		"Eritrea",
		"Estonia",
		"Ethiopia",
		"Fiji",
		"Finland",
		"France",
		"Gabon",
		"Gambia, The",
		"Georgia",
		"Germany",
		"Ghana",
		"Greece",
		"Grenada",
		"Guatemala",
		"Guinea",
		"Guinea-Bissau",
		"Guyana",
		"Haiti",
		"Honduras",
		"Hungary",
		"Iceland",
		"India",
		"Indonesia",
		"Iran",
		"Iraq",
		"Ireland",
		"Israel",
		"Italy",
		"Jamaica",
		"Japan",
		"Jordan",
		"Kazakhstan",
		"Kenya",
		"Kiribati",
		"Korea, North",
		"Korea, South",
		"Kuwait",
		"Kyrgyzstan",
		"Laos",
		"Latvia",
		"Lebanon",
		"Lesotho",
		"Liberia",
		"Libya",
		"Liechtenstein",
		"Lithuania",
		"Luxembourg",
		"Macedonia",
		"Madagascar",
		"Malawi",
		"Malaysia",
		"Maldives",
		"Mali",
		"Malta",
		"Marshall Islands",
		"Mauritania",
		"Mauritius",
		"Mexico",
		"Micronesia",
		"Moldova",
		"Monaco",
		"Mongolia",
		"Morocco",
		"Mozambique",
		"Myanmar",
		"Namibia",
		"Nauru",
		"Nepa",
		"Netherlands",
		"New Zealand",
		"Nicaragua",
		"Niger",
		"Nigeria",
		"Norway",
		"Oman",
		"Pakistan",
		"Palau",
		"Panama",
		"Papua New Guinea",
		"Paraguay",
		"Peru",
		"Philippines",
		"Poland",
		"Portugal",
		"Qatar",
		"Romania",
		"Russia",
		"Rwanda",
		"Saint Kitts and Nevis",
		"Saint Lucia",
		"Saint Vincent",
		"Samoa",
		"San Marino",
		"Sao Tome and Principe",
		"Saudi Arabia",
		"Senegal",
		"Serbia and Montenegro",
		"Seychelles",
		"Sierra Leone",
		"Singapore",
		"Slovakia",
		"Slovenia",
		"Solomon Islands",
		"Somalia",
		"South Africa",
		"Spain",
		"Sri Lanka",
		"Sudan",
		"Suriname",
		"Swaziland",
		"Sweden",
		"Switzerland",
		"Syria",
		"Taiwan",
		"Tajikistan",
		"Tanzania",
		"Thailand",
		"Togo",
		"Tonga",
		"Trinidad and Tobago",
		"Tunisia",
		"Turkey",
		"Turkmenistan",
		"Tuvalu",
		"Uganda",
		"Ukraine",
		"United Arab Emirates",
		"United Kingdom",
		"United States",
		"Uruguay",
		"Uzbekistan",
		"Vanuatu",
		"Vatican City",
		"Venezuela",
		"Vietnam",
		"Yemen",
		"Zambia",
		"Zimbabwe"
	);
  return $paises;
}
