<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Configuraciones extends RR_Controller {
    
    public function Configuraciones(){
        parent::__construct();
        $this->module_title = 'Configuración del Sistema';
        $this->load->model("configuracion_mod", "Configuracion");
        $this->widget_view = array('tables' => array('js'=>array('jquery.dataTables.min','extras')),
                                   'validate'=>array('js'=>array('jquery.validate','messages_es'))
                                   );
    
        //$this->output->enable_profiler(TRUE);
    }
    
    public function index(){}
    
    public function listado(){        
        $this->breadcrumb->addCrumb($this->module_title,'');
        $this->breadcrumb->addCrumb('Listado','','current');        
        $module = $this->Configuracion->getListado();
        $this->_show($module);
    }
    
    public function action($id=null){
        if(checkParam($this->params['iu'])){
            $module = $this->Configuracion->set_iu();
        } else {
            show_error('Ups la página que buscas no existe',301,'Ups');
        }
        
        $this->_show($module);     
    }
    
    public function do_iu(){
        $return = $this->Configuracion->do_iu();
        echo json_encode($return);
    }
    
    
  
    private function _show($module){        
        echo $this->show_main($module);
    }
}