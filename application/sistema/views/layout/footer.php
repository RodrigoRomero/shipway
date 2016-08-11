<!-- footer -->
<section id="footer-site">
    
    	<div class="container">
    		<div class="row">    			
    			<div class="span12 text-center logo_footer">    				
                    <a href="<?php echo lang_url()?>">
                        <?php echo image_asset('logo_footer.png') ?>
                    </a>
                    <p>Bernardo de Irigoyen 722 12º floor - C1072AAP. Ciudad Autónoma de Buenos Aires, ARGENTINA - Ph: + 54 11 5032 2020 - Fax : + 54 11 5032 2027</p>
    
    			</div>
    			
    		</div>
    	
    </div>
</section>
<section id="footer">
      <div class="container">
        <div class="row">
          <div class="span12 text-center">
            <p>Copyright <?php echo date('Y') ?> All right reserved :::: <?php echo anchor('http://www.orsonia.com.ar','Web design: Orsonia',array('target'=>'_blank')) ?></p>
          </div>
        </div>
      </div>
</section>
<!-- end footer -->
<?php


#WIDGETS
foreach($widgets as $folder => $v){
    $widgetFolder = $folder;
    foreach ($v as $type => $file){        
        if($type=='css'){
            if(is_array($file)){
                foreach ($file as $f){
                    echo css_asset($type.'/'.$f.'.'.$type,'../widgets/'.$widgetFolder);
                }
                
            } else {
                echo css_asset($type.'/'.$file.'.'.$type,'../widgets/'.$widgetFolder);
            }
            
        } elseif ($type=='js'){
            if(is_array($file)){
                foreach ($file as $f){
                    echo js_asset($type.'/'.$f.'.'.$type,'../widgets/'.$widgetFolder);
                }
            } else {
                echo js_asset($type.'/'.$file.'.'.$type,'../widgets/'.$widgetFolder);
            }
        } else {
            show_error('formato no valido',500,'Problema al parsear Widget');
        }
    }
}
?>