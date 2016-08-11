<div class="box span12">
<?php echo $this->view('layout/panels/box_header', array('title'=>'Usuarios', 'icon'=>'icon-pencil')) ?>
<div class="box-content">
<?php $this->view('alerts/error') ?>
<?php
$data = array ('id'=>'usuariosForm', 'class'=>'form-horizontal');
echo form_open($action,$data);

$data = array('name'=>'nombre','id'=>'nombre','placeholder'=>'Nombre', 'class'=>'required input-xlarge', 'value'=>$row->nombre);
echo control_group('Nombre', form_input($data),$attr = array());

$data = array('name'=>'apellido','id'=>'apellido','placeholder'=>'Apellido', 'class'=>'required input-xlarge', 'value'=>$row->apellido);
echo control_group('Apellido', form_input($data),$attr = array());

$data = array('name'=>'email','id'=>'email','placeholder'=>'Email', 'class'=>'required email input-xlarge', 'value'=>$row->email);
echo control_group('Email', form_input($data),$attr = array('help-block'=>'(Será el usuario para ingresar al sistema administrador)'));

$data = array('name'=>'password','id'=>'password','placeholder'=>'Password', 'class'=>'password input-xlarge', 'value'=>$row->password, 'type'=>'password');
echo control_group('Password', form_input($data),$attr = array());

$data = array('name'=>'valid_password','id'=>'valid_password','placeholder'=>'Repetir Password', 'class'=>'valid_password input-xlarge', 'value'=>$row->password, 'type'=>'password');
echo control_group('Repetir Password', form_input($data),$attr = array());

$data = array('name'=>'status','id'=>'status', 'class'=>'', 'type'=>'checkbox', 'checked'=>'checked');
echo control_group('Status', form_input($data),$attr = array());

$buttons = '';

$buttons .= '<span class="pull-left">';
$data = array('type'=>'submit', 'value'=>'Guardar', 'class'=>'btn btn-inverse', 'onclick'=>"validateForm('usuariosForm')");
$buttons .= form_input($data);
$buttons .= '</span>'; 
echo form_action($buttons);

echo form_close();

?>
</div>
</div>