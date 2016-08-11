<?php $separador = ($pos%2==1) ? 'offset1' : ''; 
$json = json_decode($item->json);

?>
<div class="span4 <?php echo $separador ?>" style="margin-bottom: 20px;">
    <div class="">
        <a href="<?php echo lang_url('casos-de-exito/detalle/'.$item->id.'/'.$json->lang->$Clang->nombre)?>">
            <?php echo up_asset('porfolios/original/'.$item->id.'_0.jpg', array('class'=>'img-polaroid', 'alt'=>$json->lang->$Clang->nombre.' '.$categoria->lang->$Clang->nombre, 'title'=>$json->lang->$Clang->nombre.' '.$categoria->lang->$Clang->nombre)) ?>
        </a>
        <h4>
        <?php echo lang('caso').': '. $json->lang->$Clang->nombre; ?><br/>
        <?php echo lang('pais').': '.$json->lang->$Clang->pais; ?><br />
         <?php echo lang('rubro').': '.$categoria->lang->$Clang->nombre ?>
        </h4>
        <p><?php echo $json->lang->$Clang->resumen ?></p>
        <a href="<?php echo lang_url('casos-de-exito/detalle/'.$item->id.'/'.$json->lang->$Clang->nombre) ?>" class="btn-leer" title="<?php echo $json->lang->$Clang->nombre.' '.$categoria->lang->$Clang->nombre ?>"><?php echo lang('leer') ?><span class="icon-plus"></span></a>
    </div>
</div>
<?php echo ($pos%2==1) ? '<hr class="span9 hidden-phone">' : ''; ?>