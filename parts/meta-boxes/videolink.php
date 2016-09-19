<?php
/*
Title: You Tube Video Link
Post Type: imgd_programa
Description: Link al video de Youtube
Priority: high
Order: 3
Context: side
*/

piklist (
    'field',
    array(
        'type' => 'text',
        'scope' => 'post_meta',
        'field' => 'imgd_programa_video',
        'label' => __('Link Youtube', 'imgd'),
        'value' => '',
        'attributes' => array(
            'class' => 'text'
        ),
        'position' => 'wrap'
    )
);

piklist('field', array(
    'type' => 'file'
    ,'field' => '_thumbnail_id' // Use these field to match WordPress featured images.
    ,'scope' => 'post_meta'
    ,'options' => array(
        'title' => __('Imagenes del Show', 'imgd')
        ,'button' => __('Inserte las imagenes', 'imgd')
    )
));
