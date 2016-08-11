<?php

$url = 'https://www.googleapis.com/youtube/v3/videos?part=snippet&id='.$vid.'&key=AIzaSyCJvj2DlEdDDHJ_CfSA6CGSFrI-t56S7iQ';
$url_account = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=UUdx52osmZYghra6jI6dUq6A&key=AIzaSyCJvj2DlEdDDHJ_CfSA6CGSFrI-t56S7iQ';
$json_account = json_decode(file_get_contents($url_account));
$json = json_decode(file_get_contents($url)); 

?>
<section id="videos">
    <div class="container">
        <div class="row margin-10">
    		<div class="span9 show_videos">
                <?php echo $this->view('layout/elements/section_title', array('title'=>'Galería / Videos / '.$json->items[0]->snippet->title)) ?>                
                <article class="youtube video flex-video">
                    <iframe width="960" height="720" src="http://www.youtube.com/embed/<?php echo $json->items[0]->id ?>"></iframe>
                </article>                
                
                <h4><?php echo $json->items[0]->snippet->title?></h4>
                <p><?php echo $json->items[0]->snippet->description?></p>
                <div class="row-fluid videos_relacionados">
                    <div class="span12">
                        <h4><?php echo lang('videos_relacionados') ?></h4>
                    </div>
                    <ul class="unstyled">
                    <?php                    
                    foreach($json_account->items as $a){
                        if($a->snippet->resourceId->videoId!=$vid){
                            echo '<li class="span3">';
                                echo '<img src="'.($a->snippet->thumbnails->standard->url).'"/>';
                                echo '<p><a href="'.lang_url('galeria/detalle/'.($a->snippet->resourceId->videoId)).'" >'.character_limiter($a->snippet->title,25).'</a></p>'; 
                            echo '</li>';
                            }
                            
                           
    
                        }
                    ?>
                    </ul>
                </div>
    		</div>
            <div class="span3">
                <?php echo $this->view('layout/elements/aside'); ?>
            </div>
        </div>
    </div>
</section>