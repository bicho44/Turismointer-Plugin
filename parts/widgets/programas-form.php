<?php

piklist('field', 
    array(
        'type' => 'text'
    ,'field' => 'imgd_programa_widget_title'
    ,'label' => __('Título', 'imgd')
    ,'value' => __('Último Programa', 'imgd')
    ,'attributes' => array(
            'class' => 'regular-text'
        )
    )
);

piklist('field', array(
'type' => 'select'
,'field' => 'imgd_programa_widget_seleccion'
,'columns' => 12
,'choices' =>  piklist(
              get_posts(
                 array(
                  'post_type' => 'imgd_programa'
                  ,'posts_per_page' => 12
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

piklist (
    'field',
    array(
        'type' => 'radio',
        'field' => 'imgd_programa_thumb',
        'label' => __('Muestra el Thumbnail', 'imgd'),
        'value' => 0,
        'attributes' => array(
            'class' => 'radio'
        ),
        'choices' => array(
            0 => __('No', 'imgd'),
            1 => __('Si', 'imgd')
        ),
        'position' => 'wrap'
    )
);

piklist (
    'field',
    array(
        'type' => 'radio',
        'field' => 'imgd_programa_thumb_format',
        'label' => __('Formato del Thumbnail', 'imgd'),
        'value' =>  'img-square' ,
         'attributes' => array (
            'class' => 'radio'
        ),
        'choices' => array(
            'img-square' => __('Cuadrado', 'imgd'),
             'img-circle' => __('Redondo', 'imgd')
        ),
        'conditions' => array(
                    array(
                        'field' => 'imgd_programa_thumb'
                        , 'value' => 1
                    )
                )
    )
);

piklist('field', array(
    'type' => 'select'
    ,'field' => 'imgd_programa_thumb_sizes'
    , 'label' => __('Tamaño del Thumbnail', 'imgd')
    ,'choices' =>  get_intermediate_image_names()
    ,'value' => 'thumbnail'
    ,'conditions' => array(
                        array(
                            'field' => 'imgd_programa_thumb'
                            , 'value' => 1
                        )
        )
    )
);
