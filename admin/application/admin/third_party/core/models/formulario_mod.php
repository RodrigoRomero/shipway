<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');
error_reporting(E_ALL ^ E_NOTICE);

/**
 * @author Rodrigo Romero
 * @version 1.0.0
 * 
 *  TODO: LOG
 */
 

class Formulario_mod extends RR_Model {
    var $table    = 'formularios';
    var $atributo = "formularios";
	public function __construct() {	   
 		parent::__construct();
    }
    
    public function getListado(){
        $this->db->where('tipo_form',$this->params['c']);
        $this->db->order_by('id','DESC');
        $query = $this->db->get_where($this->table,array('status >='=>0));
        
        //CONFIG
        $lnk_del   = set_url(array($this->atributo =>'chk_deletea'));
        $lnk_det   = set_url(array($this->atributo =>'see_detail'));
        
        $html  = "<a class='ax-modal tip-top icon-trash' href='".$lnk_del."/id/{%id%}' data-original-title='Eliminar' style='margin-right:10px'></a>"; 
		$html .= "<a class='ax-modal tip-top icon-eye-open' href='".$lnk_det."/id/{%id%}' data-original-title='Ver Detalle Consulta' style='margin-right:10px'></a>";
        
        $extra[] = array("html" => $html, "pos" => 0);
        $datagrid["columns"][] = array("title" => "", "field" => "", "width" => "46");
        if($this->params['c']=='ctc') {              
            $datagrid["columns"][] = array("title" => "Nombre", "field" => "nombre");
            $datagrid["columns"][] = array("title" => "Email", "field" => "json", 'json'=>'email');
            $datagrid["columns"][] = array("title" => "Teléfono", "field" => "json", 'json'=>'telefono');
        } else {
            $datagrid["columns"][] = array("title" => "Email", "field" => "json", 'json'=>'frmNltr_email');            
        }
        $datagrid["rows"]      = $this->datagrid->query_to_rows($query->result(), $datagrid["columns"], $extra);

        $filter_data = array('new' => set_url(array($this->atributo =>'action', 'iu'=>'i')),
                            );
        
        $filter = ''; //$this->view("filters/".$this->atributo, $filter_data);
        
        $dg = array("datagrid" => $datagrid,
                    "filters"  => $filter);
        $grid = $this->datagrid->make($dg);
        return $grid;
    }
    
     public function set_iu(){
        $data_panel['action'] = set_url(array('configuraciones'=>'do_iu'));
        if(!empty($this->params['id'])){
            $id = $this->params['id'];
            $data_panel['row'] = $this->db->get_where($this->table,array('id'=>$id))->row();
        }
        
        $panel = $this->view("panels/".$this->atributo, $data_panel);
        return $panel;
    }
    
    public function do_iu(){
         #VALIDO FORM POR PHP
         $success = 'false';
         if($this->form_validation->run('Atributos')==FALSE){
            $this->form_validation->set_error_delimiters('<li>', '</li>');
            $responseType = 'function';
            $function     = 'appendFormMessages';
            $messages     = validation_errors();
            $data = array('success' => $success, 'responseType'=>$responseType, 'messages'=>$messages, 'value'=>$function);
         } else {
            $activo = 0;            
            if (isset($_POST['activo'])) $activo = 1;
            
            
            
            $values = array ('nombre'      => $this->input->post('nombre'),
                             'abreviatura' => $this->input->post('abreviatura'),
                             'activo'      => $activo
                             );
                                         
            if(!isset($_POST['id'])){
                $query = $this->db->insert($this->table, $values);
                $this->session->set_flashdata('insert_success', 'Registro Insertado Exitosamente');
            } else {
                $id = $this->input->post('id');
                $this->db->where('id', $id);
				$query = $this->db->update($this->table, $values);
                $this->session->set_flashdata('insert_success', 'Registro Actualizado Exitosamente');
            }
            
            if($query){
                $success = true;
                $responseType = 'redirect';
                
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('pelajes/listado/'));
            }
             
         }
         
         return $data;
    }
    
    public function see_detail(){        
        if(isset($this->params['id']) && !empty($this->params['id'])){
            $id           = $this->params['id'];
            
            $data_panel['row'] = $this->db->get_where($this->table, array('id'=>$id))->row();
            
            $success      = 1;
            $responseType = 'function';
            $data = array('title'   => 'Detalle de la Consulta',
                          'texto'   => $this->view('panels/detalle_formulario',$data_panel)
                        );
            $html         = $this->view('alerts/modal_detail', $data);
            $function     = 'open_modal';
            $data = array('success' => $success, 'responseType'=>$responseType, 'html'=>$html, 'value'=>$function);
        }
        return $data;
    }
    
    public function chk_deletea(){
       return $this->check_deletea();
    }
    
    public function deletea(){
        if(isset($this->params["id"]) || empty($this->params["id"])) {
            $id = $this->params["id"];
            $values = array('status'=>-1);
            $this->db->where('id', $id);
	        $query = $this->db->update($this->table, $values);
            $this->session->set_flashdata('insert_success', 'Registro Eliminado Exitosamente');
            
            if($query){
                $success = true;
                $responseType = 'redirect';                
                $data    = array('success' =>$success,'responseType'=>$responseType, 'value'=>lang_url('formularios/listado/c/'.$this->params['c']));
            }
        }
        return $data;
    }
    

    

}