<?php
$video = json_decode($videos->json); 
$oembed_endpoint = 'http://vimeo.com/api/oembed';

?>
<section id="videos">
    <div class="container">
        <div class="row margin-10">
    		<div class="span9 show_videos">
                <?php echo $this->view('layout/elements/section_title', array('title'=>'Galería / Videos / '.$video->lang->$Clang->title)) ?>                
                <article class="youtube video flex-video">
                    <?php $url = 'https://player.vimeo.com/video/'.$video->lang->$Clang->vimeo_id; ?>
                    <iframe src="<?php echo $url ?>" width="960" height="540" frameborder="0" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>
                </article>                
                
                <h4><?php echo $video->lang->$Clang->title?></h4>
                <p><?php echo $video->lang->$Clang->resumen?></p>
                <div class="row-fluid videos_relacionados">
                    <div class="span12">
                        <h4><?php echo lang('videos_relacionados') ?></h4>
                    </div>
                    <ul class="unstyled">
                    <?php                    
                    foreach($videos_related as $vr){
                        $details = json_decode($vr->json);

                        $video_url = ($_GET['url']) ? $_GET['url'] : 'http://vimeo.com/'.$vr->video_id;
                        
                        $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url);
                        // Load in the oEmbed XML
                        $oembed = json_decode(curl_get($json_url));

                        echo '<li class="span3">';
                            echo '<img src="'.($oembed->thumbnail_url).'" style="width: 100%"/>';
                            echo '<p><a href="'.lang_url('galeria/detalle/'.($vr->video_id)).'" >'.character_limiter($details->lang->$Clang->title,25).'</a></p>'; 
                        echo '</li>';
                        
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
<?php
// Curl helper function
function curl_get($url) {
    $curl = curl_init($url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($curl, CURLOPT_TIMEOUT, 30);
    curl_setopt($curl, CURLOPT_FOLLOWLOCATION, 1);
    $return = curl_exec($curl);
    curl_close($curl);
    return $return;
}
?>