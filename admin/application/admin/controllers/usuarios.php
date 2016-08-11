<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuarios extends RR_Controller {
    
    public function Usuarios(){
        parent::__construct();
        $this->load->model("usuarios_mod","Usuario");
        $this->widget_view = array('tables'=>array('js'=>array('jquery.dataTables.min','extras')),
                                   'validate'=>array('js'=>array('jquery.validate','messages_es'))
                                   );
        
       //$this->output->enable_profiler(TRUE);
    }

	public function index(){}
    
    public function listado(){        
        $this->breadcrumb->addCrumb('Usuarios','');
        $this->breadcrumb->addCrumb('Listado','','current');        
        $module = $this->Usuario->getListado();
        $this->_show($module);
    }
    
    public function action(){  
        if(checkParam($this->params['iu'])){            
            $module = $this->Usuario->set_iu();    
        } else {
            show_error('Ups la página que buscas no existe',301,'Ups');
        }
        
        $this->_show($module);     
    }
    
    public function do_iu(){
        $return = $this->Usuario->do_iu();
        echo json_encode($return);
    }
    
     public function chk_deletea(){
        $return = $this->Usuario->chk_deletea();
        echo json_encode($return);
    }
    
    public function deletea(){
        $return = $this->Usuario->deletea();
        echo json_encode($return);
    }
    
    private function _show($module){        
        echo $this->show_main($module);
    }
}