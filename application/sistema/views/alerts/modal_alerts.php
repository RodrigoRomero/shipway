<div class="modal-header">
	<button data-dismiss="modal" class="close" type="button">×</button>
	<h3><?php echo $title ?></h3>
</div>
<div class="modal-body alert-<?php echo $class_type ?>">
    <ul class="unstyled">
	   <?php echo $texto ?>
    </ul>
</div>
<div class="modal-footer">
	<a data-dismiss="modal" class="btn" href="#"><?php echo lang('close_modal') ?></a>
</div>