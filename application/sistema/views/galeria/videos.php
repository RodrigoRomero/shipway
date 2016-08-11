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

<div id="made-in-ny"></div>

<script src="https://player.vimeo.com/api/player.js"></script>
<script>
    var options = {
        id: 59777392,
        width: 640,
        loop: true
    };

    var player = new Vimeo.Player('made-in-ny', options);

    player.setVolume(0);

    player.on('play', function() {
        console.log('played the video!');
    });
</script>