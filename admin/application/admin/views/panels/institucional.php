<?php $this->view('alerts/error') ?>
<div class="widget-box">
<div class="widget-title">
	<span class="icon">
		<i class="icon-pencil"></i>									
	</span>
	<h5>Información Institucional</h5>
</div>
<?php
$data = array ('id'=>'institucionalForm', 'class'=>'form-horizontal');
echo form_open($action,$data);

$data = array('name'=>'nombre','id'=>'nombre','placeholder'=>'Nombre', 'class'=>'required', 'value'=>'nombre');
echo control_group('Nombre', frm_input_lang($data,$json),$attr = array());

if($this->params['id']=='me') {
    $data = array('name'=>'cargo','id'=>'cargo','placeholder'=>'Cargo', 'class'=>'required', 'value'=>'cargo');
    echo control_group('Cargo', frm_input_lang($data,$json),$attr = array());
    
    $data = array('name'=>'titulo','id'=>'titulo','placeholder'=>'Título', 'class'=>'required', 'value'=>'titulo');
    echo control_group('Título', frm_input_lang($data,$json),$attr = array());
    
}
$data = array('name'=>'descripcion','id'=>'descripcion','placeholder'=>'Descripción', 'class'=>'required', 'value'=>'descripcion');
echo control_group('Descripción', frm_textarea_lang($data, $json),$attr = array());

echo control_group('Imágenes', upload_manager("",array("id"=>$row->id, "uploadFolder"=>"uploads/institucional/", "filter"=>$img_institucional->filter, "ratio"=>$img_institucional->ratio)),$attr = array('id'=>'uploadGroup'));
if($img_institucional->add){
    $env = ($this->params['id']=='bio') ? 'bio' : 'estudio';
    $addImage = anchor_js('Agregar Imágen', array('onclick'=>'cloneUpload(\'institucional\',\''.$env.'\')', 'class'=>'btn btn-mini btn-info'));
}
echo control_group('', $addImage,$attr = array());

$data = array('name'=>'activo','id'=>'activo', 'class'=>'', 'type'=>'checkbox', 'checked'=>'checked');
echo control_group('Activo', form_input($data),$attr = array());

$buttons = '';
$buttons .= '<span class="pull-left">';
$data = array('type'=>'submit', 'value'=>'Guardar', 'class'=>'btn btn-inverse', 'onclick'=>"validateForm('institucionalForm')");
$buttons .= form_input($data);
$buttons .= '</span>'; 
echo form_action($buttons);

echo form_close();

?>
</div>