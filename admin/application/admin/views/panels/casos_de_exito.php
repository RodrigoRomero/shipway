<div class="box span12">
<?php echo $this->view('layout/panels/box_header', array('title'=>'Casos de Éxito', 'icon'=>'icon-pencil')) ?>
<div class="box-content">
<?php $this->view('alerts/error') ?>
<?php
$data = array ('id'=>'porfoliosForm', 'class'=>'form-horizontal');
echo form_open($action,$data);

$data = array('name'=>'nombre','id'=>'nombre','placeholder'=>'Caso', 'class'=>'required input-xlarge', 'value'=>'nombre');
echo control_group('Caso', frm_input_lang($data,$json),$attr = array());

$data = array('name'=>'pais','id'=>'pais','placeholder'=>'País', 'class'=>'required input-xlarge', 'value'=>'pais');
echo control_group('País', frm_input_lang($data,$json),$attr = array());

$data = array('name'=>'resumen','id'=>'resumen','placeholder'=>'Resúmen', 'class'=>'required input-xlarge', 'value'=>'resumen');
echo control_group('Resúmen', frm_textarea_lang($data, $json),$attr = array());;

$data = array('name'=>'proyecto','id'=>'proyecto','placeholder'=>'Proyecto', 'class'=>'required input-xlarge', 'value'=>'proyecto');
echo control_group('Proyecto', frm_input_lang($data,$json),$attr = array());

$data = array('name'=>'cliente','id'=>'cliente','placeholder'=>'Cliente', 'class'=>'required input-xlarge', 'value'=>'cliente');
echo control_group('Cliente', frm_input_lang($data,$json),$attr = array());

$data = array('name'=>'descripcion','id'=>'descripcion','placeholder'=>'Objetivos', 'class'=>'required input-xlarge', 'value'=>'descripcion');
echo control_group('Objetivos', frm_textarea_lang($data, $json),$attr = array());


$data = array('class'=>'categorias', 'required'=>true);
echo control_group('Categorias Asignadas', frm_select_multi_trasfer($categorias, 'categorias', $data, $row->atributos_id), $attr = array('class_controls'=>'clearfix'));

$data = array('class'=>'etiquetas', 'required'=>false);
echo control_group('Etiquetas Asignadas', frm_select_multi_trasfer($etiquetas, 'etiquetas', $data, $row->atributos_id),$attr = array('class_controls'=>'clearfix'));

echo control_group('Imágen Slider Home', upload_manager("",array("id"=>$row->id, "lastPos"=>"home", "uploadFolder"=>"uploads/porfolios/", "filter"=>$img_home->filter, "ratio"=>$img_home->ratio)),$attr = array('id'=>'uploadHome', 'help-block'=>'(Medida Imágen 1920px x 480px)'));

echo control_group('Imágenes', upload_manager("",array("id"=>$row->id, "uploadFolder"=>"uploads/porfolios/", "filter"=>$img_porfolio->filter, "ratio"=>$img_porfolio->ratio, "resize"=>$img_porfolio->resize, "pie"=>true, 'json'=>$json)),$attr = array('id'=>'uploadGroup', 'help-block'=>'(Medida Imágen 2000px x 1200px)'));
if($img_porfolio->add){
    $env = 'porfolio';
    $addImage = anchor_js('Agregar Imágen', array('onclick'=>'cloneUpload(\'porfolios\',\''.$env.'\',\'pie\')', 'class'=>'btn btn-mini btn-info'));
} 
echo control_group('', $addImage,$attr = array());
    

$data = array('name'=>'status','id'=>'status', 'class'=>'', 'type'=>'checkbox', 'checked'=>'checked');
echo control_group('Activo', form_input($data),$attr = array());

$buttons = '';
$buttons .= '<span class="pull-left">';
$data = array('type'=>'submit', 'value'=>'Guardar', 'class'=>'btn btn-inverse', 'onclick'=>"validateForm('porfoliosForm')");
$buttons .= form_input($data);
$buttons .= '</span>'; 
echo form_action($buttons);

echo form_close();

?>
</div>
</div>