<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucional extends RR_Controller {
    
    public function Institucional(){
        parent::__construct();
        $this->module_title = 'Institucional';
        $this->load->model("institucional_mod", "Institucional");
        $this->js_view     = array('admin/swfobject');
        $this->widget_view = array('tables' => array('js'=>array('jquery.dataTables.min')),
                                   'validate'=>array('js'=>array('jquery.validate','messages_es')),
                                   'shadowbox'=>array('css'=>array('shadowbox'), 'js'=>array('shadowbox'))
                                   );
    
        //$this->output->enable_profiler(TRUE);
    }
    
    public function index(){}
    
    public function listado(){        
        $this->breadcrumb->addCrumb($this->module_title,'');
        $this->breadcrumb->addCrumb('Listado','','current');        
        $module = $this->Institucional->getListado();
        $this->_show($module);
    }
    
    public function action($id=null){
        if(checkParam($this->params['iu'])){
            $this->breadcrumb->addCrumb($this->module_title, lang_url('institucional/listado'));
            if(!empty($this->params['id'])) {
                $this->breadcrumb->addCrumb('Editar','','current');    
            } else {
                $this->breadcrumb->addCrumb('Nuevo','','current');
            }
            
        } else {
            show_error('Ups la página que buscas no existe',301,'Ups');
        }
        $module = $this->Institucional->set_iu();
        $this->_show($module);     
    }
    
    public function do_iu(){
        $return = $this->Institucional->do_iu();
        echo json_encode($return);
    }
    
    public function getUploads(){
        echo json_encode($this->setUploads());
    }
    private function _show($module){        
        echo $this->show_main($module);
    }
}