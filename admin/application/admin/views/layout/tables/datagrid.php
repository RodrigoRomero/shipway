<div class="box span12">
    <div class="box-header">		         
        <h2><i class="icon-th-list"></i> <?php echo $grid_title ?></h2>
        <div class="box-icon">
            <?php if ($new) { ?>
            <a class="btn-setting tip-top" data-original-title='Nuevo Registro' href="<?php echo $new ?>"><i class="icon-wrench"></i></a>
            <?php } ?>
            <a class="btn-minimize" href="#"><i class="icon-chevron-up"></i></a>
        </div>
    </div>    
    <div class="box-content">
        <table class="table table-striped <?php echo $grid_type ?>" id="">
            <thead>
                <tr>
                    <?php echo $header?>
                </tr>
            </thead>
            <tbody>
                <?php echo $rows ?>			
            </tbody>
        </table>  
    </div>
</div>