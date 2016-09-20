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
        'title' => __('Imagen del Programa', 'imgd')
        ,'button' => __('Inserte la imagen', 'imgd')
    )
));

$uploaddir = wp_upload_dir();
$uploadfile = $uploaddir['path'] . '/' . $filename;

$contents= file_get_contents($uploadfile);
$savefile = fopen($uploadfile, 'w');
fwrite($savefile, $contents);
fclose($savefile);
?>
<script type="text/javascript">

jQuery(document).ready(function( $ ) {

  $("#_post_meta_imgd_programa_video_0").on('change',function () {
     var ytl = $( "#_post_meta_imgd_programa_video_0" ).val();
     var yti = ytl.match(/(?:https?:\/{2})?(?:w{3}\.)?youtu(?:be)?\.(?:com|be)(?:\/watch\?v=|\/)([^\s&]+)/);
     $('_post_meta__thumbnail_id_0').value("http://i3.ytimg.com/vi/"+ yti[1] + "/hqdefault.jpg");
     //$( "#msg" ).html( "<img src=\"http://i3.ytimg.com/vi/" + yti[1] + "/hqdefault.jpg\" /><input name=\"imageURL\" id=\"copyimageURL\" class=\"text\" type=\"text\" value=\"http://i3.ytimg.com/vi/"+ yti[1] + "/hqdefault.jpg\" onclick=\"this.select()\" readonly />" );
  });

});
</script>
