<?php
/*
Title: Datos de Servicio
Post Type: imgd_servicio
Description: Datos correcpondientes al tipo de servicio
Priority: default
Order: 3
*/

// nombre contacto multiples
// Cel multiple
// Categoría Principal del Servicio
// web multiple
// email multiple
// taxonomies
// Mapa?
// Categoría Ubicaciones (esta es la generica)

piklist (
    'field',
    array(
        'type' => 'text',
        'scope' => 'post_meta',
        'field' => 'imgd_servicio_contacto_name',
        'label' => __('Nombre de contacto', 'imgd'),
        'value' => '',
        'columns' => 12,
        'add_more' => true,
        'attributes' => array(
            'class' => 'text'
        ),
        'position' => 'wrap'
    )
);

piklist('field', array(
    'type' => 'group'
    ,'field' => 'imgd_direccion_group'
    ,'label' => __('Dirección', 'imgd')
    ,'list' => false
    ,'fields' => array(
      array(
        'type' => 'text'
        ,'field' => 'address_1'
        ,'label' => __('Calle', 'imgd')
        ,'required' => true
        ,'columns' => 12
        ,'attributes' => array(
          'placeholder' => 'Calle'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'address_2'
        ,'label' => __('Calle segunda línea', 'imgd')
        ,'columns' => 12
        ,'attributes' => array(
          'placeholder' => 'Segunda línea'
        )
      )
      ,array(
        'type' => 'text'
        ,'field' => 'postal_code'
        ,'label' => __('Código Postal', 'imgd')
        ,'columns' => 3
        ,'attributes' => array(
          'placeholder' => 'Codigo Postal'
        )
      )
    )
    ,'on_post_status' => array(
      'value' => 'lock'
    )
  ));

piklist (
    'field',
    array(
        'type' => 'text',
        'scope' => 'post_meta',
        'field' => 'imgd_servicio_tel',
        'label' => __('Tel', 'imgd'),
        'value' => '',
        'add_more' => true,
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
        'field' => 'imgd_servicio_cel',
        'label' => __('Cel', 'imgd'),
        'value' => '',
        'add_more' => true,
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
        'field' => 'imgd_servicio_email',
        'label' => __('Email', 'imgd'),
        'value' => '',
        'add_more' => true,
        'attributes' => array(
            'class' => 'text'
        ),
        'position' => 'wrap',
        'sanitize' => array(
          array(
            'type' => 'email'
          )
        )
    )
);
piklist (
    'field',
    array(
        'type' => 'text',
        'scope' => 'post_meta',
        'field' => 'imgd_servicio_web',
        'label' => __('Web', 'imgd'),
        'value' => '',
        'add_more' => true,
        'attributes' => array(
            'class' => 'text',
            'placeholder'=> 'http://',
        ),
        'position' => 'wrap'
    )
);
