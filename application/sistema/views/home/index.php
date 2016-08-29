<?php  $video_destacado = json_decode($video_destacado->json); ?>
<section id="main_flexslider" class="flexslider">
    <ul class="slides">
        <?php foreach($home_slider as $slide) {
            echo $this->view('layout/flexslider/slide', array('data'=>$slide));
        } ?>
	</ul>
</section>
<section id="featured">
    <div class="container">
    	<div class="row">
    			<div class="span4">
                    <a href="<?php echo lang_url('casos-de-exito/listado/10001/Industrial')?>">
        				<div class="featured-photos">
        					<?php echo up_asset('Home_mod_3.jpg') ?>
        				</div>
                        <div class="content">
        				    <h4 class="like"><?php echo lang('experiencia_shipway') ?></h4>
                            <?php 
                            
                                switch($Clang) {
                                    case 'es':
                                    default:
                                        echo '<p>Conozca Shipway a través de nuestros casos más importantes.</p>';
                                        break;
                                    
                                    case 'en':
                                        echo '<p>Click here to know more about Shipway’s experience.</p>';
                                        break;
                                    
                                    case 'dk':
                                        echo '<p>Klicken Sie hier , um mehr über Shipway´s Projekteerfahrung kennenzulernen.</p>';
                                        break;                                        
                                }
        				    ?>
                        </div>
                    </a>
    			</div>
    			<div class="span4">
                    <a href="<?php echo lang_url('institucional/soluciones')?>" >
    				<div class="featured-photos">
                         
    				        <?php echo up_asset('Home_mod_2.jpg') ?>	
                       
    				</div>
    				<div class="content">
    				    <h4 class="soluciones"><?php echo lang('soluciones') ?></h4>
                        <?php 
                            
                                switch($Clang) {
                                    case 'es':
                                    default:
                                        echo '<p>Soluciones integrales para el transporte internacional de cargas.</p>';
                                        break;
                                    
                                    case 'en':
                                        echo '<p>Click here, to know more about Shipway’s solutions for international cargo transportation.</p>';
                                        break;
                                    
                                    case 'dk':
                                        echo '<p>Klicken Sie hier, um mehr über Shipway´s integrale Lösungen für den internationalen Frachttransport kennenzulernen.</p>';
                                        break;                                        
                                }
        				    ?>
    				    
                    </div>
                     </a>
    			</div>
    			<div class="span4">
    				<div class="featured-photos">
                        <article class="youtube video flex-video">
                            <?php $url = 'https://player.vimeo.com/video/'.$video_destacado->lang->$Clang->vimeo_id; ?>
                            <iframe src="<?php echo $url ?>" width="960" height="540" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                        </article>    					
    				</div>
    				<div class="content">
                        <a href="<?php echo lang_url('galeria/videos') ?>">
    				    <h4 class="video"><?php echo lang('videos_destacados') ?></h4>
    				    <p><?php echo $video_destacado->lang->$Clang->title ?></p>
                        </a>
                    </div>
    			</div>
    		
    	</div>
    </div>
</section>