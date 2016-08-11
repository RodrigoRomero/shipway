<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends RR_Controller {
    
    public function Home(){
        parent::__construct();
        $this->load->model('main_mod','Main');
        $this->widget_view = array('flexslider' => array('js'=>array('flexslider'), 'css'=>array('flexslider'))
                                  );

    }

	public function index(){	   
	   $data = array('home_slider'=>$this->Main->getDestacadosHome());
	   $module = $this->view('home/index', $data);      
       $this->_show($module);
	}
    
    
  
    private function _show($module){        
        echo $this->show_main($module);
    }
}