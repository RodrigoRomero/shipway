<?php 
$attr = explode(",",$data->atributos_id);
$json = json_decode($data->json);
if(in_array('20002',$attr)){
    $lnk = 'onclick="window.location.href =\''.lang_url('casos-de-exito/detalle/'.$data->id.'/'.$json->lang->$Clang->proyecto.'').'\' "';
}

?>
<li class="item" style="background: url('<?php echo up_file('porfolios/'.$data->id.'_home.jpg')?>');">
    <div class="container" <?php echo $lnk ?> >
        <div class="carousel-caption">
            <h2><?php echo $json->lang->$Clang->proyecto?></h2>
            <p class="lead"><?php echo $json->lang->$Clang->resumen ?></p>
        </div>
    </div>
</li>