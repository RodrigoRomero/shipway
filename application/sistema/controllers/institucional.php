<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Institucional extends RR_Controller {
    
    public function Institucional(){
        parent::__construct();        
        $this->load->model('Institucional_mod','Institucional');
        //$this->output->enable_profiler(TRUE);
    }

	public function index(){
	   redirect(lang_url());
       die;
	}
    
    public function contacto(){        
        $module = $this->view('institucional/contacto');
        $this->_show($module);
    }
    
    public function hseq(){
        $view = 'hseq_'.$this->Clang;
        $module = $this->view('institucional/'.$view);
        $this->_show($module);
    }
    
    public function soluciones(){
        $view = 'soluciones_'.$this->Clang;
        $module = $this->view('institucional/'.$view);
        $this->_show($module);
    }
    
    public function empresa(){
        $view = 'empresa_'.$this->Clang;
        $module = $this->view('institucional/'.$view);
        $this->_show($module);
    }
    
    public function por_que_shipway(){
        $view = 'porque_'.$this->Clang;
        $module = $this->view('institucional/'.$view);        
        $this->_show($module);
    }
    
    public function global_network(){
        $module = $this->view('institucional/global');
        $this->_show($module);
    }
    public function do_suscription(){
        $data = $this->Institucional->do_suscription();
        echo json_encode($data);
    }
    
    public function do_contacto(){
        $data = $this->Institucional->do_contacto();
        echo json_encode($data);
    }
 
    private function _show($module){        
        echo $this->show_main($module);
    }
}