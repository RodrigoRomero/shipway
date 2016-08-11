<section id="soluciones">
    <div class="container">
        <div class="row margin-10">
    		<div class="span9">
                <div id="mapa_america" onclick="$('#mapa_mundi').toggleClass('hide');$(this).addClass('hide')" style="cursor: pointer;">
                    <?php echo $this->view('layout/elements/section_title', array('title'=>lang('South_America') )) ?>
                    <?php echo image_asset('site/global/mapa_sudamerica.jpg') ?>
                </div>
                <div id="mapa_mundi" class="hide" onclick="$('#mapa_america').toggleClass('hide');$(this).addClass('hide')" style="cursor: pointer;">
                    <?php echo $this->view('layout/elements/section_title', array('title'=>'World Wide')) ?>
                    <?php echo image_asset('site/global/mapa_mundial.jpg') ?>
                    <div class="row-fluid" style="margin: 10px 0;">    
                        <div class="span6" style="cursor: pointer;"><?php echo image_asset('site/global/america.jpg') ?></div>
                        <div class="span6" style="cursor: pointer;"><?php echo image_asset('site/global/europa.jpg') ?></div>
                    </div>
                    <div class="row-fluid" style="margin: 0 0 10px 0;">    
                        <div class="span6" style="cursor: pointer;"><?php echo image_asset('site/global/medio_oriente.jpg') ?></div>
                        <div class="span6" style="cursor: pointer;"><?php echo image_asset('site/global/africa.jpg') ?></div>
                    </div>
                    <div class="row-fluid" style="margin: 0 0 10px 0;">    
                        <div class="span6" style="cursor: pointer;"><?php echo image_asset('site/global/asia.jpg') ?></div>
                        <div class="span6" style="cursor: pointer;"><?php echo image_asset('site/global/oceania.jpg') ?></div>
                    </div>
                </div>
    		</div>
            <div class="span3">
                <?php echo $this->view('layout/elements/aside'); ?>
            </div>
        </div>
    </div>
</section>