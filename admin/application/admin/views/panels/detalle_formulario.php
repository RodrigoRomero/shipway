<?php $json = json_decode($row->json); ?>
<dl>
    <?php if($row->tipo_form == 'ctc') { ?>
        <dt>Nombre y Apellido</dt>
        <dl><?php echo $json->nombre.' '.$json->apellido ?></dl>
        <dt>Email</dt>
        <dl><?php echo $json->email ?></dl>
        <dt>Teléfono</dt>
        <dl><?php echo $json->telefono ?></dl>
        <dt>Mensaje</dt>
        <dl><?php echo $json->mensaje ?></dl>
    <?php } else { ?>
        <dt>Email</dt>
        <dl><?php echo $json->frmNltr_email ?></dl>
    <?php } ?>
</dl>
