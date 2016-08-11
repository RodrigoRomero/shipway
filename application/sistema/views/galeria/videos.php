<?php
$url = 'https://www.googleapis.com/youtube/v3/playlistItems?part=snippet&playlistId=UUdx52osmZYghra6jI6dUq6A&key=AIzaSyCJvj2DlEdDDHJ_CfSA6CGSFrI-t56S7iQ';
$json_account = json_decode(file_get_contents($url));
?>

<section id="listados">
    <div class="container">
        <div class="row margin-10">
    		<div class="span12">
                <?php echo $this->view('layout/elements/section_title', array('title'=>lang('galeria').'/ '.lang('videos'))) ?>
                
                <div class="row">
                    <?php
                    $c=0;
                    foreach($json_account->items as $a){
                            echo '<div class="span4 item_box">';
                            echo '<div class="">';
                                echo '<img src="'.($a->snippet->thumbnails->standard->url).'"/>';
                                echo '<a href="'.lang_url('galeria/detalle/'.($a->snippet->resourceId->videoId)).'">';
                                echo '<div class="overlay"><i class="icon-youtube-play"></i></div>';                                
                                echo '</a>';                                
                            echo '</div>';
                            echo '<a href="'.lang_url('galeria/detalle/'.($a->snippet->resourceId->videoId)).'" class="btn-pictures" >'.character_limiter($a->snippet->title,30).' <span class="icon-youtube-play"></span></a>';
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