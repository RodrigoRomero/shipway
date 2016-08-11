<div class="span4 item_box">
    <div class="">
        <a style="margin-bottom:5px" href="<?php echo up_file('porfolios/original/'.$data['id'].'_1.jpg')?>" class="btn-pictures" rel="shadowbox[gal<?php echo $data['id']?>]" title="<?php echo $data['titulo'] ?>"><?php echo $data['titulo'] ?><span class="icon-eye-open"></span></a>
        <a href="<?php echo up_file('porfolios/original/'.$data['id'].'_0.jpg')?>" rel="shadowbox[gal<?php echo $data['id']?>]" title="<?php echo $data['titulo'] ?>">
        <?php echo up_asset('porfolios/original/'.$data['id'].'_0.jpg', array('class'=>'img-polaroid')) ?>
        <div class="overlay">
            <i class="icon-eye-open"></i>
        </div>
        </a>                            
    </div>
    
    <?php for($i=2;$i<$data['total_images'];$i++){
        echo '<a href="'.up_file('porfolios/original/'.$data['id'].'_'.$i.'.jpg').'" rel="shadowbox[gal'.$data['id'].']"  title="'.$data['titulo'].'"></a>';
        
    } ?>
</div>