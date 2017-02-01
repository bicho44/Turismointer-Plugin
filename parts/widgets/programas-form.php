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
,'columns' => 12
,'choices' =>  piklist(
              get_posts(
                 array(
                  'post_type' => 'imgd_programa'
                  ,'orderby' => 'post_date'
                 )
                 ,'objects'
               )
               ,array(
                 'ID'
                 ,'post_title'
               )
)
));
