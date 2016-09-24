<?php

piklist('field', array(
    'type' => 'text'
,'field' => 'imgd_programa_widget_title'
,'label' => __('Título', 'imgd')
,'value' => __('Último Programa', 'imgd')
,'attributes' => array(
        'class' => 'regular-text'
    )
));


piklist('field', array(
    'type' => 'select'
,'field' => 'imgd_programa_widget_seleccion'
,'label' => __('Mostrar', 'imgd')
,'description' => __('Selecciona el programa a mostrar','imgd')
,'value' => 5
,'attributes' => array(
        'class' => 'small-text'
    ,'step' => 1
    ,'min' => 0
    ,'max' => 12
    )
));
