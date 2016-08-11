<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.1
 */

class RR_Model extends CI_Model
{
    var $Clang;
    var $today;
    var $i;
    var $params;
    var $sistema_id;
    var $langs; 
    public function __construct()
    {
        parent::__construct();
        $this->Clang = config_item("language");
        $this->today = date('Y-m-d H:i:s');
        $this->i = array("fa"  => date('Y-m-d H:i:s'), "status"=>1);  
        $this->params = $this->uri->uri_to_assoc(1);
        $this->sistema_id = get_session('sistema_id',false);
        $this->langs = $this->config->item("languages"); 
        
    }
    public function view($view, $vars = array(), $return = true)
    {
        $vars["Clang"] = $this->Clang;
        return $this->load->view($view, $vars, $return) . "\n";
    }
    
    function post_lang($str, $lang){
        return (!empty($_POST[$str.'_'.$lang])) ? $this->input->post($str.'_'.$lang) : $this->input->post($str.'_'.$this->langs[0]);
    }
    
    public function _getAtributos($id, $child=NULL){        
        $this->db->select("id, nombre, status, json");
        if(is_null($child)){
            $return = $this->db->get_where("atributos", array("status >="=>0, "id >" => ($id*10000), "id <" => (($id+1)*10000) ))->result();
        } else {
            $return = $this->db->get_where("atributos", array("status >="=>0, "id" => $child, 'padre_id'=>$id))->row();
        }
        return $return;
    }
    
    public function check_deletea(){        
        if(isset($this->params['id']) && !empty($this->params['id'])){
            $id = $this->params['id'];
            $success      = 1;
            $responseType = 'function';
            $data = array('title'   => 'Eliminar Registo',
                          'texto'   => 'Estas seguro que deseas eliminar este registro ?',
                          'link'    => set_url(array($this->atributo=>'deletea', 'c'=>$this->params['c'], 'id'=>$id)),                 
                    );
            $html         = $this->view('alerts/modal_dialog', $data);
            $function     = 'open_modal';
            $data = array('success' => $success, 'responseType'=>$responseType, 'html'=>$html, 'value'=>$function);
        }
        return $data;
    }
    
    
   
}