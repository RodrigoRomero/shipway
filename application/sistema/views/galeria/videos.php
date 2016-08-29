<?php 
$video_destacado = json_decode($video_destacado->json); 
$oembed_endpoint = 'http://vimeo.com/api/oembed';
#8dbed51deb99cd0643558766cb238afe
?>





<section id="listados">
    <div class="container">
        <div class="row margin-10">
    		<div class="span12">
                <?php echo $this->view('layout/elements/section_title', array('title'=>lang('galeria').'/ '.lang('videos'))) ?>
                
                <div class="row">
                    <?php

                    $c=0;
                    foreach($videos as $video){
                        $details = json_decode($video->json);

                        $video_url = ($_GET['url']) ? $_GET['url'] : 'http://vimeo.com/'.$video->video_id;
                        
                        $json_url = $oembed_endpoint . '.json?url=' . rawurlencode($video_url);
                        // Load in the oEmbed XML
                        $oembed = json_decode(curl_get($json_url));
                       

                            echo '<div class="span4 item_box">';
                            echo '<div class="">';
                                echo '<img src="'.($oembed->thumbnail_url).'" style="width: 100%" />';
                                echo '<a href="'.lang_url('galeria/detalle/'.$video->video_id).'">';
                                echo '<div class="overlay"><i class="icon-youtube-play"></i></div>';                                
                                echo '</a>';                                
                            echo '</div>';
                            echo '<a href="'.lang_url('galeria/detalle/'.$video->video_id).'" class="btn-pictures" >'.character_limiter($details->lang->$Clang->title,30).' <span class="icon-youtube-play"></span></a>';
                            echo '</div>';
                            $c++;
                            if($c%3==0) {
                                echo '<hr class="span12" />';
                            }
    
                        }
                    ?>
                </div>
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