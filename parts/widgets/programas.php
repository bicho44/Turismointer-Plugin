<?php
/**
 * Title: Programas Turismo InterOceánico
 * Description: Widget para destacar un Programa de Turismo InterOceánico
 */

piklist::pre($settings);

$title = "";
$cant = "";
$ID_programa = "";

//global $imgd_email;
if (isset($settings['imgd_programa_widget_title'])){
    $title = $settings['imgd_programa_widget_title'];
}

if (isset($settings['imgd_programa_widget_seleccion'])){
    $ID_programa = $settings['imgd_programa_widget_seleccion'];
}

// Cantidad de Show a Mostrar @todo agregar la opcion en el widget
//if (isset($settings['imgd_shows_widget_cantidad']))  $cant = $settings['imgd_shows_widget_cantidad'][0];



//if (isset($settings['imgd_shows_widget_orden']))  $image = $settings['lateral_image'];

//if (isset($settings['imgd_shows_widget_orden'])) $orden = $settings['imgd_shows_widget_orden'];


/*
 * Array
(
    [imgd_shows_widget_title] => Próximos Shows
    [imgd_shows_widget_cantidad] => Array
        (
            [0] => 5
        )

    [imgd_shows_widget_orden] => fecha
)
 */


echo $before_title;

echo $title;

echo $after_title;

echo $before_widget;
// Acá seleciono las Páginas que voy a mostrar en la Home
if($ID_programa!=0) {
$programa = get_post( $ID_programa );
$programa_url = get_permalink($ID_programa);
$programa_title= $programa->post_title;

//piklist::pre($programa);

    if (has_post_thumbnail( $ID_programa )) { ?>
        <a href="<?php echo $programa_url; ?>">
            <?php echo get_the_post_thumbnail( $ID_programa, 'thumbnail', array('class'=>'img-circle') );  ?>
        </a>
    <?php } ?>
    <h3><a href="<?php echo $programa_url; ?>">
            <?php echo $programa_title; ?>
    </a></h3>     
<?php } ?>
<?php 
echo $after_widget;
