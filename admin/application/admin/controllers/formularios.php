<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Formularios extends RR_Controller {
    
    public function Formularios(){
        parent::__construct();
        $this->module_title = 'Formularios';
        $this->load->model("formulario_mod", "Formulario");
        $this->widget_view = array('tables' => array('js'=>array('jquery.dataTables.min','extras'))
                                   );
    
        //$this->output->enable_profiler(TRUE);
    }
    
    public function index(){}
    
    public function listado(){        
        $this->breadcrumb->addCrumb($this->module_title,'');
        $this->breadcrumb->addCrumb('Listado','','current');        
        $module = $this->Formulario->getListado();
        $this->_show($module);
    }
    
    public function action($id=null){
        if(checkParam($this->params['iu'])){
            $this->breadcrumb->addCrumb($this->module_title, lang_url('configuraciones/listado'));
            if(!empty($this->params['id'])) {
                $this->breadcrumb->addCrumb('Editar','','current');    
            } else {
                $this->breadcrumb->addCrumb('Nuevo','','current');
            }
            
        } else {
            show_error('Ups la página que buscas no existe',301,'Ups');
        }
        $module = $this->Configuracion->set_iu();
        $this->_show($module);     
    }
    
    public function see_detail(){
        $return = $this->Formulario->see_detail();
        echo json_encode($return);
    }
    
    public function chk_deletea(){
        $return = $this->Formulario->chk_deletea();
        echo json_encode($return);
    }
    
    public function deletea(){
        $return = $this->Formulario->deletea();
        echo json_encode($return);
    }
    
    
  
    private function _show($module){        
        echo $this->show_main($module);
    }
}