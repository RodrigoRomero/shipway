<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Atributos extends RR_Controller {
    
    public function Atributos(){
        parent::__construct();
        $this->module_title = 'Atributos';
        $this->load->model("atributos_mod", "Atributos");
        $this->widget_view = array('tables' => array('js'=>array('jquery.dataTables.min','extras')),
                                   'validate'=>array('js'=>array('jquery.validate','messages_es')),
                                   );
    
        //$this->output->enable_profiler(TRUE);
    }
    
    public function index(){}
    
    public function listado(){
        $module = $this->Atributos->getListado();
        $this->_show($module);
    }
    
    public function action($id=null){
        if(checkParam($this->params['iu'])){            
            $module = $this->Atributos->set_iu();
        } else {
            show_error('Ups la página que buscas no existe',301,'Ups');
        }
       
        $this->_show($module);     
    }
    
    public function do_iu(){
        $return = $this->Atributos->do_iu();
        echo json_encode($return);
    }
    
    public function chk_deletea(){
        $return = $this->Atributos->chk_deletea();
        echo json_encode($return);
    }
    
    public function deletea(){
        $return = $this->Atributos->deletea();
        echo json_encode($return);
    }
    
    private function _show($module){        
        echo $this->show_main($module);
    }
}