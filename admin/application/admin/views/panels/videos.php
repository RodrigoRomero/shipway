<div class="box span12">
<?php echo $this->view('layout/panels/box_header', array('title'=>'Videos', 'icon'=>'icon-pencil')) ?>
<div class="box-content">
<?php $this->view('alerts/error') ?>
<?php
$data = array ('id'=>'videosForm', 'class'=>'form-horizontal');
echo form_open($action,$data);

$data = array('name'=>'title','id'=>'title','placeholder'=>'Título', 'class'=>'required input-xlarge', 'value'=>'title');
echo control_group('Titulo', frm_input_lang($data,$json),$attr = array());

$data = array('name'=>'resumen','id'=>'resumen','placeholder'=>'Resúmen', 'class'=>'required input-xlarge', 'value'=>'resumen');
echo control_group('Resúmen', frm_textarea_lang($data, $json),$attr = array());;

$data = array('name'=>'vimeo_id','id'=>'vimeo_id','placeholder'=>'Vimeo ID', 'class'=>'required input-xlarge', 'value'=>'vimeo_id');
echo control_group('Vimeo ID', frm_input_lang($data,$json),$attr = array());

$checked = ($row->destacado==1) ? array('checked'=>true) : array();
$data = array('name'=>'destacado','id'=>'destacado', 'class'=>'', 'type'=>'checkbox');
echo control_group('Destacado', form_input($data+$checked),$attr = array());



$checked = ($row->status==1) ? array('checked'=>true) : array();


$data = array('name'=>'status','id'=>'status', 'class'=>'', 'type'=>'checkbox');
echo control_group('Activo', form_input($data+$checked),$attr = array());

$buttons = '';
$buttons .= '<span class="pull-left">';
$data = array('type'=>'submit', 'value'=>'Guardar', 'class'=>'btn btn-inverse', 'onclick'=>"validateForm('videosForm')");
$buttons .= form_input($data);
$buttons .= '</span>'; 
echo form_action($buttons);

echo form_close();

?>
</div>
</div>