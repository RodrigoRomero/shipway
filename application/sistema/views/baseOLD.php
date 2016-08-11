<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <?php $this->view('layout/head.php')?>
	</head>
	<body>
        <div class="nav-wrap">
            <div class="navbar navbar-fixed-top">
                <div class="navbar-inner">
                    <div class="container">
                        
                                <ul class="pull-right toolbar">
                                    <li class="langChange">
                                        <?php 
                                        switch($Clang){
                                            case 'po':
                                                echo '<a href="'.lang_change('sp').'">'.image_asset('site/sp.png').'</a>';
                                                echo '<a href="'.lang_change('en').'">'.image_asset('site/en.png').'</a>';
                                                break;
                                            case 'en':
                                                echo '<a href="'.lang_change('sp').'">'.image_asset('site/sp.png').'</a>';
                                                echo '<a href="'.lang_change('po').'">'.image_asset('site/po.png').'</a>';
                                                break;
                                            case 'sp':
                                            default:
                                                echo '<a href="'.lang_change('en').'">'.image_asset('site/en.png').'</a>';
                                                echo '<a href="'.lang_change('po').'">'.image_asset('site/po.png').'</a>';
                                                break;
                                            
                                            
                                        }
                                        ?>
                                        
                                    </li>
                                    <li class="divider-vertical hidden-phone"></li>
                                    <li class="hidden-phone"><a href="<?php echo lang_url('institucional/contacto')?>" style="margin-top: 3px; display: inline-block;">Trabaje en <b>Shipway</b></a></li>
                                    <li class="divider-vertical hidden-phone"></li>
                                    <li>
                                        <div>
                                            <?php
                                                $data   = array ('id'=>'suscribeForm', 'class'=>'form');
                                                $action = lang_url('institucional/do-suscription');
                                                echo form_open($action,$data);
                                                $data = array('name'=>'frmNltr_email','id'=>'frmNltr_email','placeholder'=>'Escriba su mail para recibir el news', 'class'=>'required email');
                                                echo form_input($data);
                                                $data = array('type'=>'submit', 'value'=>'Enviar', 'class'=>'', 'onclick'=>"validateForm('suscribeForm')");
                                                echo '<span class="btn_send"><i class="icon-chevron-sign-right" style="margin-top: 3px; display: inline-block;"></i>'.form_input($data).'</span>';
                                                echo form_close();                                                
                                            ?>
                                        </div>
                                    </li>
                                    <li class="divider-vertical hidden-phone"></li>
                                    <li class="hidden-phone"><a href="http://shipway.pbyasoc.com/" style="margin-top: 3px; display: inline-block;"><span class="icon-signin"></span> Webtraking</a></li>
                                    <li class="divider-vertical hidden-phone"></li>
                                    <li>
                                        <a href="https://www.facebook.com/pages/Shipway-ARG/500870196600704?ref=ts&fref=ts"><?php echo image_asset('site/fb.png') ?></a>
                                        <a href=""><?php echo image_asset('site/yt.png') ?></a>
                                        <a href="http://www.linkedin.com/company/2868462?trk=tyah&trkInfo=tas%3Ashipway%2Cidx%3A1-2-2"><?php echo image_asset('site/in.png') ?></a>
                                    </li>
                                </ul>
                                             
                        <a data-target=".navbar-responsive-collapse" data-toggle="collapse" class="btn btn-navbar">
                            <p style="display: inline-block; margin: 0 10px">Menú</p>
                            <div style="display: inline-block;">
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </div>
                        </a>
                        <a class="brand" href="<?php echo lang_url()?>">
                                <?php echo image_asset('logo_header.png', '', array('alt'=>$title_page, 'title'=>$title_page)) ?>                                
                        </a>
                        <div class="nav-collapse collapse navbar-responsive-collapse">                            
                            
                            <ul class="nav pull-right">
                                <li class="<?php echo ($this->uri->segment(2)=='soluciones') ? 'active' : ''; ?>"><a href="<?php echo lang_url('institucional/soluciones')?>">Soluciones</a></li>
                                <li class="divider-vertical"></li>
                                <li class="<?php echo ($this->uri->segment(2)=='por-que-shipway') ? 'active' : ''; ?>"><a href="<?php echo lang_url('institucional/por-que-shipway')?>">Porque shipway?</a></li>
                                <li class="divider-vertical"></li>
                                <li class="<?php echo ($this->uri->segment(2)=='empresa') ? 'active' : ''; ?>"><a href="<?php echo lang_url('institucional/empresa')?>">Empresa</a></li>
                                <li class="divider-vertical"></li>
                                <li class="<?php echo ($this->uri->segment(1)=='casos-de-exito') ? 'active' : ''; ?> dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascrip:void(0)">casos de exito <b class="caret"></b></a>
                                    <?php echo  generateMenuTree($data_menu['casos_de_exito'],0,1,'dropdown-menu animated fadeInUp') ?>
                                </li>
                                <li class="divider-vertical"></li>                            
                                <li class="<?php echo ($this->uri->segment(2)=='hseq') ? 'active' : ''; ?>"><a href="<?php echo lang_url('institucional/hseq')?>">Hseq</a></li>
                                <li class="divider-vertical"></li>
                                <li class="<?php echo ($this->uri->segment(1)=='galeria') ? 'active' : ''; ?> dropdown">
                                    <a data-toggle="dropdown" class="dropdown-toggle" href="javascrip:void(0)">Galería <b class="caret"></b></a>
                                    <ul class="dropdown-menu animated fadeInUp">
                                        <li class="<?php echo ($this->uri->segment(2)=='fotos') ? 'active' : ''; ?>"><a href="<?php echo lang_url('galeria/fotos')?>">Fotos</a></li>
                                        <li class="<?php echo ($this->uri->segment(2)=='videos') ? 'active' : ''; ?>"><a href="<?php echo lang_url('galeria/videos')?>">Videos</a></li>                                                                                
                                    </ul>    
                                </li>
                                <li class="divider-vertical"></li>
                                <li class="<?php echo ($this->uri->segment(2)=='contacto') ? 'active' : ''; ?>"><a href="<?php echo lang_url('institucional/contacto')?>">contacto</a></li>
                            </ul>
                        </div><!-- /.nav-collapse -->
                    </div>
                </div><!-- /navbar-inner -->
            </div>
        </div>
        <?php 
            //echo $menu_top;
            echo $module;
            echo $footer; 
        ?>

	</body>
</html>