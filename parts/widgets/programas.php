<?php
/**
 * Title: Programas Turismo InterOceánico
 * Description: Widget para destacar un Programa de Turismo InterOceánico
 * Standalone: true
 */

//piklist::pre($settings);

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

If (isset($settings[ 'imgd_programa_thumb_format'][0])){
    $class = $settings[ 'imgd_programa_thumb_format'][0];
}

If (isset($settings[ 'imgd_programa_thumb_sizes'])){
    $format_thumb = $settings[ 'imgd_programa_thumb_sizes'];
}
// Cantidad de Show a Mostrar @todo agregar la opcion en el widget
//if (isset($settings['imgd_shows_widget_cantidad']))  $cant = $settings['imgd_shows_widget_cantidad'][0];


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

If ($settings[ 'imgd_programa_thumb']!=0){
    if (has_post_thumbnail( $ID_programa )) { ?>
        <a href="<?php echo $programa_url; ?>">
            <?php echo get_the_post_thumbnail( $ID_programa, $format_thumb, array('class'=>$class) );  ?>
        </a>
    <?php } ?>
<?php } ?>
    <h3><a href="<?php echo $programa_url; ?>">
            <?php echo $programa_title; ?>
    </a></h3>     
<?php } ?>
<?php 
echo $after_widget;
