<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class videos extends RR_Controller {
    
    public function videos(){
        parent::__construct();
        $this->load->model("videos_mod", "Videos");
        $this->js_view     = array('admin/swfobject');
        $this->widget_view = array('tables' => array('js'=>array('jquery.dataTables.min', 'extras')),
                                   'validate'=>array('js'=>array('jquery.validate','messages_es')),
                                   'shadowbox'=>array('css'=>array('shadowbox'), 'js'=>array('shadowbox'))
                                   );
    
        //$this->output->enable_profiler(TRUE);
    }
    
    //public function index(){}
    
    public function listado(){
        $module = $this->Videos->getListado();
        $this->_show($module);
    }


    
    public function action($id=null){
        if(checkParam($this->params['iu'])){
            
            $module = $this->Videos->set_iu();
        } else {
            show_error('Ups la página que buscas no existe',301,'Ups');
        }
        
        $this->_show($module);     
    }

    
    public function do_iu(){
        $return = $this->Videos->do_iu();
        echo json_encode($return);
    }

    public function chk_deletea(){
        $return = $this->Videos->chk_deletea();
        echo json_encode($return);
    }
    
    public function deletea(){
        $return = $this->Videos->deletea();
        echo json_encode($return);
    }
    
    private function _show($module){        
        echo $this->show_main($module);
    }
}