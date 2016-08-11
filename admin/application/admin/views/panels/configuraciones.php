<div class="box span12">
<?php echo $this->view('layout/panels/box_header', array('title'=>'Configuración General del Sitio', 'icon'=>'icon-pencil')) ?>
<div class="box-content">
<?php $this->view('alerts/error') ?>
<?php
$data = array ('id'=>'configuracionesForm', 'class'=>'form-horizontal');
echo form_open($action, $data);

$data = array('name'=>'nombre','id'=>'nombre', 'class'=>'required input-xlarge', 'readonly'=>'readonly', 'value'=>$row->nombre);
echo control_group('Nombre', form_input($data),$attr = array());

$data = array('name'=>'descripcion','id'=>'descripcion','placeholder'=>'Descripción', 'class'=>'required input-xlarge', 'value'=>'descripcion');
echo control_group('Descripción', frm_input_lang($data, $valor),$attr = array());

if($row->tipo=='email'){
    $data = array('name'=>'valor','id'=>'valor','placeholder'=>'Valor', 'class'=>'required input-xlarge', 'value'=>'valor');    
    echo control_group('Valor', frm_input_lang($data, $valor),$attr = array());
} else {
    $data = array('name'=>'valor','id'=>'valor','placeholder'=>'Descripción', 'class'=>'required input-xlarge', 'value'=>'valor');
    echo control_group('Valor', frm_textarea_lang($data, $valor),$attr = array());
}
$data = array('name'=>'status','id'=>'activo', 'class'=>'', 'type'=>'checkbox', 'checked'=>'checked');
echo control_group('Activo', form_input($data),$attr = array());

$buttons = '';
$buttons .= '<span class="pull-left">';
$data = array('type'=>'submit', 'value'=>'Guardar', 'class'=>'btn btn-primary', 'onclick'=>"validateForm('configuracionesForm')");
$buttons .= form_input($data);
$buttons .= '</span>'; 
echo form_action($buttons);

echo form_close();

?>
</div>
</div>