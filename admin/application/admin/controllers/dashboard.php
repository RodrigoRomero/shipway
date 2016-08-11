<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Dashboard extends RR_Controller {
    
    public function Dashboard(){
        parent::__construct();
        /*
        $this->widget_view = array('tables' => array('js'=>array('jquery.dataTables.min'))
                                   );
        */
        //$this->output->enable_profiler(TRUE);
    }

	public function index(){
	  
       $module =	$this->view('dashboard/index', $data);
       $this->_show($module);
	}
    
  
    private function _show($module){        
        echo $this->show_main($module);
    }
}