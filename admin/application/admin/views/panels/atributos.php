<div class="box span12">
<?php echo $this->view('layout/panels/box_header', array('title'=>'Atributos', 'icon'=>'icon-pencil')) ?>
<div class="box-content">
<?php $this->view('alerts/error') ?>
<?php
$data = array ('id'=>'atributosForm', 'class'=>'form-horizontal');
echo form_open($action,$data);

$data = array('name'=>'nombre','id'=>'nombre','placeholder'=>'Nombre', 'class'=>'required input-xlarge', 'value'=>'nombre');
echo control_group('Nombre', frm_input_lang($data,$json),$attr = array());

$data = array('name'=>'descripcion','id'=>'descripcion','placeholder'=>'Descripción', 'class'=>'required input-xlarge', 'value'=>'descripcion');
echo control_group('Descripción', frm_textarea_lang($data, $json),$attr = array());

$data = array('name'=>'status','id'=>'status', 'class'=>'', 'type'=>'checkbox', 'checked'=>'checked');
echo control_group('Activo', form_input($data),$attr = array());

$buttons = '';
$buttons .= '<span class="pull-left">';
$data = array('type'=>'submit', 'value'=>'Guardar', 'class'=>'btn btn-primary', 'onclick'=>"validateForm('atributosForm')");
$buttons .= form_input($data);
$buttons .= '</span>'; 
echo form_action($buttons);

echo form_close();

?>
</div>
</div>