<?php
/*
Title: Datos de Producción
Post Type: imgd_programa
Description: Datos sobre la Producción del Programa
Priority: default
Order: 3
*/

piklist (
    'field',
    array(
        'type' => 'number',
        'scope' => 'post_meta',
        'field' => 'imgd_programa_ano',
        'label' => __('Año', 'imgd'),
        'value' => 2016,
        'attributes' => array(
            'class' => 'text'
        ),
        'position' => 'wrap'
    )
);

piklist (
    'field',
    array(
        'type' => 'text',
        'scope' => 'post_meta',
        'field' => 'imgd_programa_director',
        'label' => __('Director', 'imgd'),
        'value' => 'Carlos Snaimon',
        'attributes' => array(
            'class' => 'text'
        ),
        'position' => 'wrap'
    )
);

piklist (
    'field',
    array(
        'type' => 'text',
        'scope' => 'post_meta',
        'field' => 'imgd_programa_produccion',
        'label' => __('Producción', 'imgd'),
        'value' => 'Filmarte',
        'attributes' => array(
            'class' => 'text'
        ),
        'position' => 'wrap'
    )
);
