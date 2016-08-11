<?php 
$segment = ($this->uri->segment(1) !='en' && $this->uri->segment(1) !='sp') ? $this->uri->segment(1) : $this->uri->segment(2); 
$section = ($this->uri->segment(1) !='en' && $this->uri->segment(1) !='sp') ? $this->uri->segment(2) : $this->uri->segment(3);
?>
<!-- navigation -->
<div class="container-fluid sf_nav">
	<div class="navbar navbar-static-top">
		<div class="navbar-inner">
			<div class="container">
				<!-- Be sure to leave the brand out there if you want it shown -->
				<a class="brand myBrand" href="<?php echo lang_url()?>" title="<?php echo $this->env->getEnv('site_name')?>">
                    <?php echo image_asset('logo.png','',array('alt'=>$this->env->getEnv('site_name'),'title'=>$this->env->getEnv('site_name'))) ?>
                </a>

				<!-- Everything you want hidden at 940px or less, place within here -->
				<!--<div class="nav-collapse">-->
				<ul class="nav pull-right sf_navmenu navanimation sf-menu hidden-phone" id="sf-menu-responsive">
					<li id="home" class="Lava <?php echo (!$segment && !$section) ? 'selectedLava' : ''; ?> ">
						<a href="<?php echo lang_url('')?>"><?php echo lang('home') ?><span><span class="hidden-desktop"> - </span>Homepage</span></a>
					</li>
					<li id="institucional" class="Lava open-submenu <?php echo ($segment=='institucional' && ($section=='el-estudio' || $section=='me')) ? 'selectedLava' : ''; ?>">
						<a href="javascript:void(0)"><?php echo lang('institucional') ?><span><span class="hidden-desktop"> - </span>La empresa</span></a>
						<ul class="navsub noLava">
                            <li class="noLava">
								<a href="<?php echo lang_url('institucional/el-estudio')?>"><?php echo lang('el_estudio') ?></a>
							</li>
							<li class="noLava">
								<a href="<?php echo lang_url('institucional/me')?>"><?php echo lang('bio') ?></a>
							</li>
							
						</ul>
					</li>
                    <li id="portfolio" class="Lava <?php echo ($segment=='porfolio') ? 'selectedLava' : ''; ?>">
						<a href="<?php echo lang_url('porfolio/listado') ?>"><?php echo lang('porfolio') ?> <span><span class="hidden-desktop"> - </span><?php echo lang('nuestros_trabajos') ?></span></a>
					</li>
				
					
					<li id="contacts" class="Lava <?php echo ($segment=='institucional' && ($section=='contacto')) ? 'selectedLava' : ''; ?>">
						<a href="<?php echo lang_url('institucional/contacto')?>"><?php echo lang('contacto') ?> <span><span class="hidden-desktop"> - </span><?php echo lang('email_us') ?></span></a>
					</li>
				</ul>
				<!--</div> -->
			</div>
		</div>
	</div>
	<!-- end navbar -->
    <div class="lang_change">
        <ul class="unstyled">
            <li><?php echo anchor(lang_change('sp'),'Español') ?></li>
            <li><?php echo anchor(lang_change('en'),'English') ?></li>
        </ul>
    </div>
</div>
<!-- end navigation -->

