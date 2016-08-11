
<aside>
    <div class="row-fluid" id="caso_exito_aside">
        <div class="span12">
            <?php echo $this->view('layout/elements/aside_titles', array('title'=>lang('conozca'), 'icon'=>'like_m')) ?>
            <div class="caption">
                <?php echo  generateMenuTree($this->categorias['casos_de_exito'],0,1,'') ?>
            </div>
        </div>
    </div>
    <div class="row-fluid" id="world_aside">
        <div class="span12">
            <?php 
            echo $this->view('layout/elements/aside_titles', array('title'=>lang('global_network'), 'icon'=>'world_m'));            
            ?>            
            <div>
                <a href="<?php echo lang_url('institucional/global_network')?>">
                    <?php echo image_asset('site/mapa_mundi.jpg'); ?>
                </a>
            </div>
        </div>
    </div>
    <?php /*
    <div class="row-fluid" id="video_aside">
        <div class="span12">
            <?php echo $this->view('layout/elements/aside_titles', array('title'=>lang('videos_destacados'), 'icon'=>'video_m')) ?>
        </div>
        <div>
            <a href="<?php echo lang_url('galeria/detalle/'.$json->snippet->resourceId->videoId)?>" style="color: #ffffff;">
                <img src="<?php echo $json->snippet->thumbnails->standard->url ?>"/>
                <div class="caption">
                    <p><?php echo $json->snippet->title ?></p>
                </div>
            </a>
        </div>
    </div>
    */ ?>
</aside>